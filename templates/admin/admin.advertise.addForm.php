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
    <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> افزودن تبلیغ جدید</a></li>
  </ul><!--/control-nav-->

</div><!-- /content-control -->
<div class="content-body">
  <div id="panel-tablesorter" class="panel panel-warning">
    <div class="panel-heading bg-white">
      <h3 class="panel-title rtl">فرم تبلیغ</h3>
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
          <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal form-bordered"  novalidate="novalidate" method="post">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="title" id="title"   required value="<?=$list['title']?>">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="brif_description">توضیحات مختصر:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="brif_description" id="brif_description"  required value="<?=$list['brif_description']?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">تصویر :</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <div class="input-group" dir="ltr">

                      <input name="image" type="text" class="form-control" id="xImagePath" value="<?=$list['image'];?>" />
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
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="category_id">شماره دسته بندی:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <select name="category_id[]" id="category_id" data-input="select2"  multiple>
                      <?
                      foreach($list['category'] as $category_id => $value)
                      {
                      ?>
                        <option  <?php echo $value['Category_id'] == $list['category_id'] ? 'selected' : '' ?> value="<?=$value['Category_id']?>">
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
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="url">آدرس اینترنتی:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="url" id="url"   value="<?=$list['url']?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p class="pull-right">
                  <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                    <input name="action" type="hidden" id="action" value="add" />
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







