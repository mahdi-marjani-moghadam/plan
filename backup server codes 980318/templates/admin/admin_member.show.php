<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {

        // Setup - add a text input to each footer cell
        $('#example tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        ////




        // Apply the search


    } );

</script>


<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>لسیت عاملیت ها</h2>
  </div><!--/content-header -->
    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">لسیت عاملیت ها</h3>
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
                    <div class="pull-right margin-bottom">
                        <a href="<?php echo RELA_DIR.'admin/members.php?action=add'?>" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن</a>
                    </div>

                    <div class="pull-right margin-bottom margin-right"></div>
                    <div class="pull-right margin-bottom margin-right"></div>

              <div class="row smallSpace"></div>

                    <table id="example" class="companyTable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کد نمایندگی</th>
                            <th>نام </th>
                            <th>نام خانوادگی</th>
                            <th>رمز عبور</th>
                            <th>موبایل</th>
                            <th>تلفن</th>
                            <th>تعیین قیمت</th>                         
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" name="search_10" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_20" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_40" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_50" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_70" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_80" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_80" value="" class="search_init form-control" /></th>
                            <th><input type="text" name="search_90" value="" class="search_init form-control" /></th>

                        </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</div>

<!--/content -->
