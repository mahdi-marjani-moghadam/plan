<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/06/2016
 * Time: 12:08 AM
 */
include_once(dirname(__FILE__). "/model/admin.review.controller.php");

global $admin_info,$PARAM;

$reviewController = new adminReviewController();
if(isset($exportType))
{
    $reviewController->exportType=$exportType;
}


switch ($_GET['action'])
{
    /*case 'showMore':
        $reviewController->showMore($_GET['id']);
        break;

*/
    case 'deleteReview':

        $input['Review_id']=$_GET['id'];
        $reviewController->deleteReview($input);

        break;
    case 'addReview':
        if(isset($_POST['action']) & $_POST['action']=='add')
        {

            $reviewController->addReview($_POST);
        }
        else
        {
            $reviewController->showReviewAddForm('','');
        }
        break;
    case 'editReview':
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {

            $reviewController->editReview($_POST);
        }
        else
        {
            $input['Review_id']=$_GET['id'];
            $reviewController->showReviewEditForm($input, '');
        }
        break;
    default:

        //$fields['order']['Review_id'] = 'DESC';
        $reviewController->showList($fields);
        break;
}

?>