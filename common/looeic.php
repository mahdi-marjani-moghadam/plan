<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:33 AM
 */

include_once ROOT_DIR . 'common/GUMP-master/gump.class.php';
include_once ROOT_DIR . 'common/chainquerybuilder.class.php';


class looeic extends DB
{
    protected $fields;
    protected $TABLE_FIELD;
    protected $rules;
    private $extendClass;
    protected $PRI_KEY = '';
    protected $TABLE_NAME;
    protected $GUARDED;

    private $err;
    private $list;
    private $relation;
    private $keyBy = '';
    private $overWrite = 1;

    //query
    //private $_operation = '';
    //private $_where = array();
    //private $_useWhere = 0;

    private $selectFields;
    private $select;
    private $finalQuery = '0';
    private $config = '';


    public function hasOne($model, $key, $local_key, $component)
    {
        return $this->hasAll($model, $key, $local_key, $component)->first();
    }

    public function hasMany($model, $key, $local_key, $component)
    {
        return $this->hasAll($model, $key, $local_key, $component);
    }

    private function hasAll($model, $foreign_key, $local_key, $component)
    {
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        $this->appendFields();
        if ($component != '') {
            $componenetAdress = ROOT_DIR . "component/" . $component . "/" . $component . ".php";
            include_once $component;
        }

        $funcName = getBy . '_' . $foreign_key;

        $val = $this->fields[$this->PRI_KEY];
        $this->relation[$model] = $model::$funcName($val);

        return $this->relation[$model];
    }

    public function belongTo($model, $key, $local_key, $component)
    {
        $this->appendFields();
        if ($component != '') {
            //$componenetAdress = ROOT_DIR."component/".$component."/".$component.".php";
            include_once $component;
        }
        $temp = new $model();
        $prikey = $temp->getPriKey();
        $funcName = getBy . '_' . $prikey;
        $val = $this->fields[$key];

        $this->relation[$model] = $model::$funcName($val);


        return $this->relation[$model];
    }

