<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/22/2016
 * Time: 11:35 PM
 */
class adminadminModel extends looeic
{
    protected $rules = array(
        'title' => 'required',
        'brief_description' => 'required'
    );

}