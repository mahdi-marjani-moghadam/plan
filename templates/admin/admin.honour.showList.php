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
    <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>لیست افتخار های تولیدی</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl">لیست افتخار های تولیدی</h3>

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
              <a href="<?=RELA_DIR?>admin/?component=honour&company_id=<?php echo $list['company_id']; ?>&action=add" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن افتخار جدید</a>
          </div>
          <div class="row smallSpace"></div>

          <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>توضیحات</th>
            <th>تصویر</th>
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
                <td><?php echo $fields['Company_honours_id']; ?></td>
                <td><?php echo $fields['title']; ?></td>
                <td><?php echo $fields['description']; ?></td>
                <td dir="ltr" align="center"> <img height="60px" src="<?=$fields['image']?>"/> </td>
                <td>
                <a href="<?=RELA_DIR?>admin/?component=honour&action=edit&id=<?php echo $fields['Company_honours_id']; ?>">ویرایش</a> <br/>

                  <a href="<?=RELA_DIR?>admin/?component=honour&action=deleteHonour&id=<?php echo $fields['Company_honours_id']; ?>">حذف</a> </td>

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
          </tfoot>
        </table>
      </div>
    </div>
    <div class="panel-footer clearfix">
    </div>
  </div>
</div><!--/content-body -->
