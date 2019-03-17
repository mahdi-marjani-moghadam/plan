<?php
class clsPermissionsPage
{
    private $_action;
    private $_startPoint;
    private $_scriptName;
    private $_index;
    private $_base;

//******************************************
    function __construct($index, $base, $scriptName = '')
    {
        $this->_setPoint($index, $base);
        if (strlen($scriptName) == 0) {
            $this->_scriptName = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);
        } else {
            $this->_scriptName = $scriptName;
        }
    }

//******************************************
    public function __get($field)
    {
        if ($field == 'action') {
            return $this->_action;
        }
    }

//******************************************
    function __call($method, $args)
    {
        $method = '_' . $method;

        if (method_exists($this, $method)) {
            switch ($method) :
                case "_addAction" :
                    return $this->$method($args[0]);
                    break;
                case "_check" :
                    return $this->$method($args);
                    break;
                case "_getPointAction" :
                    return $this->$method($args[0]);
                    break;


            endswitch;
        }

    }

//******************************************
    private function _setPoint($index, $base)
    {

        $this->_index = $index;
        $this->_base = $base;
        $this->_startPoint = ($index - 1) * $base + 1;
    }

//*****************************************
    private function _setAction($args)
    {
        $this->_action[$args['action']]['action'] = $args['action'];//_setActionAction($args['action']);
        $this->_action[$args['action']]['code'] = $args['code'];//_setActioncode($args['code']);
        $this->_action[$args['action']]['label'] = $args['label'];    //_setActionlabel($args['label']);

    }

//******************************************
    private function _addAction($args)
    {
        $this->_setAction($args);
        $return['result'] = 1;
        $return['msgNo'] = 1;
        $return['msg'] = "Permission Added Successfully";

        return ($return);

    }

//******************************************
    private function _getPointAction($args)
    {

        return ($this->_startPoint + $this->_action[$args]['code'] - 1);

    }


//******************************************
    private function _check($args)
    {

        $action = $args[0];
        $code = $args[1];
        //echo '<pre/>';
        //print_r($args);
        if (isset($this->_action[$action])) {
            //$this->_action[$action]['code'].'<br/>';
            if ($code[$this->_startPoint + ($this->_action[$action]['code']) - 2] == 1) {

                $return['result'] = 1;
                $return['msgNo'] = 2;
                $return['msg'] = "";
                return ($return);
            } else {
                $return['result'] = -1;
                $return['msgNo'] = 3;
                $return['msg'] = "You Dont Have Permission To Access This " . $action;
                return ($return);


            }
        }


    }

//******************************************

}

//******************************************
function getAllPermisssion()
{
    $len = COUNT_PERMISSION;
    //******************** article **********************//
    $PagePermission['index'] = new clsPermissionsPage(1, $len);
    $PagePermission['index']->addAction(array('action' => 'deleteEvent', 'code' => 1, 'label' => 'delete event'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteEventGallery', 'code' => 2, 'label' => 'delete event'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteArtists', 'code' => 3, 'label' => 'delete artists'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteProduct', 'code' => 4, 'label' => 'delete product'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteCategory', 'code' => 5, 'label' => 'delete category'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteBanner', 'code' => 6, 'label' => 'delete banner'));//addArticle
    $PagePermission['index']->addAction(array('action' => 'deleteContactus', 'code' => 7, 'label' => 'delete contactus'));//addArticle


    return ($PagePermission);


    //******************************************

}