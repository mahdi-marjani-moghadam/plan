

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
        $('#tbl3 tbody tr').click(function () {
            //var head = $(this).closest('table').find('thead').clone();
            //$('.panel-body').append(head);
        });

        //	dtatatable
        var dataTable = $('#example');
        var oTable = dataTable.DataTable({
            "dom":'lrti',
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


        /** value more than prev input */
        $( document ).ajaxStop(function() {
            $(".percent-input").each(function (e) {

                var inputVal = parseInt($(this).val());
                var dataVal = $(this).data('season');
                var result = dataVal.split('-');

                var aData = parseInt($("div[data-season='"+(result[0]-1)+"-"+result[1]+"']").text());

                if(inputVal < aData){
                    this.setCustomValidity('مقدار وارد شده نباید از درصد نهایی دوره قبل کمتر باشد.');
                    //$(this).setAttribute('novalidate', true);
                    console.log(result[1]);

                }
                else {
                    this.setCustomValidity('');

                }

            });

            $(".percent-input").on('keyup',function (e) {

                var inputVal = parseInt($(this).val());
                var dataVal = $(this).data('season');
                var result = dataVal.split('-');

                var aData = parseInt($("div[data-season='"+(result[0]-1)+"-"+result[1]+"']").text());

                if(inputVal < aData ){
                    this.setCustomValidity('مقدار وارد شده نباید از درصد نهایی دوره قبل کمتر باشد.');
                    //$(this).setAttribute('novalidate', true);
                    console.log(result[1]);

                }
                else {
                    this.setCustomValidity('');
                    console.log(result[1] + 'clear');
                }

            });


            $('form').submit(function (b) {
                console.log('submit');
                $(".percent-input").each(function (eww) {
                    console.log('clear');
                    this.setCustomValidity('');
                });
            });

            /*$(".btn-info").on('click',function (e) {
                $('form').submit(function (b) {
                    b.preventDefault();
                },function (ee) {
                    $(".percent-input").each(function (eww) {
                        console.log('clear');
                        this.setCustomValidity('');
                    },function (q) {
                        console.log('submiyt');
                        //$('form').submit();
                    });
                });

            });*/


            $('table.dataTable').css('cssText','margin-top:0px !important ');
        });


// Code goes here
        'use strict'
        window.onload = function(){
            var tableCont1 = document.querySelector('.table-cont1');

            /**
             * scroll handle
             * @param {event} e -- scroll event
             */
            function scrollHandle (e){
                var scrollTop = this.scrollTop;
                //console.log(scrollTop);
                this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
            }

            tableCont1.addEventListener('scroll',scrollHandle);

        }

    });
</script>

<!--/*********page size**********/-->
<style>

    td{white-space: pre-wrap !important}
</style>

