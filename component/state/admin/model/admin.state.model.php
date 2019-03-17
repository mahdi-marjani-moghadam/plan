<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 AM
 */
class adminStateModel
{
    /**
     * @var
     */
    private $TableName;
    /**
     * @var
     */
    private $fields;  // other record fields
    /**
     * @var
     */
    private $list;  // other record fields
    /**
     * @var
     */
    private $recordsCount;  // other record fields
    /**
     * @var
     */
    public $level = 0;


    /**
     * @var
     */
    private $result;

    /**
     * @param $field
     * @return mixed
     */
    public function __get($field)
    {
        if ($field == 'result') {
            return $this->result;
        } else if ($field == 'fields') {
            return $this->fields;
        } else if ($field == 'list') {
            return $this->list;
        } else if ($field == 'recordsCount') {
            return $this->recordsCount;
        } else {
            return $this->fields[$field];
        }

    }

    public function getStates()
    {
      include_once(dirname(__FILE__) . "/admin.state.model.db.php");
      $result = adminStateModelDb::getAll();

      if($result['result'] != 1)
      {
          return $result;
      }

      $this->list = $result['export']['list'];
      $this->recordsCount = $result['export']['recordsCount'];

      return $result;

    }

  }
