<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
include_once(ROOT_DIR . "/common/validators.php");
define("A",'کمتر از 5 کاراکتر نمیشود');
class accountModel extends looeic
{
    /*protected $rules = array(
        'title' => 'min_len,5*aa|max_len,10*ghhg',
        'brif_description' => 'required|max_len,100'
    );*/
    /**
     * set fields by post arrived
     *
     * @var
     */
    //private $fields;  // other record fields

    /**
     * @var
     */
    private $list;  // other record fields

    /**
     * @var
     */
    private $recordsCount;  // other record fields


    /**
     * @var
     */
    private $result;

    /**
     * accountModel constructor.
     */
    /*public function __construct()
    {
      parent::__construct();

    }*/

    /**
     *
     * @param $field
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function __get($field)
    {
        if ($field == 'result')
        {
            return $this->result;
        }
        else if ($field == 'list')
        {
            return $this->list;
        }
        else if ($field == 'recordsCount')
        {
            return $this->recordsCount;
        }else
        {
            return parent::__get($field);
        }

    }

    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */

   /*public function setFields ($input)
    {
       // print_r_debug($input);

        foreach($input as $field =>$val)
        {
            $funcName='__set'.ucfirst($field);
            //print_r_debug($field);
            if(method_exists($this,$funcName))
            {
                $result=$this->$funcName($val);
            //    print_r_debug($funcName);
                if($result['result']==1)
                {

                    $this->fields[$field]=$val;
                   // print_r_debug($this->fields);
                }else
                {
                    return $result;
                }
            }
            }
        $result['result']=1;
        return $result;

    }*/


    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    private function __setProduct ($input)
    {

        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='pleas enter title';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }

    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    private function __setCategory ($input)
    {
        if($input=='')
        {
            $result['result'] = 1;
        }else if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='pleas enter Brif description';
        }else
        {
            $result['result'] = 1;
        }
        return $result;
    }

    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    private function __setKeyword ($input)
    {
        if($input=='')
        {
            $result['result'] = 1;
        }else if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='pleas enter Description';
        }else
        {
            $result['result'] = 1;
        }
        return $result;
    }

    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    private function __setLang ($input)
    {
        if($input=='')
        {
            $result['result'] = 1;
        }else if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='pleas enter Meta_keyword';
        }else
        {
            $result['result'] = 1;
        }
        return $result;
    }

    /**
     * set the values that have been received through post
     *
     * @param $input
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    private function __setAccounttype ($input)
    {
        if($input=='')
        {
            $result['result'] = 1;
        }else if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='pleas enter Meta_description';
        }else
        {
            $result['result'] = 1;
        }
        return $result;
    }






    /**
     * get account by id
     *
     * @param $id
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    
    public function getAccountById($id)
    {
        include_once(dirname(__FILE__)."/account.model.db.php");

        $result=accountModelDb::getAccountById($id);

        if($result['result']!=1)
        {
            return $result;
        }

        /*$resultSet=$this->setFields($result['list']);
        if($resultSet!=1)
        {
            return $resultSet;
        }
        $result['result']=1;
        $result['list']= $this->fields;
        return $result;
        */
        //or

        $this->fields=$result['export']['list'];
       // print_r_debug( $this->fields);
        return $result;
    }

    /**
     * get all account
     *
     * @param $fields
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function getAccount($fields)
    {
        include_once(dirname(__FILE__)."/account.model.db.php");

        $result=accountModelDb::getAccount($fields);

        if($result['result']!=1)
        {
            return $result;
        }
        $this->list=$result['export']['list'];
        $this->recordsCount=$result['export']['recordsCount'];

        return $result;
    }

    /**
     * add new account
     *
     * @return mixed
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function add()
    {
        include_once(dirname(__FILE__)."/account.model.db.php");

        $result=accountModelDb::insert($this->fields);
        $this->fields['Account_id']=$result['export']['insert_id'];
        return $result;
    }



    /**
     * delete account by account_id
     *
     * @return mixed
     * @author mahdi marjani moghadam <marjani@dabacenter.ir>
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function delete()
    {
        include_once(dirname(__FILE__)."/account.model.db.php");
        $result=accountModelDb::delete($this->fields);
       // print_r_debug($result);
        return $result;
    }

}