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
    // It is not  to return any value.
    // When false is returned, CKFinder will not close automatically.
    return false;
  }
</script>
<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
    <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> درخواست تجدید نظر</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<table width="1450" border="34" align="center"><table width="1450" height="34" border="1" align="center">
        <tr>
            <td width="1284" align="right" bgcolor="#990033" style="color: #fff;"> *   تبصره 8: ارزیابی کننده یا ارزیابی شونده در صورت داشتن اعتراض به نتیجه ارزیابی، می بایست فرم ثبت اعتراض تکمیل و به همراه مستندات مربوطه حداکثر 3 روز پس از دریافت کاربرگ شماره 6 از طریق سامانه ارسال نموده تا در کمیته، رسیدگی و اتخاذ
                تصمیم گردد. تصمیمات کیته لازم الاجرا بوده و پس از اعلام به فرد و واحد مربوطه، در پرونده پرسنلی ایشان ثبت میگردد. </td>
        </tr>
<tr><td>
.
    </td></tr>

       <tr> <td width="1284" align="right" bgcolor="#990033" style="color: #fff;">
            صرفا درخواست هایی ترتیب اثر داده می شود که با ذکر شاخصی که نیازمند بازنگری است و ارسال مستندات کامل ثبت شده باشد. و درخواست های تجدیدنظر به امتیاز نهایی بدون ارائه این توضیحات و مستندات بررسی نمی گردند.
           </td> </tr>
        <tr><td>
                .
            </td></tr>
        <tr><td width="1284" align="right"  style="color: red;">
                * توجه به نکات زیر قبل از ثبت درخواست تجدید نظر توصیه می گردد:
            </td></tr>

        <tr><td width="1284" align="right" style="color: red;">
            1. تعیین شاخصی که نیازمند به بررسی مجدد می باشد.
            </td></tr>
            <tr><td width="1284" align="right" style="color: red;">
                2. ارائه مستندات تکمیلی که تحقق کامل شاخص مذکور را نمایان سازد.
                </td>
            </tr>
<tr><td width="1284" align="right" style="color: red;">3.عدم ارسال درخواست تجدیدنظر از طریق سامانه به منزله تائید امتیاز نهایی می باشد.</td></tr>
        <tr><td width="1284" align="right" style="color: red;">4. درخواست هایی که پس از اتمام تاریخ تجدیدنظر ارسال گردد، مورد بررسی قرار نمی گیرد.</td></tr>
             </table>
    <table width="1284" border="" align="center">
        <tr>

<div class="content-body">

  <div id="panel-tablesorter" class="panel panel-warning">
    <div class="panel-heading bg-white">
      <h3 class="panel-title rtl">فرم تجدید نظر</h3>
      <div class="panel-actions">
        <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
          <i class="fa fa-expand"></i>
        </button>
        <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته">
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
                            <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="name">*  نام:</label>
                        <div class="col-xs-12 col-sm-8 pull-right">
                            <input type="text" class="form-control" name="name" id="name"   value="<?=$list['name']?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="family">*  نام خانوادگی:</label>
                        <div class="col-xs-12 col-sm-8 pull-right">
                            <input type="text" class="form-control" name="family" id="family"   value="<?=$list['family']?>" required>
                        </div>
                    </div>
                </div>
