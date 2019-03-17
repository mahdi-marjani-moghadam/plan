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


    <script src="<?=RELA_DIR?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/highcharts.js"></script>
    <script src="<?=RELA_DIR?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/pattern-fill.js"></script>


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



            <div id="container<?=$k?>" style="  margin: 0 auto"></div>

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
                        crosshair: true,
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

                    series:  <?=$chart['series']?>


                });
            </script>
        </div>
    </div>
        </div>

    <? endforeach;?>



</div>