    public function hasLeft($model, $key, $component)
    {

        $this->appendFields('*', 1);
        //echo '****************';

        $conn = dbConn::getConnection();
        $stmt = $conn->prepare($this->sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        $row = $stmt->fetch();

        //print_r_debug($row['ALL_IDS']);
        if ($component != '') {
            $componenetAdress = ROOT_DIR . "component/" . $component . "/" . $component . ".php";
            include_once $componenetAdress;
        }
        $funcName = getBy . '_' . $key;
        $val = explode(" ", $row['ALL_IDS']);

        $this->relation[$model] = $model::$funcName($val);

        return $this->relation[$model];
    }

    public function __construct($fields = '')
    {

        $conf = looeicConfig;
        if ($conf == 'api') {
            $this->config = looeicConfig::getConfig();
        }
        $input = func_get_args();

        if ($input[1] != '') {

            $this->getTableName($input[1]);
        }
        $this->getFieldsName();
        if ($fields != '') {
            $this->setFields($fields);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (strpos($name, 'getBy') === 0) {
            return self::getby($name, $arguments);
        }
    }

    function __call($name, $arguments)
    {
        // setExtendClass
        if ($name == 'setExtendClass') {
            $this->extendClass = $arguments[0];
        }
        if ($name == 'findModel') {
            return $this->findModel($arguments[0]);
        }
        if ($name == 'getbyModel') {
            return $this->getbyModel($arguments[0], $arguments[1]);
        }

        // TODO: Implement __call() method.
        //print_r($name);
        //print_r($arguments);
        //echo '__call';
    }

    function validator($rules, $fields)
    {

        if (!isset($rules)) {
            $rules = $this->rules;
        }
        if (!isset($fields)) {
            $fields = $this->fields;
        }

        if (count($rules) < 1) {
            $result['result'] = '1';

            return $result;
        }


        $validator = new GUMP();
        $valid = $validator->validate($fields, $rules);
        $this->err = $validator->get_errors_array();
        $result = $this->err;
        if (count($this->err)) {
            $result['result'] = '-1';
        } else {
            $result['result'] = '1';
        }

        return $result;
    }

    function getErr()
    {
        return $this->err;
    }


    /*function limit($limit,$offset=0)
    {
        if($offset==0)
        {
            $this->sql .= " limit $limit";
        }else
        {
            $this->sql .= " limit $limit,$offset";
        }
        return $this;
    }*/

    static function query($sql)
    {
        $className = get_called_class();
        $obj = new $className('', get_called_class());
        $obj->getFieldsName();

        $obj->sql .= $sql;
        $obj->finalQuery = 1;

        return $obj;
    }

    /////////////
    function first()
    {
        $conn = dbConn::getConnection();

        $this->sql = $this->build();

        if (strlen($this->sql) < 1) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';

            return $result;
        }

        //$this->appendFields();

        $conn = dbConn::getConnection();

        $stmt = $conn->prepare($this->sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        if (!$stmt->rowCount()) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';

            return $result;
        }
        $row = $stmt->fetch();


        //$extendClass=$this->extendClass;
        $temp_object = $this->findModel($row[$this->PRI_KEY]);

        //$temp_object=$this->extendClass::find($conn->lastInsertId());
        return $temp_object;
    }


    public function keyBy($key, $overWrite = 1)
    {
        $this->keyBy = $key;
        if ($overWrite == 0) {
            $this->overWrite = 0;
        }

        return $this;
    }
    public function appendRelation($field, $internal)
    {
        $this->_appendRelation['external'] = $field;
        $this->_appendRelation['internal'] = $internal;
        return $this;
    }
    public function append($field, $internal)
    {
        $this->_appendRelationAll['external'] = $field;
        $this->_appendRelationAll['internal'] = $internal;
        return $this;
    }
    private function get_object_or_list_api($object = 1, $key)
    {
        $result['data'] = array();


        if (strlen($this->sql) < 1) {
            $this->sql = $this->build();
        } else {
            if (isset($this->PageConfig['perPage'])) {
                $statement = array();
                $this->_buildLimit($statement);
                $limitPage = implode(' ', $statement);
                $this->sql = $this->sql . $limitPage;
            }
        }
        if (strlen($this->sql) < 1) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';

            return $result;
        }
        $conn = dbConn::getConnection();


        $stmt = $conn->prepare($this->sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        $result['result'] = 1;

        if (isset($this->PageConfig['perPage'])) {

            $sql = " SELECT FOUND_ROWS() as recCount ";

            $stmTp = $conn->prepare($sql);
            $stmTp->setFetchMode(PDO::FETCH_ASSOC);
            $stmTp->execute();
            $rowP = $stmTp->fetch();
            $result['recordsCount'] = (int) $rowP['recCount'];

            $result['meta']['total'] = (int) $rowP['recCount'];
            $result['meta']['current_page'] = $this->PageConfig['currentPage'];
            $result['meta']['per_page'] = $this->PageConfig['perPage'];
            $result['meta']['from'] = $this->PageConfig['start'] + 1;
            $result['meta']['to'] = $this->PageConfig['end'];
            if ($result['meta']['to'] > $result['meta']['total']) {
                $result['meta']['to'] = $result['meta']['total'];
            }
            //$result['export']['paginate']['count_buttom']=10;


            /* $a=paginationButtom($result['export']['paginate']['total'],
                 3,
                 $result['export']['paginate']['per_page']);*/


            if ($this->PageConfig['link'] === 1) {
                //$temp=$this->links($result['export']['paginate']);
                //$result['export']['links']=

            }
            //print_r_debug($result);

            /*//function
            $r= paginationButtom($result['export']['paginate']['total'],10,
                $countButtom = 10,$result['export']['paginate']['per_page']);

            $result['export']['link']=$r['export']['list'];*/
        } else {
            $result['recordsCount'] = $stmt->rowCount();
        }
        $key = '';
        if ($this->keyBy != '') {

            if ($this->keyBy == 'PRI') {
                $key = $this->getPriKey();
            } else {
                $key = $this->keyBy;
            }
        }

        if ($object == 1) {


            while ($row = $stmt->fetch()) {

                //$temp_object = $this->findModel($row[ $this->PRI_KEY ]);

                $temp_object = clone ($this);
                // print_r_debug($row);
                $temp_object->fields = $row;
                //print_r_debug($temp_object);

                //$temp_object = $this->findModel($row[$this->PRI_KEY]);

                if ($key != '') {
                    if ($this->overWrite == 0) {
                        $result['data'][$temp_object->$key][] = clone ($temp_object);
                    } else {
                        $result['data'][$temp_object->$key] = clone ($temp_object);
                    }
                } else {
                    $result['data'][] = clone ($temp_object);
                }
            }
        } else {
            while ($row = $stmt->fetch()) {

                if ($this->_appendRelationAll != '') {

                    $row = $this->_appendRelationAll['external']['formatter']($row, $this->_appendRelationAll['internal']);
                }

                if ($this->_appendRelation != '') {

                    foreach ($this->_appendRelation['external'] as $appendKey => $func) {
                        $row[$appendKey] = $this->_appendRelation['external'][$appendKey]['formatter']($row, $this->_appendRelation['internal']);
                    }
                }

                if ($key != '') {
                    if ($this->overWrite == 0) {
                        $result['data'][$row[$key]][] = $row;
                    } else {
                        $result['data'][$row[$key]] = $row;
                    }
                } else {
                    $result['data'][] = $row;
                }
            }
        }

        // print_r_debug($result);
        return $result;
    }

    private function get_object_or_list($object = 1, $key = '')
    {
        
        if (strlen($this->sql) < 1) {
            $this->sql = $this->build();
        }
        
        if (strlen($this->sql) < 1) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';

            return $result;
        }
        $conn = dbConn::getConnection();

            //    print_r($this->sql);
        

        $stmt = $conn->prepare($this->sql);
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $stmt->execute();
        
        
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        if (isset($this->PageConfig['perPage'])) {

            $sql = " SELECT FOUND_ROWS() as recCount ";

            $stmTp = $conn->prepare($sql);
            $stmTp->setFetchMode(PDO::FETCH_ASSOC);
            $stmTp->execute();
            $rowP = $stmTp->fetch();
            $result['export']['meta']['total'] = $rowP['recCount'];
            $result['export']['meta']['current_page'] = $this->PageConfig['currentPage'];
            $result['export']['meta']['per_page'] = $this->PageConfig['perPage'];
            $result['export']['meta']['from'] = $this->PageConfig['start'] + 1;
            $result['export']['meta']['to'] = $this->PageConfig['end'];
            //$result['export']['paginate']['count_buttom']=10;


            /* $a=paginationButtom($result['export']['paginate']['total'],
                 3,
                 $result['export']['paginate']['per_page']);*/


            if ($this->PageConfig['link'] === 1) {
                //$temp=$this->links($result['export']['paginate']);
                //$result['export']['links']=

            }
            //print_r_debug($result);

            /*//function
            $r= paginationButtom($result['export']['paginate']['total'],10,
                $countButtom = 10,$result['export']['paginate']['per_page']);

            $result['export']['link']=$r['export']['list'];*/
        }
        $result['export']['recordsCount'] = $stmt->rowCount();
        $key = '';
        if ($this->keyBy != '') {

            if ($this->keyBy == 'PRI') {
                $key = $this->getPriKey();
            } else {
                $key = $this->keyBy;
            }
        }
        if ($object == 1) {


            while ($row = $stmt->fetch()) {

                //$temp_object = $this->findModel($row[ $this->PRI_KEY ]);

                $temp_object = clone ($this);
                
                // print_r_debug($row);
                $temp_object->fields = $row;
                
                //print_r_debug($temp_object);
                //$temp_object = $this->findModel($row[$this->PRI_KEY]);
                

                if ($key != '') {
                    if ($this->overWrite == 0) {
                        $result['export']['list'][$temp_object->$key][] = clone ($temp_object);
                    } else {
                        $result['export']['list'][$temp_object->$key] = clone ($temp_object);
                    }
                } else {
                    
                    $result['export']['list'][] = clone ($temp_object);
                }
            }
        } else {
            while ($row = $stmt->fetch()) {

                if ($key != '') {
                    if ($this->overWrite == 0) {
                        $result['export']['list'][$row[$key]][] = $row;
                    } else {
                        $result['export']['list'][$row[$key]] = $row;
                    }
                } else {
                    $result['export']['list'][] = $row;
                }
            }
        }

        $result['result'] = 1;

        //print_r_debug($r);
        return $result;
    }
    function links($config)
    {


        $recordCount = $config['total'];
        $pageSize = $config['per_page'];
        $countButtom = $config['count_buttom'];

        //$result['export']['paginate']['current_page'] = $this->PageConfig['currentPage'];

        //$result['export']['paginate']['from'] = $this->PageConfig['start']+1;
        //$result['export']['paginate']['to'] = $this->PageConfig['end'];



        global $page, $PARAM;

        if ((settype($pageSize, "integer")) <= 0) {
            $pageSize = 10;
        }

        if ($pageSize <= 0 || trim($pageSize) == '') {
            return $result['result'] = 1;
        }
        if (($countButtom != 0) and ($recordCount != 0)) {
            $pageCount = ceil($recordCount / PAGE_SIZE);
            $pagination = array();
            $pAddress = implode('/', $PARAM);
            $pAddress .= '/';

            if (!isset($page)) {
                $page = 1;
            }

            $fPagination = 0;
            $lPagination = 0;

            $num = $countButtom;
            if ($pageCount < $num) {
                $fPagination = 1;
                $lPagination = $pageCount;
                $nPage = false;
                $pPage = false;
            } elseif ($page == 1) {
                $fPagination = 1;
                $lPagination = $num;
                $nPage = true;
                $pPage = false;
            } elseif (($pageCount == $page)) {
                $fPagination = $pageCount - ($num - 1);
                $lPagination = $pageCount;
                $nPage = false;
                $pPage = true;
            } else {
                $fPagination = $page - floor($num / 2);
                if (($num % 2) == 0) {
                    $lPagination = $page + ((floor($num / 2)) - 1);
                } else {
                    $lPagination = $page + ((floor($num / 2)));
                }
                $nPage = true;
                $pPage = true;
                if ($fPagination <= 0) {
                    $fPagination = 1;
                    $lPagination = $num;
                } elseif ($pageCount < $lPagination) {
                    $fPagination = $pageCount - (($num - 1));
                    $lPagination = $pageCount;
                }
            }

            for ($i = $fPagination; $i <= $lPagination; $i++) {
                if (($i == $fPagination) and ($pPage == true)) {
                    $pagination[] = [address => $pAddress . 'page/' . ($page - 1), label => ">", number => $i];
                    $pPage == false;
                }
                if ($page == $i) {
                    $activePage = " activePage";
                } else {
                    $activePage = "";
                }
                $pagination[] = [address => $pAddress . 'page/' . $i, number => $i, label => $i, "activePage" => $activePage];
                if (($i == $lPagination) and ($nPage == true)) {
                    $pagination[] = [address => $pAddress . 'page/' . ($page + 1), label => "<", number => $i];
                    $pPage == false;
                }
            }
        } else {
            $result['result'] = -1;
            $result['export']['list'] = '';

            return $result;
        }
        $result['result'] = 1;
        $result['export']['list'] = $pagination;
        $result['export']['pageCount'] = $pageCount;
        $result['export']['rowCount'] = $recordCount;

        //print_r_debug($pageCount);
        return $result;
    }


