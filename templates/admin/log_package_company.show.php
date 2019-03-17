<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="undefined"></i> </h2>
    </div><!--/content-header -->
    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl"><i class="fa fa-shopping-cart text-orange"></i>فاکتور ها </h3>
                <div class="panel-actions">
                    <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                        <i class="fa fa-expand"></i>
                    </button>
                    <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div><!-- /panel-actions -->
            </div><!-- /panel-heading -->
            <div class="panel-body">
                <?php if($msg!=null)
                { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-success margin-bottom">
                        <?= $msg ?>
                    </div>
                <?php
                }
                ?>
                <div class="table-responsive table-responsive-datatables ts-pager1">
                    <table class="tablesorter table rtl table-bordered">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>تاریخ صدور</th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ انقضا</th>
                            <th>تعداد</th>
                            <th>قیمت</th>
                            <th>تاریخ پرداخت</th>
                            <th>نوع پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach($list as $key=>$value){
                            ?>
                            <tr>
                                <td><?php echo $cnt++; ?></td>
                                <td><?php echo $value['issue_date']; ?></td>
                                <td><?php echo $value['start_date']; ?></td>
                                <td><?php echo $value['expire_date'] ?></td>
                                <td><?php echo $value['extension_count'] ?></td>
                                <td><?php echo $value['price'] ?></td>
                                <td><?php echo $value['pay_date'] ?></td>
                                <td><?php echo $value['payment_type'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>

                        <tfoot>
                        </tfoot><!--/tfoot-->
                    </table>
                </div>
                <!--/table-responsive-->
            </div>
        </div>
    </div>
</div>
