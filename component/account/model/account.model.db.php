<?php

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
class adminPackageModelDb
{
    static function insert($fields)
    {
        $conn = dbConn::getConnection();
        $sql = "
                    INSERT INTO package(
                    `product`,
                    `category`,
                    `keyword`,
                    `lang`,
                    `packagetype`,                  
                    `date`
                    )
                    VALUES(
                    '" . $fields['product'] . "',
                    '" . $fields['category']  . "',
                    '" . $fields['keyword']  . "',
                    '" . $fields['lang']  . "',
                    '" . $fields['packagetype']  . "',
                    NOW()
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if (!$stmt)
        {//print_r_debug('no');
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['export']['insert_id']=$conn->lastInsertId();
      //  print_r_debug($stmt);
        $result['result'] = 1;
        return $result;
    }
    static function delete($fields)
    {
        $conn = dbConn::getConnection();

        $sql = "
                DELETE FROM package
                    WHERE Package_id = '" . $fields['Package_id'] . "'
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
    static function getPackageById($id)
    {
        //global $lang;
        $conn = dbConn::getConnection();
        $sql = "SELECT
                    *
                FROM
                    package
                WHERE
                    Package_id= '$id'";
//print_r_debug($sql) ;
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
//print_r_debug($result);
        return $result;
    }
    public function getPackage($fields='')
    {
        $conn = dbConn::getConnection();
        include_once(ROOT_DIR."/model/db.inc.class.php");
        $condition= DataBase::filterBuilder($fields);
        $sql = "SELECT SQL_CALC_FOUND_ROWS
                 *
    		     FROM 	package ".$condition['list']['WHERE'].$condition['list']['filter'].$condition['list']['order'].$condition['list']['limit'];
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
    //    print_r_debug($condition);
//print_r_debug($sql);
        if (!$stmt)
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $sql=" SELECT FOUND_ROWS() as recCount ";
      //  print_r_debug($sql);
        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();
        $result['export']['recordsCount']= $rowP['recCount'];
       // print_r_debug($result['export']['recordsCount']);
        while ($row = $stmt->fetch())
        {
            $list[$row['Package_id']]= $row;
       //     print_r_debug($list);
        }
        $result['result'] = 1;
        $result['export']['list'] = $list;
    // print_r_debug($result);
        return $result;
    }
}