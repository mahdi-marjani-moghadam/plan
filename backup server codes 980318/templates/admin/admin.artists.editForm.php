<script type="text/javascript" src="../common/ckfinder/ckfinder.js"></script>
<script type="text/javascript">

    function BrowseServer(startupPath, functionData) {
        var finder = new CKFinder();
        finder.basePath = '../';
        finder.startupPath = startupPath;
        finder.selectActionFunction = SetFileField;
        finder.selectActionData = functionData;

        finder.popup();
    }

    function SetFileField(fileUrl, data) {
        document.getElementById(data["selectActionData"]).value = fileUrl;
    }
    function ShowThumbnails(fileUrl, data) {
        // this = CKFinderAPI

        var sFileName = this.getSelectedFile().name;
        document.getElementById('thumbnails').innerHTML +=
            '<div class="thumb">' +
            '<img src="' + fileUrl + '" />' +
            '<div class="caption">' +
            '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
            '</div>' +
            '</div>';

        document.getElementById('preview').style.display = "";
        // It is not required to return any value.
        // When false is returned, CKFinder will not close automatically.
        return false;
    }
</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش هنرمند</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">جزییات</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl"
                        data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?php if($msg != null)
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
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal form-bordered"
                          novalidate="novalidate" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="nickname">nickname:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="nickname" id="nickname"  value="<?= $list['nickname'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="artists_name_fa">نام هنرمند(فارسی):</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="artists_name_fa" id="artists_name_fa"  value="<?= $list['artists_name_fa'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="description_fa">توضیحات(فارسی):</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="description_fa" id="description_fa"  value="<?= $list['description_fa'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="artists_name_en">نام هنرمند(انگلیسی):</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="artists_name_en" id="artists_name_en"  value="<?= $list['artists_name_en'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="description_en">توضیحات(انگلیسی):</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="description_en" id="description_en"  value="<?= $list['description_en'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="artists_phone1">تلفن:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="artists_phone1" id="artists_phone1"  value="<?= $list['artists_phone1'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="email">ایمیل:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="email" id="email"  value="<?= $list['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="birthday">تاریخ تولد:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control date" name="birthday" id="birthday" value="<?= convertDate($list['birthday']) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="category_id">انتخاب دسته بندی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="category_id[]" id="category_id" data-input="select2" multiple>
                                            <?
                                            foreach($list['category'] as $category_id => $value)
                                            {
                                                ?>
                                                <option <?php echo in_array($value['Category_id'], $list['category_id']) ? 'selected' : '' ?>
                                                    value="<?= $value['Category_id'] ?>">
                                                    <?= $value['export'] ?>
                                                </option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <!-- city -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="city_id">انتخاب شهر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">

                                        <select name="city_id" id="city_id" data-input="select2">
                                            <?
                                            foreach($list['cities'] as $city_id => $value)
                                            {
                                                ?>
                                                <option <?= $value['province_id'] == $list['city_id'] ? 'selected' : '' ?>
                                                    value="<?= $value['province_id'] ?>">
                                                    <?= $value['name'] ?>
                                                </option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- state -->

                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="meta_keyword">کلمات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="<?= $list['meta_keyword'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="meta_description">توضیحات متا:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?= $list['meta_description'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="instagram">آدرس instagram:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $list['instagram'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="twitter">آدرس twitter:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?= $list['twitter'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="telegram">آدرس telegram:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="telegram" id="telegram" value="<?= $list['telegram'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="soundcloud">آدرس soundcloud:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="soundcloud" id="soundcloud" value="<?= $list['soundcloud'] ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="facebook">آدرس facebook:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $list['facebook'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="site">آدرس سایت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="site" id="site" value="<?= $list['site'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="status">وضعیت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="status" id="status">
                                            <option
                                                value="1" <?= ($list['status'] == 1) ? 'selected="selected"' : ''; ?>>تایید
                                            </option>
                                            <option value="0" <?= ($list['status'] == 0) ? 'selected="selected"' : ''; ?>>در انتظار تایید
                                            </option>
                                            <option value="-1" <?= ($list['status'] == -1) ? 'selected="selected"' : ''; ?>>تایید نشده
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="refresh_date">تاریخ بروزرسانی</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control date" name="refresh_date" id="refresh_date" value="<?= convertDate($list['refresh_date']) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">تصویر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <div class="input-group" dir="ltr">
                                            <input type="file" class="form-control"name="logo" >
                                        </div>
                                        <img class="img-thumbnail" src="<?=RELA_DIR?>statics/files/<?=$list['Artists_id']?>/<?=$list['logo']?>">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="edit"/>
                                    <input name="Artists_id" type="hidden" id="Artists_id"
                                           value="<?= $list['Artists_id'] ?>"/>
                                    <input name="showStatus" type="hidden" id="Artists_id"
                                           value="<?=$list['showStatus'] ?>"/>

                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl"><i class="fa fa-plus"></i>
                                        ثبت
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
