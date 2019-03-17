<?php

class stateModelDb
{
    public static function getStates()
    {
        $conn = dbConn::getConnection();

        $sql = 'SELECT * FROM `state`';

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
            $list[]= $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }

    public static function getStateByIdArray($id = array())
    {
        $conn = dbConn::getConnection();

        $states = "";
        foreach ($id as $i) {
            $states.= "'$i',";
        }
        $states = substr($states, 0, -1);
        $sql = "SELECT * FROM state WHERE State_id IN (".$states.")";

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
