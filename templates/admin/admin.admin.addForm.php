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

    document.getElementById( 'padmin' ).style.display = "";
    // It is not  to return any value.
    // When false is returned, CKFinder will not close automatically.
    return false;
  }
</script>
<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
      <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> افزودن راهکار جدید</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">

  <div id="panel-tablesorter" class="panel panel-warning">
    <div class="panel-heading bg-white">
      <h3 class="panel-title rtl">فرم کاربر</h3>
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
          <form name="queue" id="queue" role="form" data-validate="form"  enctype="multipart/form-data" class="form-horizontal form-bordered"  novalidate="novalidate" method="post">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="title" id="title"   value="<?=$list['title']?>">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="email">ایمیل:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="email"  id="email"  value="<?=$list['email']?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-4 pull-right control-label rtl"
                               for="description">متن کاربر :</label>
                        <div class="col-xs-12 col-sm-10 col-md-8 pull-right">

                            <?php

                            include_once ROOT_DIR.'common/ckeditor/ckeditor.php';
                            include_once ROOT_DIR.'common/ckfinder/ckfinder.php';
                            $ckeditor = new CKEditor();
                            $ckeditor->basePath = RELA_DIR.'common/ckeditor/';




                            $config['language'] = 'fa';
                            $config['filebrowserBrowseUrl'] = RELA_DIR.'common/ckfinder/ckfinder.html';
                            $config['filebrowserImageBrowseUrl'] = RELA_DIR.'common/ckfinder/ckfinder.html?type=Images';
                            $config['filebrowserUploadUrl'] = RELA_DIR.'common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
                            $config['filebrowserImageUploadUrl'] = RELA_DIR.'common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

                            $tt = $ckeditor->editor('description',$list['description'],$config);

                            echo $tt;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">فایل:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="file" name="file">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="priority">وضعیت :</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="status" id="status"   value="<?=$list['status']?>">
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <p class="pull-right">
                  <button type="submit"  class="btn btn-icon btn-success rtl">
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







