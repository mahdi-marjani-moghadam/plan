<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once dirname(__FILE__).'/search.model.php';

/**
 * Class searchController.
 */
class searchController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
     * @var
     */
    public $fileName;

    /**
     * searchController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * call tempate.
     *
     * @param array
     * @param $msg
     *
     * @return string
     */
    public function template($list = [], $msg)
    {
         global  $lang;

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/title.inc.php';
                include ROOT_DIR.'templates/'.CURRENT_SKIN."/$this->fileName";
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/tail.inc.php';
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
     * search in produce and product.
     *
     * @param $fields
     *
     * @return int|mixed
     *
     * @author marjani
     * @date 3/10/2015
     *
     * @version 01.01.01
     */
    public function showALL($fields)
    {


        $search = new searchModel();
        $result = $search->setFields($fields);
        $this->fileName = 'search.result.php';

        if ($result['result'] == -1) {
            $this->template('', $result['msg']);
            die();
        }
        // if (isset($fields['category']) && $fields['category'] != '0') {
        //     $categoryId = $fields['category'];
        //     $fields['filter']['category_id'] = ','.$fields['category'].',';
        // }
        $result = $search->getSearch($fields);
//        print_r_debug($result);
        if ($result['result'] != '1') {
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export'];
        
        
        //$export['type'] = $fields['type'];
        //$export['q'] = $search->q;
        //$export['recordsCount'] = $search->recordsCount;
        //$export['pagination'] = $search->pagination;

//        print_r_debug($export);
        $this->template($export, $result['msg']);
        die();
    }
}
