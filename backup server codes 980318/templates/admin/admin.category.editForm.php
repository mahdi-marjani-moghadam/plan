<script type="text/javascript" src="../common/ckfinder/ckfinder.js"></script>
<script type="text/javascript">

    function BrowseServer( startupPath, functionData )
    {
        var finder = new CKFinder();
        finder.basePath = '../';
        finder.startupPath = startupPath;
        finder.selectActionFunction = SetFileField;
        finder.selectActionData = functionData;

        finder.popup();
    }

    function SetFileField( fileUrl, data )
    {
        document.getElementById( data["selectActionData"] ).value = fileUrl;
    }
    function ShowThumbnails( fileUrl, data )
    {
        // this = CKFinderAPI

        var sFileName = this.getSelectedFile().name;
        document.getElementById( 'thumbnails' ).innerHTML +=
            '<div class="thumb">' +
            '<img src="' + fileUrl + '" />' +
            '<div class="caption">' +
            '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
            '</div>' +
            '</div>';

        document.getElementById( 'preview' ).style.display = "";
        // It is not required to return any value.
        // When false is returned, CKFinder will not close automatically.
        return false;
    }
</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i>  ویرایش دسته بندی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">

  <div id="panel-tablesorter" class="panel panel-warning">
    <div class="panel-heading bg-white">
      <h3 class="panel-title rtl">جزییات دسته بندی</h3>
      <div class="panel-actions">
        <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
          <i class="fa fa-expand"></i>
        </button>
        <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
          <i class="fa fa-caret-down"></i>
        </button>
      </div><!-- /panel-actions -->
    </div><!-- /panel-heading -->

    <?php if($msg!=null)
    {
    ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
    <?= $msg ?>
      </div>
    <?php
    }
    ?>
    <div class="panel-body">

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8  center-block">
          <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal form-bordered" autocomplete="off" novalidate="novalidate" method="post">

            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title_fa">عنوان(فارسی):</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="title_fa" id="title_fa" autocomplete="off" required value="<?=$list['title_fa']?>">
                  </div>
                </div>
              </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title_en">عنوان(انگلیسی):</label>
                        <div class="col-xs-12 col-sm-8 pull-right">
                            <input type="text" class="form-control" name="title_en" id="title_en" autocomplete="off" required value="<?=$list['title_en']?>">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="parent_id">دسته بندی والد:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                   <select class="valid" name="parent_id" id="parent_id">
                    <?
                    foreach($list['category_list'] as $category_id => $value)
                    {
                    ?>
                      <option <?php echo $value['Category_id'] == $list['parent_id'] ? 'selected' : '' ?> value="<?=$value['Category_id']?>">
                    <?=$value['export']?>
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
            <div class="row" style="display: none">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">تصویر:</label>
                        <div class="col-xs-12 col-sm-8 pull-right">
                            <div class="input-group" dir="ltr">
                              <input name="img_name" type="text" class="form-control" id="xImagePath" value="<?=$list['img_name'];?>" />
                              <span class="input-group-btn">
                                <input class="btn  btn-info" type="button" value="انتخاب فایل" onclick="BrowseServer( 'Images:/', 'xImagePath' );" />
                              </span>
                            </div>
                            <div id="preview" style="display:none">
                                <strong>Selected Thumbnails</strong><br/>
                                <div id="thumbnails"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="sort">ترتیب:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="sort" id="sort" autocomplete="off"  required value="<?=$list['sort']?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_keyword">کلمات کلیدی:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <textarea name="meta_keyword" class="form-control fullFix" id="meta_keyword" autocomplete="off" ><?=$list['meta_keyword'];?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6"></div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_description">توضیحات کلیدی:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <textarea name="meta_description" class="form-control fullFix" id="meta_description" autocomplete="off" placeholder="meta_description" ><?=$list['meta_description']?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6"></div>
            </div>
            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="row">
              <div class="col-md-12">
                <p class="pull-right margin-right">
                 <input name="action" type="hidden" id="action" value="edit" />
                 <input name="Category_id" type="hidden" id="Category_id" value="<?=$list['Category_id']?>" />

                  <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                    <i class="fa fa-plus"></i>
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
