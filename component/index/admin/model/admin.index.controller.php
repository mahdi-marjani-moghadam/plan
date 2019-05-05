<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__)."/admin.index.model.php");

/**
 * Class indexController
 */
class adminIndexController
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
        $this->exportType='html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list=[],$msg='')
    {
        global $messageStack,$admin_info, $lang;
        if($msg==''){
            $msg = $messageStack->output('message');
        }
        switch($this->exportType)
        {
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



    /**
     * @param $fields
     */
    public function showList($fields)
    {

        /*include_once(ROOT_DIR."component/artists/admin/model/admin.artists.model.php");
        $result = adminArtistsModel::query('select count(Artists_id) as count from artists')->getList();
        $export['artists_count'] = $result['export']['list'][0]['count'];

        include_once(ROOT_DIR."component/product/admin/model/admin.product.model.php");
        $result = adminProductModel::query('select count(Artists_products_id) as count from artists_products')->getList();
        $export['artists_products_count'] = $result['export']['list'][0]['count'];

        */

        include_once(ROOT_DIR."component/admin/admin/model/admin.admin.model.php");
        $result = adminadminModel::query('select count(distinct(admin_id)) as count from sessions_admin')->getList();
        $export['admin_count'] = $result['export']['list'][0]['count'];

        $this->fileName='admin.index.php';
        $this->template($export);
        die();
    }


}
?>