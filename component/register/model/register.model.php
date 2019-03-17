<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM
 */

include_once(ROOT_DIR."/common/validators.php");
class registerModel
{
    private $fields;  // other record fields
    private $list;  // other record fields

    private $result;

    /**
     * registerModel constructor.
     */
    public function __construct()
    {

        $this->requiredFields = array(
            'company_name'=>  '',
            'company_phone1'=>  '',
            'email'=>  ''
        );
    }

    /**
     * @param $field
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function __get($field)
    {
        if ($field == 'result')
        {
            return $this->result;
        }
        else if ($field == 'fields')
        {
            return $this->fields;
        }
        else if ($field == 'list')
        {
            return $this->list;
        }



        else
        {
            return $this->fields[$field];
        }

    }

    /**
     * validator controller
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function setFields ($input)
    {
        foreach($input as $field =>$val)
        {
            $funcName='__set'.ucfirst($field);
            if(method_exists($this,$funcName))
            {
                $result=$this->$funcName($val);

                if($result['result'] == '1')
                {
                    $this->fields[$field]=$val;
                }else
                {

                    return $result;
                }

            }
        }
        $result['result']=1;
        return $result;

    }

    /**
     * check subject
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setCompany_name ($input)
    {
        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا نام کمپانی را وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }

    /**
     *check email
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setEmail ($input)
    {
        if(Validator::Email($input) != '1')
        {
            $result['result']=-1;
            $result['msg']='ایمیل را به درستی وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }

    /**
     * check Address
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setAddress ($input)
    {
        /*if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا آدرس را وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }*/
        $result['result'] = 1;

        return $result;
    }
    /**
     * check Address
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setCompany_phone1 ($input)
    {
        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا تلفن را وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }



    /**
     * check coordinator_name
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setCoordinator_name ($input)
    {
        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا نام نماینده را وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }

    /**
     * check Coordinator_family
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setCoordinator_family  ($input)
    {
        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا نام خانوادگی نماینده را وارد نمایید.';
        }else
        {
            $result['result'] = 1;
        }

        return $result;
    }

    /**
     * check __setCoordinator_phone
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    private function __setCoordinator_phone  ($input)
    {
        if(!Validator::required($input))
        {
            $result['result']=-1;
            $result['msg']='لطفا تلفن نماینده را وارد نمایید.';
        }else
        {
             $result['result'] = 1;
        }

        return $result;
    }
    /**
     * add contact us
     *
     * @param $input
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function addRegister()
    {

        foreach($this->requiredFields as $field =>$val)
        {
            $requiredList[$field]=$this->fields[$field];
        }
        $result=$this->setFields($requiredList);

        if($result['result']==-1)
        {
            return $result;
        }

        include_once(dirname(__FILE__)."/register.model.db.php");




        $result=registerModelDb::insert($this->fields);

        if($result['result']!=1)
        {
            return $result;
        }

        $this->fields['Register_id']=$result['export']['insert_id'];

        return $result;
    }


}
