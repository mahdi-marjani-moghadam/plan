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
    <li><a class="rtl text-24">لیست محصولات<i class="sidebar-icon fa fa-info"></i></a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">

  <div id="panel-tablesorter" class="panel panel-warning">
    <div class="panel-heading bg-white">
      <h3 class="panel-title rtl">محصولات</h3>
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
          <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal form-bordered"  novalidate="novalidate" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title_fa">عنوان(فارسی):</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="title_fa" id="title_fa"  placeholder=" عنوان" required value="<?=$list['title_fa']?>">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="brif_description_fa">توضیحات مختصر(فارسی):</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="brif_description_fa" id="brif_description_fa"  placeholder="brif_description_fa" required value="<?=$list['brif_description_fa']?>">
                  </div>
                </div>
              </div>
            </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                          <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title_fa">عنوان(انگلیسی):</label>
                          <div class="col-xs-12 col-sm-8 pull-right">
                              <input type="text" class="form-control" name="title_en" id="title_en"  placeholder=" عنوان" required value="<?=$list['title_en']?>">
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                          <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="brif_description_en">توضیحات مختصر(انگلیسی):</label>
                          <div class="col-xs-12 col-sm-8 pull-right">
                              <input type="text" class="form-control" name="brif_description_en" id="brif_description_en"  placeholder="brif_description_en" required value="<?=$list['brif_description_en']?>">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="description_fa">توضیحات(فارسی):</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                    <textarea name="description_fa" class="form-control"
                    id="description_fa" placeholder="توضیحات" required="required"><?=$list['description_fa']?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="description_en">توضیحات(انگلیسی):</label>
                    <div class="col-xs-12 col-sm-8 pull-right">
                    <textarea name="description_en" class="form-control"
                              id="description_en" placeholder="توضیحات" required="required"><?=$list['description_en']?></textarea>
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
                        <input type="file" name="image">
                        <img class="img-thumbnail" src="<?=RELA_DIR?>statics/files/<?=$list['artists_id']?>/<?=$list['image']?>">

                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">فایل:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="file" name="file">
                      <? if($list['file_type']  == 'image' ):?>
                          <img class="img-thumbnail" src="<?=RELA_DIR?>statics/files/<?=$list['artists_id']?>/<?=$list['file']?>"/>
                      <? endif;?>
                      <? if ($list['file_type']  == 'video'):?>
                          <video controls width="100%"  >
                              <source src="<?=RELA_DIR?>statics/files/<?=$list['artists_id']?>/<?=$list['file']?>" type="video/<?=$list['extension']?>"" />

                          </video>
                      <? endif;?>
                      <? if ($list['file_type']  == 'audio'):?>
                          <audio controls>
                              <source src="<?=RELA_DIR?>statics/files/<?=$list['artists_id']?>/<?=$list['file']?>" type="audio/<?=$list['extension']?>">
                              Your browser does not support the audio element.
                          </audio>
                      <? endif;?>

                  </div>
                </div>
              </div>

            </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                          <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="category_id">category_id:</label>
                          <div class="col-xs-12 col-sm-8 pull-right">
                              <select name="category_id[]" data-input="select2" placeholder="Multiple select" multiple>
                                  <?
                                  foreach($list['category'] as $category_id => $value)
                                  {
                                      ?>
                                      <option  <?php echo in_array($value['Category_id'],$list['category_id'] ) ? 'selected' : '' ?> value="<?=$value['Category_id']?>">
                                          <?=$value['export']?>
                                      </option>
                                      <?
                                  }
                                  ?>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                          <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="category_id">وضعیت:</label>
                          <div class="col-xs-12 col-sm-8 pull-right">
                              <select name="status" data-input="select2" placeholder=" select">
                                      <option  <?php echo ($list['status'] == 0 ) ? 'selected' : '' ?> value="0">غیر فعال</option>
                                      <option  <?php echo ($list['status'] == 1 ) ? 'selected' : '' ?> value="1"> فعال</option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
            <div class="row xsmallSpace hidden-xs"></div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="creation_date">تاریخ تولید:</label>
                        <div class="col-xs-12 col-sm-8 pull-right">
                            <input type="text" class="form-control date" name="creation_date" id="creation_date"  placeholder="" required value="<?=convertDate($list['creation_date'])?>">
                        </div>
                    </div>
                </div>
              <div class="col-md-12">
                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="edit" />
                    <input name="Artists_products_id" type="hidden" id="artists_id" value="<?=$list['Artists_products_id']?>" />
                  <button type="submit" name="submit" id="submit" class="btn btn-icon btn-success rtl">
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
