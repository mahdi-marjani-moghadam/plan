<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 AM.
 */
class cityModel extends looeic
{
    protected $TABLE_NAME = 'city';
    private $fields;  // other record fields
    private $list;  // other record fields
    private $recordsCount;  // other record fields
    private $pagination;  // other record fields

    private $result;

    /**
     * @param $fields
     *
     * @return mixed
     */
    public function getCities()
    {
        include_once dirname(__FILE__).'/city.model.db.php';

        $result = cityModelDb::getCities($fields);
        if ($result['result'] != 1) {
            return $result;
        }
        $this->list = $result['export']['list'];

        return $result;
    }
}
