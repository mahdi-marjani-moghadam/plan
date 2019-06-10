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
    <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>  لیست گواهی</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
  <!-- separator -->
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl">لیست گواهی ها</h3>
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
            <a href="<?=RELA_DIR?>admin/?component=certification&action=add" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i> افزودن گواهی جدید</a>
        </div>
        <!-- separator -->
        <div class="row smallSpace"></div>
          <div class="table-responsive table-responsive-datatables">
            <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>ردیف</th>
                <th>عنوان گواهی</th>
                <th>توضیحات</th>
                <th>تصویر</th>
                <th>ابزار</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $cn = 1;
              if (isset($list['list'])) 
              {foreach ($list['list'] as $id => $fields)
              {?>
                  <tr>
                    <td><?php echo $fields['Certification_id']; ?></td>
                    <td><?php echo $fields['title']; ?></td>
                    <td><?php echo $fields['description']; ?></td>
                    <td><img height="60" src="<?php echo $fields['image'];?>"></td>
                    <td>
                        <a href="<?=RELA_DIR?>admin/?component=certification&action=edit&id=<?php echo $fields['Certification_id'];?>">ویرایش</a> <br/>
                        <a href="<?=RELA_DIR?>admin/?component=certification&action=delete&id=<?php echo $fields['Certification_id'];?>">حذف</a>
                    </td>
                  </tr>
              <?php

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
