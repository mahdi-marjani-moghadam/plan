<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 11:02 AM
 */
class registerModelDb
{

    static function insert($fields)
    {
        $conn = dbConn::getConnection();
        $sql = "
                    INSERT INTO company(
                    `company_name`,
                    `coordinator_name`,
                    `coordinator_phone`,
                    `coordinator_family`,
                    `email`,
                    `site`,
                    `date`,
                    `address`,
                    `status`
                    )
                    VALUES(
                    '" . $fields['company_name']  . "',
                    '" . $fields['coordinator_name']  . "',
                    '" . $fields['coordinator_phone']  . "',
                    '" . $fields['coordinator_family']  . "',
                    '" . $fields['email']  . "',
                    '" . $fields['site']  . "',
                     NOW(),
                    '" . $fields['address']  . "',
                     '0'
                    )";


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

        include_once(ROOT_DIR . "/component/company/admin/model/admin.company.model.db.php");

        $f = [
          'company_phone' => [
            'subject' => [
              'روابط عمومی'
            ],
            'number' => [
              $fields['company_phone1']
            ],
            'state' => [
              'سایر'
            ],
            'value' => [
              ''
            ]
          ]
        ];

        $result['result'] = adminCompanyModelDb::insertToPhones($f,$result['export']['insert_id']);

        if (!$result['result'])
        {
            return $result;
        }

        $result['result'] = 1;
        return $result;
    }






}
