<script>
    $(document).ready(function () {

        var baseUrl = window.location.origin + '/admin/?component=talfigh&m=chart';
        var qq = '<?php echo (isset($_GET['qq'])) ? '&qq=' . $_GET['qq'] : ''; ?>';
        var r = '<?php echo (isset($_GET['r'])) ? '&r=' . $_GET['r'] : ''; ?>';
        var s = '<?php echo (isset($_GET['s'])) ? '&s=' . $_GET['s'] : ''; ?>';
        var chart = '<?php echo (isset($_GET['chart'])) ? '&chart=' . $_GET['chart'] : ''; ?>';


        /** change season event */
        $('#season').change(function () {
            var season = $(this).val();

            location.href = baseUrl + '&s=' + season + r + chart + qq;
        });

        /** change result event */
        $('#result').change(function () {
            var result = $(this).val();

            location.href = baseUrl + '&r=' + result + s + chart + qq;
        });

        /** change result event */
        $('#chart').change(function () {
            var chart2 = $(this).val();

            location.href = baseUrl + '&chart=' + chart2 + r + s + qq;
        });

        /** change admin event */
        $('#admin').change(function () {

            var adminId = ',' + $(this).val() + ',';
            if ($(this).val() == 0) {
                location.href = baseUrl + s + r;
            } else {
                location.href = baseUrl + '&qq=' + adminId + s + r + chart;
            }
        });


    });
</script>
<!--suppress ALL -->


<!-- <link rel="stylesheet" href="< ?php echo RELA_DIR; ?>templates/< ?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css"> -->


