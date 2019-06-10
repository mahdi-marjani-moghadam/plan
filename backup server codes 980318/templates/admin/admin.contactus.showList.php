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
    <li><a class="rtl text-24"><i class="sidebar-icon fa fa-envelope"></i> لیست پیام ها</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl">لیست پیام ها</h3>

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
        <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>ردیف</th>
            <th>موضوع</th>
            <th>ایمیل</th>
            <th>نظرات</th>
            <th>وضعیت</th>
            <th>تاریخ</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <?
          $cn = 1;
          if(isset($list['list'])) {
            foreach ($list['list'] as $id =>$fields) {
              ?>
              <tr>
                <td><?php echo $fields['Contact_id']; ?></td>
                <td><?php echo $fields['subject']; ?></td>
                <td><?php echo $fields['email']; ?></td>
                <td><?php echo $fields['comment']; ?></td>
                <td><?php echo $fields['status']; ?></td>
                <td><?php echo $fields['date']; ?></td>

                <td><a href="<?=RELA_DIR?>admin/?component=contactus&action=showMore&id=<?php echo $fields['Contact_id']; ?>">نمایش</a>
                  <a href="<?=RELA_DIR?>admin/?component=contactus&action=deleteContactus&id=<?php echo $fields['Contact_id']; ?>">حذف</a> </td>

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
  </div>
</div><!--/content-body -->