    public function get($key = '')
    {

        /*if ( strlen($this->sql) < 1 ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';
            return $result;
        }*/

        //$this->appendFields();

        return $this->get_object_or_list(1, $key);
    }

    public function getList($key = '')
    {
        /*if ( strlen($this->sql) < 1 ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';
            return $result;
        }*/
        //$this->appendFields();


        if ($this->config['export_type'] == 'api') {
            return $this->get_object_or_list_api(0, $key);
        }
        return $this->get_object_or_list(0, $key);
    }


    function appendFields($field = '*', $concat = 0)
    {

        if ($this->finalQuery == '0') {
            if ($concat == 1) {
                $this->sql = " SELECT Group_Concat( " . $this->PRI_KEY . ") AS ALL_IDS " . $this->sql;
            } else {

                $this->selectFields = " * ";
                $this->sql = " SELECT " . $this->selectFields . $this->sql;
            }
        }
    }

    public function getPriKey()
    {
        return $this->PRI_KEY;
    }


    public static function getAll()
    {

        $className = get_called_class();
        $obj = new $className('', get_called_class());
        $obj->getFieldsName();


        //$obj->_operation='SELECT';
        //$obj->select();
        //$appendSql = '';
        $obj->getFieldsName();
        //$sql = " FROM " . $obj->TABLE_NAME . " ";
        //$obj->sql = $sql;
        //$obj->_useWhere=1;

        return $obj;
    }

