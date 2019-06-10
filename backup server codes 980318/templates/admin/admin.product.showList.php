<script type="text/javascript" language="javascript" class="init">

  $(document).ready(function() {

    // DataTable
    var table = $('#example').DataTable();

    // Apply the search
    table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
          that
              .search( this.value )
              .draw();
        }
      } );
    } );
    ////

    // Apply the search


  } );



</script>
<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
    <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> لیست محصولات تولیدی</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl"> لیست محصولات تولیدی</h3>

      <div class="panel-actions">
      <button data-expand="#panel-1" title="نمایش" class="btn-panel">
          <i class="fa fa-expand"></i>
        </button>
        <button data-collapse="#panel-1" title="بازکردن" class="btn-panel">
          <i class="fa fa-caret-down"></i>
        </button>
      </div>
    </div>
    <div class="panel-body">
      <div class="table-responsive table-responsive-datatables">
          <div class="pull-right">
              <a href="<?=RELA_DIR?>admin/?component=product&artists_id=<?php echo $list['artists_id']; ?>&action=add" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i> افزودن محصول جدید</a>
          </div>
          <div class="row smallSpace"></div>

          <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>ردیف</th>
            <th>عنوان(فارسی)</th>
            <th>عنوان(انگلیسی)</th>
            <th>توضیحات مختصر(فارسی)</th>
            <th>توضیحات مختصر(انگلیسی)</th>
            <th>توضیحات(فارسی)</th>
            <th>توضیحات(انگلیسی)</th>
            <th>تصویر</th>
            <th>فایل</th>
            <th>ابزار</th>
            
          </tr>
          </thead>
          <tbody>
          <?
          $cn = 1;
          if(isset($list['list'])) {
            foreach ($list['list'] as $id =>$fields) {
              ?>
              <tr>
                <td><?php echo $fields['Artists_products_id']; ?></td>
                <td><?php echo $fields['title_fa']; ?></td>
                <td><?php echo $fields['title_en']; ?></td>
                <td><?php echo $fields['brif_description_fa']; ?></td>
                <td><?php echo $fields['brif_description_en']; ?></td>
                <td><?php echo $fields['description_fa']; ?></td>
                <td><?php echo $fields['description_en']; ?></td>
                <td dir="ltr" align="center"> <img height="100px" src="<?=RELA_DIR.'statics/files/'.$fields['artists_id'].'/'.$fields['image']?>"/> </td>
                <td dir="ltr" align="center">
                    <? if($fields['file_type']  == 'image' ):?>
                        <img height="100px" src="<?=RELA_DIR?>statics/files/<?=$fields['artists_id']?>/<?=$fields['file']?>"/>
                    <? endif;?>
                    <? if ($fields['file_type']  == 'video'):?>
                        <video controls width="100%"  >
                            <source src="<?=RELA_DIR?>statics/files/<?=$fields['artists_id']?>/<?=$fields['file']?>" type="video/<?=$fields['extension']?>"" /> <!-- MPEG4 for Safari -->
                            <!--<source src="video.ogg" type="video/ogg" /> <!-- Ogg Theora for Firefox 3.1b2 -->
                        </video>
                    <? endif;?>
                    <? if ($fields['file_type']  == 'audio'):?>
                        <audio controls>
                            <source src="<?=RELA_DIR?>statics/files/<?=$fields['artists_id']?>/<?=$fields['file']?>" type="audio/<?=$fields['extension']?>">
                            Your browser does not support the audio element.
                        </audio>
                    <? endif;?>
                </td>
                <td>
                    <a href="<?=RELA_DIR?>admin/?component=product&action=edit&id=<?php echo $fields['Artists_products_id']; ?>">ویرایش</a> <br/>
                    <a href="<?=RELA_DIR?>admin/?component=product&action=deleteProduct&id=<?php echo $fields['Artists_products_id']; ?>">حذف</a> </td>
              </tr>
              <?
            }
          }
          ?>
          </tbody>
          <tfoot>
            <th><input type="hidden" name="search_1" class="search_init form-control" /></th>
            <th><input type="text" name="search_2" class="search_init form-control" /></th>
            <th><input type="text" name="search_3" class="search_init form-control" /></th>
            <th><input type="text" name="search_4" class="search_init form-control" /></th>
            <th><input type="text" name="search_5" class="search_init form-control" /></th>
            <th><input type="text" name="search_6" class="search_init form-control" /></th>
            <th><input type="text" name="search_7" class="search_init form-control" /></th>
            <th><input type="hidden" name="search_8" class="search_init form-control" /></th>
            <th><input type="hidden" name="search_9" class="search_init form-control" /></th>
            <th><input type="hidden" name="search_10" class="search_init form-control" /></th>

          </tfoot>
        </table>
      </div>
    </div>
    <div class="panel-footer clearfix">
    </div>
  </div>
</div><!--/content-body -->