<style>
    .table-cont1,.table-cont2,.table-cont3{
        max-height: 600px;
        overflow: auto;

</style>


<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> فرم خوداظهاری واحد</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">فرم خوداظهاری واحد</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">

            <!-- separator -->
            <div class="table-responsive table-responsive-datatables">
                <? if($msg != ''): ?>
                    <?=$msg;?>
                <? endif;?>
                <style>td{white-space: nowrap;}</style>
                <form action="" method="post" enctype="multipart/form-data">
                    <? if($admin_info['status'] == 2):?>
                        <div class="alert alert-success">
                            <strong >شما در حال حاضر«منتظر نظر مافوق»هستید. درصورت (تائید مافوق)، دکمه "ثبت نهایی" فعال خواهد شد و در صورت (نیازمند اصلاح) دکمه های "ویرایش/ذخیره" و "ارسال به مافوق" مجددا فعال می گردند. </strong>
                        </div>
                    <? endif;?>

                    <? if($admin_info['status'] == 3):?>
                        <div class="alert alert-success">
                            <strong>اطلاعات مورد تائید است. شما میتوانید نسبت به ثبت نهایی اقدام نمائید. </strong>
                        </div>
                    <? endif;?>

                    <table style="font-size: larger">
                        <td style="color: #c7284a"> توجه: </td>

                        <tr>
                            <td style="color: #c7284a"> * درصد اعلامی هر دوره نمی‌تواند از درصد نهایی(تائید شده) دوره قبل «کمتر» باشد. </td>
                        </tr>
                        <tr>
                            <td style="color: #c7284a"> * ضروریست قبل از بارگذاری، به مستندات مورد نیاز هر اقدام در قسمت «؟» توجه گردد. </td>
                        </tr>
                        <tr>
                        <td style="color: #c7284a"> * «ثبت نهایی» به منزله تائید نهایی اطلاعات ثبت شده در سامانه تلقی می گردد و پس از آن امکان هیچگونه اصلاح یا تغییر وجود نخواهد داشت.</td>
                        </tr>
                        <tr>
                            <td style="color: #c7284a"> * درصورت عدم ثبت نهایی قبل از مهلت زمانی تعیین شده مرکز ارزیابی، مستندات فاقد اعتبار لازم جهت بررسی این مرکز خواهد بود.</td>
                        </tr>




                    </table>

                    <div class="panel-body">
                    <div id="container"  >
                        <div class='table-cont1'>
                    <table  id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr style="text-align: center">
                        <td colspan="5" bgcolor= #fff8dc>برنامه اختصاصی واحد</td>
                        <td colspan="2" bgcolor= #ffdf5e>سه ماهه</td>
                        <td colspan="2" bgcolor= #8DD4FF>شش ماهه</td>
                        <td colspan="2" bgcolor= #a4df80>نه ماهه</td>
                        <td colspan="2" bgcolor= #f2a89e>یکساله</td>
                    </tr>
                    <tr class="text-center">
                        <th width="20%" class="text-center"> کد فعالیت</th>
                        <th width="20%" style="align-content: center">هدف کلان</th>
                        <th width="20%" class="text-center">هدف عملیاتی</th>
                        <th width="20%" class="text-center">اقدام</th>

                        <th width="20%" class="text-center">فعالیت</th>

                        <th width="20%" class="text-center">درصد پیشرفت فعالیت</th>
                        <th width="20%" class="text-center">توضیحات</th>

                        <th width="20%" class="text-center">درصد پیشرفت فعالیت</th>
                        <th width="20%" class="text-center">توضیحات</th>

                        <th width="20%" class="text-center">درصد پیشرفت فعالیت</th>
                        <th width="20%" class="text-center">توضیحات</th>

                        <th width="20%" class="text-center">درصد پیشرفت فعالیت</th>
                        <th width="20%" class="text-center">توضیحات</th>
                    </tr>
                    </thead>

                </table>
                    <div style="width: 100%; float: right">

                    </div>
                        </div>
                    </div>
                    </div>

                    <? if($admin_info['status'] == 0 || ($admin_info['status'] == 1 ) && $admin_info['start_date'] <= date('Y-m-d') and $admin_info['finish_date'] >= date('Y-m-d') ): ?>
                        <input type="submit" class="btn btn-info btn-white btn-large " style="font-size: 20px" name="submit" value="ویرایش/ ذخیره" />
                    <? endif;?>

                    <? if ($admin_info['group_admin'] == 0 && $admin_info['status'] == 1 && $admin_info['start_date'] <= date('Y-m-d') and $admin_info['finish_date'] >= date('Y-m-d')): ?>
                        <input type="submit" class="btn btn-success btn-white btn-large" style="font-size: 20px" name="submit1" onclick="return confirm('آیا مطمئن هستید؟')"  value="ارسال به مافوق" />
                    <? endif;?>

                    <? if( $admin_info['status'] == 3 || ($admin_info['group_admin'] == 1 && $admin_info['status'] == 1) && $admin_info['start_date'] <= date('Y-m-d') and $admin_info['finish_date'] >= date('Y-m-d') ): ?>
                        <input type="submit" class="btn btn-success btn-white btn-large " style="font-size: 25px" name="submit2" onclick="return confirm('آیا مطمئن هستید؟')"  value="ثبت نهایی" />
                    <? endif;?>

                </form>
            </div>
        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>

<!--/content-body -->
