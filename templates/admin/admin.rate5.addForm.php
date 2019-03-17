<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {
        var $modal = $('.customMobile');

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
            "processing": true,
            "serverSide": true,
            "ajax": "<?=RELA_DIR?>admin/?component=form&action=search2&status=<?=$list['status']?>",
            "ordering": false
        });

        // Apply the search
        //alert($("#search_9").val(`));

        oTable.columns().every(function () {
            var that = this;

            $('	:input select', this.footer()).on('keyup change', function () {
                that.search(this.value).draw();
            });
        });

        //	dtatatable

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
            <h3 class="panel-title rtl ">وضعیت پیشرفت دانشکده</h3>
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
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>کد</th>
                        <th>هدف کلان</th>
                        <th>هدف عملیاتی</th>
                        <th>اقدام</th>
                        <th>وزن اقدام</th>
                        <th>درصد پیشرفت اقدام سه ماهه-اعلامی واحد</th>
                        <th>درصد پیشرفت اقدام سه ماهه-تعدیلی</th>
                        <th>درصد پیشرفت اقدام شش ماهه-اعلامی واحد</th>
                        <th>درصد پیشرفت اقدام شش ماهه-تعدیلی</th>
                        <th>درصد پیشرفت اقدام نه ماهه-اعلامی واحد</th>
                        <th>درصد پیشرفت اقدام نه ماهه-تعدیلی</th>
                        <th>درصد پیشرفت اقدام یکساله-اعلامی واحد</th>
                        <th>درصد پیشرفت اقدام یکساله-تعدیلی</th>
                    </tr>
                    </thead>
                    <!--<tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><select style="display: none" name="search_9" class="search_init form-control" id="search_9">
                            <option value="">همه</option>
                            <option value="0">کارمند به خود نظری نداده</option>
                            <option value="1">منتظر نظر مدیر بلافصل</option>
                            <option value="11">منتظر نظر مدیر میانی</option>
                            <option value="111">منتظر نظر تائیید کننده نهایی</option>
                        </select>
                    </th>

                    <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                    </tfoot>-->
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>
<!--<p>
    <input type="submit" class="btn btn-info btn-white" name="submit" id="submit" value="ثبت" />
</p>-->
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