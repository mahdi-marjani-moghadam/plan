<!--suppress ALL -->
<!--<link rel="stylesheet" href="<?php /*echo RELA_DIR; */ ?>templates/<?php /*echo CURRENT_SKIN; */ ?>/assets/css/buttons.dataTables.min.css">
-->
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {

        $('#tbl3 tbody tr').click(function() {
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
                customize: function(win) {
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
                customizeData: function(data) {

                    // return false;
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {

                            data.body[i][j] = '\u200C' + data.body[i][j];
                            data.body[i][j] = data.body[i][j].replace('                                   ◄                                     ▼ واحد', '');
                            data.body[i][j] = data.body[i][j].replace('                                     ◄                                         ▼ واحد', '');
                            data.body[i][j] = data.body[i][j].replace('                                       ◄                                             ▼ واحد', '');
                            data.body[i][j] = data.body[i][j].replace('                                                ▼ واحد', '');


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
            "paging": false,
            "processing": true,
            "searching": false,

            //            "ajax": "<?php //=RELA_DIR
                                    ?>//admin/?component=form&action=search2&status=<?php //=$list['status']
                                                                                                ?>//",
            "ordering": false
        });


        oTable.columns().every(function() {
            var that = this;

            $('	:input select', this.footer()).on('keyup change', function() {
                that.search(this.value).draw();
            });


        });

        $(document).ready(function() {


            /** +/- */
            $('.show-more').click(function(e) {

                e.preventDefault();
                var level = $(this).data('level');
                //alert(level);
                var no = $(this).data(level + '_no');

                if ($(this).hasClass('active')) {
                    $('.' + level + '-' + no).hide();

                    $(this).removeClass('active');

                    $('.kalan-active').removeClass('kalan-active');

                    if (level == 'kalan') {
                        $('.tr-eghdam').hide();
                        $('.tr-faaliat').hide();


                        /** remove class active amaliati level*/
                        $(".show-more[data-level='amaliati']").each(function(index) {
                            $(this).removeClass('active');
                        });

                        /** remove class active eghdam level*/
                        $(".show-more[data-level='eghdam']").each(function(index) {
                            $(this).removeClass('active');
                        });


                        /** remove class active eghdam admin level*/
                        $('.tr-amaliati-admins').hide();
                        $(".show-more-admin[data-level='amaliati']").each(function(index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active eghdam admin level*/
                        $('.tr-eghdam-admins').hide();
                        $(".show-more-admin[data-level='eghdam']").each(function(index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active faaliat admin level*/
                        $('.tr-faaliat-admins').hide();
                        $(".show-more-admin[data-level='faaliat']").each(function(index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.kalan-no-group-' + no).hide();
                        $('.a-show-group-kalan-' + no).removeClass('active');
                    }
                    if (level == 'amaliati') {
                        $('.tr-faaliat').hide();

                        /** remove class active eghdam level*/
                        $(".show-more[data-level='eghdam']").each(function(index) {
                            $(this).removeClass('active');
                        });

                        /** remove class active eghdam admin level*/
                        $('.tr-eghdam-admins').hide();
                        $(".show-more-admin[data-level='eghdam']").each(function(index) {
                            $(this).removeClass('active');
                        });
                        /** remove class active faaliat admin level*/
                        $('.tr-faaliat-admins').hide();
                        $(".show-more-admin[data-level='faaliat']").each(function(index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.amaliati-no-group-' + no).hide();
                        $('.a-show-group-amaliati-' + no).removeClass('active');


                    }
                    if (level == 'eghdam') {
                        $('.tr-faaliat-admins').hide();

                        $(".show-more-admin[data-level='faaliat']").each(function(index) {
                            $(this).removeClass('active');
                        });

                        /** hidden group */
                        $('.eghdam-no-group-' + no).hide();
                        $('.a-show-group-eghdam-' + no).removeClass('active');


                    }

                } else {
                    $('.' + level + '-' + no).show();
                    $(this).addClass('active');
                }

            });


            /** show level */
            $('.show-level').change(function(e) {

                var level = $(this).val();

                if (level == 'kalan') {
                    $('.tr-amaliati').hide();
                    $('.tr-eghdam').hide();
                    $('.tr-faaliat').hide();



                    $('.tr-kalan-admins').hide();
                    $('.tr-amaliati-admins').hide();
                    $('.tr-eghdam-admins').hide();
                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();



                    /**  >  */
                    $(".show-more[data-level='kalan'] , .show-more-admin[data-level='kalan'] , .show-more-group-kalan").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='amaliati'] , .show-more-admin[data-level='amaliati'] , .show-more-group-amaliati").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function(index) {
                        $(this).removeClass('active');
                    });


                }
                if (level == 'amaliati') {
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').hide();
                    $('.tr-faaliat').hide();



                    $('.tr-kalan-admins').hide();
                    $('.tr-amaliati-admins').hide();
                    $('.tr-eghdam-admins').hide();
                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();


                    /** - */
                    $(".show-more[data-level='kalan']").each(function(index) {
                        $(this).addClass('active');
                    });


                    /**  >  */
                    $(" .show-more-admin[data-level='kalan'] , .show-more-group-kalan").each(function(index) {
                        $(this).removeClass('active');
                    });
                    /**  >  */
                    $(".show-more[data-level='amaliati'] , .show-more-admin[data-level='amaliati'] , .show-more-group-amaliati").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function(index) {
                        $(this).removeClass('active');
                    });
                }
                if (level == 'eghdam') {
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').show();
                    $('.tr-faaliat').hide();

                    $('.tr-faaliat-admins').hide();
                    $('.tr-admins-group').hide();

                    /** - */
                    $(".show-more[data-level='kalan']").each(function(index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='amaliati']").each(function(index) {
                        $(this).addClass('active');
                    });

                    /**  >  */
                    $(".show-more[data-level='eghdam'] , .show-more-admin[data-level='eghdam'] ,.show-more-group-eghdam").each(function(index) {
                        $(this).removeClass('active');
                    });

                    /**  >  */
                    $(".show-more-admin[data-level='faaliat'] ,.show-more-group-faaliat").each(function(index) {
                        $(this).removeClass('active');
                    });
                }
                if (level == 'faaliat') {
                    $('.tr-amaliati').show();
                    $('.tr-eghdam').show();
                    $('.tr-faaliat').show();

                    /** - */
                    $(".show-more[data-level='kalan']").each(function(index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='amaliati']").each(function(index) {
                        $(this).addClass('active');
                    });

                    /** -  */
                    $(".show-more[data-level='eghdam']").each(function(index) {
                        $(this).addClass('active');
                    });
                }

            });

            /** show amaliati */
            $('.show-amaliati').click(function(e) {
                e.preventDefault();

                $('.tr-amaliati').show();
                $('.tr-eghdam').hide();
                $('.tr-faaliat').hide();

                /** add class active */
                $(".show-more[data-level='kalan']").each(function(index) {
                    $(this).addClass('active');
                });

                /** remove class active amaliati level*/
                $(".show-more[data-level='amaliati']").each(function(index) {
                    $(this).removeClass('active');
                });

                /** remove class active eghdam level*/
                $(".show-more[data-level='eghdam']").each(function(index) {
                    $(this).removeClass('active');
                });

                $(this).addClass('kalan-active');

            });



            $('table.dataTable').css('cssText', 'margin-top:0px !important ');
            $('button.buttons-excel').css('cssText', 'position: absolute; top: 2px; left: 89px;').addClass('btn-default').addClass('btn');
        });

        /** show-admin */
        $('.show-admin').click(function(e) {

            var adminId = $(this).val();
            console.log(adminId);

            if (adminId != 0) {
                //alert(adminId);

                location.href = window.location.origin + '/admin/?component=form&q=,' + adminId + ',';
            }

        });

        $("select[id=admin]").select2({
            placeholder: "کل",
            allowClear: true
        });

        /** show-columns */
        $('.show-columns').click(function(e) {

            var columns = $(this).val();
            //Cookies.set('columns', columns);
            //console.log(columns);
            //localStorage.setItem('columns', columns);
            localStorage.columns = columns;


            //console.log(Cookies.get('columns'));


            $('table tbody tr td').hide();
            $('table thead th').hide();
            $.each(columns, function(i, column) {

                $('table tbody tr').find('td:eq(' + column + ')').show()
                $('table thead tr').find('th:eq(' + column + ')').show()

            })
            $('table').attr({
                'style': 'width: auto;'
            });
        });

        if (localStorage.length !== 0) {
            var local = localStorage.columns;

            var columns = local.split(',');

            //console.log(columns);

            $('table tbody tr td').hide();
            $('table thead th').hide();
            //console.log('ss');
            $.each(columns, function(i, column) {
                //console.log(column);
                $('table tbody tr').find('td:eq(' + column + ')').show()
                $('table thead tr').find('th:eq(' + column + ')').show()

            })
            $('table').attr({
                'style': 'width: auto;'
            });

            $(window).on('load', function() {
                $('.show-columns').select2('val', columns);
            });

        }



        /** +/- */
        $('.show-more-admin').click(function(e) {
            e.preventDefault();

            var level = $(this).data('level');
            var no = $(this).data(level + '_no');

            //            alert(level);
            //            alert(no);
            if ($(this).hasClass('active')) {
                $('.' + level + '-admin-' + no).hide();
                $(this).removeClass('active');

                // hidden groups
                $('.faaliat-no-group-' + no).hide();
                $('.show-more-admin-' + no).removeClass('active');
            } else {
                $('.' + level + '-admin-' + no).show();
                $(this).addClass('active');
            }

        });

        $('.show-more-group-faaliat').click(function(e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if ($(this).hasClass('active')) {
                $('.admins-group-' + admin).hide();
                $(this).removeClass('active');
            } else {
                $('.admins-group-' + admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-eghdam').click(function(e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if ($(this).hasClass('active')) {
                $('.admins-group-eghdam-' + admin).hide();
                $(this).removeClass('active');
            } else {
                $('.admins-group-eghdam-' + admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-amaliati').click(function(e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if ($(this).hasClass('active')) {
                $('.admins-group-amaliati-' + admin).hide();
                $(this).removeClass('active');
            } else {
                $('.admins-group-amaliati-' + admin).show();
                $(this).addClass('active');
            }
        });
        $('.show-more-group-kalan').click(function(e) {
            e.preventDefault();

            var admin = $(this).data('admin_id');

            if ($(this).hasClass('active')) {
                $('.admins-group-kalan-' + admin).hide();
                $(this).removeClass('active');
            } else {
                $('.admins-group-kalan-' + admin).show();
                $(this).addClass('active');
            }
        });

        $("input[data-input='manager']").keyup(function(e) {

            var position = $(this).data('position'); // 5010_1_1

            $("input[data-input='manager_faaliat_" + position + "']").val($(this).val());

        });
        // Code goes here
        'use strict'
        window.onload = function() {
            var tableCont1 = document.querySelector('.table-cont1');


            function scrollHandle(e) {
                var scrollTop = this.scrollTop;
                //console.log(scrollTop);
                this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
                if (scrollTop > 10) {
                    $('thead tr th').html();
                }
            }

            tableCont1.addEventListener('scroll', scrollHandle)

        }

        $('.w100').keyup(function(e) {
            if ($(this).val() < 0 || $(this).val() > 100) {
                alert('مقدار ' + $(this).val() + ' صحیح نمی باشد.');
                $(this).val('')
            } else if (!$.isNumeric($(this).val())) {
                alert('مقدار ' + $(this).val() + ' صحیح نمی باشد.');
                $(this).val('')
            }
        });

    });
</script>



<style>
    .table-cont1,
    .table-cont2,
    .table-cont3 {
        max-height: 600px;
        overflow: auto;
    }
     a[target="_blank"]{
        z-index: 9999999;
    position: relative;

}
    .word-wrap {
        position: relative;
        /* width: 260px; */
        /* adjust to desired wrapping */
        padding: 0px 0 15px !important;
        white-space: inherit;
        /* css-3 */
        /* white-space: -moz-pre-wrap; */
        /* Mozilla, since 1999 */
        /* white-space: -pre-wrap; */
        /* Opera 4-6 */
        /* white-space: -o-pre-wrap; */
        /* Opera 7 */
        word-wrap: break-word;
        /* Internet Explorer 5.5+ */
        z-index: 2;
    }

    input {
        autocomplete="off"
    }

    .active,
    .kalan-active {
        color: red !important;
        content: '▬'
    }

    .word-wrap div {
        padding: 5px 5px 5px 15px;
    }

    .show-more {
        font-weight: bold;
        position: absolute;
        bottom: 0;
        padding-top: 15px;
        height: 50px;
        margin-bottom: 10px;
        background: #f1ff8b;
        left: 0;
    }

    .show-more:hover,
    .show-more:focus {
        text-decoration: none
    }

    .show-more-admin {
        background-color: rgb(212, 247, 255);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center
    }

    /*th{width: auto !important}*/
    th {
        width: 100px
    }

    .tr-amaliati {
        display: none
    }

    .tr-eghdam {
        display: none
    }

    .tr-faaliat {
        display: none
    }

    .tr-faaliat-admins,
    .tr-eghdam-admins,
    .tr-amaliati-admins,
    .tr-kalan-admins,
    .tr-admins-group {
        display: none
    }

    .select2-container-multi .select2-choices li {
        float: right
    }

    .select2-container-multi .select2-choices .select2-search-choice {
        padding: 3px 3px 3px 16px
    }

    table.dataTable thead>tr>th,
    table.dataTable thead>tr>td {
        padding-right: 10px
    }

    th {
        text-align: center !important;
    }

    input.w100 {
        width: 40px
    }

    table.table-bordered.dataTable td {
        border-left-width: 1px;
    }

    button.btn.call {
        position: static;
    }

    button.btn.fixed {
        position: fixed;
        bottom: 10px;
        z-index: 0;
        left:
            3
    }

    footer {
        display: none
    }
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

    <style>
        td {
            white-space: nowrap;
        }
    </style>
    <form action="<?php echo RELA_DIR ?>admin/?component=form&action=sabt" method="post">
        <input type="hidden" name="q" value="<?php echo $_GET['q'] ?>">
        <a style="display: none" class="show-amaliati btn btn-info">نمایش در سطح عملیاتی</a>

        <label for="admin">واحد:</label>


        <select id="admin" class="show-admin" multiple>
            <?php foreach ($list['showAdmin'] as $k => $admins) : ?>
                <option <?php if (strpos($_GET['q'], ',' . $admins['admin_id'] . ',') !== false) {
                            echo 'selected';
                        } ?> value="<?php echo $admins['admin_id'] ?>"><?php echo $admins['name'] . ' ' . $admins['family'] ?></option>
            <?php endforeach; ?>
        </select>

        <!--<p:selectCheckboxMenu id="menu" value="#{itemsBean.selectedItems}" label="Items"
                              filter="true" filterMatchMode="contains">
            <f:selectItems value="#{itemsBean.items}"/>
            <p:ajax event="change" update="selectedItemText"/>
        </p:selectCheckboxMenu>
        <h:outputText id="selectedItemText" value=" #{itemsBean.selectedItems}"/>-->

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

            <?php if ($admin_info['parent_id'] == 0) : ?>
                <option selected value="9">10</option>
                <option selected value="10">11</option>
                <option selected value="11">12</option>
                <option selected value="12">13</option>
            <?php endif; ?>

            <option selected value="13">14</option>
            <option selected value="14">15</option>
            <option selected value="15">16</option>
            <option selected value="16">17</option>

            <?php if ($admin_info['parent_id'] == 0) : ?>
                <option selected value="17">18</option>
                <option selected value="18">19</option>
                <option selected value="19">20</option>
                <option selected value="20">21</option>
            <?php endif; ?>

            <option selected value="21">22</option>
            <option selected value="22">23</option>
            <option selected value="23">24</option>
            <option selected value="24">25</option>

            <?php if ($admin_info['parent_id'] == 0) : ?>
                <option selected value="25">26</option>
                <option selected value="26">27</option>
                <option selected value="27">28</option>
                <option selected value="28">29</option>
            <?php endif; ?>

            <option selected value="29">30</option>
            <option selected value="30">31</option>
            <option selected value="31">32</option>
            <option selected value="32">33</option>
            <?php if ($admin_info['parent_id'] == 0) : ?>
                <option selected value="33">34</option>
                <option selected value="34">35</option>
                <option selected value="35">36</option>
                <option selected value="36">37</option>
            <?php endif; ?>
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
                -->
                <div class="table-responsive table-responsive-datatables">
                    <?php if ($msg != '') : ?>
                        <?php echo $msg; ?>
                    <?php endif; ?>


                    <div class="panel-body">
                        <div id="container" style="width: 100%;">
                            <div class='table-cont1'>
                                <table id="example" class="  table-bordered rtl" cellspacing="0">
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

                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th style="background-color: #7dff7f; border: 0">10</th>
                                                <th style="background-color: #7dff7f; border: 0">11</th>
                                                <th style="background-color: #7dff7f; border: 0">12</th>
                                                <th style="background-color: #7dff7f; border: 0">13</th>
                                            <?php endif; ?>
                                            <th style="background-color: #7dff7f; border: 0">14</th>

                                            <th style="background-color: #f2a89e; border: 0">15</th>
                                            <th style="background-color: #f2a89e; border: 0">16</th>
                                            <th style="background-color: #f2a89e; border: 0">17</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th style="background-color: #f2a89e; border: 0">18</th>
                                                <th style="background-color: #f2a89e; border: 0">19</th>
                                                <th style="background-color: #f2a89e; border: 0">20</th>
                                                <th style="background-color: #f2a89e; border: 0">21</th>
                                            <?php endif; ?>
                                            <th style="background-color: #f2a89e; border: 0">22</th>


                                            <th style="background-color: #ffbe62; border: 0">23</th>
                                            <th style="background-color: #ffbe62; border: 0">24</th>
                                            <th style="background-color: #ffbe62; border: 0">25</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th style="background-color: #ffbe62; border: 0">26</th>
                                                <th style="background-color: #ffbe62; border: 0">27</th>
                                                <th style="background-color: #ffbe62; border: 0">28</th>
                                                <th style="background-color: #ffbe62; border: 0">29</th>
                                            <?php endif; ?>
                                            <th style="background-color: #ffbe62; border: 0">30</th>


                                            <th style="background-color: #8DD4FF; border: 0">31</th>
                                            <th style="background-color: #8DD4FF; border: 0">32</th>
                                            <th style="background-color: #8DD4FF; border: 0">33</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th style="background-color: #8DD4FF; border: 0">34</th>
                                                <th style="background-color: #8DD4FF; border: 0">35</th>
                                                <th style="background-color: #8DD4FF; border: 0">36</th>
                                                <th style="background-color: #8DD4FF; border: 0">37</th>
                                            <?php endif; ?>
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
                                            <th>درصد نهایی مرکز</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th>تطابق مستند با درصد اعلامی</th>
                                                <th>تطابق سایت با درصد اعلامی</th>
                                                <th>تطابق جلسه با درصد اعلامی</th>
                                                <th> max</th>
                                            <?php endif; ?>
                                            <th>توضیحات مرکز </th>
                                            <th>اعلامی واحد</th>
                                            <th>توضیحات اعلامی واحد</th>
                                            <th>درصد نهایی مرکز</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th>تطابق مستند با درصد اعلامی</th>
                                                <th>تطابق سایت با درصد اعلامی</th>
                                                <th>تطابق جلسه با درصد اعلامی</th>
                                                <th> max</th>
                                            <?php endif; ?>
                                            <th>توضیحات مرکز</th>
                                            <th>اعلامی واحد</th>
                                            <th>توضیحات اعلامی واحد</th>
                                            <th>درصد نهایی مرکز</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th>تطابق مستند با درصد اعلامی</th>
                                                <th>تطابق سایت با درصد اعلامی</th>
                                                <th>تطابق جلسه با درصد اعلامی</th>
                                                <th> max</th>
                                            <?php endif; ?>
                                            <th>توضیحات مرکز </th>
                                            <th>اعلامی واحد</th>
                                            <th>توضیحات اعلامی واحد</th>
                                            <th>درصد نهایی مرکز</th>
                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                <th>تطابق مستند با درصد اعلامی</th>
                                                <th>تطابق سایت با درصد اعلامی</th>
                                                <th>تطابق جلسه با درصد اعلامی</th>
                                                <th> max</th>
                                            <?php endif; ?>
                                            <th>توضیحات مرکز </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($list['kalans'] as $kalan_no => $vKalan) : ?>

                                            <tr class="">
                                                <td><?php echo $kalan_no ?></td>
                                                <td class="word-wrap" style=" display: inline-table;width: 100% ">
                                                    <div><?php echo $vKalan['kalan_name'] ?>
                                                        <a class="show-more " data-level="kalan" data-kalan_no="<?php echo $kalan_no ?>" href="">◄</a>
                                                        <a class="show-more-admin " data-level="kalan" data-kalan_no="<?php echo $kalan_no ?>" href="">▼ واحد</a>
                                                    </div>
                                                </td>
                                                <td style="background-color: whitesmoke"></td>
                                                <td style="background-color: whitesmoke"></td>
                                                <td style="background-color: whitesmoke"></td>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "HH1-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['HH1'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "H1-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['H1'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "HH2-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['HH2'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "H2-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['H2'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "HH3-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['HH3'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "H3-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['H3'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "HH4-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['HH4'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td><?php if (isset($_GET['dev'])) echo "H4-"; ?>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <?php echo substr($vKalan['H4'], 0, 5) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td></td>

                                            </tr>
                                            <?php foreach ($vKalan['admins'] as $KAId => $vAdmins) : ?>
                                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-kalan-admins kalan-admin-<?php echo $kalan_no ?>">
                                                    <td></td>
                                                    <td class="word-wrap" style="white-space:nowrap;">
                                                        <div>
                                                            <!--تجمیع--> <?php echo $vAdmins['admin_name'] . ' ' . $vAdmins['family'] ?><a class="show-more-group-kalan show-more-admin-<?php echo $kalan_no ?> a-show-group-kalan-<?php echo $kalan_no ?> a-show-group-kalan-<?php echo $kalan_no ?> " data-admin_id="<?php echo $KAId ?>-<?php echo $kalan_no ?>" href="">▼ </a>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "GG1-"; ?><?php echo substr($vAdmins['GG1'], 0, 5) ?></td>
                                                    <td></td>
                                                    <td>
                                                        <?php if (isset($_GET['dev'])) echo "G1-"; ?><?php echo substr($vAdmins['G1'], 0, 5) ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>

                                                    <td><?php if (isset($_GET['dev'])) echo "GG2-"; ?><?php echo substr($vAdmins['GG2'], 0, 5) ?></td>
                                                    <td></td>
                                                    <td>
                                                        <?php if (isset($_GET['dev'])) echo "G2-"; ?><?php echo substr($vAdmins['G2'], 0, 5) ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "GG3-"; ?><?php echo substr($vAdmins['GG3'], 0, 5) ?></td>
                                                    <td></td>
                                                    <td>
                                                        <?php if (isset($_GET['dev'])) echo "G3-"; ?><?php echo substr($vAdmins['G3'], 0, 5) ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "GG4-"; ?><?php echo substr($vAdmins['GG4'], 0, 5) ?></td>
                                                    <td></td>
                                                    <td>
                                                        <?php if (isset($_GET['dev'])) echo "G4-"; ?><?php echo substr($vAdmins['G4'], 0, 5) ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>

                                                </tr>
                                                <?php foreach ($vAdmins['groups'] as $id => $vKGroup) : ?>
                                                    <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-kalan-<?php echo $KAId ?>-<?php echo $kalan_no ?>
                                            kalan-no-group-<?php echo $kalan_no ?>
                                            ">
                                                        <td></td>
                                                        <td class="word-wrap|--- "><?php echo $vKGroup['group_name'] . ' ' . $vKGroup['group_family'] ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "QQ1-"; ?><?php echo substr($vKGroup['QQ1'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "Q1-"; ?><?php echo substr($vKGroup['Q1'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>

                                                        <td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <div> ارزیاب:
                                                                        <?php if ($vKGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                            <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][1-a]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab1'] ?></textarea>
                                                                        <?php else : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab1']) ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <span>مدیر</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1'] != '') : ?>
                                                                        <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1']) ?><?php endif; ?>
                                                                    <?php else : ?>
                                                                        <div>مدیر:
                                                                            <?php if ($vKGroup['group_status'] < 7 && $vKGroup['group_status'] > 4) : ?>
                                                                                <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][1-m]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1'] ?></textarea>
                                                                            <?php else : ?>
                                                                                <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1']) ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <span>ارزیاب</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab1'] != '') : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab1']) ?><?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($vKGroup['group_status1'] == 7) : ?>
                                                                            <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1'] != '') : ?> <br>
                                                                                <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager1']) ?><?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                        </td>



                                                        <td><?php if (isset($_GET['dev'])) echo "QQ2-"; ?><?php echo substr($vKGroup['QQ2'], 0, 5) ?></td>
                                                        <td></td>

                                                        <td><?php if (isset($_GET['dev'])) echo "Q2-"; ?><?php echo substr($vKGroup['Q2'], 0, 5) ?></td>

                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>


                                                        <td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <div> ارزیاب:
                                                                        <?php if ($vKGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                            <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][2-a]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab2'] ?></textarea>
                                                                        <?php else : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab2']) ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <span>مدیر</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2'] != '') : ?>
                                                                        <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2']) ?><?php endif; ?>
                                                                    <?php else : ?>
                                                                        <div>مدیر:
                                                                            <?php if ($vKGroup['group_status'] < 7 && $vKGroup['group_status'] > 4) : ?>
                                                                                <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][2-m]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2'] ?></textarea>
                                                                            <?php else : ?>
                                                                                <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2']) ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <span>ارزیاب</span>:
                                                                        <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab2'] != '') : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab2']); ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php if ($vKGroup['group_status2'] == 7) : ?>
                                                                        <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2'] != '') : ?> <br>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager2']) ?><?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                        </td>

                                                        <td><?php if (isset($_GET['dev'])) echo "QQ3-"; ?><?php echo substr($vKGroup['QQ3'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "Q3-"; ?><?php echo substr($vKGroup['Q3'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <div> ارزیاب:
                                                                        <?php if ($vKGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                            <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][3-a]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab3'] ?></textarea>
                                                                        <?php else : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab3']) ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <span>مدیر</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3'] != '') : ?>
                                                                        <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3']) ?><?php endif; ?>
                                                                    <?php else : ?>
                                                                        <div>مدیر:
                                                                            <?php if ($vKGroup['group_status'] < 7 && $vKGroup['group_status'] > 4) : ?>
                                                                                <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][3-m]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3'] ?></textarea>
                                                                            <?php else : ?>
                                                                                <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3']) ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <span>ارزیاب</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab3'] != '') : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab3']) ?><?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($vKGroup['group_status3'] == 7) : ?>
                                                                            <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3'] != '') : ?> <br>
                                                                                <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager3']) ?><?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                        </td>

                                                        <td><?php if (isset($_GET['dev'])) echo "QQ4-"; ?><?php echo substr($vKGroup['QQ4'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "Q4-"; ?><?php echo substr($vKGroup['Q4'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <div> ارزیاب:
                                                                        <?php if ($vKGroup['group_status'] < 5 && $list['editable'] == 1) : ?> <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][4-a]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab4'] ?></textarea></div>
                                                                <?php else : ?>
                                                                    <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab4']) ?>
                                                                <?php endif; ?>

                                                                <span>مدیر</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4'] != '') : ?>
                                                                    <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4']) ?><?php endif; ?>
                                                                <?php else : ?>
                                                                    <div>مدیر:
                                                                        <?php if ($vKGroup['group_status'] < 7 && $vKGroup['group_status'] > 4) : ?>
                                                                            <textarea name="kalan_tahlil[<?php echo $kalan_no ?>][<?php echo $id ?>][4-m]"><?php echo $vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4'] ?></textarea>
                                                                        <?php else : ?>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4']) ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <span>ارزیاب</span>: <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab4'] != '') : ?>
                                                                        <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_arzyab4']) ?><?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php if ($vKGroup['group_status4'] == 7) : ?>
                                                                        <?php if ($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4'] != '') : ?> <br>
                                                                            <?php echo readMore($vKGroup['kalan_tahlil']($kalan_no, $id)['kalan_tahlil_manager4']) ?><?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>


                                            <?php foreach ($vKalan['amaliatis'] as $amaliati_no => $vAmaliati) : ?>
                                                <tr class="tr-amaliati kalan-<?php echo $kalan_no ?>">
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo $amaliati_no; ?></td>
                                                    <td class="word-wrap" style=" display: inline-table;width: 100% " rowspan="<?php echo $vKalan['amaliatiRow'] ?>" style="width:150px !important; ">
                                                        <div><?php echo $vAmaliati['amaliati_name'] ?>
                                                            <a class="show-more" data-level="amaliati" data-amaliati_no="<?php echo $amaliati_no ?>" href="">◄</a>
                                                            <a class="show-more-admin " data-level="amaliati" data-amaliati_no="<?php echo $amaliati_no ?>" href="">▼ واحد</a>
                                                        </div>
                                                    </td>

                                                    <td style="background-color: whitesmoke"></td>
                                                    <td style="background-color: whitesmoke"></td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "FF1-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['FF1'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "F1-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['F1'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "FF2-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['FF2'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "F2-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['F2'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "FF3-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['FF3'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "F3-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['F3'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "FF4-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['FF4'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td></td>
                                                    <td><?php if (isset($_GET['dev'])) echo "F4-"; ?>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <?php echo substr($vAmaliati['F4'], 0, 5) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php endif; ?>
                                                    <td></td>
                                                </tr>
                                                <?php foreach ($vAmaliati['admins'] as $AAId => $vAdmins) : ?>
                                                    <tr style="background-color: rgb(212,247,255) !important;" class="tr-amaliati-admins amaliati-admin-<?php echo $amaliati_no ?>">
                                                        <td></td>
                                                        <td></td>
                                                        <td class="word-wrap" style="white-space:nowrap;">
                                                            <div>
                                                                <!--تجمیع--> <?php echo $vAdmins['admin_name'] . ' ' . $vAdmins['family'] ?><a class="show-more-group-amaliati show-more-admin-<?php echo $amaliati_no ?> a-show-group-kalan-<?php echo $kalan_no ?> " data-admin_id="<?php echo $AAId ?>-<?php echo $amaliati_no ?>" href="">▼ </a>
                                                            </div>
                                                        </td>

                                                        <td></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "N-"; ?><?php echo substr($vAdmins['N'], 0, 4) ?></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "EE1-"; ?><?php echo substr($vAdmins['EE1'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "E1-"; ?><?php echo substr($vAdmins['E1'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "EE2-"; ?><?php echo substr($vAdmins['EE2'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "E2-"; ?><?php echo substr($vAdmins['E2'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "EE3-"; ?><?php echo substr($vAdmins['EE3'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "E3-"; ?><?php echo substr($vAdmins['E3'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "EE4-"; ?><?php echo substr($vAdmins['EE4'], 0, 5) ?></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "E4-"; ?><?php echo substr($vAdmins['E4'], 0, 5) ?></td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                    </tr>
                                                    <?php foreach ($vAdmins['groups'] as $id => $vAGroup) : ?>
                                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-amaliati-<?php echo $AAId ?>-<?php echo $amaliati_no ?>
                                            amaliati-no-group-<?php echo $vAGroup['amaliati_no'] ?>
                                            kalan-no-group-<?php echo $kalan_no ?> ">
                                                            <td></td>
                                                            <td></td>
                                                            <td class="word-wrap|--- "><?php echo $vAGroup['group_name'] . ' ' . $vAGroup['group_family'] ?></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "NN-"; ?><?php echo substr($vAGroup['NN'], 0, 5) ?></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "PP1-"; ?><?php echo substr($vAGroup['PP1'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "P1-"; ?><?php echo substr($vAGroup['P1'], 0, 5) ?></td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>

                                                            <td><?php if (isset($_GET['dev'])) echo "PP2-"; ?><?php echo substr($vAGroup['PP2'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "P2-"; ?><?php echo substr($vAGroup['P2'], 0, 5) ?></td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "PP3-"; ?><?php echo substr($vAGroup['PP3'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "P3-"; ?><?php echo substr($vAGroup['P3'], 0, 5) ?></td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "PP4-"; ?><?php echo substr($vAGroup['PP4'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "P4-"; ?><?php echo substr($vAGroup['P4'], 0, 5) ?></td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>


                                                <?php foreach ($vAmaliati['eghdams'] as $eghdam_id => $vEghdam) : ?>
                                                    <tr class="tr-eghdam amaliati-<?php echo $amaliati_no ?>">
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo $eghdam_id; ?></td>
                                                        <td class="word-wrap" style=" display: inline-table;width: 100% " rowspan="<?php echo $vKalan['eghdamRow'] ?>" style="width:150px !important; ">
                                                            <div><?php echo $vEghdam['eghdam_name'] ?>
                                                                <a class="show-more" data-level="eghdam" data-eghdam_no="<?php echo $eghdam_id ?>" href="">◄</a>
                                                                <a class="show-more-admin " data-level="eghdam" data-eghdam_no="<?php echo $eghdam_id ?>" href="">▼ واحد</a>
                                                            </div>
                                                        </td>

                                                        <td style="background-color: whitesmoke"></td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "DD1-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['DD1'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "D1-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['D1'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "DD2-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['DD2'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "D2-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['D2'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "DD3-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['DD3'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "D3-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['D3'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "DD4-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['DD4'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?php if (isset($_GET['dev'])) echo "D4-"; ?>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php echo substr($vEghdam['D4'], 0, 5) ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                    </tr>
                                                    <?php foreach ($vEghdam['admins'] as $EAId => $vEAdmins) : ?>
                                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-eghdam-admins eghdam-admin-<?php echo $eghdam_id ?>">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="word-wrap" style="white-space:nowrap;">
                                                                <div>
                                                                    <!--تجمیع--> <?php echo $vEAdmins['admin_name'] . ' ' . $vEAdmins['family'] ?><a class="show-more-group-eghdam show-more-admin-<?php echo $vEghdam['eghdam_vazn'] ?> a-show-group-amaliati-<?php echo $amaliati_no ?> a-show-group-kalan-<?php echo $kalan_no ?> " data-admin_id="<?php echo $EAId ?>-<?php echo $eghdam_id ?>" href="">▼ </a><?php if (isset($_GET['dev'])) {
                                                                                                                                                                                                                                                                                                                                                                                                            echo "(ev:" . $vEAdmins['eghdam_vazn'];
                                                                                                                                                                                                                                                                                                                                                                                                        } ?>
                                                                </div>
                                                            </td>

                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "M-"; ?><?php echo substr($vEAdmins['M'], 0, 5) ?></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "CC1-"; ?><?php echo substr($vEAdmins['CC1'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "C1-"; ?><?php echo substr($vEAdmins['C1'], 0, 5) ?></td>


                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <td>
                                                                        <?php echo $vEAdmins['admin_status'] ?>
                                                                        <?php if ($vEAdmins['admin_status'] < 5) : ?>
                                                                            <input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_1_1" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][1_1]" value="<?php echo $vEAdmins['manager1_1'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['manager1_1'] ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($vEAdmins['admin_status'] < 5) : ?>
                                                                            <input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_1_2" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][1_2]" value="<?php echo $vEAdmins['manager1_2'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['manager1_2'] ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?php if ($vEAdmins['admin_status'] < 5) : ?>
                                                                            <input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_1_3" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][1_3]" value="<?php echo $vEAdmins['manager1_3'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['manager1_3'] ?>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                <?php else : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                            <?php endif; ?>


                                                            <td><?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab1'], 0, 5) ?><br>
                                                                        <span>مدیر</span>:
                                                                        <?php if ($vEAdmins['group_status'] < 7 && $list['editable'] == 1) : ?>
                                                                            <input class="w100" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][max_manager1]" value="<?php echo $vEAdmins['max_manager1'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['max_manager1'] ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab1'], 0, 5) ?><br>
                                                                        <span>مدیر</span>: <?php echo substr($vEAdmins['max_manager1'], 0, 5) ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>

                                                                        <span>ارزیاب</span>: <?php echo readmore($vEAdmins['tarzyab1']) ?><br>
                                                                        <span>مدیر</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tmanager1]"><?php echo $vEAdmins['tmanager1'] ?></textarea>
                                                                    <?php else : ?>
                                                                        <span>ارزیاب</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tarzyab1]"><?php echo $vEAdmins['tarzyab1'] ?></textarea><br>
                                                                        <span>مدیر</span>: <?php echo readmore($vEAdmins['tmanager1']) ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php echo readmore($vEAdmins['tmanager1']) ?>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td><?php if (isset($_GET['dev'])) echo "CC2-"; ?><?php echo substr($vEAdmins['CC2'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "C2-"; ?><?php echo substr($vEAdmins['C2'], 0, 5) ?></td>

                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_2_1" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][2_1]" value="<?php echo $vEAdmins['manager2_1'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager2_1'] ?></span></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_2_2" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][2_2]" value="<?php echo $vEAdmins['manager2_2'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager2_2'] ?></span></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_2_3" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][2_3]" value="<?php echo $vEAdmins['manager2_3'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager2_3'] ?></span></td>
                                                                <?php else : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <td><?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab2'], 0, 5) ?><br>
                                                                        <span>مدیر</span>:
                                                                        <?php if ($vEAdmins['group_status'] < 7 && $list['editable'] == 1) : ?>
                                                                            <input class="w100" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][max_manager2]" value="<?php echo $vEAdmins['max_manager2'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['max_manager2'] ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab2'], 0, 5) ?><br>
                                                                        <span>مدیر</span>: <?php echo substr($vEAdmins['max_manager2'], 0, 5) ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                        <span>ارزیاب</span>:
                                                                        <?php if ($vEAdmins['tarzyab2'] != '') : ?>
                                                                            <?php echo readMore($vEAdmins['tarzyab2']) ?><?php endif; ?><br>
                                                                            <span>مدیر</span>:
                                                                            <?php if ($vEAdmins['group_status'] >= 5 && $vEAdmins['group_status'] <= 7) : ?>
                                                                                <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tmanager2]"><?php echo $vEAdmins['tmanager2'] ?></textarea>
                                                                                <!--                                                                     <input  data-input="manager" data-position="<?/*=$eghdam_id*/ ?>_<?/*=$EAId*/ ?>_2_4" name="manager[<?/*=$EAId*/ ?>][<?/*=$eghdam_id*/ ?>][2_4]" value="<?/*=$vEAdmins['tahlil2_4']*/ ?>"><span style="display: none;">--><?/*=$vEAdmins['tahlil2_4']*/ ?>
                                                                            <?php else : ?>
                                                                                <?php echo readMore($vEAdmins['tmanager2']) ?>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <span>ارزیاب</span>:
                                                                            <?php if ($vEAdmins['group_status'] < 5) : ?>
                                                                                <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tarzyab2]"><?php echo $vEAdmins['tarzyab2'] ?></textarea><br>
                                                                            <?php else : ?>
                                                                                <?php echo readMore($vEAdmins['tarzyab2']) ?>
                                                                            <?php endif; ?>
                                                                            <span>مدیر</span>: <?php if ($vEAdmins['tmanager2'] != '') : ?>
                                                                                <?php echo readMore($vEAdmins['tmanager2']) ?><?php endif; ?><br>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <?php if ($vEAdmins['group_status'] < 7) : ?>
                                                                                <?php if ($vEAdmins['tmanager2'] != '') : ?>
                                                                                    <?php echo readMore($vEAdmins['tmanager2']) ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                            </td>


                                                            <td><?php if (isset($_GET['dev'])) echo "CC3-"; ?><?php echo substr($vEAdmins['CC3'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "C3-"; ?><?php echo substr($vEAdmins['C3'], 0, 5) ?></td>

                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_3_1" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][3_1]" value="<?php echo $vEAdmins['manager3_1'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager3_1'] ?></span></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_3_2" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][3_2]" value="<?php echo $vEAdmins['manager3_2'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager3_2'] ?></span></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_3_3" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][3_3]" value="<?php echo $vEAdmins['manager3_3'] ?>"><span style="display: none;"><?php echo $vEAdmins['eghdam_vazn']['manager3_3'] ?></span></td>
                                                                <?php else : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <td><?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab3'], 0, 5) ?><br>
                                                                        <span>مدیر</span>:
                                                                        <?php if ($vEAdmins['group_status'] < 6) : ?>
                                                                            <input class="w100" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][max_manager3]" value="<?php echo $vEAdmins['max_manager3'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['max_manager3'] ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab3'], 0, 5) ?><br>
                                                                        <span>مدیر</span>: <?php echo substr($vEAdmins['max_manager3'], 0, 5) ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>

                                                                        <span>ارزیاب</span>: <?php echo $vEAdmins['tarzyab3'] ?><br>
                                                                        <span>مدیر</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tmanager3]"><?php echo $vEAdmins['tmanager3'] ?></textarea>
                                                                    <?php else : ?>

                                                                        <span>ارزیاب</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tarzyab3]"><?php echo $vEAdmins['tarzyab3'] ?></textarea><br>
                                                                        <span>مدیر</span>: <?php echo $vEAdmins['tmanager3'] ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php echo $vEAdmins['tmanager3'] ?>
                                                                <?php endif; ?>
                                                            </td>


                                                            <td><?php if (isset($_GET['dev'])) echo "CC4-"; ?><?php echo substr($vEAdmins['CC4'], 0, 5) ?></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "C4-"; ?><?php echo substr($vEAdmins['C4'], 0, 5) ?></td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <?php if ($admin_info['admin_id'] != 1) : ?>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_4_1" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][4_1]" value="<?php echo $vEAdmins['manager4_1'] ?>"></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_4_2" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][4_2]" value="<?php echo $vEAdmins['manager4_2'] ?>"></td>
                                                                    <td><input class="w100" data-input="manager" data-position="<?php echo $eghdam_id ?>_<?php echo $EAId ?>_4_3" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][4_3]" value="<?php echo $vEAdmins['manager4_3'] ?>"></td>
                                                                <?php else : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <td><?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab4'], 0, 5) ?><br>
                                                                        <span>مدیر</span>:
                                                                        <?php if ($vEAdmins['group_status'] < 6) : ?>
                                                                            <input class="w100" name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][max_manager4]" value="<?php echo $vEAdmins['max_manager4'] ?>">
                                                                        <?php else : ?>
                                                                            <?php echo $vEAdmins['max_manager4'] ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <span>ارزیاب</span>: <?php echo substr($vEAdmins['max_arzyab4'], 0, 5) ?><br>
                                                                        <span>مدیر</span>: <?php echo substr($vEAdmins['max_manager4'], 0, 5) ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php if ($admin_info['admin_id'] == 1) : ?>

                                                                        <span>ارزیاب</span>: <?php echo $vEAdmins['tarzyab4'] ?><br>
                                                                        <span>مدیر</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tmanager4]"><?php echo $vEAdmins['tmanager4'] ?></textarea>
                                                                    <?php else : ?>

                                                                        <span>ارزیاب</span>: <textarea name="manager[<?php echo $EAId ?>][<?php echo $eghdam_id ?>][tarzyab4]"><?php echo $vEAdmins['tarzyab4'] ?></textarea><br>
                                                                        <span>مدیر</span>: <?php echo $vEAdmins['tmanager4'] ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php echo $vEAdmins['tmanager4'] ?>
                                                                <?php endif; ?>
                                                            </td>



                                                        </tr>
                                                        <?php foreach ($vEAdmins['groups'] as $EGid => $vEGroup) : ?>
                                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-eghdam-<?php echo $EAId ?>-<?php echo $eghdam_id ?> eghdam-no-group-<?php echo $eghdam_id ?> amaliati-no-group-<?php echo $amaliati_no ?> kalan-no-group-<?php echo $kalan_no ?> ">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="word-wrap">|--- <?php echo $vEGroup['group_name'] . ' ' . $vEGroup['group_family'] ?></td>
                                                                <td></td>
                                                                <td><?php if (isset($_GET['dev'])) {
                                                                        echo "MM-";
                                                                        echo substr($vEGroup['MM'], 0, 5);
                                                                    } ?></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "RR1-"; ?><?php echo substr($vEGroup['RR1'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td> <?php if (isset($_GET['dev'])) echo "R1-"; ?><?php echo substr($vEGroup['R1'], 0, 5) ?> </td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td>

                                                                    <?php echo $vEGroup['tahlil1_4'] ?>

                                                                </td>

                                                                <td><?php if (isset($_GET['dev'])) echo "RR2-"; ?><?php echo substr($vEGroup['RR2'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td> <?php if (isset($_GET['dev'])) echo "R2-"; ?><?php echo substr($vEGroup['R2'], 0, 5) ?> </td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td>

                                                                    <?php echo $vEGroup['tahlil2_4'] ?>

                                                                </td>
                                                                <td><?php if (isset($_GET['dev'])) echo "RR3-"; ?><?php echo substr($vEGroup['RR3'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td> <?php if (isset($_GET['dev'])) echo "R3-"; ?><?php echo substr($vEGroup['R3'], 0, 5) ?> </td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td>

                                                                    <?php echo $vEGroup['tahlil3_4'] ?>

                                                                </td>
                                                                <td><?php if (isset($_GET['dev'])) echo "RR4-"; ?><?php echo substr($vEGroup['RR4'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td> <?php if (isset($_GET['dev'])) echo "R4-"; ?><?php echo substr($vEGroup['R4'], 0, 5) ?> </td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <?php echo $vEGroup['tahlil4_4'] ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>



                                                    <?php foreach ($vEghdam['faaliats'] as $faaliat_id => $vFaaliat) : ?>
                                                        <tr class="tr-faaliat eghdam-<?php echo $eghdam_id ?>">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo $faaliat_id; ?></td>
                                                            <td class="word-wrap" style=" display: inline-table;width: 100% " style="width:150px !important; ">
                                                                <div><?php echo $vFaaliat['faaliat_name'] ?>
                                                                    <a class="show-more-admin " data-level="faaliat" data-faaliat_no="<?php echo $faaliat_id ?>" href="">▼ واحد</a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "BB1-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['BB1'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "B1-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['B1'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "BB2-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['BB2'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "B2-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['B2'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "BB3-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['BB3'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "B3-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['B3'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "BB4-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['BB4'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td></td>
                                                            <td><?php if (isset($_GET['dev'])) echo "B4-"; ?>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <?php echo substr($vFaaliat['B4'], 0, 5) ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php endif; ?>
                                                            <td></td>

                                                        </tr>
                                                        <?php foreach ($vFaaliat['admins'] as $fAId => $vFAdmins) : ?>
                                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-faaliat-admins faaliat-admin-<?php echo $faaliat_id ?>">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="word-wrap" style="white-space:nowrap;">
                                                                    <div>
                                                                        <!--تجمیع--> <?php echo $vFAdmins['admin_name'] . ' ' ?><a class="show-more-group-faaliat show-more-admin-<?php echo $faaliat_id ?> a-show-group-eghdam-<?php echo $eghdam_id ?> a-show-group-amaliati-<?php echo $amaliati_no ?> a-show-group-kalan-<?php echo $kalan_no ?> " data-admin_id="<?php echo $fAId ?>-<?php echo $faaliat_id ?>" href="">▼ </a>(fv:<?php echo $vFAdmins['faaliat_vazn'] ?>)
                                                                    </div>
                                                                </td>
                                                                <td><?php if (isset($_GET['dev'])) echo "Z-"; ?><?php echo substr($vFAdmins['Z'], 0, 5) ?></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "AA1-"; ?><?php echo substr($vFAdmins['AA1'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td> <?php if (isset($_GET['dev'])) echo "A1-"; ?><?php echo substr($vFAdmins['A1'], 0, 5) ?> </td>
                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td></td>

                                                                <td><?php if (isset($_GET['dev'])) echo "AA2-"; ?><?php echo substr($vFAdmins['AA2'], 0, 5) ?></td>
                                                                <td></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "A2-"; ?><?php echo substr($vFAdmins['A2'], 0, 5) ?></td>

                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "AA3-"; ?><?php echo substr($vFAdmins['AA3'], 0, 5) ?> </td>
                                                                <td></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "A3-"; ?><?php echo substr($vFAdmins['A3'], 0, 5) ?></td>

                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td></td>
                                                                <td><?php if (isset($_GET['dev'])) echo "AA4-"; ?><?php echo substr($vFAdmins['AA4'], 0, 5) ?></td>
                                                                <td></td>

                                                                <td><?php if (isset($_GET['dev'])) echo "A4-"; ?><?php echo substr($vFAdmins['A4'], 0, 5) ?></td>

                                                                <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                <?php endif; ?>
                                                                <td></td>
                                                            </tr>
                                                            <?php foreach ($vFAdmins['groups'] as $FGId => $vFGroup) : ?>
                                                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-<?php echo $fAId ?>-<?php echo $faaliat_id ?> faaliat-no-group-<?php echo $faaliat_id ?> eghdam-no-group-<?php echo $eghdam_id ?> amaliati-no-group-<?php echo $amaliati_no ?> kalan-no-group-<?php echo $kalan_no ?> ">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="word-wrap">|--- <?php echo $vFGroup['group_name'] . ' ' . $vFGroup['group_family'] ?>
                                                                    </td>
                                                                    <td><?php if (isset($_GET['dev'])) echo "ZZ "; ?><?php echo substr($vFGroup['ZZ'], 0, 5) ?></td>

                                                                    <td><?php if (isset($_GET['dev'])) echo "OO1-"; ?><?php echo substr($vFGroup['OO1'], 0, 5) ?>
                                                                        <?php if ($vFGroup['admin_file1']) : ?>
                                                                            <br>
                                                                            <a target="_blank" href="<?php echo RELA_DIR ?>statics/files/<?php echo $FGId ?>/season<?php echo STEP_FORM1 ?>/<?php echo $eghdam_id ?>/<?php echo $vFGroup['admin_file1'] ?>">دانلود فایل</a> <?php endif; ?>
                                                                    </td>
                                                                    <td class="word-wrap">
                                                                        <?php if ($vFGroup['admin_tozihat1'] != '') : ?>
                                                                            <?php echo readMore($vFGroup['admin_tozihat1']) ?>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <td><?php if ($admin_info['parent_id'] == 0  || $vFGroup['group_status'] == 7) : ?>
                                                                            <?php if (isset($_GET['dev'])) echo "O1-"; ?><?php echo substr($vFGroup['O1'], 0, 5) ?>
                                                                        <?php endif; ?>
                                                                    </td>


                                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_1_1" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][1_1]" value="<?php echo $vFGroup['manager1_1'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager1_1'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?> <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_1_2" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][1_2]" value="<?php echo $vFGroup['manager1_2'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager1_2'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?> <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_1_3" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][1_3]" value="<?php echo $vFGroup['manager1_3'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager1_3'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max1'], 0, 5) ?><br>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <input class="w100" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][max_manager1]" value="<?php echo $vFGroup['max_manager1'] ?>">
                                                                                <?php else : ?>
                                                                                    <?php echo $vFGroup['max_manager1'] ?>
                                                                                <?php endif; ?>
                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max1'], 0, 5) ?><br>
                                                                                <span>مدیر</span>: <?php echo substr($vFGroup['max_manager1'], 0, 5) ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    <td class="word-wrap">

                                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php if ($vFGroup['tahlil1'] != '') : ?> <br>
                                                                                    <?php echo readMore($vFGroup['tahlil1']) ?><?php endif; ?>
                                                                                    <span>مدیر</span>:
                                                                                    <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                        <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil_manager1]"><?php echo $vFGroup['tahlil_manager1'] ?></textarea>
                                                                                    <?php else : ?>
                                                                                        <?php echo readMore($vFGroup['tahlil_manager1']) ?>
                                                                                    <?php endif; ?>
                                                                                <?php else : ?>
                                                                                    <span>ارزیاب</span>:
                                                                                    <?php if ($vFGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                                        <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil1]"><?php echo $vFGroup['tahlil1'] ?></textarea><br>
                                                                                    <?php else : ?>
                                                                                        <?php echo readMore($vFGroup['tahlil1']) ?>
                                                                                    <?php endif; ?>

                                                                                    <span>مدیر</span>: <?php if ($vFGroup['tahlil_manager1'] != '') : ?> <br>
                                                                                        <?php echo readMore($vFGroup['tahlil_manager1']) ?><?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                <?php else : ?>
                                                                                    <?php if ($vFGroup['group_status1'] == 7) : ?>
                                                                                        <?php if ($vFGroup['tahlil_manager1'] != '') : ?>
                                                                                            <?php echo readMore($vFGroup['tahlil_manager1']) ?>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                    </td>

                                                                    <td><?php if (isset($_GET['dev'])) echo "OO2-"; ?><?php echo substr($vFGroup['OO2'], 0, 5) ?>
                                                                        <?php if ($vFGroup['admin_file2']) : ?>
                                                                            <br>
                                                                            <a target="_blank" href="<?php echo RELA_DIR ?>statics/files/<?php echo $FGId ?>/season2/<?php echo $eghdam_id ?>/<?php echo $vFGroup['admin_file2'] ?>">دانلود فایل</a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="word-wrap">
                                                                        <?php if ($vFGroup['admin_tozihat2'] != '') : ?>
                                                                            <?php echo readMore($vFGroup['admin_tozihat2']) ?>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <td><?php if ($admin_info['parent_id'] == 0  || $vFGroup['group_status'] == 7) : ?>
                                                                            <?php if (isset($_GET['dev'])) echo "O2-"; ?><?php echo substr($vFGroup['O2'], 0, 5) ?>
                                                                        <?php endif; ?></td>

                                                                    <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_2_1" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][2_1]" value="<?php echo $vFGroup['manager2_1'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager2_1'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_2_2" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][2_2]" value="<?php echo $vFGroup['manager2_2'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager2_2'] ?>
                                                                            <?php endif; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_2_3" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][2_3]" value="<?php echo $vFGroup['manager2_3'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager2_3'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max2'], 0, 5) ?><br>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <input class="w100" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][max_manager2]" value="<?php echo $vFGroup['max_manager2'] ?>">
                                                                                <?php else : ?>
                                                                                    <?php echo $vFGroup['max_manager2'] ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max2'], 0, 5) ?><br>
                                                                                <span>مدیر</span>: <?php echo substr($vFGroup['max_manager2'], 0, 5) ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>

                                                                    <td class="word-wrap">
                                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php if ($vFGroup['tahlil2'] != '') : ?> <br>
                                                                                    <?php echo readMore($vFGroup['tahlil2']) ?>
                                                                                <?php endif; ?>

                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil_manager2]"><?php echo $vFGroup['tahlil_manager2'] ?></textarea>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager2']) ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>:
                                                                                <?php if ($vFGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil2]"><?php echo $vFGroup['tahlil2'] ?></textarea><br>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil2']) ?>
                                                                                <?php endif; ?>

                                                                                <span>مدیر</span>: <?php if ($vFGroup['tahlil_manager2'] != '') : ?> <br>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager2']) ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <?php if ($vFGroup['group_status2'] == 7) : ?>
                                                                                <?php if ($vFGroup['tahlil_manager2'] != '') : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager2']) ?><?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                    </td>

                                                                    <td><?php if (isset($_GET['dev'])) echo "OO3-"; ?><?php echo substr($vFGroup['OO3'], 0, 5) ?>
                                                                        <?php if ($vFGroup['admin_file3']) : ?>
                                                                            <br>
                                                                            <a target="_blank" href="<?php echo RELA_DIR ?>statics/files/<?php echo $FGId ?>/season3/<?php echo $eghdam_id ?>/<?php echo $vFGroup['admin_file3'] ?>">دانلود فایل</a> <?php endif; ?>
                                                                    </td>
                                                                    <td class="word-wrap">
                                                                        <?php if ($vFGroup['admin_tozihat3'] != '') : ?>
                                                                            <?php echo readMore($vFGroup['admin_tozihat3']) ?>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <td><?php if ($admin_info['parent_id'] == 0  || $vFGroup['group_status'] == 7) : ?>
                                                                            <?php if (isset($_GET['dev'])) echo "O3-"; ?><?php echo substr($vFGroup['O3'], 0, 5) ?>
                                                                        <?php endif; ?></td> <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                        <td>

                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_3_1" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][3_1]" value="<?php echo $vFGroup['manager3_1'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager3_1'] ?>
                                                                            <?php endif; ?>


                                                                        </td>
                                                                        <td>

                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_3_2" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][3_2]" value="<?php echo $vFGroup['manager3_2'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager3_2'] ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>

                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_3_3" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][3_3]" value="<?php echo $vFGroup['manager3_3'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager3_3'] ?>
                                                                            <?php endif; ?>


                                                                        </td>
                                                                        <td>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max3'], 0, 5) ?><br>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?> <input class="w100" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][max_manager3]" value="<?php echo $vFGroup['max_manager3'] ?>">
                                                                                <?php else : ?>
                                                                                    <?php echo $vFGroup['max_manager3'] ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max3'], 0, 5) ?><br>
                                                                                <span>مدیر</span>: <?php echo substr($vFGroup['max_manager3'], 0, 5) ?>

                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>

                                                                    <td class="word-wrap">
                                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php if ($vFGroup['tahlil3'] != '') : ?> <br>
                                                                                    <?php echo readMore($vFGroup['tahlil3']) ?>
                                                                                <?php endif; ?>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil_manager3]"><?php echo $vFGroup['tahlil_manager3'] ?></textarea>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager3']) ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>:
                                                                                <?php if ($vFGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil3]"><?php echo $vFGroup['tahlil3'] ?></textarea><br>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil3']) ?>
                                                                                <?php endif; ?>

                                                                                <span>مدیر</span>: <?php if ($vFGroup['tahlil_manager3'] != '') : ?> <br>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager3']) ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <?php if ($vFGroup['group_status3'] == 7) : ?>
                                                                                <?php if ($vFGroup['tahlil_manager3'] != '') : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager3']) ?><?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                    </td>



                                                                    <td><?php if (isset($_GET['dev'])) echo "OO4-"; ?><?php echo substr($vFGroup['OO4'], 0, 5) ?>
                                                                        <?php if ($vFGroup['admin_file4']) : ?>
                                                                            <br>
                                                                            <a target="_blank" href="<?php echo RELA_DIR ?>statics/files/<?php echo $FGId ?>/season4/<?php echo $eghdam_id ?>/<?php echo $vFGroup['admin_file4'] ?>">دانلود فایل</a> <?php endif; ?>
                                                                    </td>
                                                                    <td class="word-wrap">
                                                                        <?php if ($vFGroup['admin_tozihat4'] != '') : ?>
                                                                            <?php echo readMore($vFGroup['admin_tozihat4']) ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($admin_info['parent_id'] == 0  || $vFGroup['group_status'] == 7) : ?>
                                                                            <?php if (isset($_GET['dev'])) echo "O4-"; ?><?php echo substr($vFGroup['O4'], 0, 5) ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <?php if ($admin_info['parent_id'] == 0) : ?>

                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_4_1" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][4_1]" value="<?php echo $vFGroup['manager4_1'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager4_1'] ?>
                                                                            <?php endif; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_4_2" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][4_2]" value="<?php echo $vFGroup['manager4_2'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager4_2'] ?>
                                                                            <?php endif; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php if ($list['editable'] == 1 && $vFGroup['group_status'] < 5) : ?>
                                                                                <input class="w100" data-input="manager_faaliat_<?php echo $eghdam_id ?>_<?php echo $fAId ?>_4_3" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][4_3]" value="<?php echo $vFGroup['manager4_3'] ?>">
                                                                            <?php else : ?>
                                                                                <?php echo $vFGroup['manager4_3'] ?>
                                                                            <?php endif; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max4'], 0, 5) ?><br>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <input class="w100" name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][max_manager4]" value="<?php echo $vFGroup['max_manager4'] ?>">
                                                                                <?php else : ?>
                                                                                    <?php echo $vFGroup['max_manager4'] ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>: <?php echo substr($vFGroup['max4'], 0, 5) ?><br>
                                                                                <span>مدیر</span>: <?php echo substr($vFGroup['max_manager4'], 0, 5) ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>

                                                                    <td class="word-wrap">
                                                                        <?php if ($admin_info['parent_id'] == 0) : ?>
                                                                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                                                                <span>ارزیاب</span>: <?php if ($vFGroup['tahlil4'] != '') : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil4']) ?>
                                                                                <?php endif; ?>
                                                                                <span>مدیر</span>:
                                                                                <?php if ($vFGroup['group_status'] < 7 && $vFGroup['group_status'] > 4) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil_manager4]"><?php echo $vFGroup['tahlil_manager4'] ?></textarea>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager4']) ?>
                                                                                <?php endif; ?>

                                                                            <?php else : ?>
                                                                                <span>ارزیاب</span>:
                                                                                <?php if ($vFGroup['group_status'] < 5 && $list['editable'] == 1) : ?>
                                                                                    <textarea name="manager_group[<?php echo $FGId ?>][<?php echo $faaliat_id ?>][tahlil4]"><?php echo $vFGroup['tahlil4'] ?></textarea>
                                                                                <?php else : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil4']) ?>
                                                                                <?php endif; ?>

                                                                                <span>مدیر</span>: <?php if ($vFGroup['tahlil_manager4'] != '') : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager4']) ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <?php if ($vFGroup['group_status4'] == 7) : ?>
                                                                                <?php if ($vFGroup['tahlil_manager4'] != '') : ?>
                                                                                    <?php echo readMore($vFGroup['tahlil_manager4']) ?><?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                    </td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>


                            </div>
                        </div>
                        <?php if ($admin_info['parent_id'] == 0 && $list['editable'] == 1 && $vFGroup['group_status'] < 7 || $admin_info['admin_id'] == 1 && $vFGroup['group_status'] >= 5 && $vFGroup['group_status'] < 7) : ?>
                            <!--                        --><?/* if($admin_info['admin_id']==1 || $vFGroup['group_status'] >= 5): */ ?>
                            <button name="submit" class="btn  btn-primary fixed pull-right" style="font-size: 20px">ثبت موقت</button>
                            <input name="submit2" type="submit" class="btn  btn-info pull-left" style="font-size: 20px; margin-right: 50px" onclick="return confirm('جهت ثبت نهایی مطمئن هستید؟')" value="ثبت نهایی" />
                            <?php if ($admin_info['admin_id'] == 1) : ?>
                                <button name="submit1" class="btn  btn-warning fixed pull-left" style="font-size: 20px; ">ثبت اولیه</button>
                            <?php endif; ?>

                        <?php endif; ?>
                        <!--                        --><?/* endif;*/ ?>
    </form>


</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تحلیل</h4>
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
    $(document).ready(function() {
        $('.readMore').click(function(e) {
            e.preventDefault();
            $('myModal').modal('hide');

            var text = $(this).data("text");
            //alert(text);
            $('#myModal .modal-body').html("<p>" + nl2br(text) + "</p>");
            $('#myModal').modal('show');
        })
    });

    function nl2br(str, replaceMode, isXhtml) {

        var breakTag = (isXhtml) ? '<br />' : '<br>';
        var replaceStr = (replaceMode) ? '$1' + breakTag : '$1' + breakTag + '$2';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
    }
</script>