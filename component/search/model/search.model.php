<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 2/20/2016
 * Time: 4:24 AM.
 */
include_once ROOT_DIR.'/common/validators.php';
class searchModel
{
    private $TableName;
    private $fields;  // other record fields
    private $list;  // other record fields
    private $recordsCount;  // other record fields
    private $pagination;  // other record fields
    private $companyFields;  // Default Fields Of Company For Search
    private $productsFields;  // Default Fields Of Company For Search

    private $result;

    /**
     * searchModel constructor.
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
        $this->companyFields = array('company_name', 'description');
        $this->productsFields = array('title', 'description');
    }

    /**
     * @param $field
     *
     * @return mixed
     */
    public function __get($field)
    {
        if ($field == 'result') {
            return $this->result;
        } elseif ($field == 'fields') {
            return $this->fields;
        } elseif ($field == 'list') {
            return $this->list;
        } elseif ($field == 'recordsCount') {
            return $this->recordsCount;
        } elseif ($field == 'pagination') {
            return $this->pagination;
        } else {
            return $this->fields[$field];
        }
    }

    /**
     * @param $input
     *
     * @return int
     */
    public function setFields($input)
    {
        foreach ($input as $field => $val) {
            $funcName = '__set'.ucfirst($field);
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

    //hamid
    private function __setProvince($input)
    {
        $result['result'] = 1;
        // if ($input == '') {
        //     $result['result'] = 1;
        // } elseif (!Validator::required($input)) {
        //     $result['result'] = -1;
        //     $result['msg'] = 'لینک وارد شده صحیح نمیباشد.';
        // } else {
        //     $result['result'] = 1;
        // }

        return $result;
    }

    //end hamid
    /**
     * @param $input
     *
     * @return mixed
     */
    private function __setQ($input)
    {
        $result['result'] = 1;
        // if ($input == '') {
        //     $result['result'] = 1;
        // } elseif (!Validator::required($input)) {
        //     $result['result'] = -1;
        //     $result['msg'] = 'لینک وارد شده صحیح نمیباشد.';
        // } else {
        //     $result['result'] = 1;
        // }

        return $result;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    private function __setType($input)
    {
        $result['result'] = 1;
        // if ($input == '') {
        //     $result['result'] = 1;
        // } elseif (!Validator::required($input)) {
        //     $result['result'] = -1;
        //     $result['msg'] = 'pleas enter Type';
        // } else {
        //     $result['result'] = 1;
        // }

        return $result;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    private function __setCity($input)
    {
        $result['result'] = 1;

        return $result;
    }
    /**
     * @param $input
     *
     * @return mixed
     */
    private function __setCategory($input)
    {
        $result['result'] = 1;

        return $result;
    }
    /**
     * @param $input
     *
     * @return mixed
     */
    private function __setOrder($input)
    {
        $result['result'] = 1;

        return $result;
    }
    /**
     * get all search in companies and products.
     *
     * @param $fields
     *
     * @return mixed
     *
     * @author marjani
     * @date 3/15/2016
     *
     * @version 01.01.01
     */
    public function getSearch($fields)
    {
        global $lang;
        switch ($fields['type']) {

            case 'رویدادها' || 'events':
                include_once ROOT_DIR."component/event/model/event.model.php";
                $tt = 'event_name_'.$lang;

                $result = eventModel::query("select * from event where $tt like '%".handleData($fields['q'])."%'")->getList();

                if ($result['result'] != 1) {
                    return $result;
                }


                $temp = $result['export']['list'];
                unset($result['export']);
                $result['export']['events'] = $temp;
                
                //print_r_debug($this->recordsCount[company]);
                //$resultPage['company'] = paginationButtom($this->recordsCount['company'],10);

                /*if ($resultPage['company']['result'] == 1 && ($fields['type'] == 'تولیدی' || !isset($fields['type']))) {
                    $this->pagination['company']['pageCount'] = $resultPage['company']['export']['pageCount'];
                    $this->pagination['company']['rowCount'] = $resultPage['company']['export']['rowCount'];
                    $this->pagination['company']['list'] = $resultPage['company']['export']['list'];

                }*/
                //print_r_debug($this->pagination);

                break;
            case 'هنرمندان' || 'artists':

                include_once ROOT_DIR."component/artists/model/artists.model.php";
                $tt = 'artists_name_'.$lang;

                $result = artistsModel::query("select * from artists where $tt like '%".handleData($fields['q'])."%'")->getList();

                if ($result['result'] != 1) {
                    return $result;
                }


                $temp = $result['export']['list'];
                unset($result['export']);
                $result['export']['artists'] = $temp;


               //$resultPage['company'] = paginationButtom($this->recordsCount['company'],10);

                /*if ($resultPage['company']['result'] == 1 && ($fields['type'] == 'تولیدی' || !isset($fields['type']))) {
                    $this->pagination['company']['pageCount'] = $resultPage['company']['export']['pageCount'];
                    $this->pagination['company']['rowCount'] = $resultPage['company']['export']['rowCount'];
                    $this->pagination['company']['list'] = $resultPage['company']['export']['list'];

                }*/
                //print_r_debug($this->pagination);

                break;

            default:
                if (isset($fields['order'])) {
                    $order = $fields['order'];
                    unset($fields['order']);
                    $fields['order']['Company_id'] = $order;
                    $fields['order']['rnk'] = $order;

                }
                $fields['type'] = 'تولیدی';
                $result = $this->getCompany($fields);
                if ($result['result'] != 1) {
                    return $result;
                }
                $temp = $result['export'];
                unset($result['export']);
                $result['export']['company'] = $temp;

                $resultPage['company'] = $this->pagination('company');
                if ($resultPage['company']['result'] == 1 && ($fields['type'] == 'تولیدی' || !isset($fields['type']))) {
                    $this->pagination['company'] = $resultPage['company']['export']['list'];
                }
                break;
        }



        return $result;
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author marjani
     * @date 3/15/2016
     *
     * @version 01.01.01
     */
    public function getCompany($fields)
    {

        $result = $this->search('company', $this->companyFields, $fields);

        if ($result['result'] != 1) {
            return $result;
        }
       // print_r_debug($result);

        return $result;
    }
    public function getArtist($fields)
    {
        $result = $this->search('artits', $this->companyFields, $fields);

        if ($result['result'] != 1) {
            return $result;
        }
        // print_r_debug($result);

        return $result;
    }


    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author marjani
     * @date 3/15/2016
     *
     * @version 01.01.01
     */
    public function getProducts($fields)
    {
        $result = $this->search('company_products', $this->productsFields, $fields);
        if ($result['result'] != 1) {
            return $result;
        }

        return $result;
    }

    /**
     * this function call from every where for search in db.
     *
     * @param $table
     * @param $dbFields
     * @param $fields
     *
     * @return mixed
     *
     * @author marjani
     * @date 3/15/2016
     *
     * @version 01.01.01
     */
    private function search($table, $dbFields, $fields)
    {
        include_once dirname(__FILE__).'/search.model.db.php';
        $result = searchModelDb::searchInDB($table, $dbFields, $fields);

        if ($result['result'] != 1) {
            return $result;
        }

        $this->list[$table] = $result['export']['list'];
        $this->list['category'] = $result['export']['category'];
        $this->list['searchCategory'] = $result['export']['searchCategory'];
        $this->list['searchProvince'] = $result['export']['searchProvince'];
        
        $this->list['category'] = $result['export']['category'];
        $this->list['province'] = $result['export']['province'];
        $this->list['city'] = $this->sortCities($result['export']['city']);

        $this->list['searchItem'] = $result['export']['searchItem'];
        $this->recordsCount[$table] = $result['export']['recordsCount'];

        include_once(ROOT_DIR."component/category/model/category.model.php");
        $category = new categoryModel();
        $resultCategory = $category->getCategoryUlLiSearch($this->list['searchCategory']);

        if($resultCategory['result'] == 1)
        {
            $export['category_list'] = $resultCategory['export']['list'];
            $this->list['searchCategoryUlLi'] =$export['category_list'];
        }
        //print_r_debug($this->list['searchCategoryUlLi']);

        if (($result['export']['recordsCount']) == 0) {
            $result['msg'] = 'رکوردی یافت نشد';
        }
        return $result;
    }

    private function sortCities($cities)
    {
        if (isset($_SESSION['city'])) {
            $city = $_SESSION['city'];
            $newCities = array();
            foreach ($cities as $key => $value) {
                if ($value['name'] == $city) {
                    unset($city);
                    $city = $value;
                    unset($cities[$key]);
                }
            }
            array_push($newCities, $city);
            foreach ($cities as $key => $value) {
                array_push($newCities, $value);
            }

            return $newCities;
        }

        return $cities;
    }
    /**
     * create pagination link.
     *
     * @param $table
     *
     * @return mixed
     *
     * @author marjani
     * @date 3/15/2016
     *
     * @version 01.01.01
     */
    private function pagination($table)
    {
        $pageCount = ceil($this->recordsCount[$table] / PAGE_SIZE);
        $pagination = array();
        $temp = 1;

        $url_main = substr($_SERVER['REQUEST_URI'], strlen(SUB_FOLDER) + 1);
        $url_main = urldecode($url_main);
        $PARAM = explode('/', $url_main);
        $PARAM = array_filter($PARAM, 'strlen');

        if (array_search('page', $PARAM)) {
            $index_pageSize = array_search('page', $PARAM);
            unset($PARAM[$index_pageSize]);
            unset($PARAM[$index_pageSize + 1]);
            $PARAM = implode('/', $PARAM);
            $PARAM = explode('/', $PARAM);
            $PARAM = array_filter($PARAM, 'strlen');
        }

        for ($i = 1;$i <= $pageCount;++$i) {
            foreach ($PARAM as $key => $value) {
                $url = '/'.$value;
            }
            $pagination[] = $url.'/page/'.$temp;
            $temp = $temp + 1;
            $url = '';
        }

        $result['result'] = 1;
        $result['export']['list'] = $pagination;

        return $result;
    }
}