<div >.</div>
                <div class="row"></div>
                  <div class="col-xs-12 col-sm-12 col-md-10">
                      <div class="form-group">
                          <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="indicator_NO"> * شاخص نیازمند تجدیدنظر:</label>
                          <div class="col-xs-12 col-sm-8 pull-right">
                              <!--<input type="text" class="form-control" name="subject" id="subject"   value="<?=$list['indicator_NO']?>" required>-->
                              <select name="indicator_NO" id="indicator_NO">
                                  <option value=""> لطفا شماره شاخص مورد نظر را انتخاب کنید </option>
                                  <option <?=($list['indicator_NO'] == 1)?'selected':'';?> value="1">شاخص شماره 1</option>
                                  <option <?=($list['indicator_NO'] == 2)?'selected':'';?> value="2">شاخص شماره 2</option>
                                  <option <?=($list['indicator_NO'] == 3)?'selected':'';?> value="3">شاخص شماره 3</option>
                                  <option <?=($list['indicator_NO'] == 4)?'selected':'';?> value="4">شاخص شماره 4</option>
                                  <option <?=($list['indicator_NO'] == 5)?'selected':'';?> value="5">شاخص شماره 5</option>
                                  <option <?=($list['indicator_NO'] == 6)?'selected':'';?> value="6">شاخص شماره 6</option>
                                  <option <?=($list['indicator_NO'] == 7)?'selected':'';?> value="7">شاخص شماره 7</option>
                                  <option <?=($list['indicator_NO'] == 8)?'selected':'';?> value="8">شاخص شماره 8</option>
                                  <option <?=($list['indicator_NO'] == 9)?'selected':'';?> value="9">شاخص شماره 9</option>
                                  <option <?=($list['indicator_NO'] == 10)?'selected':'';?> value="10">شاخص شماره 10</option>
                                  <option <?=($list['indicator_NO'] == 11)?'selected':'';?> value="11">شاخص شماره 11</option>
                                  <option <?=($list['indicator_NO'] == 12)?'selected':'';?> value="12">شاخص شماره 12</option>
                                  <option <?=($list['indicator_NO'] == 13)?'selected':'';?> value="13">شاخص شماره 13</option>
                                  <option <?=($list['indicator_NO'] == 14)?'selected':'';?> value="14">شاخص شماره 14</option>
                                  <option <?=($list['indicator_NO'] == 15)?'selected':'';?> value="15">شاخص شماره 15</option>
                                  <option <?=($list['indicator_NO'] == 16)?'selected':'';?> value="16">شاخص شماره 16</option>
                                  <option <?=($list['indicator_NO'] == 17)?'selected':'';?> value="17">شاخص شماره 17</option>
                                  <option <?=($list['indicator_NO'] == 18)?'selected':'';?> value="18">شاخص شماره 18</option>
                                  <option <?=($list['indicator_NO'] == 19)?'selected':'';?> value="19">شاخص شماره 19</option>
                                  <option <?=($list['indicator_NO'] == 20)?'selected':'';?> value="20">شاخص شماره 20</option>
                                  <option <?=($list['indicator_NO'] == 21)?'selected':'';?> value="21">شاخص شماره 21</option>
                                  <option <?=($list['indicator_NO'] == 22)?'selected':'';?> value="22">شاخص شماره 22</option>
                                  <option <?=($list['indicator_NO'] == 23)?'selected':'';?> value="23">شاخص شماره 23</option>
                                  <option <?=($list['indicator_NO'] == 24)?'selected':'';?> value="24">شاخص شماره 24</option>
                                  <option <?=($list['indicator_NO'] == 25)?'selected':'';?> value="25">شاخص شماره 25</option>
                                  <option <?=($list['indicator_NO'] == 24)?'selected':'';?> value="26">شاخص شماره 26</option>
                                  <option <?=($list['indicator_NO'] == 25)?'selected':'';?> value="27">شاخص شماره 27</option>
                              </select></td>                             </div>
                      </div>
                  </div>



                      <!--<div class="row"><label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="subject"> </label></div>
                      <div class="row">
                          <div class="row"></div>
                          <div class="col-xs-12 col-sm-12 col-md-7">-->

                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-10">
                              <div >.</div>
                          <div class="form-group">
                                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="current"> * امتیاز فعلی کسب شده در شاخص مورد نظر:</label>
                                  <div class="col-xs-12 col-sm-8 pull-right">
                                      <input type="text" class="form-control" name="current" id="current"   value="<?=$list['current']?>" required>
                                  </div>
                              </div>
                          </div>
                      </div>
              <div >.</div>

              <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-10">
                          <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="new"> * امتیاز مورد انتظار در شاخص مورد نظر:</label>
                  <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="text" class="form-control" name="new" id="new"   value="<?=$list['new']?>" required>
                  </div>
              </div>
        </div>
                      </div>
                  <!--<div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                       <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="email">ایمیل:</label>
                      <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="text" class="form-control" name="email"  id="email"  value="<?=$list['email']?>">
                  </div>
                </div>
              </div>-->
                  <div>
                  </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">
                <div class="row">

                    <div class="row"><label class="col-xs-12 col-sm-6 pull-right control-label rtl" for="subject"> </label></div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-4 pull-right control-label rtl"
                               for="comment">* شرح درخواست تجدیدنظر :</label>
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

                            $tt = $ckeditor->editor('comment',$list['comment'],$config);

                            echo $tt;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="form-group">
                  <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="file">*بارگذاری مستندات شاخص:</label>
                    <label style="color: red">*نکته: الزامی است که اسم فایل مستندات، انگلیسی باشد.</label>

                    <div class="col-xs-12 col-sm-8 pull-right">
                    <input type="file" name="file">
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
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

       <!--<div class="print">
                <a href="javascript: window.print();">چاپ</a>
                <div class="print">Printed <span>text</span></div>
                <div>Not Printed <span>Text</span></div>-->





