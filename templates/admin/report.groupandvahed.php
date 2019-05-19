<script>
    $(document).ready(function () {
        /** change season event */
        $('#season').change(function () {
            var season = $(this).val();

            location.href = window.location.origin + '/admin/?component=chart&action=' + <?=$_GET['action']?> + '&s=' + season <?=(isset($_GET['r']))?"+'&r=".$_GET['r']."'":'';?>;
        });

        /** change result event */
        $('#result').change(function () {
            var result = $(this).val();

            location.href = window.location.origin + '/admin/?component=chart&action=' + <?=$_GET['action']?> + '&r=' + result <?=(isset($_GET['s']))?"+'&s=".$_GET['s']."'":'';?>;
        });




    });
</script>
<!--suppress ALL -->




<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">


<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> وضعیت پیشرفت</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label for="season">دوره ارزیابی:</label>
                <select name="season" id="season" >
                    <option value="1" <?=($_GET['s'] == '1')?'selected':'';?>>سه ماهه</option>
                    <option value="2" <?=($_GET['s'] == '2')?'selected':'';?>>شش ماهه</option>
                    <option value="3" <?=($_GET['s'] == '3')?'selected':'';?>>نه ماهه</option>
                    <option value="4" <?=($_GET['s'] == '4')?'selected':'';?>>یکساله</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12" >
                <label for="result">دوره :</label>
                <select name="season" id="result" >
                    <option value="1" <?=($_GET['r'] == '1')?'selected':'';?>> همه</option>
                    <option value="2" <?=($_GET['r'] == '2')?'selected':'';?>> نهایی (تایید شده)</option>
                    <option value="3" <?=($_GET['r'] == '3')?'selected':'';?>>خود اظهاری</option>
                </select>
            </div>
            <div class="col-md-1 pull-left">
                <input type='button' class="btn btn-default btn-block pull-left" style="" id='btn' value='Print' onclick='printDiv();'>
                <style>
                    @media print{
                        table{direction: rtl;
                            float: right;}
                        td{
                            float: right;}
                    }
                </style>
                <script>
                    function printDiv()
                    {
                        var html ='';
                        <? foreach ($charts as $k =>$chart):?>
                            var divToPrint<?=$k?> = document.getElementById('panel-<?=$k?>');
                            html += divToPrint<?=$k?>.innerHTML+"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                        <? endforeach; ?>


                        var newWin=window.open('','Print-Window');

                        newWin.document.open();

                        newWin.document.write('<html><body dir="rtl"  onload="window.print()"><style>td{font-family: Tahoma; font-size: 11px; padding: 5px}  table tr:nth-child(even){background: #f4f4f4}</style>'+ html +'</body></html>');

                        newWin.document.close();

                        setTimeout(function(){newWin.close();},10);

                    }
                </script>
            </div>
    </div>

    <div class="clearfix"><br></div>

    <script src="<?=TEMPLATE_DIR?>assets/js/highstock.js"></script>
    <script src="<?=TEMPLATE_DIR?>assets/js/exporting.js"></script>
    <script src="<?=TEMPLATE_DIR?>assets/js/export-data.js"></script>
    <script src="<?=TEMPLATE_DIR?>assets/js/pattern-fill.js"></script>




    <div class="row">
    <? foreach ($charts as $k =>$chart):?>
        <div class="col-md-12">
            <div id="panel-<?=$k?>" class="panel panel-default border-green ">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "><?=$chart['name']?></h3>
            <div class="panel-actions">
                <button data-expand="#panel-<?=$k?>" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-<?=$k?>" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">

            <div id="container<?=$k?>" style="overflow:visible; "></div>

            <script>
                Highcharts.chart('container<?=$k?>', {

                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'نمودار پیشرفت'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: <?=$chart['categories']?>,
                        //crosshair: true,
                        reversed: true
                    },
                    yAxis: {
                        min: 0,
                        max:100,
                        title: {
                            text: 'درصد'
                        },
                        opposite: true
                    },
                    legend: {
                        reversed: true,
                        useHTML: Highcharts.hasBidiBug
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 1
                        }
                    },
                    rtl:true,
                    exporting:{
                        enabled: true,
                        chartOptions: { // specific options for the exported image
                            plotOptions: {
                                series: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            yAxis: {
                                scrollbar: {
                                    enabled: false
                                }
                            },
                            xAxis: {
                                labels: {
                                    style: {
                                        fontSize: '15px'
                                    }
                                }
                            }
                        },
                        scale: 2
                    },

                    series:  <?=$chart['series']?>


                });
            </script>
        </div>
    </div>
        </div>

    <? endforeach;?>



</div>
</div>

