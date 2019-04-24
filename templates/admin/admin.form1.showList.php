<!--suppress ALL -->
<!--<link rel="stylesheet" href="<?php /*echo RELA_DIR; */?>templates/<?php /*echo CURRENT_SKIN; */?>/assets/css/buttons.dataTables.min.css">
-->
<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        $('#tbl3 tbody tr').click(function () {
            //var head = $(this).closest('table').find('thead').clone();
            //$('.panel-body').append(head);
        });

        var $modal = $('.customMobile');


        //	dtatatable
        var dataTable = $('#example');

        var oTable = dataTable.DataTable({
            "dom": 'frptiB',
            /*"buttons": [
             'copy', 'csv', 'excel', 'pdf', 'print'
             ],*/

            buttons: [{
                extend: 'excelHtml5',
                customize: function (win) {
                    // console.log(win.content_type);
                    /*console.log(win.document);
                     $(win.document.body)
                     .css('font-size', '14pt')
                     .css('direction', 'rtl')
                     .attr('align', 'center');*/

                    /*$(win.document.body).find('table')
                     .addClass('compact')
                     .css('font-size', '10px')
                     .attr('align', 'center')
                     .css('width', '870px');*/

                },
                customizeData: function ( data ) {

                    // return false;
                    for (var i=0; i<data.body.length; i++){
                        for (var j=0; j<data.body[i].length; j++ ){

                            data.body[i][j] = '\u200C' + data.body[i][j];
                            data.body[i][j] = data.body[i][j].replace('                                   ◄                                     ▼ واحد','');
                            data.body[i][j] = data.body[i][j].replace('                                     ◄                                         ▼ واحد','');
                            data.body[i][j] = data.body[i][j].replace('                                       ◄                                             ▼ واحد','');
                            data.body[i][j] = data.body[i][j].replace('                                                ▼ واحد','');


                        }

                    }
                    //console.log(data);

                }
                /* customize: function(xlsx) {
                 var sheet = xlsx.xl.worksheets['sheet1.xml'];

                 // Loop over the cells in column `C`
                 $('row ', sheet).each( function () {
                 if ( $('is t', this).text() == '◄' ) {
                 $(this).attr( 's', '20' );
                 }
                 });

                 }*/
            }],
            "paging":false,
            "processing": true,
            "searching": false,

//            "ajax": "<?//=RELA_DIR?>//admin/?component=form&action=search2&status=<?//=$list['status']?>//",
            "ordering": false
        });


        oTable.columns().every(function () {
            var that = this;

            $('	:input select', this.footer()).on('keyup change', function () {
                that.search(this.value).draw();
            });


        });

        $(document).ready(function () {


            /** +/- */
            $('.show-more').click(function (e) {

                e.preventDefault();
                var level = $(this).data('level');
                //alert(level);
                var no = $(this).data(level+'_no');

                if($(this).hasClass('active')){
                    $('.'+level+'-'+no).hide();

                    $(this).removeClass('active');

                    $('.kalan-active').removeClass('kalan-active');

                    if(level == 'kalan')
                    {
                        $('.tr-eghdam').hide();
                        $('.tr-faaliat').hide();


                        /** remove class active amaliati level*/
                        $(".show-more[data-level='amaliati']").each(function (index) {
                            $(this).removeClass('active');
                        });

                        /** remove class active eghdam level*/
                        $(".show-more[data-level='eghdam']").each(function (index) {
                            $(this).removeClass('active');
                        });


                        /** remove class active eghdam admin level*/
                        $('.tr-amaliati-admins').hide();
                        $(".show-more-admin[data-level='amaliati']").each(function (index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active eghdam admin level*/
                        $('.tr-eghdam-admins').hide();
                        $(".show-more-admin[data-level='eghdam']").each(function (index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active faaliat admin level*/
                        $('.tr-faaliat-admins').hide();
                        $(".show-more-admin[data-level='faaliat']").each(function (index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.kalan-no-group-'+no).hide();
                        $('.a-show-group-kalan-'+no).removeClass('active');
                    }
                    if(level == 'amaliati')
                    {
                        $('.tr-faaliat').hide();

                        /** remove class active eghdam level*/
                        $(".show-more[data-level='eghdam']").each(function (index) {
                            $(this).removeClass('active');
                        });

                        /** remove class active eghdam admin level*/
                        $('.tr-eghdam-admins').hide();
                        $(".show-more-admin[data-level='eghdam']").each(function (index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active faaliat admin level*/
                        $('.tr-faaliat-admins').hide();
                        $(".show-more-admin[data-level='faaliat']").each(function (index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.amaliati-no-group-'+no).hide();
                        $('.a-show-group-amaliati-'+no).removeClass('active');


                    }
                    if(level == 'eghdam'){
                        $('.tr-faaliat-admins').hide();

                        $(".show-more-admin[data-level='faaliat']").each(function (index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.eghdam-no-group-'+no).hide();
                        $('.a-show-group-eghdam-'+no).removeClass('active');


                    }

                }
                else
                {
                    $('.'+level+'-'+no).show();
                    $(this).addClass('active');
                }

            });


            /** show level */
            $('.show-level').change(function (e) {

                var level = $(this).val();

                if(level == 'kalan'){
                    $('.tr-amaliati').hide();
                    $('.tr-eghdam').hide();
                    $('.tr-faaliat').hide();



                    $('.tr-kalan-admins').hide();
                    $('.tr-amaliati-admins').hide();
                    $('.tr-eghdam-admins').hide();
                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();



                    /**  >  */
                    $(".show-more[data-level='kalan'] , .show-more-admin[data-level='kalan'] , .show-more-group-kalan").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='amaliati'] , .show-more-admin[data-level='amaliati'] , .show-more-group-amaliati").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function (index) {
                        $(this).removeClass('active');
                    });


                }
                if(level == 'amaliati'){
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').hide();
                    $('.tr-faaliat').hide();



                    $('.tr-kalan-admins').hide();
                    $('.tr-amaliati-admins').hide();
                    $('.tr-eghdam-admins').hide();
                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();


                    /** - */
                    $(".show-more[data-level='kalan']").each(function (index) {
                        $(this).addClass('active');
                    });


                    /**  >  */
                    $(" .show-more-admin[data-level='kalan'] , .show-more-group-kalan").each(function (index) {
                        $(this).removeClass('active');
                    });
                    /**  >  */
                    $(".show-more[data-level='amaliati'] , .show-more-admin[data-level='amaliati'] , .show-more-group-amaliati").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function (index) {
                        $(this).removeClass('active');
                    });
                }
                if(level == 'eghdam'){
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').show();
                    $('.tr-faaliat').hide();

                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();

                    /** - */
                    $(".show-more[data-level='kalan']").each(function (index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='amaliati']").each(function (index) {
                        $(this).addClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function (index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function (index) {
                        $(this).removeClass('active');
                    });
                }
                if(level == 'faaliat'){
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').show();
                    $('.tr-faaliat').show();

                    /** - */
                    $(".show-more[data-level='kalan']").each(function (index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='amaliati']").each(function (index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='eghdam']").each(function (index) {
                        $(this).addClass('active');
                    });
                }

            });

            /** show amaliati */
            $('.show-amaliati').click(function (e) {
                e.preventDefault();

                $('.tr-amaliati').show();
                $('.tr-eghdam').hide();
                $('.tr-faaliat').hide();

                /** add class active */
                $(".show-more[data-level='kalan']").each(function (index) {
                    $(this).addClass('active');
                });

                /** remove class active amaliati level*/
                $(".show-more[data-level='amaliati']").each(function (index) {
                    $(this).removeClass('active');
                });

                /** remove class active eghdam level*/
                $(".show-more[data-level='eghdam']").each(function (index) {
                    $(this).removeClass('active');
                });

                $(this).addClass('kalan-active');

            });



            $('table.dataTable').css('cssText','margin-top:0px !important ');
            $('button.buttons-excel').css('cssText','position: absolute; top: 2px; left: 89px;').addClass('btn-default').addClass('btn');
        });

        /** show-admin */
        $('.show-admin').click(function (e) {

            var adminId = $(this).val();
            console.log(adminId);

            if(adminId != 0){
                //alert(adminId);

                location.href = window.location.origin + '/admin/?component=form&q=,'+adminId+',';
            }

        });

        $("select[id=admin]").select2({
            placeholder: "کل",
            allowClear: true
        });

        /** show-columns */
        $('.show-columns').click(function (e) {

            var columns = $(this).val();

            $('table tbody tr td').hide();
            $('table thead th').hide();
            $.each(columns,function (i,column) {
                //console.log(column);

                $('table tbody tr').find('td:eq('+column+')').show()
                $('table thead tr').find('th:eq('+column+')').show()

            })
            $('table').attr({'style':'width: auto;'});
        });

        /** +/- */
        $('.show-more-admin').click(function (e) {
            e.preventDefault();

            var level = $(this).data('level');
            var no = $(this).data(level+'_no');

//            alert(level);
//            alert(no);
            if($(this).hasClass('active')){
                $('.'+level+'-admin-'+no).hide();
                $(this).removeClass('active');

                // hidden groups
                $('.faaliat-no-group-'+no).hide();
                $('.show-more-admin-'+no).removeClass('active');
            }
            else
            {
                $('.'+level+'-admin-'+no).show();
                $(this).addClass('active');
            }

        });

        $('.show-more-group-faaliat').click(function (e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if($(this).hasClass('active')){
                $('.admins-group-'+admin).hide();
                $(this).removeClass('active');
            }
            else
            {
                $('.admins-group-'+admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-eghdam').click(function (e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if($(this).hasClass('active')){
                $('.admins-group-eghdam-'+admin).hide();
                $(this).removeClass('active');
            }
            else
            {
                $('.admins-group-eghdam-'+admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-amaliati').click(function (e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if($(this).hasClass('active')){
                $('.admins-group-amaliati-'+admin).hide();
                $(this).removeClass('active');
            }
            else
            {
                $('.admins-group-amaliati-'+admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-kalan').click(function (e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if($(this).hasClass('active')){
                $('.admins-group-kalan-'+admin).hide();
                $(this).removeClass('active');
            }
            else
            {
                $('.admins-group-kalan-'+admin).show();
                $(this).addClass('active');
            }
        });

        $("input[data-input='manager']").keyup(function (e) {

            var position = $(this).data('position'); // 5010_1_1

            $("input[data-input='manager_faaliat_"+position+"']").val($(this).val());

        });
        // Code goes here
        'use strict'
        window.onload = function(){
            var tableCont1 = document.querySelector('.table-cont1');


            function scrollHandle (e){
                var scrollTop = this.scrollTop;
                //console.log(scrollTop);
                this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
                if(scrollTop > 10){
                    $('thead tr th').html();
                }
            }

            tableCont1.addEventListener('scroll',scrollHandle)

        }

        $('.w100').keyup(function (e) {
            if($(this).val() < 0 || $(this).val() > 100)
            {
               alert('مقدار '+$(this).val() + ' صحیح نمی باشد.');
                $(this).val('')
            }
            else if(!$.isNumeric($(this).val())){
                alert('مقدار '+$(this).val() + ' صحیح نمی باشد.');
                $(this).val('')
            }
        });

    });
</script>



<style>
    .table-cont1,.table-cont2,.table-cont3{
        max-height: 600px;
        overflow: auto;
    }
    .word-wrap{
        position: relative;
        width:260px;  /* adjust to desired wrapping */
        padding: 0px !important;
        white-space: pre-wrap; /* css-3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        word-wrap: break-word; /* Internet Explorer 5.5+ */
        z-index: 2;
    }
    input{ autocomplete="off" }
    .active,.kalan-active{color: red !important; content: '▬'}
    .word-wrap div{padding: 5px 5px 5px 15px;}
    .show-more{ font-weight: bold; position: absolute; bottom: 0; padding-top: 15px; height: 50px; margin-bottom:10px; background: #f1ff8b;   left: 0;}
    .show-more:hover,.show-more:focus{text-decoration: none}
    .show-more-admin{ background-color: rgb(212,247,255); position: absolute; bottom: 0; left: 0; width: 100%; text-align: center}
    /*th{width: auto !important}*/
    th{width: 100px}
    .tr-amaliati{display: none}
    .tr-eghdam{display: none}
    .tr-faaliat{display: none}
    .tr-faaliat-admins,.tr-eghdam-admins,.tr-amaliati-admins,.tr-kalan-admins,.tr-admins-group{display: none }
    .select2-container-multi .select2-choices li{float: right}
    .select2-container-multi .select2-choices .select2-search-choice{padding: 3px 16px 3px 5px}
    table.dataTable thead>tr>th, table.dataTable thead>tr>td{padding-right: 10px}
    th {        text-align: center !important;  }
    input.w100{ width: 40px}
    table.table-bordered.dataTable td{border-left-width:1px;}
    button.btn.call{ position: static;
    button.btn.fixed{ position: fixed; bottom: 10px; z-index: 0;left:
            3
    }
    footer{display: none  }

</style>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> وضعیت پیشرفت </a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">

    <style>td{white-space: nowrap;}</style>
    <form action="<?=RELA_DIR?>admin/?component=form&action=sabt"  method="post">

        <a style="display: none" class="show-amaliati btn btn-info" >نمایش در سطح عملیاتی</a>

        <label for="admin">واحد:</label>


        <select id="admin" class="show-admin" multiple >
            <? foreach ($list['showAdmin'] as $k => $admins):?>
                <option <? if(strpos($_GET['q'], ','.$admins['admin_id'].',') !== false){ echo 'selected';}?> value="<?=$admins['admin_id']?>"><?=$admins['name'].' '.$admins['family']?></option>
            <? endforeach; ?>
        </select>


        <label for="level"> سطح:</label>

        <select id="level" class="show-level">
            <option value="kalan">نمایش در سطح کلان</option>
            <option value="amaliati">نمایش در سطح عملیاتی</option>
            <option value="eghdam">نمایش در سطح اقدام</option>
            <option value="faaliat">نمایش در سطح فعالیت</option>
        </select>

        <label for="columns">نمایش ستون:</label>
        <select id="columns" class="show-columns" multiple>
            <option selected value="0">1</option>
            <option selected value="1">2</option>
            <option selected value="2">3</option>
            <option selected value="3">4</option>
            <option selected value="4">5</option>
            <option selected value="5">6</option>
            <option selected value="6">7</option>
            <option selected value="7">8</option>
            <option selected value="8">9</option>

            <? if($admin_info['parent_id']==0):?>
                <option selected value="9">10</option>
                <option selected value="10">11</option>
                <option selected value="11">12</option>
                <option selected value="12">13</option>
            <? endif;?>

            <option selected value="13">14</option>
            <option selected value="14">15</option>
            <option selected value="15">16</option>
            <option selected value="16">17</option>

            <? if($admin_info['parent_id']==0):?>
                <option selected value="17">18</option>
                <option selected value="18">19</option>
                <option selected value="19">20</option>
                <option selected value="20">21</option>
            <? endif;?>

            <option selected value="21">22</option>
            <option selected value="22">23</option>
            <option selected value="23">24</option>
            <option selected value="24">25</option>

            <? if($admin_info['parent_id']==0):?>
                <option selected value="25">26</option>
                <option selected value="26">27</option>
                <option selected value="27">28</option>
                <option selected value="28">29</option>
            <? endif;?>

            <option selected value="29">30</option>
            <option selected value="30">31</option>
            <option selected value="31">32</option>
            <option selected value="32">33</option>
            <? if($admin_info['parent_id']==0):?>
                <option selected value="33">34</option>
                <option selected value="34">35</option>
                <option selected value="35">36</option>
                <option selected value="36">37</option>
            <? endif;?>
            <option selected value="37">38</option>
        </select>


        <!-- separator -->
        <div id="panel-1" class="panel panel-default border-blue">
            <div class="panel-heading bg-green">
                <h3 class="panel-title rtl ">وضعیت پیشرفت</h3>
                <div class="panel-actions">
                    <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                    <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
            <div class="panel-body">


                <!-- separator -->
                <!--            <div class="row smallSpace"></div>
                -->            <div class="table-responsive table-responsive-datatables">
                    <? if($msg != ''): ?>
                        <?=$msg;?>
                    <? endif;?>


                    <div class="panel-body">
                        <div id="container" style="width: 100%;" >
                            <div class='table-cont1'>
                                <table id="example" class="  table-bordered rtl" cellspacing="0" >
                                    <thead>
                                    <tr>

                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>

                                        <th style="background-color: #7dff7f; border: 0">7</th>
                                        <th style="background-color: #7dff7f; border: 0">8</th>
                                        <th style="background-color: #7dff7f; border: 0">9</th>

                                        <? if($admin_info['parent_id']==0):?>
                                            <th style="background-color: #7dff7f; border: 0">10</th>
                                            <th style="background-color: #7dff7f; border: 0">11</th>
                                            <th style="background-color: #7dff7f; border: 0">12</th>
                                            <th style="background-color: #7dff7f; border: 0">13</th>
                                        <? endif;?>
                                        <th style="background-color: #7dff7f; border: 0">14</th>

                                        <th style="background-color: #f2a89e; border: 0">15</th>
                                        <th style="background-color: #f2a89e; border: 0">16</th>
                                        <th style="background-color: #f2a89e; border: 0">17</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th style="background-color: #f2a89e; border: 0">18</th>
                                            <th style="background-color: #f2a89e; border: 0">19</th>
                                            <th style="background-color: #f2a89e; border: 0">20</th>
                                            <th style="background-color: #f2a89e; border: 0">21</th>
                                        <? endif;?>
                                        <th style="background-color: #f2a89e; border: 0">22</th>


                                        <th style="background-color: #ffbe62; border: 0">23</th>
                                        <th style="background-color: #ffbe62; border: 0">24</th>
                                        <th style="background-color: #ffbe62; border: 0">25</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th style="background-color: #ffbe62; border: 0">26</th>
                                            <th style="background-color: #ffbe62; border: 0">27</th>
                                            <th style="background-color: #ffbe62; border: 0">28</th>
                                            <th style="background-color: #ffbe62; border: 0">29</th>
                                        <? endif; ?>
                                        <th style="background-color: #ffbe62; border: 0">30</th>


                                        <th style="background-color: #8DD4FF; border: 0">31</th>
                                        <th style="background-color: #8DD4FF; border: 0">32</th>
                                        <th style="background-color: #8DD4FF; border: 0">33</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th style="background-color: #8DD4FF; border: 0">34</th>
                                            <th style="background-color: #8DD4FF; border: 0">35</th>
                                            <th style="background-color: #8DD4FF; border: 0">36</th>
                                            <th style="background-color: #8DD4FF; border: 0">37</th>
                                        <? endif;?>
                                        <th style="background-color: #8DD4FF; border: 0">38</th>

                                    </tr>
                                    <tr style="background-color: #355f29; color:#fff; text-align: center">
                                        <th>کد</th>
                                        <th>هدف کلان</th>
                                        <th>هدف عملیاتی</th>
                                        <th>اقدام</th>
                                        <th>فعالیت</th>
                                        <th>وزن</th>
                                        <th>اعلامی واحد</th>
                                        <th>توضیحات اعلامی واحد</th>
                                        <th>درصد تعدیلی مرکز</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th>تطابق مستند با درصد اعلامی</th>
                                            <th>تطابق سایت با درصد اعلامی</th>
                                            <th>تطابق جلسه با درصد اعلامی</th>
                                            <th> max</th>
                                        <? endif;?>
                                        <th>توضیحات </th>
                                        <th>اعلامی واحد</th>
                                        <th>توضیحات اعلامی واحد</th>
                                        <th>درصد تعدیلی مرکز</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th>تطابق مستند با درصد اعلامی</th>
                                            <th>تطابق سایت با درصد اعلامی</th>
                                            <th>تطابق جلسه با درصد اعلامی</th>
                                            <th> max</th>
                                        <? endif;?>
                                        <th>توضیحات </th>
                                        <th>اعلامی واحد</th>
                                        <th>توضیحات اعلامی واحد</th>
                                        <th>درصد تعدیلی مرکز</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th>تطابق مستند با درصد اعلامی</th>
                                            <th>تطابق سایت با درصد اعلامی</th>
                                            <th>تطابق جلسه با درصد اعلامی</th>
                                            <th> max</th>
                                        <? endif;?>
                                        <th>توضیحات </th>
                                        <th>اعلامی واحد</th>
                                        <th>توضیحات اعلامی واحد</th>
                                        <th>درصد تعدیلی مرکز</th>
                                        <? if($admin_info['parent_id']==0):?>
                                            <th>تطابق مستند با درصد اعلامی</th>
                                            <th>تطابق سایت با درصد اعلامی</th>
                                            <th>تطابق جلسه با درصد اعلامی</th>
                                            <th> max</th>
                                        <? endif;?>
                                        <th>توضیحات </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <? foreach ($list['kalans'] as $kalan_no => $vKalan): ?>

                                        <tr class="">
                                            <td><?=$kalan_no?></td>
                                            <td class="word-wrap" style=" display: inline-table;width: 100% ">
                                                <div><?=$vKalan['kalan_name']?>
                                                    <a class="show-more " data-level="kalan" data-kalan_no="<?=$kalan_no?>" href="#">◄</a>
                                                    <a class="show-more-admin " data-level="kalan" data-kalan_no="<?=$kalan_no?>" href="#">▼ واحد</a>
                                                </div>
                                            </td>
                                            <td style="background-color: whitesmoke"></td>
                                            <td style="background-color: whitesmoke"></td>
                                            <td style="background-color: whitesmoke"></td>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H1'";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['HH1'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H1";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['H1'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <? endif;?>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H2'";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['HH2'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H2";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['H2'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <? endif;?>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H3'";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['HH3'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H3";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['H3'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <? endif;?>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H4'";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['HH4'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <td></td>
                                            <td><?if(isset($_GET['dev']))echo "H4";?>
                                                <? if($admin_info['parent_id']==0):?>
                                                <?=substr($vKalan['H4'],0,5)?>
                                                <? endif;?>
                                            </td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <? endif;?>
                                            <td></td>

                                        </tr>
                                        <? foreach ($vKalan['admins'] as $KAId => $vAdmins):?>
                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-kalan-admins kalan-admin-<?=$kalan_no?>">
                                                <td></td>
                                                <td class="word-wrap" style="white-space:nowrap;"><div><!--تجمیع--> <?=$vAdmins['admin_name'].' '.$vAdmins['family']?><a class="show-more-group-kalan show-more-admin-<?=$kalan_no?> a-show-group-kalan-<?=$kalan_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$KAId?>-<?=$kalan_no?>"  href="#">▼ </a></div></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G1'";?><?=substr($vAdmins['GG1'],0,5)?></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G1";?><?=substr($vAdmins['G1'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G2'";?><?=substr($vAdmins['GG2'],0,5)?></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G2";?><?=substr($vAdmins['G2'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G3'";?><?=substr($vAdmins['GG3'],0,5)?></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G3";?><?=substr($vAdmins['G3'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G4'";?><?=substr($vAdmins['GG4'],0,5)?></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "G4";?><?=substr($vAdmins['G4'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>

                                            </tr>
                                            <? foreach ($vAdmins['groups'] as $id => $vKGroup):?>
                                                <tr style="background-color: rgb(212,247,255) !important;"
                                                    class="tr-admins-group admins-group-kalan-<?=$KAId?>-<?=$kalan_no?>
                                            kalan-no-group-<?=$kalan_no?>
                                            " >
                                                    <td></td>
                                                    <td class="word-wrap|--- "><?=$vKGroup['group_name'].' '.$vKGroup['group_family']?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "Q1'-";?><?=substr($vKGroup['QQ1'],0,5)?></td>
                                                    <td></td>

                                                    <td><?if(isset($_GET['dev']))echo "Q1 ";?><?=substr($vKGroup['Q1'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>

                                                    <td><?if(isset($_GET['dev']))echo "Q2'";?><?=substr($vKGroup['QQ2'],0,5)?></td>
                                                    <td></td>

                                                    <td><?if(isset($_GET['dev']))echo "Q2";?><?=substr($vKGroup['Q2'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "Q3'";?><?=substr($vKGroup['QQ3'],0,5)?></td>
                                                    <td></td>

                                                    <td><?if(isset($_GET['dev']))echo "Q3";?><?=substr($vKGroup['Q3'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "Q4'";?><?=substr($vKGroup['QQ4'],0,5)?></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "Q4";?><?=substr($vKGroup['Q4'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                </tr>
                                            <? endforeach;?>
                                        <? endforeach;?>


                                        <? foreach ($vKalan['amaliatis'] as $amaliati_no => $vAmaliati):?>
                                            <tr class="tr-amaliati kalan-<?=$kalan_no?>" >
                                                <td></td>
                                                <td></td>
                                                <td class="word-wrap" style=" display: inline-table;width: 100% " rowspan="<?=$vKalan['amaliatiRow']?>" style="width:150px !important; ">
                                                    <div><?=$vAmaliati['amaliati_name']?>
                                                        <a class="show-more" data-level="amaliati" data-amaliati_no="<?=$amaliati_no?>" href="#">◄</a>
                                                        <a class="show-more-admin " data-level="amaliati" data-amaliati_no="<?=$amaliati_no?>" href="#">▼ واحد</a>
                                                    </div></td>

                                                <td style="background-color: whitesmoke"></td>
                                                <td style="background-color: whitesmoke"></td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F1'";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['FF1'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F1";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['F1'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F2'";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['FF2'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F2";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['F2'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F3'";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['FF3'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F3";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['F3'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F4'";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['FF4'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <td></td>
                                                <td><?if(isset($_GET['dev']))echo "F4";?>
                                                    <? if($admin_info['parent_id']==0):?>
                                                    <?=substr($vAmaliati['F4'],0,5)?>
                                                    <? endif;?>
                                                </td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <? endif;?>
                                                <td></td>
                                            </tr>
                                            <? foreach ($vAmaliati['admins'] as $AAId => $vAdmins):?>
                                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-amaliati-admins amaliati-admin-<?=$amaliati_no?>">
                                                    <td></td>
                                                    <td></td>
                                                    <td class="word-wrap" style="white-space:nowrap;"> <div><!--تجمیع--> <?=$vAdmins['admin_name'].' '.$vAdmins['family']?><a class="show-more-group-amaliati show-more-admin-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> "
                                                                                                                                                                        data-admin_id="<?=$AAId?>-<?=$amaliati_no?>"  href="#">▼ </a></div></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "N-";?><?=substr($vAdmins['N'],0,4)?></td>
                                                    <td><?if(isset($_GET['dev']))echo "EE1-";?><?=substr($vAdmins['EE1'],0,5)?></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "E1-";?><?=substr($vAdmins['E1'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "EE2-";?><?=substr($vAdmins['EE2'],0,5)?></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "E2-";?><?=substr($vAdmins['E2'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "EE3-";?><?=substr($vAdmins['EE3'],0,5)?></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "E3-";?><?=substr($vAdmins['E3'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "EE4-";?><?=substr($vAdmins['EE4'],0,5)?></td>
                                                    <td></td>

                                                    <td><?if(isset($_GET['dev']))echo "E4-";?><?=substr($vAdmins['E4'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?endif;?>
                                                    <td></td>
                                                </tr>
                                                <? foreach ($vAdmins['groups'] as $id => $vAGroup):?>
                                                    <tr style="background-color: rgb(212,247,255) !important;"
                                                        class="tr-admins-group admins-group-amaliati-<?=$AAId?>-<?=$amaliati_no?>
                                            amaliati-no-group-<?=$vAGroup['amaliati_no']?>
                                            kalan-no-group-<?=$kalan_no?> " >
                                                        <td></td>
                                                        <td></td>
                                                        <td class="word-wrap|--- "><?=$vAGroup['group_name'].' '.$vAGroup['group_family']?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "PP1-";?><?=substr($vAGroup['PP1'],0,5)?></td>
                                                        <td></td>

                                                        <td><?if(isset($_GET['dev']))echo "P1-";?><?=substr($vAGroup['P1'],0,5)?></td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>

                                                        <td><?if(isset($_GET['dev']))echo "PP2-";?><?=substr($vAGroup['PP2'],0,5)?></td>
                                                        <td></td>

                                                        <td><?if(isset($_GET['dev']))echo "P2-";?><?=substr($vAGroup['P2'],0,5)?></td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "PP3-";?><?=substr($vAGroup['PP3'],0,5)?></td>
                                                        <td></td>

                                                        <td><?if(isset($_GET['dev']))echo "P3-";?><?=substr($vAGroup['P3'],0,5)?></td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "PP4-";?><?=substr($vAGroup['PP4'],0,5)?></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "P4-";?><?=substr($vAGroup['P4'],0,5)?></td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                    </tr>
                                                <? endforeach;?>
                                            <? endforeach;?>


                                            <? foreach ($vAmaliati['eghdams'] as $eghdam_id => $vEghdam):?>
                                                <tr class="tr-eghdam amaliati-<?=$amaliati_no?>">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td  class="word-wrap"  style=" display: inline-table;width: 100% " rowspan="<?=$vKalan['eghdamRow']?>" style="width:150px !important; ">
                                                        <div><?=$vEghdam['eghdam_name']?>
                                                            <a class="show-more" data-level="eghdam" data-eghdam_no="<?=$eghdam_id?>" href="#">◄</a>
                                                            <a class="show-more-admin " data-level="eghdam" data-eghdam_no="<?=$eghdam_id?>" href="#">▼ واحد</a>
                                                        </div></td>

                                                    <td style="background-color: whitesmoke"></td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D1'";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['DD1'],0,5)?>
                                                        <?endif;?>
                                                    </td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D1";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['D1'],0,5)?>
                                                        <?endif;?>
                                                    </td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <? endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D2'";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['DD2'],0,5)?>
                                                        <?endif;?>
                                                    </td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D2";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['D2'],0,5)?>
                                                        <?endif;?>
                                                    </td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <? endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D3'";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['DD3'],0,5)?>
                                                        <? endif;?>
                                                    </td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D3";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['D3'],0,5)?>
                                                        <? endif;?>
                                                    </td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <? endif;?>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D4'";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['DD4'],0,5)?>
                                                        <? endif;?>
                                                    </td>
                                                    <td></td>
                                                    <td><?if(isset($_GET['dev']))echo "D4";?>
                                                        <? if($admin_info['parent_id']==0):?>
                                                        <?=substr($vEghdam['D4'],0,5)?>
                                                        <? endif;?>
                                                    </td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <? endif;?>
                                                    <td></td>
                                                </tr>
                                                <? foreach ($vEghdam['admins'] as $EAId => $vEAdmins):?>
                                                    <tr style="background-color: rgb(212,247,255) !important;" class="tr-eghdam-admins eghdam-admin-<?=$eghdam_id?>">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="word-wrap" style="white-space:nowrap;">
                                                            <div><!--تجمیع--> <?=$vEAdmins['admin_name'].' '.$vEAdmins['family']?><a class="show-more-group-eghdam show-more-admin-<?=$vEghdam['eghdam_vazn']?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$EAId?>-<?=$eghdam_id?>"  href="#">▼ </a><? if(isset($_GET['dev'])){ echo "(ev:". $vEAdmins['eghdam_vazn']; }?></div>

                                                        </td>


                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "M-";?><?=substr($vEAdmins['M'],0,5)?></td>
                                                        <td><?if(isset($_GET['dev']))echo "CC1-";?><?=substr($vEAdmins['CC1'],0,5)?></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "C1-";?><?=substr($vEAdmins['C1'],0,5)?></td>


                                                        <? if($admin_info['parent_id']==0):?>
                                                            <? if($admin_info['admin_id']!=1):?>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_1_1" name="manager[<?=$EAId?>][<?=$eghdam_id?>][1_1]" value="<?=$vEAdmins['eghdam_vazn']['manager1_1']?>"></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_1_2" name="manager[<?=$EAId?>][<?=$eghdam_id?>][1_2]" value="<?=$vEAdmins['eghdam_vazn']['manager1_2']?>"></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_1_3" name="manager[<?=$EAId?>][<?=$eghdam_id?>][1_3]" value="<?=$vEAdmins['eghdam_vazn']['manager1_3']?>"></td>
                                                                <td></td>
                                                        <? else:?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <? endif; ?>
                                                        <? endif; ?>


                                                        <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <? if($admin_info['admin_id']==1):?>

                                                                <span>ارزیاب</span>: <?=$vEAdmins['eghdam_vazn']['tarzyab1_4']?><br>
                                                                    <span>مدیر</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][1_5]"><?=$vEAdmins['eghdam_vazn']['tmanager1_5']?></textarea>
                                                                <? else :?>
                                                                    <span>ارزیاب</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][1_4]"><?=$vEAdmins['eghdam_vazn']['tarzyab1_4']?></textarea><br>
                                                                <span>مدیر</span>: <?=$vEAdmins['eghdam_vazn']['tmanager1_5']?>
                                                                <? endif;?>
                                                            <? else:?>
                                                                <?=$vEAdmins['eghdam_vazn']['tmanager1_5']?>
                                                        <? endif; ?>
                                                        </td>

                                                        <td><?if(isset($_GET['dev']))echo "CC2-";?><?=substr($vEAdmins['CC2'],0,5)?></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "C2-";?><?=substr($vEAdmins['C2'],0,5)?></td>


                                                        <? if($admin_info['parent_id']==0):?>
                                                        <? if($admin_info['admin_id']!=1):?>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_2_1" name="manager[<?=$EAId?>][<?=$eghdam_id?>][2_1]" value="<?=$vEAdmins['eghdam_vazn']['manager2_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_1']?></span></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_2_2" name="manager[<?=$EAId?>][<?=$eghdam_id?>][2_2]" value="<?=$vEAdmins['eghdam_vazn']['manager2_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_2']?></span></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_2_3" name="manager[<?=$EAId?>][<?=$eghdam_id?>][2_3]" value="<?=$vEAdmins['eghdam_vazn']['manager2_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_3']?></span></td>
                                                                <td></td>
                                                            <? else:?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <? endif; ?>
                                                        <? endif; ?>


                                                        <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                                <? if($admin_info['admin_id']==1):?>

                                                                    <span>ارزیاب</span>: <?=$vEAdmins['eghdam_vazn']['tarzyab2_4']?><br>
                                                                    <span>مدیر</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][2_5]"><?=$vEAdmins['eghdam_vazn']['tmanager2_5']?></textarea>
<!--                                                            <input  data-input="manager" data-position="<?/*=$eghdam_id*/?>_<?/*=$EAId*/?>_2_4" name="manager[<?/*=$EAId*/?>][<?/*=$eghdam_id*/?>][2_4]" value="<?/*=$vEAdmins['eghdam_vazn']['tahlil2_4']*/?>"><span style="display: none;">--><?/*=$vEAdmins['eghdam_vazn']['tahlil2_4']*/?>
                                                                <? else :?>
                                                                    <span>ارزیاب</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][2_4]"><?=$vEAdmins['eghdam_vazn']['tarzyab2_4']?></textarea><br>
                                                                    <span>مدیر</span>: <?=$vEAdmins['eghdam_vazn']['tmanager2_5']?>
                                                                <? endif;?>
                                                            <? else:?>
                                                        <?=$vEAdmins['eghdam_vazn']['tmanager2_5']?>
                                                        <? endif; ?>
                                                        </td>


                                                        <td><?if(isset($_GET['dev']))echo "CC3-";?><?=substr($vEAdmins['CC3'],0,5)?></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "C3-";?><?=substr($vEAdmins['C3'],0,5)?></td>

                                                        <? if($admin_info['parent_id']==0):?>
                                                            <? if($admin_info['admin_id']!=1):?>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_3_1" name="manager[<?=$EAId?>][<?=$eghdam_id?>][3_1]" value="<?=$vEAdmins['eghdam_vazn']['manager3_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_1']?></span></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_3_2" name="manager[<?=$EAId?>][<?=$eghdam_id?>][3_2]" value="<?=$vEAdmins['eghdam_vazn']['manager3_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_2']?></span></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_3_3" name="manager[<?=$EAId?>][<?=$eghdam_id?>][3_3]" value="<?=$vEAdmins['eghdam_vazn']['manager3_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_3']?></span></td>
                                                                <td></td>
                                                        <? else:?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <? endif; ?>
                                                        <? endif; ?>


                                                        <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                                <? if($admin_info['admin_id']==1):?>

                                                                    <span>ارزیاب</span>: <?=$vEAdmins['eghdam_vazn']['tarzyab3_4']?><br>
                                                                    <span>مدیر</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][3_5]"><?=$vEAdmins['eghdam_vazn']['tmanager3_5']?></textarea>
                                                                <? else :?>

                                                                    <span>ارزیاب</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][3_4]"><?=$vEAdmins['eghdam_vazn']['tarzyab3_4']?></textarea><br>
                                                                    <span>مدیر</span>: <?=$vEAdmins['eghdam_vazn']['tmanager3_5']?>
                                                                <? endif;?>
                                                            <? else:?>
                                                                <?=$vEAdmins['eghdam_vazn']['tmanager3_5']?>
                                                        <? endif; ?>
                                                        </td>


                                                        <td><?if(isset($_GET['dev']))echo "CC4-";?><?=substr($vEAdmins['CC4'],0,5)?></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "C4-";?><?=substr($vEAdmins['C4'],0,5)?></td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <? if($admin_info['admin_id']!=1):?>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_4_1" name="manager[<?=$EAId?>][<?=$eghdam_id?>][4_1]" value="<?=$vEAdmins['eghdam_vazn']['manager4_1']?>"></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_4_2" name="manager[<?=$EAId?>][<?=$eghdam_id?>][4_2]" value="<?=$vEAdmins['eghdam_vazn']['manager4_2']?>"></td>
                                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$EAId?>_4_3" name="manager[<?=$EAId?>][<?=$eghdam_id?>][4_3]" value="<?=$vEAdmins['eghdam_vazn']['manager4_3']?>"></td>
                                                                <td></td>
                                                                <? else:?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        <? endif; ?>
                                                        <? endif; ?>


                                                        <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                                <? if($admin_info['admin_id']==1):?>

                                                                    <span>ارزیاب</span>: <?=$vEAdmins['eghdam_vazn']['tarzyab4_4']?><br>
                                                                    <span>مدیر</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][4_5]"><?=$vEAdmins['eghdam_vazn']['tmanager4_5']?></textarea>
                                                                <? else :?>

                                                                    <span>ارزیاب</span>: <textarea name="manager[<?=$EAId?>][<?=$eghdam_id?>][4_4]"><?=$vEAdmins['eghdam_vazn']['tarzyab4_4']?></textarea><br>
                                                                    <span>مدیر</span>: <?=$vEAdmins['eghdam_vazn']['tmanager4_5']?>
                                                                <? endif;?>
                                                            <? else:?>
                                                        <?=$vEAdmins['eghdam_vazn']['tmanager4_5']?>
                                                        <? endif; ?>
                                                        </td>



                                                    </tr>
                                                    <? foreach ($vEAdmins['groups'] as $EGid => $vEGroup):?>
                                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-eghdam-<?=$EAId?>-<?=$eghdam_id?> eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="word-wrap">|--- <?=$vEGroup['group_name'].' '.$vEGroup['group_family']?></td>
                                                            <td></td>
                                                            <td><?if(isset($_GET['dev'])){echo "MM-"; echo substr($vEGroup['MM'],0,5);}?></td>
                                                            <td><?if(isset($_GET['dev']))echo "RR1-";?><?=substr($vEGroup['RR1'],0,5)?></td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "R1-";?><?=substr($vEGroup['R1'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td>

                                                                <?=$vEGroup['tahlil1_4']?>

                                                            </td>

                                                            <td><?if(isset($_GET['dev']))echo "RR2-";?><?=substr($vEGroup['RR2'],0,5)?></td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "R2-";?><?=substr($vEGroup['R2'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td>

                                                                <?=$vEGroup['tahlil2_4']?>

                                                            </td>
                                                            <td><?if(isset($_GET['dev']))echo "RR3-";?><?=substr($vEGroup['RR3'],0,5)?></td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "R3-";?><?=substr($vEGroup['R3'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td>

                                                                <?=$vEGroup['tahlil3_4']?>

                                                            </td>
                                                            <td><?if(isset($_GET['dev']))echo "RR4-";?><?=substr($vEGroup['RR4'],0,5)?></td>
                                                            <td></td>
                                                            <td><?if(isset($_GET['dev']))echo "R4-";?><?=substr($vEGroup['R4'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td>

                                                                <?=$vEGroup['tahlil4_4']?>

                                                            </td>
                                                        </tr>
                                                    <? endforeach;?>
                                                <? endforeach;?>



                                                <? foreach ($vEghdam['faaliats'] as $faaliat_id => $vFaaliat):?>
                                                    <tr class="tr-faaliat eghdam-<?=$eghdam_id?>">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo $faaliat_id;?></td>
                                                        <td class="word-wrap" style=" display: inline-table;width: 100% " style="width:150px !important; "><div><?=$vFaaliat['faaliat_name']?>
                                                                <a class="show-more-admin " data-level="faaliat" data-faaliat_no="<?=$faaliat_id?>" href="#">▼ واحد</a>
                                                            </div></td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "BB1-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                            <?=substr($vFaaliat['BB1'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "B1-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <?=substr($vFaaliat['B1'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "BB2-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <?=substr($vFaaliat['BB2'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "B2-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                            <?=substr($vFaaliat['B2'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "BB3-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                            <?=substr($vFaaliat['BB3'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "B3-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                            <?=substr($vFaaliat['B3'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "BB4-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                            <?=substr($vFaaliat['BB4'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <td></td>
                                                        <td><?if(isset($_GET['dev']))echo "B4-";?>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <?=substr($vFaaliat['B4'],0,5)?>
                                                            <?endif;?>
                                                        </td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?endif;?>
                                                        <td></td>

                                                    </tr>
                                                    <? foreach ($vFaaliat['admins'] as $fAId => $vFAdmins):?>
                                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-faaliat-admins faaliat-admin-<?=$faaliat_id?>">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="word-wrap" style="white-space:nowrap;"><div><!--تجمیع--> <?=$vFAdmins['admin_name'].' '?><a class="show-more-group-faaliat show-more-admin-<?=$faaliat_id?> a-show-group-eghdam-<?=$eghdam_id?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$fAId?>-<?=$faaliat_id?>"  href="#">▼ </a>(fv:<?=$vFAdmins['faaliat_vazn']?>)</div></td>
                                                            <td><?if(isset($_GET['dev']))echo "Z-";?><?=substr($vFAdmins['Z'],0,5)?></td>
                                                            <td><?if(isset($_GET['dev']))echo "AA1-";?><?=substr($vFAdmins['AA1'],0,5)?>
                                                                <?/* if($vFAdmins['admin_file1']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$fAId*/?>/season1/<?/*=$faaliat_id*/?>/<?/*=$vFAdmins['admin_file1']*/?>">دانلود فایل</a>
                                                <?/* endif;*/?></td>-->
                                                            <td></td>
                                                            <td><?if(isset($_GET['dev']))echo "A1-";?><?=substr($vFAdmins['A1'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "AA2-";?><?=substr($vFAdmins['AA2'],0,5)?>
                                                                <?/* if($vFAdmins['admin_file2']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$fAId*/?>/season2/<?/*=$faaliat_id*/?>/<?/*=$vFAdmins['admin_file2']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                            </td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "A2-";?><?=substr($vFAdmins['A2'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td></td>
                                                            <td><?if(isset($_GET['dev']))echo "AA3-";?><?=substr($vFAdmins['AA3'],0,5)?>
                                                                <?/* if($vFAdmins['admin_file3']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$fAId*/?>/season3/<?/*=$faaliat_id*/?>/<?/*=$vFAdmins['admin_file3']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                            </td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "A3-";?><?=substr($vFAdmins['A3'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td></td>
                                                            <td><?if(isset($_GET['dev']))echo "AA4-";?><?=substr($vFAdmins['AA4'],0,5)?>
                                                                <!-- <?/* if($vFAdmins['admin_file4']):*/?>
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$fAId*/?>/season4/<?/*=$faaliat_id*/?>/<?/*=$vFAdmins['admin_file4']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                            </td>
                                                            <td></td>

                                                            <td><?if(isset($_GET['dev']))echo "A4-";?><?=substr($vFAdmins['A4'],0,5)?></td>
                                                            <? if($admin_info['parent_id']==0):?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?endif;?>
                                                            <td></td>
                                                        </tr>
                                                        <? foreach ($vFAdmins['groups'] as $id => $vFGroup):?>
                                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-<?=$fAId?>-<?=$faaliat_id?> faaliat-no-group-<?=$faaliat_id?> eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="word-wrap">|--- <?=$vFGroup['group_name'].' '.$vFGroup['group_family']?>
                                                                </td>
                                                                <td><?if(isset($_GET['dev']))echo "ZZ ";?><?=substr($vFGroup['ZZ'],0,5)?></td>
                                                                <td><?if(isset($_GET['dev']))echo "OO1-";?><?=substr($vFGroup['OO1'],0,5)?>
                                                                    <? if($vFGroup['admin_file1']):?>
                                                                        <br>
                                                                        <a href="<?=RELA_DIR?>statics/files/<?=$fAId?>/season1/<?=$eghdam_id?>/<?=$vFGroup['admin_file1']?>">دانلود فایل</a>
                                                                    <? endif;?>
                                                                </td>
                                                                <td class="word-wrap" >
                                                                    <? if($vFGroup['admin_tozihat1']!=''):?>
                                                                    <i  data-text="<?=$vFGroup['admin_tozihat1']?>" class="far fa fa-info-circle"></i>
                                                                    <? endif;?>
                                                                </td>

                                                                <td><?if(isset($_GET['dev']))echo "O1-";?><?=substr($vFGroup['O1'],0,5)?></td>
                                                                <? if($admin_info['parent_id']==0 ):?>

                                                                        <td>
                                                                            <? if($admin_info['admin_id']!=1 ):?>
                                                                              <!--  <select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][1_1]">
                                                                                    <option value="0" <?/* if($vFGroup['manager1_1'] == 0){echo"selected";}*/?>>0</option>
                                                                                    <option value="25" <?/* if($vFGroup['manager1_1'] == 25){echo"selected";}*/?>>25</option>
                                                                                    <option value="50" <?/* if($vFGroup['manager1_1'] == 50){echo"selected";}*/?>>50</option>
                                                                                    <option value="75" <?/* if($vFGroup['manager1_1'] == 75){echo"selected";}*/?>>75</option>
                                                                                    <option value="100" <?/* if($vFGroup['manager1_1'] == 100){echo"selected";}*/?>>100</option>
                                                                                </select>-->

                                                                               <input class="w100"
                                                                                data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_1_1"
                                                                                name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][1_1]"
                                                                                value="<?=$vFGroup['manager1_1']?>"
                                                                               >
                                                                            <?else:?>

                                                                                <?=$vFGroup['manager1_1']?><?endif;?>
                                                                        </td>

                                                                    <td>
                                                                        <? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][1_2]">
                                                                                <option value="0" <?/*if($vFGroup['manager1_2'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager1_2'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager1_2'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager1_2'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager1_2'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_1_2"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][1_2]"
                                                                                   value="<?=$vFGroup['manager1_2']?>">
                                                                        <?else:?>

                                                                            <?=$vFGroup['manager1_2']?>
                                                                        <?endif;?>



                                                                    </td>


                                                                        <td>
                                                                            <? if($admin_info['admin_id']!=1 ):?>
                                                                                <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][1_3]">
                                                                                    <option value="0" <?/*if($vFGroup['manager1_3'] == 0){echo"selected";}*/?>>0</option>
                                                                                    <option value="25" <?/*if($vFGroup['manager1_3'] == 25){echo"selected";}*/?>>25</option>
                                                                                    <option value="50" <?/*if($vFGroup['manager1_3'] == 50){echo"selected";}*/?>>50</option>
                                                                                    <option value="75" <?/*if($vFGroup['manager1_3'] == 75){echo"selected";}*/?>>75</option>
                                                                                    <option value="100" <?/*if($vFGroup['manager1_3'] == 100){echo"selected";}*/?>>100</option>
                                                                                </select>-->
                                                                                <input class="w100"
                                                                                       data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_1_3"
                                                                                       name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][1_3]"
                                                                                       value="<?=$vFGroup['manager1_3']?>">
                                                                            <?else:?>
                                                                                <?=$vFGroup['manager1_3']?>
                                                                            <?endif;?>


                                                                        </td>
                                                                <td>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max1'],0,5)?><br>
                                                                            <span>مدیر</span>:<input class="w100" name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][max_manager1]" value="<?=$vFGroup['max_manager1']?>">
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max1'],0,5)?><br>
                                                                            <span>مدیر</span>: <?=substr($vFGroup['max_manager1'],0,5)?>

                                                                        <? endif;?>
                                                                    </td>
                                                                <?endif;?>
                                                                <td>
                                                                    <? if($admin_info['parent_id']==0):?>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=$vFGroup['tahlil1']?><br>
                                                                            <span>مدیر</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil_manager1]" ><?=$vFGroup['tahlil_manager1']?></textarea>
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil1]" ><?=$vFGroup['tahlil1']?></textarea><br>
                                                                            <span>مدیر</span>: <?=$vFGroup['tahlil_manager1']?>
                                                                        <? endif;?>
                                                                    <? else:?>
                                                                        <?=$vFGroup['tahlil_manager1']?>
                                                                    <? endif; ?>
                                                                </td>

                                                                <td><?if(isset($_GET['dev']))echo "OO2-";?><?=substr($vFGroup['OO2'],0,5)?>
                                                                    <? if($vFGroup['admin_file2']):?>
                                                                        <br>
                                                                        <a href="<?=RELA_DIR?>statics/files/<?=$fAId?>/season2/<?=$faaliat_id?>/<?=$vFGroup['admin_file2']?>">دانلود فایل</a>
                                                                    <? endif;?>
                                                                </td>
                                                                <td class="word-wrap">
                                                                    <? if($vFGroup['admin_tozihat2']!=''):?>
                                                                        <i  data-text="<?=$vFGroup['admin_tozihat2']?>" class="far fa fa-info-circle"></i>
                                                                    <? endif;?>
                                                                </td>

                                                                <td><?if(isset($_GET['dev']))echo "O2-";?><?=substr($vFGroup['O2'],0,5)?></td>
                                                                <? if($admin_info['parent_id']==0):?>
                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][2_1]">
                                                                                <option value="0" <?/*if($vFGroup['manager2_1'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager2_1'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager2_1'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager2_1'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager2_1'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                        <?else:?><?=$vFGroup['manager2_1']?><?endif;?>
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_2_1"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][2_1]"
                                                                                   value="<?=$vFGroup['manager2_1']?>">
                                                                    </td>
                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][2_2]">
                                                                                <option value="0" <?/*if($vFGroup['manager2_2'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager2_2'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager2_2'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager2_2'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager2_2'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_2_2"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][2_2]"
                                                                                   value="<?=$vFGroup['manager2_2']?>">
                                                                        <?else:?><?=$vFGroup['manager2_2']?><?endif;?>


                                                                    </td>

                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                           <!-- <select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][2_3]">
                                                                                <option value="0" <?/*if($vFGroup['manager2_3'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager2_3'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager2_3'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager2_3'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager2_3'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_2_3"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][2_3]"
                                                                                   value="<?=$vFGroup['manager2_3']?>">
                                                                        <?else:?><?=$vFGroup['manager2_3']?><?endif;?>

                                                                    </td>
                                                                    <td>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max2'],0,5)?><br>
                                                                            <span>مدیر</span>: <input class="w100" name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][max_manager2]" value="<?=$vFGroup['max_manager2']?>">
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max2'],0,5)?><br>
                                                                            <span>مدیر</span>: <?=substr($vFGroup['max_manager2'],0,5)?>

                                                                        <? endif;?>
                                                                    </td>
                                                                <?endif;?>
                                                                <td>
                                                                    <? if($admin_info['parent_id']==0):?>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=$vFGroup['tahlil2']?><br>
                                                                            <span>مدیر</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil_manager2]" ><?=$vFGroup['tahlil_manager2']?></textarea>
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil2]" ><?=$vFGroup['tahlil2']?></textarea><br>
                                                                            <span>مدیر</span>: <?=$vFGroup['tahlil_manager2']?>
                                                                        <? endif;?>
                                                                    <? else:?>
                                                                        <?=$vFGroup['tahlil_manager2']?>
                                                                    <? endif; ?>
                                                                </td>
                                                                <td><?if(isset($_GET['dev']))echo "OO3-";?><?=substr($vFGroup['OO3'],0,5)?>
                                                                    <? if($vFGroup['admin_file3']):?>
                                                                        <br>
                                                                        <a href="<?=RELA_DIR?>statics/files/<?=$fAId?>/season3/<?=$faaliat_id?>/<?=$vFGroup['admin_file3']?>">دانلود فایل</a>
                                                                    <? endif;?>
                                                                </td>
                                                                <td class="word-wrap">
                                                                    <? if($vFGroup['admin_tozihat3']!=''):?>
                                                                        <i  data-text="<?=$vFGroup['admin_tozihat3']?>" class="far fa fa-info-circle"></i>
                                                                    <? endif;?>
                                                                </td>

                                                                <td><?if(isset($_GET['dev']))echo "O3-";?><?=substr($vFGroup['O3'],0,5)?></td>
                                                                <? if($admin_info['parent_id']==0):?>
                                                                    <td>
                                                                        <? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][3_1]">
                                                                                <option value="0" <?/*if($vFGroup['manager3_1'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager3_1'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager3_1'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager3_1'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager3_1'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_3_1"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][3_1]"
                                                                                   value="<?=$vFGroup['manager3_1']?>">
                                                                        <?else:?><?=$vFGroup['manager3_1']?><?endif;?>


                                                                    </td>
                                                                    <td>
                                                                        <? if($admin_info['admin_id']!=1 ):?>
                                                                           <!-- <select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][3_2]">
                                                                                <option value="0" <?/*if($vFGroup['manager3_2'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager3_2'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager3_2'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager3_2'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager3_2'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_3_2"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][3_2]"
                                                                                   value="<?=$vFGroup['manager3_2']?>">
                                                                        <?else:?><?=$vFGroup['manager3_2']?><?endif;?>

                                                                    </td>
                                                                    <td>
                                                                        <? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][3_3]">
                                                                                <option value="0" <?/*if($vFGroup['manager3_3'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager3_3'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager3_3'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager3_3'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager3_3'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_3_3"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][3_3]"
                                                                                   value="<?=$vFGroup['manager3_3']?>">
                                                                        <?else:?><?=$vFGroup['manager3_3']?><?endif;?>

                                                                    </td>
                                                                    <td>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max3'],0,5)?><br>
                                                                            <span>مدیر</span>: <input class="w100" name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][max_manager3]" value="<?=$vFGroup['max_manager3']?>">
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max3'],0,5)?><br>
                                                                            <span>مدیر</span>: <?=substr($vFGroup['max_manager3'],0,5)?>

                                                                        <? endif;?>
                                                                    </td>
                                                                <?endif;?>
                                                                <td>
                                                                    <? if($admin_info['parent_id']==0):?>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=$vFGroup['tahlil3']?><br>
                                                                            <span>مدیر</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil_manager3]" ><?=$vFGroup['tahlil_manager3']?></textarea>
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil3]" ><?=$vFGroup['tahlil3']?></textarea><br>
                                                                            <span>مدیر</span>: <?=$vFGroup['tahlil_manager3']?>
                                                                        <? endif;?>
                                                                    <? else:?>
                                                                        <?=$vFGroup['tahlil_manager3']?>
                                                                    <? endif; ?>
                                                                </td>
                                                                <td><?if(isset($_GET['dev']))echo "OO4-";?><?=substr($vFGroup['OO4'],0,5)?>
                                                                    <? if($vFGroup['admin_file4']):?>
                                                                        <br>
                                                                        <a href="<?=RELA_DIR?>statics/files/<?=$fAId?>/season4/<?=$faaliat_id?>/<?=$vFGroup['admin_file4']?>">دانلود فایل</a>
                                                                    <? endif;?>
                                                                </td>
                                                                <td class="word-wrap">
                                                                    <? if($vFGroup['admin_tozihat4']!=''):?>
                                                                        <i  data-text="<?=$vFGroup['admin_tozihat4']?>" class="far fa fa-info-circle"></i>
                                                                    <? endif;?>
                                                                </td>
                                                                <td><?if(isset($_GET['dev']))echo "O4-";?><?=substr($vFGroup['O4'],0,5)?></td>
                                                                <? if($admin_info['parent_id']==0):?>

                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                            <!--<select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][4_1]">
                                                                                <option value="0" <?/*if($vFGroup['manager4_1'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager4_1'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager4_1'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager4_1'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager4_1'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_4_1"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][4_1]"
                                                                                   value="<?=$vFGroup['manager4_1']?>">
                                                                        <?else:?>
                                                                            <?=$vFGroup['manager4_1']?><?endif;?>

                                                                    </td>

                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                           <!-- <select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][4_2]">
                                                                                <option value="0" <?/*if($vFGroup['manager4_2'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager4_2'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager4_2'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager4_2'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager4_2'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_4_2"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][4_2]"
                                                                                   value="<?=$vFGroup['manager4_2']?>">
                                                                        <?else:?>
                                                                            <?=$vFGroup['manager4_2']?><?endif;?>

                                                                    </td>

                                                                    <td><? if($admin_info['admin_id']!=1 ):?>
                                                                           <!-- <select name="manager_group[<?/*=$fAId*/?>][<?/*=$faaliat_id*/?>][4_3]">
                                                                                <option value="0" <?/*if($vFGroup['manager4_3'] == 0){echo"selected";}*/?>>0</option>
                                                                                <option value="25" <?/*if($vFGroup['manager4_3'] == 25){echo"selected";}*/?>>25</option>
                                                                                <option value="50" <?/*if($vFGroup['manager4_3'] == 50){echo"selected";}*/?>>50</option>
                                                                                <option value="75" <?/*if($vFGroup['manager4_3'] == 75){echo"selected";}*/?>>75</option>
                                                                                <option value="100" <?/*if($vFGroup['manager4_3'] == 100){echo"selected";}*/?>>100</option>
                                                                            </select>-->
                                                                            <input class="w100"
                                                                                   data-input="manager_faaliat_<?=$eghdam_id?>_<?=$fAId?>_4_3"
                                                                                   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][4_3]"
                                                                                   value="<?=$vFGroup['manager4_3']?>">
                                                                    <?else:?>
                                                                            <?=$vFGroup['manager4_3']?><?endif;?>

                                                                    </td>

                                                                    <td>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max4'],0,5)?><br>
                                                                            <span>مدیر</span>: <input class="w100" name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][max_manager4]" value="<?=$vFGroup['max_manager4']?>">
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <?=substr($vFGroup['max4'],0,5)?><br>
                                                                            <span>مدیر</span>: <?=substr($vFGroup['max_manager4'],0,5)?>

                                                                        <? endif;?>
                                                                    </td>
                                                                <?endif;?>
                                                                <td>
                                                                    <? if($admin_info['parent_id']==0):?>
                                                                        <? if($admin_info['admin_id']==1):?>
                                                                            <span>ارزیاب</span>: <?=$vFGroup['tahlil4']?><br>
                                                                            <span>مدیر</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil_manager4]" ><?=$vFGroup['tahlil_manager4']?></textarea>
                                                                        <? else :?>
                                                                            <span>ارزیاب</span>: <textarea   name="manager_group[<?=$fAId?>][<?=$faaliat_id?>][tahlil4]" ><?=$vFGroup['tahlil4']?></textarea><br>
                                                                            <span>مدیر</span>: <?=$vFGroup['tahlil_manager4']?>
                                                                        <? endif;?>
                                                                    <? else:?>
                                                                        <?=$vFGroup['tahlil_manager4']?>
                                                                    <? endif; ?>
                                                                </td>
                                                            </tr>
                                                        <? endforeach;?>
                                                    <? endforeach;?>
                                                <? endforeach;?>
                                            <? endforeach;?>
                                        <? endforeach;?>
                                    <? endforeach;?>
                                    </tbody>

                                </table>


                            </div>
                        </div>
                        <? if(($admin_info['status'] == 0 || $admin_info['status'] == 1) && $admin_info['parent_id']==0 ): ?>
                            <button name="submit" class="btn btn-block btn-primary fixed">ثبت موقت</button>
                            <button name="submit2" class="btn btn-block btn-info">ثبت نهایی</button>
                        <? endif;?>
    </form>


</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('.fa-info-circle').click(function () {

            $('myModal').modal('hide');

            var text = $(this).data("text");
            alert(text);
            $('#myModal .modal-body').html("<p>" + text + "</p>")
            $('myModal').modal('show');
        })
    });
</script>

