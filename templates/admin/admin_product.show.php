<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {

        var dataTable = $('#example');

        var oTable = dataTable.DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "<?=RELA_DIR?>admin/product.php?action=search&ajax=1"
        } );

        // Apply the search
        oTable.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                that.search( this.value ).draw();
            } );
        } );

    } );

</script>


<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>Companies</h2>
    </div><!--/content-header -->
    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">Companies</h3>
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
                <?php

                if($list!=null)
                {
                ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning margin-bottom">
                        <?php
                        echo $list['label']['announce'];
                        foreach($list['list']['announce'] as $key=>$value)
                        {
                           echo '<strong>'.$value['announce_name'].'</strong>, ';
                        }
                        echo $list['label']['outbound'];

                        ?>
                    </div>
                <?php
                }
                ?>
                <form method="post" action="<?=RELA_DIR.'admin/product.php?action=changeStatus';?>" name="action" id="action">
                    <div class="pull-right margin-bottom">
                        <a href="<?php echo RELA_DIR.'admin/product.php?action=add'?>" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن</a>
                    </div>

                    <div class="pull-right margin-bottom margin-right"></div>
                    <div class="pull-right margin-bottom margin-right"></div>

                    <div class="row smallSpace"></div>

                    <table id="example" class="companyTable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام </th>
                            <th>واحد شمارش</th>
                            <th>متر</th>
                            <th>مبلغ (تومان)</th>
                            <th>وضعیت</th>
                            <th>کد رنگ</th>
                            <th>عملیات</th>

                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th><input type="text" name="search_10" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_20" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>

                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<!--/content -->
