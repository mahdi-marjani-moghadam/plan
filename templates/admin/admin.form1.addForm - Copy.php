<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {

        // DataTable
        /*    var table = $('#example').DataTable();

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
         } );*/


        //	dtatatable
        var dataTable = $('#example');
        var oTable = dataTable.DataTable({
//            "dom":'lfrti'
            "paging": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?=RELA_DIR?>admin/?component=form&action=search&status=<?=$list['status']?>",
            "ordering": false
        });

        // Apply the search
        oTable.columns().every(function () {
            var that = this;

            $('	:input select', this.footer()).on('keyup change', function () {
                that.search(this.value).draw();
            });
        });
        // Apply the search


    });




</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> وضعیت پیشرفت دانشکده</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl ">وضعیت پیشرفت واحد</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">


            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <? if($msg != ''): ?>
                    <?=$msg;?>
                <? endif;?>
                <style>td{white-space: nowrap;}</style>
                <form action="" method="post" enctype="multipart/form-data">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>کد</th>
                        <th>هدف کلان</th>
                        <th>هدف عملیاتی</th>
                        <th>اقدام</th>
                        <th>وزن اقدام</th>
                        <th>فعالیت</th>
                        <th>وزن فعالیت</th>
                        <th>درصد پیشرفت فعالیت سه ماهه (خود ارزیابی)</th>
                        <th>درصد پیشرفت فعالیت شش ماهه(خود ارزیابی)</th>
                        <th>درصد پیشرفت فعالیت نه ماهه(خود ارزیابی)</th>
                        <th>درصد پیشرفت فعالیت یکساله(خود ارزیابی)</th>
                    </tr>
                    </thead>

                </table>
                    <div style="width: 100%; float: right">

                        <? if($admin_info['status'] == 0 || $admin_info['status'] == 1 ): ?>
                        <input type="submit" class="btn btn-info btn-white btn-large btn-block" style="font-size: 20px" name="submit" value="ثبت موقت" />

<br>

                        <input type="submit" class="btn btn-success btn-white btn-large btn-block" style="font-size: 25px" name="submit2"  value="ثبت نهایی" />
                        <? endif;?>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>

<!--/content-body -->

<div class="modal fade customMobile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p class="phoneHolder"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->