<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>وضعیت پیشرفت</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <div class="row" >
        <div class="col-md-2 col-sm-6 col-xs-12"  style="display:">
            <label for="season">دوره ارزیابی:</label>
            <select name="season" id="season">
                <option value="2" <?php echo ($_GET['s'] == '2' ) ? 'selected' : ''; ?>>شش ماهه</option>
                <option value="4" <?php echo ($_GET['s'] == '4'  || (STEP_FORM1 == 4 && !isset($_GET['s']))) ? 'selected' : ''; ?>>یکساله</option>
            </select>
        </div>
        <?php if ($admin_info['groups'] == 0 || $admin_info['groups'] == 100 || $admin_info['admin_id'] == 4000) : ?>
        <div class="col-md-2 col-sm-6 col-xs-12 " style="display:">
            <label for="chart">نوع نمودار :</label>
            <select name="chart" id="chart">

                <option value="1" <?php echo ($_GET['chart'] == '1') ? 'selected' : ''; ?>>نمودار عملکرد کل پايش</option>
                <option value="2" <?php echo ($_GET['chart'] == '2') ? 'selected' : ''; ?>>  نمودار تلفيق پايش و ارزيابي</option>
            </select>
        </div>
        <?php endif; ?>

        <?php if ($admin_info['groups'] == 0 || $admin_info['groups'] == 100 || $admin_info['admin_id'] == 4000) : ?>

            <div class="col-md-2 col-sm-6 col-xs-12" style="display:">
                <label for="admin">واحد :</label>
                <select id="admin">
                    <option value="0">انتخاب کنید</option>
                    <?php if($_GET['chart']== 1):?>

                    <?php foreach ($reportChartTalfigh['showAdmin'] as $k => $admins) : ?>
                    <option <?php if (strpos($_GET['qq'], ',' . $admins['admin_id'] . ',') !== false) {
                            echo 'selected';
                        } ?> value="<?php echo $admins['admin_id'] ?>"><?php echo $admins['name'] . ' ' . $admins['family'] ?></option>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <option <?php if (strpos($_GET['qq'], ',110,') !== false) {
                        echo 'selected';
                    } ?> value="110">                    کل واحد ادبیات
                    </option>
                        <option <?php if (strpos($_GET['qq'], ',111,') !== false) {
                            echo 'selected';
                        } ?> value="111">                    کل واحد الهیات
                        </option>
                    <?php endif ?>


                </select>


            </div>
        <?php endif; ?>

    </div>

    <div class="clearfix"><br></div>

    <?php if($_GET['chart'] == 2):?>
        <script src="<?php echo TEMPLATE_DIR ?>assets/js/highstock.js"></script>
     <script src="<?php echo TEMPLATE_DIR ?>assets/js/exporting.js"></script>
     <script src="<?php echo TEMPLATE_DIR ?>assets/js/export-data.js"></script>
        <script src="<?php echo TEMPLATE_DIR ?>assets/js/pattern-fill.js"></script>
    <?php endif;?>

    <div class="row">
        <?php

        foreach ($charts as $k => $chart) : ?>

            <div class="col-md-12">
                <div id="panel-<?php echo $k ?>" class="panel panel-default border-green ">
                    <div class="panel-heading bg-green">
                        <h3 class="panel-title rtl "><?php echo $chart['name'] ?></h3>
                        <div class="panel-actions">
                            <button data-expand="#panel-<?php echo $k ?>" title="نمایش" class="btn-panel"><i
                                        class="fa fa-expand"></i></button>
                            <button data-collapse="#panel-<?php echo $k ?>" title="بازکردن" class="btn-panel"><i
                                        class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>

                    <div class="panel-body">

                        <?php if($_GET['chart'] == 2):?>

                        <div id="container<?php echo $k ?>" style="overflow:visible; "></div>

                        <script> //ORGINAL
                            Highcharts.chart('container<?php echo $k ?>', {

                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: ''
                                },
                                subtitle: {
                                    text: ''
                                },

                                xAxis: {
                                    categories: <?php echo $chart['categories'] ?>,
                                    //crosshair: true,
                                    reversed: true,
                                    labels: {
                                        x: 20,
                                        y: 20,
                                        position3d: "flap",
                                        rotation: -20,
                                        align: 'left',
                                        style: {
                                            "direction": "rtl"

                                        }
                                    }
                                },
                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    title: {
                                        text: 'درصد'
                                    },
                                    opposite: true
                                },
                                 scrollbar: {
                                     enabled: true
                                 },
                                legend: {
                                    reversed: true,
                                    useHTML: Highcharts.hasBidiBug
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:.2f} </b></td></tr>',
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
                                rtl: true,
                                exporting: {
                                    enabled: true,
                                    chartOptions: { // specific options for the exported image
                                        plotOptions: {
                                            series: {
                                                dataLabels: {
                                                    enabled: true,

                                                }
                                            }

                                        },
                                        yAxis: {
                                            labels: {
                                                style: {
                                                    fontSize: '5px'
                                                }
                                            },
                                            scrollbar: {
                                                enabled: false
                                            }
                                        },

                                    },
                                    scale: 2
                                },

                                series: <?php echo $chart['series']?>


                            });
                        </script>



                        <?php endif;?>
                        <?php if($_GET['chart'] == 1 || !isset($_GET['chart'])):?>
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/highcharts-more.js"></script>
                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                        <script src="https://code.highcharts.com/modules/export-data.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>


                        <div class="row">
                            <div class="col-md-6">
                                <figure class="highcharts-figure">
                                    <div id="container10"></div>
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <figure class="highcharts-figure">
                                    <div id="container12"></div>
                                </figure>
                            </div>
                        </div>

                        <style>
                            .highcharts-figure,
                            .highcharts-data-table table {
                                min-width: 310px;
                                max-width: 500px;
                                margin: 1em auto;
                            }

                            .highcharts-data-table table {
                                font-family: Verdana, sans-serif;
                                border-collapse: collapse;
                                border: 1px solid #ebebeb;
                                margin: 10px auto;
                                text-align: center;
                                width: 100%;
                                max-width: 500px;
                            }

                            .highcharts-data-table caption {
                                padding: 1em 0;
                                font-size: 1.2em;
                                color: #555;
                            }

                            .highcharts-data-table th {
                                font-weight: 600;
                                padding: 0.5em;
                            }

                            .highcharts-data-table td,
                            .highcharts-data-table th,
                            .highcharts-data-table caption {
                                padding: 0.5em;
                            }

                            .highcharts-data-table thead tr,
                            .highcharts-data-table tr:nth-child(even) {
                                background: #f8f8f8;
                            }

                            .highcharts-data-table tr:hover {
                                background: #f1f7ff;
                            }
                        </style>
                        <script> //NEEEEEEEWWWWW GGGGague
                            Highcharts.chart('container10', {

                                chart: {
                                    type: 'gauge',
                                    plotBackgroundColor: null,
                                    plotBackgroundImage: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false,
                                    height: '80%'
                                },

                                title: {
                                    text: 'اعلامی واحد'
                                },

                                pane: {
                                    startAngle: -90,
                                    endAngle: 89.9,
                                    background: null,
                                    center: ['50%', '75%'],
                                    size: '110%'
                                },

                                // the value axis
                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    tickPixelInterval: 72,
                                    tickPosition: 'inside',
                                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                                    tickLength: 20,
                                    tickWidth: 2,
                                    minorTickInterval: null,
                                    labels: {
                                        distance: 20,
                                        style: {
                                            fontSize: '14px'
                                        }
                                    },
                                    plotBands: [{
                                        from: 0,
                                        to: 50,
                                        color: '#DF5353', // red
                                        thickness: 20
                                    }, {
                                        from: 50,
                                        to: 75,
                                        color: '#DDDF0D', // yellow
                                        thickness: 20
                                    }, {
                                        from: 75,
                                        to: 100,
                                        color: '#55BF3B', // green
                                        thickness: 20
                                    }]
                                },

                                series: [{
                                    name: 'میزان پیشرفت',
                                    data: [<?php echo $reportChartTalfigh['khodezhari']?>], // data
                                    tooltip: {
                                        valueSuffix: ''
                                    },
                                    dataLabels: {
                                        format: '{y} میزان پیشرفت',
                                        borderWidth: 0,
                                        color: (
                                            Highcharts.defaultOptions.title &&
                                            Highcharts.defaultOptions.title.style &&
                                            Highcharts.defaultOptions.title.style.color
                                        ) || '#333333',
                                        style: {
                                            fontSize: '16px'
                                        }
                                    },
                                    dial: {
                                        radius: '80%',
                                        backgroundColor: 'gray',
                                        baseWidth: 12,
                                        baseLength: '0%',
                                        rearLength: '0%'
                                    },
                                    pivot: {
                                        backgroundColor: 'gray',
                                        radius: 6
                                    }

                                }]

                            });

                            Highcharts.chart('container12', {

                                chart: {
                                    type: 'gauge',
                                    plotBackgroundColor: null,
                                    plotBackgroundImage: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false,
                                    height: '80%'
                                },

                                title: {
                                    text: 'نهایی واحد'
                                },

                                pane: {
                                    startAngle: -90,
                                    endAngle: 89.9,
                                    background: null,
                                    center: ['50%', '75%'],
                                    size: '110%'
                                },

                                // the value axis
                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    tickPixelInterval: 72,
                                    tickPosition: 'inside',
                                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                                    tickLength: 20,
                                    tickWidth: 2,
                                    minorTickInterval: null,
                                    labels: {
                                        distance: 20,
                                        style: {
                                            fontSize: '14px'
                                        }
                                    },
                                    plotBands: [{
                                        from: 0,
                                        to: 50,
                                        color: '#DF5353', // red
                                        thickness: 20
                                    }, {
                                        from: 50,
                                        to: 75,
                                        color: '#DDDF0D', // yellow
                                        thickness: 20
                                    }, {
                                        from: 75,
                                        to: 100,
                                        color: '#55BF3B', // green
                                        thickness: 20
                                    }]
                                },

                                series: [{
                                    name: 'میزان پیشرفت',
                                    data: [<?php echo $reportChartTalfigh['nahayi']?>],
                                    tooltip: {
                                        valueSuffix: ''
                                    },
                                    dataLabels: {
                                        format: '{y} میزان پیشرفت',
                                        borderWidth: 0,
                                        color: (
                                            Highcharts.defaultOptions.title &&
                                            Highcharts.defaultOptions.title.style &&
                                            Highcharts.defaultOptions.title.style.color
                                        ) || '#333333',
                                        style: {
                                            fontSize: '16px'
                                        }
                                    },
                                    dial: {
                                        radius: '80%',
                                        backgroundColor: 'gray',
                                        baseWidth: 12,
                                        baseLength: '0%',
                                        rearLength: '0%'
                                    },
                                    pivot: {
                                        backgroundColor: 'gray',
                                        radius: 6
                                    }

                                }]

                            });


                        </script>

                        <?php endif;?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <!--<div class="col-md-12">
            <div id="panel-ss" class="panel panel-default border-green ">
                <div class="panel-body">
                    <?php /*foreach ($kalan as $v) : */?>
                        <div class="col-md-4 ">

                            <?php /*$d = 50 * 180 / 100; */?>
                            <h3 style="text-align:center"><?php /*echo $v */?></h3>
                            <div class="col-md-6 ">

                                <div class="gauge"
                                     style="margin:2em; width: 150px; --rotation:<?php /*echo $d */?>deg; --color:#f15c80; --background:#e9ecef;">
                                    <div class="percentage"></div>
                                    <div class="mask"></div>
                                    <span class="value">46% ارزیابی</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="gauge"
                                     style="margin:2em; width: 150px; --rotation:<?php /*echo $d */?>deg; --color:#5ce35c; --background:#e9ecef;">
                                    <div class="percentage"></div>
                                    <div class="mask"></div>
                                    <span class="value">46% پایش</span>
                                </div>
                            </div>
                        </div>

                    <?php /*endforeach */?>
                    <style>
                        .gauge {
                            position: relative;
                            border-radius: 50%/100% 100% 0 0;
                            background-color: var(--color, #);
                            overflow: hidden;
                        }

                        .gauge:before {
                            content: "";
                            display: block;
                            padding-top: 50%;
                            /* ratio of 2:1*/
                        }

                        .gauge .chart {
                            overflow: hidden;
                        }

                        .gauge .mask {
                            position: absolute;
                            left: 20%;
                            right: 20%;
                            bottom: 0;
                            top: 40%;
                            background-color: #fff;
                            border-radius: 50%/100% 100% 0 0;
                        }

                        .gauge .percentage {
                            position: absolute;
                            top: -1px;
                            left: -1px;
                            bottom: 0;
                            right: -1px;
                            background-color: var(--background, #aaa);
                            transform: rotate(var(--rotation));
                            transform-origin: bottom center;
                            transition-duration: 600;
                        }

                        .gauge:hover {
                            --rotation: 100deg;
                        }

                        .gauge .value {
                            position: absolute;
                            bottom: 0%;
                            left: 0;
                            width: 100%;
                            text-align: center;
                        }

                        .gauge .min {
                            position: absolute;
                            bottom: 0;
                            left: 5%;
                        }

                        .gauge .max {
                            position: absolute;
                            bottom: 0;
                            right: 5%;
                        }
                    </style>


                </div>
            </div>
        </div>-->


    </div>
</div>