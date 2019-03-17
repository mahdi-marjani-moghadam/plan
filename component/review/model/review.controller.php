<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/10/2016
 * Time: 10:21 AM.
 */
include_once dirname(__FILE__).'/review.model.php';

/**
 * Class reviewController.
 */
class reviewController
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
     * reviewController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * call tempate.
     *
     * @param array $list
     * @param $msg
     *
     * @return string
     */
    public function template($list = [], $msg)
    {
        // global $conn, $lang;

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
     * show all review.
     *
     * @param $_input
     *
     * @author marjani
     * @date 3/10/2015
     *
     * @version 01.01.01
     */
    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->fileName = 'review.showList.php';
            $this->template('', $msg);
            die();
        }
        $review = new reviewModel();
        $result = $review->getReviewById($_input);

        if ($result['result'] != 1) {
            $this->fileName = 'review.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('اطلاعات تماس');
        $breadcrumb->add($review['list']['title']);
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = 'review.showMore.php';
        $this->template($review->fields);
        die();
    }

    /**
     * @param $fields
     *
     * @author marjani
     * @date 3/10/2015
     *
     * @version 01.01.01
     */
    public function showALL($fields)
    {
        $review = new reviewModel();

        $result = $review->getReview($fields);

        if ($result['result'] != '1') {
            die();
        }
        $export['list'] = $review->list;
        $export['recordsCount'] = $review->recordsCount;
        $export['pagination'] = $review->pagination;

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('اطلاعات تماس');
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = 'contactus.form.php';


        $this->template($export);
        die();
    }
}
