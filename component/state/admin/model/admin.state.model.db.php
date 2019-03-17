<?php
/**

 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 11:02 AM.
 */
class adminStateModelDb
{
    public static function insert($fields)
    {
        $conn = dbConn::getConnection();
        $sql = "
                INSERT INTO state(
                `name`
                )
                VALUES(
                '".$fields['state_name']."'
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

        $sql = 'SELECT * FROM `province`';

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

    public static function getStateById($id)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `state` where `State_id`='$id'";

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

    public static function getStateByName($name)
    {
        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `state` where `name`='$name'";
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

    public static function getStateByNameArray($name = array())
    {
        $conn = dbConn::getConnection();

        $names = explode(',', $name);
        $states = '';
        foreach ($names as $name) {
            $states .= "'$name',";
        }
        $states = substr($states, 0, -1);

        $sql = 'SELECT * FROM state WHERE name IN ('.$states.')';

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
}
