<?php
/**
 * ChianQueryBuilder
 *
 * Copyright (c) 2010 BarsMaster
 * e-mail: barsmaster@gmail.com, arthur.borisow@gmail.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author BarsMaster
 * @copyright 2010
 * @version 1.1.1
 * @access public
 */
class DB {
    protected $_operation = '';
    private $_fields = array();
    private $_values = array();
    protected $_tables = array();

    protected $_join = array();
    protected $_using = '';
    protected $_raw = 0;

    private $_on = array();

    protected $_where = array();
    protected $_limit = 0;
    private $_offset = 0;
    private $sub = 0;


    protected $_orderBy = array();
    protected $_order = 'ASC';
    protected $_groupBy = array();
    protected $_useWhere = 0;
    protected $sql;



    public function beginTransaction( )
    {
        $conn = dbConn::getConnection();
        $conn->beginTransaction();

    }
    public function rollback( )
    {
        $conn = dbConn::getConnection();
        $conn->rollBack();

    }
    public function commit( )
    {
        $conn = dbConn::getConnection();
        $conn->commit();
    }



    private function get_object_or_list( $object = 1,$key )
    {


        if(strlen($this->sql)<1)
        {
            $this->sql=$this->build();
        }
        if ( strlen($this->sql) < 1 ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';
            return $result;
        }
        $conn = dbConn::getConnection();



        $stmt = $conn->prepare($this->sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ( !$stmt ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['export']['recordsCount'] = $stmt->rowCount();
        if ( $object == 1 ) {
            while ($row = $stmt->fetch()) {
                if(isset($key))
                {
                    if($key=='PRI')
                    {
                        $key=$this->getPriKey();

                    }
                    $result['export']['list'][$row[$key]] = (object) $row;
                }else
                {
                    $result['export']['list'][] =(object) $row;
                }
            }

        } else {
            while ($row = $stmt->fetch()) {

                if(isset($key))
                {
                    if($key=='PRI')
                    {
                        $key=$this->getPriKey();
                    }
                    $result['export']['list'][$row[$key]] = $row;
                }else
                {
                    $result['export']['list'][] = $row;
                }

            }
        }

        $result['result'] = 1;
        return $result;

    }

    public function get($key='')
    {

        /*if ( strlen($this->sql) < 1 ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';
            return $result;
        }*/

        //$this->appendFields();

        return $this->get_object_or_list(1,$key);
    }

    public function getList($key='')
    {
        /*if ( strlen($this->sql) < 1 ) {
            $result['result'] = - 1;
            $result['Number'] = 1;
            $result['msg'] = 'not found';
            return $result;
        }*/
        //$this->appendFields();

        return $this->get_object_or_list(0,$key);

    }

    function orderBy( $field, $order = 'ASC' )
    {
        $this->_orderBy[] = array(
            'fields' => $field,
            'order' => $order
        );
        return $this;
    }

    /*public function orderBy($orderBy) {
        $args = $this->_getArgs(func_get_args());
        $this->_orderBy = $args;
        print_r_debug($this->_orderBy);
        return $this;
    }*/

    /*public function order($order) {
        $order = strtoupper($order);
        if (in_array($order, array('ASC', 'DESC'))) {
            $this->_order = $order;
        }
        return $this;
    }*/

    public function groupBy1($groupBy) {
        $args = $this->_getArgs(func_get_args());
        $this->_groupBy = $args;
        return $this;
    }

    public function groupBy($groupBy) {
        $this->_groupBy[] = $groupBy;
        return $this;
    }


    public function offset($offset = 0) {
        $offset = (int)abs($offset);
        if ($offset) {
            $this->_offset = $offset;
        }
        return $this;
    }

    /*public function join($table) {
        $this->_join = 'JOIN ' . $table;
        return $this;
    }*/



    public function _addJoin($joinType,$joinTable,$fieldName,$operand, $fieldName2)
    {

        $property='ON';
        $allowedTypes = array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER');
        $joinType = strtoupper(trim($joinType));

        if ($joinType && !in_array($joinType, $allowedTypes)) {
            throw new Exception('Wrong JOIN type: ' . $joinType);
        }

        /*if (!is_object($joinTable)) {
            $joinTable = self::$prefix . $joinTable;
        }*/

        $this->_join[] = array(
            'joinType' => $joinType.' JOIN',
            'joinTable' => $joinTable,
            'property' => $property,
            'fieldName' => $fieldName,
            'operand' => $operand,
            'fieldName2' => $fieldName2
        );
        return $this;
    }

    public function join($joinTable,$fieldName,$operand, $fieldName2)
    {
        $joinType='INNER';
        return $this->_addJoin($joinType,$joinTable,$fieldName,$operand, $fieldName2);
    }

    public function leftJoin($joinTable,$fieldName,$operand, $fieldName2)
    {
        $joinType='LEFT';
        return $this->_addJoin($joinType,$joinTable,$fieldName,$operand, $fieldName2);
    }
    public function rightJoin($joinTable,$fieldName,$operand, $fieldName2)
    {
        $joinType='RIGHT';
        return $this->_addJoin($joinType,$joinTable,$fieldName,$operand, $fieldName2);
    }


    public function using($field) {
        $this->_using = $field;
        return $this;
    }

    public function on($c1, $operand, $c2) {
        return $this->_addWhereOn($c1, $operand, $c2, '', 'on');
    }

    public function andOn($c1, $operand, $c2) {
        return $this->_addWhereOn($c1, $operand, $c2, 'AND', 'on');
    }

    public function orOn($c1, $operand, $c2) {
        return $this->_addWhereOn($c1, $operand, $c2, 'AND', 'on');
    }

    public function limit($offset=0,$limit =  0) {
        $limit  = (int)abs($limit);
        $offset = (int)abs($offset);

        $this->_limit = $limit;
        $this->_offset = $offset;
        return $this;
    }

    public function raw($input) {

        return $input;
        return $this;
    }

    public function select($fields) {

        $this->_setOperation('select');

        $args = $this->_getArgs(func_get_args());

        foreach ($args as $arg) {
            $this->addField($arg);
        }

        return $this;
    }

    public static function table($tables) {

        /* if ($this->_operation != 'SELECT') {
        throw new Exception('Only SELECT operators.');
        }*/
        $obj=new DB;
        $obj->_tables = $obj->_getArgs(func_get_args());
        //print_r_debug($obj);
        return $obj;
    }
    public  function from($tables) {

        $this->_tables = $this->_getArgs(func_get_args());
        //print_r_debug($this);
        return $this;

    }
    public function sub() {


    }

    public function where($cond1, $operand, $cond2) {

        //echo '<pre/>';
        if(is_object($cond2))
        {
            $this->sub=1;
            //var_dump($cond2);
            //print_r_debug($cond2);
            $n=new DB();
            //$n->sub();
            $a=$cond2($n);
            //print_r_debug($cond2);
            $b=$a->build();
            //return $b;
            return $this->_addWhereOn($cond1, $operand, $b  , '', 'where');

        }


        return $this->_addWhereOn($cond1, $operand, $cond2, '', 'where');
    }

    public function andWhereOpen($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'AND', 'where','(');
    }
    public function andWhereClose($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'AND', 'where','',')');
    }
    public function andWhere($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'AND', 'where');
    }

    public function orWhere($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'OR', 'where');
    }
    public function orWhereOpen($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'OR', 'where','(');
    }
    public function orWhereClose($cond1, $operand, $cond2) {
        return $this->_addWhereOn($cond1, $operand, $cond2, 'OR', 'where','',')');
    }

    private function _addJoinOn($cond1, $operand, $cond2, $type, $property) {
        $operand = strtoupper($operand);
        if (!in_array($operand, array('=', '>', '<', '<>', '!=', '<=', '>=', 'LIKE', 'IN'))) {
            throw new Exception('Unsupported operand:' . $operand);
        }
        $this->{'_' . $property}[] = array(
            'cond1' => $cond1,
            'operand' => $operand,
            'cond2' => $cond2,
            'type' => $type
        );
        return $this;
    }


    protected function _addWhereOn($cond1='', $operand='', $cond2='', $type='', $property='',$openAppend='',$closeAppend='') {


        // echo ' <br/>start <br/>';
        //print_r($cond2);
        //echo ' <br/>end <br/>';

        if($operand=='')
        {
            $this->{'_' . $property}[] = array(
                'cond1' => $cond1,
                'type' => $type
            );

        }else
        {
            $operand = strtoupper($operand);
            if (!in_array($operand, array('=', '>', '<', '<>', '!=', '<=', '>=', 'LIKE', 'IN','NOT IN' ))) {
                throw new Exception('Unsupported operand:' . $operand);
            }
            $this->{'_' . $property}[] = array(
                'cond1' => $cond1,
                'operand' => $operand,
                'cond2' => $cond2,
                'type' => $type,
                'openAppend' => $openAppend,
                'closeAppend' => $closeAppend

            );

        }


        /*if($this->sub==1)
        {
            return $this->build();
        }*/
        return $this;
    }

    public function addField($field) {
        if (!in_array($field, $this->_fields)) {
            $this->_fields[] = $field;
        }

        return $this;
    }

    protected function _sanitizeValue($val, $search = false) {
        if (!is_numeric($val)) {
            $val = '\'' . $val . '\'';
        }
        return $val;
    }

    public function insertInto($table) {
        $this->_setOperation('insert');
        $this->_tables[] = $table;
        return $this;
    }

    public function fields($fields) {
        if (!in_array($this->_operation, array('INSERT', 'UPDATE'))) {
            throw new Exception('Only INSERT and Update operations.');
        }
        $args = $this->_getArgs(func_get_args());
        $this->_fields = $args;
        return $this;
    }

    public function values($values) {
        if (!in_array($this->_operation, array('INSERT', 'UPDATE'))) {
            throw new Exception('Only INSERT and Update operations.');
        }
        $args = $this->_getArgs(func_get_args());
        if (count($args) != count($this->_fields)) {
            throw new Exception('Number of values has to be equal to the number of fields.');
        }
        if ($this->_operation == 'INSERT') {
            $this->_values[] = $args;
        } elseif ($this->_operation == 'UPDATE') {
            $this->_values = $args;
        }
        return $this;
    }

    public function deleteFrom($table) {
        $this->_setOperation('delete');
        $args = $this->_getArgs(func_get_args());
        $this->_tables = $args;
        return $this;
    }

    /*public function update($table) {
        $this->_setOperation('update');
        $this->_tables = array($table);
        return $this;
    }*/

    public function set($field) {
        $args = func_get_args();
        if (count($args) == 2) {
            $args = array($args[0] => $args[1]);
        } else {
            $args = $this->_getArgs(func_get_args());

        }
        foreach ($args as $field => $val) {
            if (!in_array($field, $this->_fields)) {
                $this->_fields[] = $field;
                $this->_values[] = $val;
            }
        }

        return $this;
    }

    private function _setOperation($operation) {
        if ($this->_operation) {
            throw new Exception('Can\'t modify the operator.');
        } elseif (!in_array($operation, array('select', 'insert', 'delete', 'update'))) {
            throw new Exception('Unsupported operator:' . strtoupper($operation));
        } else {
            $operation = strtoupper($operation);
            $this->_operation = $operation;
        }
    }

    private function _getArgs($args) {
        $argsCnt = count($args);
        if (!$argsCnt) {
            return array();
        }

        if ($argsCnt == 1) {
            if (!is_array($args[0])) {
                return array($args[0]);
            }
            return $args[0];
        } else {
            $return = array();

            foreach ($args as $arg) {
                $return[] = $arg;
            }

            return $return;
        }
    }

    public function build() {

        $statement = array();
        $this->_buildOperator($statement);

        $op = '_build' . $this->_operation;

        $this->$op($statement);
        //print_r_debug($this);

        $this->_buildJoin($statement);

        $this->_buildWhereOn($statement, 'where');

        $this->_buildGroupBy($statement);

        // echo 'or=';
        $this->_buildOrderBy($statement);

        $this->_buildLimit($statement);

        

        //echo implode(' ', $statement);
        return implode(' ', $statement);
    }
    /*public function build() {
        $statement = array();
        $this->_buildOperator($statement);
        $op = '_build' . $this->_operation;
        $this->$op($statement);

        $this->_buildJoin($statement);

        $this->_buildWhereOn($statement, 'where');

        $this->_buildGroupBy($statement);

        $this->_buildOrderBy($statement);

        $this->_buildLimit($statement);

        return implode(' ', $statement);
    }*/

    private function _buildJoin(&$statement)
    {

        if (!$this->_join) {
            return;
        }

        if (count($this->_join)) {
            foreach ($this->_join as $gb)
            {
                $statement[] = implode(' ', $gb);
                //$statement[] = $gb;
            }
        }

        //print_r_debug($statement);


        //$statement[] = $this->_join;

    }
    private function _buildUpdate(&$statement) {
        $statement[] = implode(', ', $this->_tables);
        $statement[] = 'SET';
        $set = array();
        foreach($this->_fields as $k => $f) {
            $set[] = $f . ' = ' . $this->_sanitizeValue($this->_values[$k]);
        }
        $statement[] = implode(', ', $set);
    }
    private function _buildDELETE(&$statement) {
        $statement[] = 'FROM ' . implode(', ', $this->_tables);
    }

    private function _buildSELECT(&$statement) {

        if(!count($this->_fields))
        {
            $statement[] = '*';
        }else
        {
            $statement[] = implode(', ', $this->_fields);
        }
        $statement[] = 'FROM ' . implode(', ', $this->_tables);

    }

    /*private function _buildSELECT(&$statement) {
        $statement[] = implode(', ', $this->_fields);
        $statement[] = 'FROM ' . implode(', ', $this->_tables);
    }*/


    private function _buildINSERT(&$statement) {
        $statement[] = 'INTO';
        $statement[] = implode(', ', $this->_tables);
        $this->_buildINSERTFields($statement);
        $statement[] = 'VALUES';
        $this->_buildINSERTValues($statement);
    }

    private function _buildINSERTFields(&$statement) {
        $statement[] = '(' . implode(', ', $this->_fields) . ')';
    }

    private function _buildINSERTValues(&$statement) {
        $values = array();
        foreach ($this->_values as $val) {
            foreach ($val as & $v) {
                $v = $this->_sanitizeValue($v);
            }
            $values[] = '(' . implode(', ', $val) . ')';
        }
        $statement[] = implode(', ', $values);
    }

    private function _buildOperator(&$statement) {

        if($this->_operation=='')
        {
            $this->select('*');
        }
        $statement[] = $this->_operation;
    }


    private function _buildWhereOn(&$statement, $type) {
        $typeSql='WHERE';
        if (count($this->{'_' . strtolower($type)})) {
            if($this->_useWhere==1){
                if($type=='where'){
                    $typeSql='';
                }
            }else
            {
                $statement[] = strtoupper($type);
            }

            $count=0;

            foreach ($this->{'_' . strtolower($type)} as $where) {

                if(($where['type']=='' and $this->_useWhere==1) or ($where['type']=='' and $count>0)){
                    $where['type']='AND';
                }
                $tmp = array($where['type'],$where['openAppend'], $where['cond1'], $where['operand'] );
                //print_r($where);echo '<br/>';

                if(!isset($where['cond2']))
                {
                    $tmp[] = $this->_sanitizeValue($where['cond2']);

                }else if ($where['operand'] != 'IN' and $where['operand'] != 'NOT IN') {

                    if ($type == 'where') {
                        $tmp[] = $this->_sanitizeValue($where['cond2']);
                    } else {
                        $tmp[] = $where['cond2'];
                    }

                } else {

                    $ins = array();
                    if (!is_array($where['cond2'])) {
                        $ins = array($where['cond2']);
                    } else {
                        foreach($where['cond2'] as $c2) {
                            $ins[] = $this->_sanitizeValue($c2, false);
                        }
                    }
                    $tmp[3] = $tmp[3] . '(' . implode(', ', $ins) . ')';
                }
                $tmp[]=$where['closeAppend'];


                $count++;
                $statement[] = implode(' ', $tmp);

            }

        }
    }

    /*  private function _buildWhereOn(&$statement, $type) {
          if (!in_array($this->_operation, array('UPDATE', 'DELETE', 'SELECT'))) {
              return;
          }
          if (count($this->{'_' . strtolower($type)})) {
              $statement[] = strtoupper($type);
              foreach ($this->{'_' . strtolower($type)} as $where) {
                  $tmp = array($where['type'], $where['cond1'], $where['operand']);
                  if ($where['operand'] != 'IN') {
                      if ($type == 'where') {
                          $tmp[] = $this->_sanitizeValue($where['cond2'], $where['operand'] == 'LIKE');
                      } else {
                          $tmp[] = $where['cond2'];
                      }
                  } else {
                      $ins = array();
                      if (!is_array($where['cond2'])) {
                          $ins = array($where['cond2']);
                      } else {
                          foreach($where['cond2'] as $c2) {
                              $ins[] = $this->_sanitizeValue($c2, false);
                          }
                      }
                      $tmp[2] = $tmp[2] . '(' . implode(', ', $ins) . ')';
                  }
                  $statement[] = implode(' ', $tmp);
              }
          }
      }*/

    private function _buildGroupBy1(&$statement) {
        if ($this->_operation != 'SELECT') {
            return;
        }
        if (count($this->_groupBy)) {
            $statement[] = 'GROUP BY';
            $gbs = array();
            foreach ($this->_groupBy as $gb) {
                $gbs[] = $gb;
            }
            $statement[] = implode(', ', $gbs);
        }
    }

    private function _buildGroupBy(&$statement) {
        if ($this->_operation != 'SELECT') {
            return;
        }
        //print_r($this->_groupBy);
        if (count($this->_groupBy)) {
            $statement[] = 'GROUP BY';
            $count=0;
            foreach ($this->_groupBy as $gb) {
                $count++;
                if($count>1)
                {
                    $statement[] = ','.$gb;
                }else
                {
                    $statement[] = $gb;

                }
            }

        }
    }

    private function _buildOrderBy1(&$statement) {

        if ($this->_operation != 'SELECT') {
            return;
        }
        if (count($this->_orderBy)) {
            $statement[] = 'ORDER BY';
            $obs = array();
            foreach ($this->_orderBy as $ob) {
                $obs[] = $ob;
            }
            $statement[] = implode(', ', $obs);
            $statement[] = $this->_order;
        }
    }
    private function _buildOrderBy (&$statement) {
        if ($this->_operation != 'SELECT') {
            return;
        }
        if (count($this->_orderBy)) {
            $statement[] = strtoupper('ORDER BY');
            $count=0;
            foreach ($this->_orderBy as $order) {
                $count++;
                if($count>1)
                {
                    $statement[] = ','.implode(' ', $order);
                }else
                {
                    $statement[] = implode(' ', $order);
                }
            }

        }
    }



    private function _buildLimit(&$statement) {

        if ($this->_offset > 0 && $this->_limit > 0) {
            $statement[] = 'LIMIT ' . $this->_offset . ', ' . $this->_limit;
        } elseif ($this->_offset > 0) {
            $statement[] = 'LIMIT ' . $this->_offset;
        } elseif ($this->_limit > 0) {
            $statement[] = 'LIMIT ' . $this->_limit;
        }
    }
}

?>