    private function getbyModel($name, $arguments)
    {

        $name = substr($name, 6);

        $a = preg_match_all('/(?J)(?<or>_or_)|(?<and>_and_)/', $name, $matches);

        $ready = str_replace(["_or_", "_and_"], '_or_', $name);
        $filter_fields = explode('_or_', $ready);
        //print_r($matches);

        $appendSql = '';
        foreach ($filter_fields as $key => $fields) {


            //print_r_debug($fields);
            $operator = ' = ';
            if (strpos($fields, 'not_') === 0) {
                $fields = substr($fields, 4);
                $operator = '<>';
            }
            $sqlFields = '`' . $fields . '`';

            $arrayInput = '';
            if (is_array($arguments[$key])) {
                if ($operator == '<>') {
                    $operator = ' NOT ';
                } else {
                    $operator = '';
                }

                $operatorName = $matches[0][$key - 1];

                if (strlen($operatorName > 0)) {
                    $funcName = str_replace('_', '', $matches[0][$key]) . 'Where';
                } else {

                    $funcName = 'Where';
                }

                $operator = trim($operator . 'in');
                $arrain = $arguments[$key];

                $this->$funcName($sqlFields, $operator, $arguments[$key]);

                //$arrayInput = implode(" ", $arguments[$key]);
                // echo 'a';
                // print_r_debug($arguments[$key]);
                $arrayInput = "'" . $arrayInput . "'";

                //$appendSql .= "`" . $fields . "` $operator in (" . $arrayInput . ") " . str_replace('_', ' ', $matches[0][$key]) . " ";

            } else {
                //$appendSql .= "`" . $fields . "` " . $operator ." '" . $arguments[$key] . "' " . str_replace('_', ' ', $matches[0][$key]) . " ";

                $funcName = str_replace('_', '', $matches[0][$key - 1]) . 'Where';

                $operator = trim($operator);

                $this->$funcName($sqlFields, $operator, $arguments[$key]);
            }
        }
        $this->getFieldsName();
        //$sql = " FROM " . $this->TABLE_NAME . " WHERE " . $appendSql . " ";
        //$this->sql = $sql;

        return $this;
    }

