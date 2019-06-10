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
      <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> لیست تبلیغات </a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl">لیست تبلیغات </h3>
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
        <div class="pull-right">
            <a href="<?=RELA_DIR?>admin/?component=advertise&action=addAdvertise" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن تبلیغ جدید </a>
        </div>
        <!-- separator -->
      <div class="row smallSpace"></div>
      <div class="table-responsive table-responsive-datatables">
        <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th> ردیف</th>
            <th>شماره دسته بندی</th>
            <th>عنوان</th>
            <th>توضیحات مختصر</th>
            <th>آدرس اینترنتی</th>
            <th>تصویر</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?
          $cn = 1;
          if(isset($list['list'])) {
            foreach ($list['list'] as $id =>$fields)
            {
          ?>
            <tr>
              <td><?php echo $fields['Advertise_id']; ?></td>
              <td><?php echo $fields['category_id']; ?></td>
              <td><?php echo $fields['title']; ?></td>
              <td><?php echo $fields['brif_description']; ?></td>
              <td><?php echo $fields['url']; ?></td>
              <td dir="ltr" align="center"> <img height="60px" src="<?=$fields['image']?>"/> </td>
              <td><a href="<?=RELA_DIR?>admin/?component=advertise&action=editAdvertise&id=<?php echo $fields['Advertise_id']; ?>">ویرایش</a>
                <a href="<?=RELA_DIR?>admin/?component=advertise&action=deleteAdvertise&id=<?php echo $fields['Advertise_id']; ?>">حذف</a> </td>
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
            <th><input type="hidden" name="search_7" class="search_init form-control" /></th>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="panel-footer clearfix">
    </div>
  </div>
</div><!--/content-body -->



