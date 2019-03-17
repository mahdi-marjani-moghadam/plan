<?php
class provinceModelDb
{


    public static function getProvinceByNameArray($name = array())
    {
        $conn = dbConn::getConnection();
        $names = explode(',', $name);
        $provinces = '';
        foreach ($names as $name) {
            $provinces .= "'$name',";
        }

        $provinces = substr($provinces, 0, -1);
        $sql = 'SELECT * FROM province WHERE name IN ('.$provinces.')';

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

    public static function getProvinces()
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

        while ($row = $stmt->fetch())
        {
            $list[$row['province_id']]= $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }
}
