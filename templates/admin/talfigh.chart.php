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



    </div>
</div>