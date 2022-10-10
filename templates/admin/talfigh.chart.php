<script>
    $(document).ready(function() {

        var baseUrl = window.location.origin + '/admin/?component=chart&menu=arzyabi&action=<?php echo $_GET['action'] ?>';
        var qq = '<?php echo (isset($_GET['qq'])) ? '&qq=' . $_GET['qq']  : ''; ?>';
        var r = '<?php echo (isset($_GET['r'])) ? '&r=' . $_GET['r']  : ''; ?>';
        var s = '<?php echo (isset($_GET['s'])) ? '&s=' . $_GET['s']  : ''; ?>';

        /** change season event */
        $('#season').change(function() {
            var season = $(this).val();

            location.href = baseUrl + '&s=' + season + r + qq;
        });

        /** change result event */
        $('#result').change(function() {
            var result = $(this).val();

            location.href = baseUrl + '&r=' + result + s + qq;
        });

        /** change admin event */
        $('#admin').change(function() {

            var adminId = ',' + $(this).val() + ',';
            if ($(this).val() == 0) {
                location.href = baseUrl + s + r;
            } else {
                location.href = baseUrl + '&qq=' + adminId + s + r;
            }
        });


    });
</script>
<!--suppress ALL -->




<!-- <link rel="stylesheet" href="< ?php echo RELA_DIR; ?>templates/< ?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css"> -->


<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> وضعیت پیشرفت</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <div class="row" style="display:none">
        <div class="col-md-2 col-sm-6 col-xs-12">
            <label for="season">دوره ارزیابی:</label>
            <select name="season" id="season">
                <option value="2" <?php echo ($_GET['s'] == '2') ? 'selected' : ''; ?>>شش ماهه</option>
                <option value="4" <?php echo ($_GET['s'] == '4') ? 'selected' : ''; ?>>یکساله</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <label for="result">اعلامی / نهایی :</label>
            <select name="result" id="result">
                <option value="1" <?php echo ($_GET['r'] == '1') ? 'selected' : ''; ?>> همه</option>
                <option value="2" <?php echo ($_GET['r'] == '2') ? 'selected' : ''; ?>> نهایی (تایید شده)</option>
                <option value="3" <?php echo ($_GET['r'] == '3') ? 'selected' : ''; ?>>خود اظهاری</option>
            </select>
        </div>
        <?php if ($admin_info['parent_id'] == 0) : ?>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label for="admin">واحد :</label>
                <select id="admin">
                    <option value="0">انتخاب کنید</option>
                    <?php foreach ($list['showAdmin'] as $k => $admins) : ?>
                        <option <?php if (strpos($_GET['qq'], ',' . $admins['admin_id'] . ',') !== false) {
                                    echo 'selected';
                                } ?> value="<?php echo $admins['admin_id'] ?>"><?php echo $admins['name'] . ' ' . $admins['family'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

    </div>

    <div class="clearfix"><br></div>

    <script src="<?php echo TEMPLATE_DIR ?>assets/js/highstock.js"></script>
    <!-- <script src="< ?php echo TEMPLATE_DIR ?>assets/js/exporting.js"></script> -->
    <!-- <script src="< ?php echo TEMPLATE_DIR ?>assets/js/export-data.js"></script> -->
    <script src="<?php echo TEMPLATE_DIR ?>assets/js/pattern-fill.js"></script>


    <div class="row">
        <?php

        foreach ($charts as $k => $chart) : ?>

            <div class="col-md-12">
                <div id="panel-<?php echo $k ?>" class="panel panel-default border-green ">
                    <div class="panel-heading bg-green">
                        <h3 class="panel-title rtl "><?php echo $chart['name'] ?></h3>
                        <div class="panel-actions">
                            <button data-expand="#panel-<?php echo $k ?>" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                            <button data-collapse="#panel-<?php echo $k ?>" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div id="container<?php echo $k ?>" style="overflow:visible; "></div>

                        <script>
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
                                /* scrollbar: {
                                     enabled: true
                                 },*/
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

                                series: <?php echo $chart['series'] ?>


                            });
                        </script>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        <div class="col-md-12">
            <div id="panel-ss" class="panel panel-default border-green ">
                <div class="panel-body">
                    <?php foreach ($kalan as $v) : ?>
                        <div class="col-md-3 ">

                            <?php $d  = 50 * 180 / 100; ?>
                            <h3 style="text-align:center"><?php echo $v ?></h3>
                            <div class="col-md-6 "  >

                                <div class="gauge" style="margin:2em; width: 150px; --rotation:<?php echo $d ?>deg; --color:#5cb85c; --background:#e9ecef;">
                                    <div class="percentage"></div>
                                    <div class="mask"></div>
                                    <span class="value">46% ارزیابی</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="gauge" style="margin:2em; width: 150px; --rotation:<?php echo $d ?>deg; --color:#5CE35C; --background:#e9ecef;">
                                    <div class="percentage"></div>
                                    <div class="mask"></div>
                                    <span class="value">46% پایش</span>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                    <style>
                        .gauge {
                            position: relative;
                            border-radius: 50%/100% 100% 0 0;
                            background-color: var(--color, #a22);
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
        </div>




    </div>
</div>