<?php
/**

 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 11:02 AM.
 */
class adminCityModelDb
{
    public static function insert($fields)
    {
        $conn = dbConn::getConnection();
        $sql = "
                INSERT INTO city(
                `name`
                )
                VALUES(
                '".$fields['city_name']."'
                )";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }
        $result['export']['insert_id'] = $conn->lastInsertId();
        $result['result'] = 1;

        return $result;

    }
    public static function getAll()
    {
        $conn = dbConn::getConnection();

        $sql = 'SELECT * FROM `city`';

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        while ($row = $stmt->fetch()) {
            $list[] = $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }

    public static function getCityById($id)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `city` where `City_id`='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        return $stmt->fetch();
    }

    public static function getCityByName($name)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `city` where `name`='$name'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if(!$stmt->rowCount()){
            return -1;
        }
        return $stmt->fetch();
    }

    public static function getCityByNameArray($name = array())
    {
        $conn = dbConn::getConnection();

        $names = explode(',', $name);
        $cities = '';
        foreach ($names as $name) {
            $cities .= "'$name',";
        }
        $cities = substr($cities, 0, -1);

        $sql = 'SELECT * FROM city WHERE name IN ('.$cities.')';

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        while ($row = $stmt->fetch()) {
            $list[] = $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }

    public static function getCitiesByprovinceID($id)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `city` where province_id = $id ";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        while ($row = $stmt->fetch()) {
            $list[] = $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }




}
