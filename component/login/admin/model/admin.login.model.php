<?php

/**
 * Created by PhpStorm.
 * User: malek,marjani
 * Date: 2/20/2016
 * Time: 4:24 PM
 * version:01.01.01
 */
class adminLoginModel
{
    /**
     * @var
     */
    private $TableName;

    /**
     * set fields by post arrived
     *
     * @var
     */
    private $fields;  // other record fields

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
     * adminLoginModel constructor.
     */
    public function __construct()
    {
        /* $this->fields = array(
                                 'title'=>  '',
                                 'brif_description'=>  '',
                                 'description'=>  '',
                                 'meta_keyword'=>  '',
                                 'meta_description'=>  '',
                                 'image'=>  '',
                                 'date'=>  ''
                                 );*/
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
    public function setFields($input)
    {

        foreach ($input as $field => $val) {
            $funcName = '__set' . ucfirst($field);
            if (method_exists($this, $funcName)) {
                $result = $this->$funcName($val);
                if ($result['result'] == 1) {

                    $this->fields[$field] = $val;
                } else {
                    return $result;
                }
            }
        }
        $result['result'] = 1;
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
    private function __setUsername($input)
    {

        if (!Validator::required($input)) {
            $result['result'] = -1;
            $result['msg'] = 'pleas enter username';
        } else {
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
    private function __setPassword($input)
    {
        if ($input == '') {
            $result['result'] = 1;
        } else if (!Validator::required($input)) {
            $result['result'] = -1;
            $result['msg'] = 'pleas enter passowrd';
        } else {
            $result['result'] = 1;
        }
        return $result;
    }


    private static function GetHash()
    {
        return '%%1^^@@REWcmv21))--';
    }

    function encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return base64_encode($result);
    }

    function decrypt($string, $key)
    {
        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return $result;
    }

    function getSession_id()
    {

        $session['decrypt'] = $this->decrypt($_SESSION["sessionID"], $this->GetHash());
        $session['encrypt'] = $_SESSION["sessionID"];

        return $session;
    }

    function loginform($message = '')
    {
        global $conn, $messageStack;

        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.login.php");
        die();
    }


    /**
     *
     * @param $fields
     * @return mixed
     */
    function login($fields)
    {
        global $admin_info;

        $result = $this->setFields($fields);
        if ($result['result'] != 1) {
            return $result;
        }

        if ($this->fields['username'] == "" ) {
            $result['result'] = -1;
            $result['msg'] = "Username is not valid";
            return $result;
        }
        if ($this->fields['password'] == "" ) {
            $result['result'] = -1;
            $result['msg'] = "password is not valid";
            return $result;
        }


        /*if ($messageStack->size('login') > 0) {
            //redirectPage($_SERVER['HTTP_REFERER'],"");
        }*/

        include_once(dirname(__FILE__) . "/admin.login.model.db.php");

        //clear database from old data
        $result = adminLoginModelDb::deleteSessions();
        if ($result['result'] != 1) {
            return $result;
        }

        //select admin info from database
        //$this->fields['password'] = md5($this->fields['password']);


        $result = adminLoginModelDb::getAdminByUsername($this->fields);

        if ($result['result'] != 1) {
            return $result;
        }
        //
        /*$result=adminLoginModelDb::deleteSessionByAdminId($result['export']['list']['admin_id']);

        if($result['result']!=1)
        {
            return $result;
        }*/

        //insert admin user session to database
        $result = adminLoginModelDb::insertSession($result['export']['list']['admin_id']);
        if ($result['result'] != 1) {
            return $result;
        }
        $_SESSION["sessionID"] = $this->encrypt($result['export']['insert_id'], $this->GetHash());
        /*$_SESSION["adminUsername"] = $obj->name . " " . $obj->family;*/
        //remember me

        setcookie("sessionID", $_SESSION["sessionID"], time() + (86400 * 30), "/"); // 86400 = 1 day


        $admin_info = $this->checkLogin();

        $result['result'] = 1;
        $result['msg'] = "به پنل خود خوش آمدید.";
        return $result;


    }

    function checkLogin()
    {
        include_once(dirname(__FILE__) . "/admin.login.model.db.php");

        $result = adminLoginModelDb::deleteSessions();
        if ($result['result'] != 1) {
            return $result;
        }
        
        if (!isset($_SESSION["sessionID"])) {
            if (!isset($_COOKIE["sessionID"])) {
                $result['result'] = -1;
                $result['no'] = 1;
                $result['msg'] = 'This Record was Not Found';
            } else {
                $sessionID = $this->decrypt($_COOKIE["sessionID"], $this->GetHash());
            }
        } else {
            $sessionID = $this->decrypt($_SESSION["sessionID"], $this->GetHash());
        }



        //select adm information from database
        $result = adminLoginModelDb::getSession($sessionID);
        if ($result['result'] != 1) {
            return $result;
        }

        //select admin information from database
        $admin_id = $result['export']['list']['admin_id'];
        $result = adminLoginModelDb::getAdminByAdmin_id($admin_id);
        if ($result['result'] != 1) {
            return $result;
        }

        return $result['export']['list'];
    }


    function logout()
    {

        if (isset($_SESSION["sessionID"])) {
            $sessionID = $this->decrypt($_SESSION["sessionID"], $this->GetHash());

            setcookie("sessionID", $sessionID, time() - 10000, "/");


        } elseif (isset($_COOKIE["sessionID"])) {
            $sessionID = $this->decrypt($_COOKIE["sessionID"], $this->GetHash());

            setcookie("sessionID", $sessionID, time() - 10000, "/");

        }
        $result = adminLoginModelDb::deleteSessionWithSession_id($sessionID);

        if ($result['result'] != 1) {
            return $result;
        }

        session_unset();
        $result['result'] = 1;
        $result['msg'] = "شما از سيستم خارج شده ايد.";
        return $result;

    }


}