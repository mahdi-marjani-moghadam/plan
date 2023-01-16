<?php

/**
 * Created by PhpStorm.
 * User: marjani and ahmadloo
 * Date: 04/07/2016
 * Time: 12 AM
 */
class adminLoginModelDb
{

    static function insertSession($id)
    {

        $conn = dbConn::getConnection();
        $sql = "
					  insert into sessions_admin(admin_id,remote_addr,last_access_time)
			  values
			  		  (" . $id . ", '". $_SERVER["REMOTE_ADDR"] . "', '" .getDateTime(). "')";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['export']['insert_id']=$conn->lastInsertId();
        $result['result'] = 1;
        return $result;
    }

    static function getSession($sessionID)
    {
        //global $lang;
        $conn = dbConn::getConnection();
        $sql="SELECT admin_id FROM sessions_admin WHERE Sessions_admin_id = '$sessionID'";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }


    static function update($fields)
    {

        $conn = dbConn::getConnection();

        $sql = "
                UPDATE login
                  SET
                    `title`             =   '" . $fields['title'] . "',
                    `brif_description`  =   '" . $fields['brif_description'] . "',
                    `description`       =   '" . $fields['description'] . "',
                    `meta_keyword`      =   '" . $fields['meta_keyword'] . "',
                    `meta_description`  =   '" . $fields['meta_description'] . "',
                    `image`             =   '" . $fields['image'] . "',
                    `date`              =   NOW()
                    WHERE Login_id = '" . $fields['Login_id'] . "'
                    ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }
    static function deleteSessions()
    {

        $conn = dbConn::getConnection();

        $sql = "DELETE FROM sessions_admin WHERE last_access_time < (NOW()-10000)"; 

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }
    static function deleteSessionWithSession_id($id)
    {

        $conn = dbConn::getConnection();

        $sql = "delete from sessions_admin where session_id='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }


    /*static function deleteSessionByAdminId($id)
    {

        $conn = dbConn::getConnection();

        $sql = "DELETE FROM sessions_admin WHERE admin_id='". $id . "'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }*/

    static function getAdminByUsername($fields)
    {
        //global $lang;
        $conn = dbConn::getConnection();
        /*$sql = "SELECT
                    *
                FROM
                    login
                WHERE
                    Login_id= '$id'";*/
        $sql = "SELECT `admin_id` , `name`, `family` FROM `admin` where  `username` = '".$fields['username']."' AND password = '".$fields['password']."'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        /*print_r_debug($sql);
        print_r_debug(!$stmt);*/
        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }

    static function getAdminByAdmin_id($id)
    {

        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `admin` where  `admin_id` = '$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }

}