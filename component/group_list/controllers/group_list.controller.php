<?php
class group_listController{
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
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list = array(), $msg = '')
    {
        global $admin_info, $messageStack;


        if ($msg == '') {
            $msg = $messageStack->output('message');
        }


        switch ($this->exportType) {
            case 'html':

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
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



    function showList()
    {
        $list='';
        ////////////////////////////////////
        /////          content         /////
        ////////////////////////////////////

        $this->fileName = '';
        $this->template($list);
    }

    function sabt($fields)
    {
        global $messageStack;
        include_once ROOT_DIR.'component/group_list/model/group_list.model.php';

        ////////////////////////////////////
        /////          content         /////
        ////////////////////////////////////

        $messageStack->add_session('message','عملیات با موفقیت انجام شد','success');
        redirectPage(RELA_DIR.'admin/?component=');
    }

}