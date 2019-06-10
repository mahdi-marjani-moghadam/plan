<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>ویرایش محصول</h2>
    </div><!--/content-header -->

    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">ویرایش محصول</h3>
                <div class="panel-actions">
                    <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="???">
                        <i class="fa fa-expand"></i>
                    </button>
                    <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="????">
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div><!-- /panel-actions -->
            </div><!-- /panel-heading -->
            <?php if($msg!=null)
            { ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                    <?= $msg ?>
                </div>
            <?php
            }
            ?>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                        <form name="announce" id="announce" role="form" data-validate="form" class="form-horizontal form-bordered" autocomplete="off" novalidate="novalidate" method="post">
                            <input name="product_id" id=id type="hidden" value="<?=$list['product_id']?>"/>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="name">نام محصول</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="name" id="name" value="<?=$list['name']?>" autocomplete="off" placeholder="Announce Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="ManagerName">قیمت :</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                          <input type="text" class="form-control" name="price" id="price" autocomplete="off" placeholder="قیمت" value="<?=$list['price'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="address">واحد شمارش:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="unit" id="unit" autocomplete="off" placeholder="واحد شمارش" value="<?=$list['unit'];?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Email">متراژ موجود در هر واحد:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="unit_count" id="unit_count" autocomplete="off" placeholder="متر" value="<?=$list['unit_count'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                               for="priority">اولویت:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select name="priority" id="priority">
                                                <option
                                                    value="1" <?= ($list['priority'] == '1') ? 'selected="selected"' : ''; ?>>1
                                                </option>
                                                <option
                                                    value="0" <?= ($list['priority'] == '0') ? 'selected="selected"' : ''; ?>>0
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right"><input type="hidden"  name="action" id="action" value="update">
                                        <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                            <i class="fa fa-plus"></i>
                                            ویرایش
                                        </button>
                                    </p>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/content -->
