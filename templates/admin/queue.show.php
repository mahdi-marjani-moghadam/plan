

<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {

        var dataTable = $('#example');

        var oTable = dataTable.DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "<?=RELA_DIR?>queue.php?action=search&ajax=1"
        } );

        // Apply the search
        oTable.columns().every( function ()
        {
            var that = this;

            $( 'input', this.footer() ).on('keyup change', function () {
                that.search( this.value ).draw();
            } );
        } );

    } );

</script>
<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>Queue</h2>
    </div><!--/content-header -->
    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">Queue</h3>
                <div class="panel-actions">
                    <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                        <i class="fa fa-expand"></i>
                    </button>
                    <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div><!-- /panel-actions -->
            </div><!-- /panel-heading -->
            <!-- panel-body -->
            <div class="panel-body">

                <?php if($list!=null)
                { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning margin-bottom">
                        <?php
                        if ($list['label']['announce'] != NULL) {
                            echo $list['label']['announce'];
                            foreach ($list['list']['announce'] as $key => $value) {
                                echo '<strong>' . $value['announce_name'] . '</strong>, ';
                            }
                            echo "</br>";
                        }

                        if ($list['label']['announce'] != NULL) {
                            echo $list['label']['inbound'];
                            foreach ($list['list']['inbound'] as $key => $value) {
                                echo '<strong>' . $value['inbound_name'] . '</strong>, ';
                            }
                            echo "</br>";
                        }

                        if ($list['label']['announce'] != NULL) {
                            echo $list['label']['ivr'];
                            foreach ($list['list']['ivr'] as $key => $value) {
                                echo '<strong>' . $value['name'] . '</strong>, ';
                            }
                            echo "</br>";
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
                <!--form-->
                <form method="post" action="<?=RELA_DIR.'queue.php?action=changeStatus';?>" name="action" id="action">
                    <div class="content-body">
                        <div class="pull-right margin-bottom">
                            <!--addsip-->
                            <a href="<?php echo RELA_DIR.'queue.php?action=addQueue'?>" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن</a>
                            <!--active-->
                            <input type="submit" name="active" id="action" class="btn btn-info btn-sm text-13" value="فعال">
                            <!--inactive-->
                            <input type="submit" name="inactive" id="action1" class="btn btn-danger btn-sm  text-13" value="غیرفعال">
                        </div>
                        <div class="row smallSpace"></div>
                        <div class="pull-right margin-left">
                            <label class="pull-right" for="checkAll">انتخاب همه
                                <input type="checkbox" id="checkAll" name="checkAll">
                            </label>
                        </div>

                        <table id="example" class="companyTable table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام</th>
                                <th>شماره</th>
                                <th>رمز</th>
                                <th>Max wait time</th>
                                <th>Agents</th>
                                <th>Position announcement</th>
                                <th>Hold Time announcement</th>
                                <th>فرکانس</th>
                                <th>Recording</th>
                                <th>Ring Strategy</th>
                                <th>DST Option ID</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><input type="text" name="search_10" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_10" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_20" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                                <th><input type="text" name="search_30" value="" class="search_init form-control" /></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row smallSpace"></div>
                </form>
            </div>
            <!--/table-responsive-->
        </div>
    </div>
</div><!--/content -->