    static private function getby($name, $arguments)
    {
        $className = get_called_class();

        $obj = new $className('', get_called_class());
        $obj->getFieldsName();

        $obj->getbyModel($name, $arguments);

        //$obj->_useWhere=1;

        return $obj;
    }

    function getFieldsName()
    {

        $this->TABLE_NAME = $this->getTableName(get_called_class());

        if (!is_array($this->TABLE_FIELD)) {
            $conn = dbConn::getConnection();
            $sql = "SHOW COLUMNS FROM " . $this->TABLE_NAME . " ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if (!$stmt) {
                $result['result'] = -1;
                $result['Number'] = 1;
                $result['msg'] = $conn->errorInfo();

                return $result;
            }

            while ($row = $stmt->fetch()) {
                //$stmt->rowCount();
                $this->TABLE_FIELD[$row['Field']] = '';
                if ($row['Key'] == 'PRI' and $this->PRI_KEY == '') {
                    $this->PRI_KEY = $row['Field'];
                }
            }
        }
    }

    private function checkMysqlValue($value)
    {

        if (strpos($value, 'callMysql') === 0) {
            $return = trim(substr($value, 9));
            $return = trim(substr($return, 1, (strlen($return) - 2)));

            return $return;
        } else {
            return "'" . $value . "'";
        }
    }

    function __set($name, $value)
    {
        $value = trim($value);
        $this->getFieldsName();
        if (!array_key_exists($name, $this->TABLE_FIELD)) {
            return;
        }
        $this->fields[$name] = $value;
    }

    public function __get($name)
    {
        $this->getFieldsName();
        if ($name == 'fields') {
            return $this->fields;
        } elseif (array_key_exists($name, $this->fields)) {
            return $this->fields[$name];
        } elseif (is_callable([$this, $name])) {
            return $this->$name();
        }
    }

    public function setFields($fields, $guarded = 1)
    {

        foreach ($this->TABLE_FIELD as $field_name => $val) {
            // print_r_debug($this->PRI_KEY);
            if ($field_name == $this->PRI_KEY) {
                continue;
            }
            if ($guarded == 1) {
                if (in_array($field_name, $this->GUARDED)) {
                    continue;
                }
            } elseif (is_array($guarded)) {
                if (in_array($field_name, $guarded)) {
                    continue;
                }
            }
            if (array_key_exists($field_name, $fields)) {
                $this->fields[$field_name] = $fields[$field_name];
            }
        }
        $result['result'] = 1;

        //print_r_debug($fields);
        return $result;
    }

    public function getByFilter($fields = array(), $query = '')
    {

        //$obj->TABLE_NAME=get_called_class();
        $this->getTableName(get_called_class());
        $conn = dbConn::getConnection();
        include_once(ROOT_DIR . "/model/db.inc.class.php");
        $condition = DataBase::filterBuilder($fields);

        if ($query != '') {
            $sql = "SELECT SQL_CALC_FOUND_ROWS
                `t1`.* FROM( $query ) as t1 " .
                $condition['list']['useWhere'] .
                $condition['list']['WHERE'] . $condition['list']['filter'] .
                $condition['list']['order'] . $condition['list']['limit'];
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS
                 *
    		     FROM 	" . $this->TABLE_NAME . " " . $condition['list']['useWhere'] .
                $condition['list']['WHERE'] . $condition['list']['filter'] .
                $condition['list']['order'] . $condition['list']['limit'];
        }


        $stmt = $conn->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        //print_r_debug($stmt);
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $sql = " SELECT FOUND_ROWS() as recCount ";

        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();

        $result['export']['recordsCount'] = $rowP['recCount'];

        while ($row = $stmt->fetch()) {
            $list[] = $row;
        }
        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }


    private function getTableName($className)
    {

        if ($this->TABLE_NAME != '') {
            //$this->_tables[]=$this->TABLE_NAME;
            $this->from($this->TABLE_NAME);

            return $this->TABLE_NAME;
        }
        $this->extendClass = $className;
        if (strpos($className, 'admin') == 0 and strpos($className, 'Model')) {

            $return = substr($className, 5, strlen($className) - 10);
            $return = strtolower($return);
            $this->TABLE_NAME = $return;
            $this->from($this->TABLE_NAME);

            return $return;

            //echo  strpos($className,'admin');
            //echo  strpos($className,'Model');
        } else {
            $this->TABLE_NAME = $className;
            $this->from($this->TABLE_NAME);

            //$this->_tables[]=$this->TABLE_NAME;
            return $className;
        }
    }

    public function save()
    {
        if ($this->fields[$this->PRI_KEY] == '') {
            if ($this->_operation == 'SELECT') {
                die('SELECT PRIMERI KEY TO CHANGE :D ');
            }
            $this->insert();
        } else {
            $this->updateModel();
        }
        $result['result'] = 1;

        return $result;
    }

    private function insert($fields = '')
    {
        $sql_key = '';
        $sql_val = '';
        foreach ($this->fields as $key => $value) {
            if (array_key_exists($key, $this->TABLE_FIELD)) {
                $sql_key .= "`" . $key . "`,";
                $sql_val .= $this->checkMysqlValue($value) . ',';
            }
        }
        $sql_key = substr($sql_key, 0, -1);
        $sql_val = substr($sql_val, 0, -1);

        $conn = dbConn::getConnection();
        $sql = "
                    INSERT INTO " . $this->TABLE_NAME . "( " . $sql_key . " ) VALUES ( " . $sql_val . " ) ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $this->fields[$this->PRI_KEY] = $conn->lastInsertId();
        $result['export']['insert_id'] = $conn->lastInsertId();
        $result['result'] = 1;
        $extendClass = $this->extendClass;
        $key = $this->PRI_KEY;
        $conn->lastInsertId();

        //$temp_object=$extendClass::find($conn->lastInsertId());

        //$temp_object=$this->extendClass::find($conn->lastInsertId());
        //$this->fields=$temp_object->fields ;
        return $result;
    }

    /**
     * @param $fields
     * @param $where
     * @return mixed
     */
    public static function update($fields, $where)
    {

        $input = func_get_args();

        $className = get_called_class();
        $tableName = $className;

        $obj = new $className('', $tableName);
        $obj->getFieldsName();


        $sql_key = '';
        $sql_val = '';
        $sql_key_val = '';
        foreach ($fields as $key => $value) {
            if ($key == $obj->PRI_KEY) {
                continue;
            }
            if (array_key_exists($key, $obj->TABLE_FIELD)) {
                $sql_key = "`" . $key . "` ";

                $sql_val = $obj->checkMysqlValue($value);

                $sql_key_val .= $sql_key . ' = ' . $sql_val . ',';
            }
        }

        $sql_key_val = substr($sql_key_val, 0, -1);

        $conn = dbConn::getConnection();
        $sql = " UPDATE " . $obj->TABLE_NAME . " SET " . $sql_key_val . " 
         WHERE " . $where . " ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $result['result'] = 1;

        return $result;
    }

    private function updateModel($fields = array())
    {
        $sql_key = '';
        $sql_val = '';

        $sql_key_val = '';
        foreach ($this->fields as $key => $value) {
            if ($key == $this->PRI_KEY) {
                continue;
            }


            if (array_key_exists($key, $this->TABLE_FIELD)) {
                $sql_key = "`" . $key . "` ";
                $sql_val = $this->checkMysqlValue($value);
                $sql_key_val .= $sql_key . ' = ' . $sql_val . ',';
            }
        }
        //$sql_key_val .= $sql_key.' = '.$sql_val.' ,';

        $sql_key_val = substr($sql_key_val, 0, -1);

        $conn = dbConn::getConnection();
        $sql = " UPDATE " . $this->TABLE_NAME . " SET " . $sql_key_val . " 
         WHERE " . $this->PRI_KEY . " = '" . $this->fields[$this->PRI_KEY] . "' ";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $result['result'] = 1;

        return $result;
    }


    public function delete()
    {
        if ($this->fields[$this->PRI_KEY] == '') {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';

            return $result;
        }
        $conn = dbConn::getConnection();
        $sql = " DELETE FROM " . $this->TABLE_NAME . "  WHERE " . $this->PRI_KEY . " = '" . $this->fields[$this->PRI_KEY] . "' ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        $result['result'] = 1;

        return $result;
    }

    private function findModel($id)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT
                *
            FROM " .
            $this->TABLE_NAME
            . " WHERE " .
            $this->PRI_KEY . " = '$id' ";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //print_r_debug($stmt);
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        if (!$stmt->rowCount()) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';

            return $result;
        }
        $row = $stmt->fetch();

        //print_r_debug($row);
        $result['result'] = 1;
        $result['list'] = $row;
        $this->fields = $row;
        //$this->setFields($row);
        // print_r_debug($this);

        return $this;
    }

    static function find($id)
    {
        $input = func_get_args();

        $className = get_called_class();
        $tableName = $className;

        $obj = new $className('', $tableName);
        $obj->getFieldsName();

        $obj = $obj->findModel($id);

        return $obj;
    }

    static function create($fields)
    {
        $className = get_called_class();
        $obj = new $className($fields, $className);
        //print_r_debug($obj);
        $obj->save();

        return $obj;
    }
}

class modelt
{
    protected $TABLE_NAME;
    protected $fields;
    protected $rules;
    protected static $obj;

    public function __construct($table, $fields = '', $rules = '')
    {

        $conf = looeicConfig;
        if ($conf == 'api') {
            $this->config = looeicConfig::getConfig();
        }
        $this->TABLE_NAME = $table;
        $this->setExtendClass('model');
        if (is_array($fields)) {
            $this->fields = $fields;
        }
        if (is_array($rules)) {
            $this->rules = $rules;
        }
        parent::__construct('', $table);
        $obj = $this;
    }

    static function find($table, $id)
    {
        $obj = new model($table);

        return $obj->findModel($id);
    }


    public static function __callStatic($name, $arguments)
    {
        if (strpos($name, 'getBy') === 0) {
            return self::getby($name, $arguments);
        }

        return parent::__callStatic($name, $arguments);
    }

    static function getby($name, $arguments)
    {

        $table = $arguments[0];
        $obj = new model($table);
        array_shift($arguments);
        $obj->getbyModel($name, $arguments);

        return $obj;
    }
}
