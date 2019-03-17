<?php
/**
 * Created by PhpStorm.
 * User: marjani,ahmadloo
 * Date: 4/07/2016
 * Time: 9:21 AM
 */

include_once(dirname(__FILE__) . "/admin.login.model.php");

/**
 * Class loginController
 */
class adminLoginController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list = array(), $msg='')
    {
        // global $conn, $lang;
        global $messageStack,$admin_info;
        $msg = translate($msg);


        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                //include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
                break;

            case 'json':
                echo json_encode($list);
                break;
            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;
            default:
                break;
        }

    }

    /**
     *
     */
    public function showLoginform()
    {
        $this->fileName = 'admin.login.form.php';
        $this->template();
        die();
    }


    /**
     * @param $fields
     * @return mixed
     */
    public function callLogin($fields)
    {

        $login = new adminLoginModel();

        $result = $login->login($fields);


        if ($result['result'] != '1') {

            $this->fileName = 'admin.login.form.php';
            $this->template('', $result['msg']);
        }

        redirectPage(RELA_DIR . "admin/", $result['msg']);
        die();
    }

    public function callLogout()
    {
        $login = new adminLoginModel();

        $result = $login->logout();

        if ($result['result'] != '1') {
            $this->fileName = 'admin.login.form.php';
            $this->template('', $result['msg']);
        }

        redirectPage(RELA_DIR . "admin/", $result['msg']);
        die();
    }


}

?>