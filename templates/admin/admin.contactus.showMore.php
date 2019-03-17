<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="content-body">

    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">جزییات پیام</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?php if($msg!=null)
        {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
        <?php
        }
        ?>
        <div class="panel-body">
            <div class="content-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <span>موضوع:</span> <?php echo $list['subject']; ?>
                        <div class="row xsmallSpace"></div>
                        <span>ایمیل:</span> <?php echo $list['email']; ?>
                        <div class="row xsmallSpace"></div>
                        <span>نظرات:</span> <?php echo $list['comment']; ?>
                        <div class="row xsmallSpace"></div>
                        <span>وضعیت:</span> <?php echo $list['status']; ?>
                        <div class="row xsmallSpace"></div>
                        <span>تاریخ:</span> <?php echo $list['date']; ?>
                        <div class="row xsmallSpace"></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
?>
