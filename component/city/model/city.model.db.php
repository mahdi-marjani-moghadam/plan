<?php

class cityModelDb
{
    //public static function getCities($province='')
    public static function getCities()
    {
        $conn = dbConn::getConnection();

//        if(is_array($province))
//        {
//            $append_sql='';
//            foreach ($province as $key =>$cityInfo)
//            {
//                $append_sql.= $cityInfo['province_id'].',';
//            }
//            $append_sql=substr($append_sql,0,-1);
//            $append_sql='where province_id in ('.$append_sql.')';
//        }

        $sql = "SELECT * FROM `city`";

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
            $list[$row['City_id']] = $row;
        }


        $result['result'] = 1;
        $result['export']['list'] = $list;
        return $result;
    }

    public static function getCityByIdArray($id = array())
    {
        $conn = dbConn::getConnection();

        $cities = "";
        foreach ($id as $i) {
            $cities.= "'$i',";
        }
        $cities = substr($cities, 0, -1);
        $sql = "SELECT * FROM city WHERE City_id IN (".$cities.")";
        $sql = "SELECT * FROM city";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        while ($row = $stmt->fetch())
        {
            $list[]= $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }
}
