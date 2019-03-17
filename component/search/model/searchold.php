<?php

/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/12/2016
 * Time: 11:33 AM.
 */
class searchModelDb
{
    public function searchInDB($table, $dbField, $fields = '')
    {
        $conn = dbConn::getConnection();
        include_once ROOT_DIR.'/model/db.inc.class.php';
        $condition = DataBase::filterBuilder($fields);

        $sqlPre = 'SELECT SQL_CALC_FOUND_ROWS * from ( ';
        $sqlEnd .= ' ) t1 ';

        // append city
        include_once ROOT_DIR.'/component/city/admin/model/admin.city.model.db.php';
        $city = adminCityModelDb::getCityByNameArray($fields['city']);
        if (count($city['export']['list'])) {
            $append_SQL_city = ' AND (';
            foreach ($city['export']['list'] as $key => $value) {
                $cityId = $value['City_id'];
                $append_SQL_city .= " `city_id` = '$cityId' or";
            }
            $append_SQL_city = substr($append_SQL_city, 0, -2);
            $append_SQL_city .= ')';
        } else {
            $append_SQL_city = '';
        }
        // end append city

        // append category
        include_once ROOT_DIR.'/component/category/model/category.model.db.php';
        $category = categoryModelDb::getCategoryByIdString($fields['category']);
        if (count($category['export']['list'])) {
            $append_SQL_category = ' AND (';
            foreach ($category['export']['list'] as $key => $value) {
                $categoryId = $value['Category_id'];
                $append_SQL_category .= " `category_id` LIKE '%,$categoryId,%' or";
            }
            $append_SQL_category = substr($append_SQL_category, 0, -2);
            $append_SQL_category .= ')';
        } else {
            $append_SQL_category = '';
        }
        // end append category

        $sql = $sqlPre.self::generateSearchSql($table, $fields, $dbField, $append_SQL_category);
        $sql = substr($sql, 0, -5);
        $sql .= $sqlEnd;
        //echo '<pre/>';
        //print_r($sql );
        //die();
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        include_once ROOT_DIR.'/component/city/model/city.model.db.php';
        $cities = cityModelDb::getCities();
        $result['export']['city'] = $cities['export']['list'];
        while ($row = $stmt->fetch()) {
            $id = ucfirst($table).'_id';
            $listTmp[$row[$id]] = $row;
            $result['export']['city'][$row['city_id']]['count'] = $result['export']['city'][$row['city_id']]['count']+1;

        }

        // cities
        $cityIds = [];
        /*foreach ($listTmp as $comp) {
            //array_push($cityIds, $value['city_id']);
            $result['export']['city'][$comp['city_id']]['count'] =
                $result['export']['city'][$comp['city_id']]['count']+1;
        }*/


        //echo '<pre/>';

        //$result['export']['city'][$key]['count'] = $cityCount;

        // end cities

        $sql = $sqlPre.self::generateSearchSql($table, $fields, $dbField, $append_SQL_category, $append_SQL_city);
        $sql = substr($sql, 0, -5);
        $sql .= $sqlEnd;
        //echo '<pre/>aa';
        //print_r($result['export']['city']);
        //print_r_debug($sql);
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        unset($listTmp);

        // categories

        $catIds = [];

        include_once ROOT_DIR.'/component/category/model/category.model.db.php';
        $categories = categoryModelDb::getCategoryAll();
        $result['export']['category'] = $categories['export']['list'];

        $rowP['recCount'] = $stmt->rowCount();

        while ($row = $stmt->fetch()) {
            $id = ucfirst($table).'_id';
            //$listTmp[$row[$id]] = $row;
            //$catIdsArray = explode(',', $row['category_id']);
            $catIdsArray = array_filter(explode(',', $row['category_id']), 'strlen');
            foreach ($catIdsArray as $key1 => $value1) {
                $result['export']['category'][$value1]['count'] =
                    $result['export']['category'][$value1]['count']+1;
            }
        }
        unset($result['export']['category'][0]);

        //print_r($result['export']['category']);
        //print_r_debug('');

        // end categories

        /*foreach ($listTmp as $comp)
        {
            $result['export']['category'][$comp['category_id']]['count'] = $result['export']['category'][$comp['category_id']]['count']+1;

        }*/


        $sql .= $condition['list']['order'].$condition['list']['limit'];
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        /*$sql = ' SELECT FOUND_ROWS() as recCount ';
        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();*/

        if ($table == 'company') {
            while ($row = $stmt->fetch()) {
                include_once ROOT_DIR.'/component/company/model/company.model.db.php';
                $id = ucfirst($table).'_id';
                $list[$row[$id]] = companyModelDb::getCompanyById($row[$id])['list'];
            }
        } else {
            while ($row = $stmt->fetch()) {
                $id = ucfirst($table).'_id';
                $list[$row[$id]] = $row;
            }
        }

        $result['export']['recordsCount'] = $rowP['recCount'];
        $result['result'] = 1;
        $result['export']['list'] = $list;
        unset($sql);
        // print_r_debug($list);
        return $result;
    }

    private static function generateSearchSql($table, $fields, $dbField, $append_SQL_category = '', $append_SQL_city = '')
    {
        $sql = '';
        foreach ($dbField as $k => $dbField) {
            $sql .= '
                   SELECT
                   *
      		     FROM 	'.$table.' WHERE '.$dbField." = '".$fields['q']."' and status = 1 $append_SQL_city $append_SQL_category
      		     UNION
      		     ";

            $sql .= '
                   SELECT
                   *
      		     FROM 	'.$table.' WHERE '.$dbField." LIKE '".$fields['q']."' and status = 1 $append_SQL_city $append_SQL_category
      		     UNION
      		     ";

            $sql .= '
                   SELECT
                   *
      		     FROM 	'.$table.' WHERE '.$dbField." LIKE '".$fields['q']."%' and status = 1 $append_SQL_city $append_SQL_category
      		     UNION
      		     ";

            $sql .= '
                   SELECT
                   *
      		     FROM 	'.$table.' WHERE '.$dbField." LIKE '%".$fields['q']."' and status = 1 $append_SQL_city $append_SQL_category
      		     UNION
      		     ";

            $sql .= '
                   SELECT
                   *
      		     FROM 	'.$table.' WHERE '.$dbField." LIKE '%".$fields['q']."%' and status = 1 $append_SQL_city $append_SQL_category
      		     UNION";
        }


        return $sql;
    }
}
