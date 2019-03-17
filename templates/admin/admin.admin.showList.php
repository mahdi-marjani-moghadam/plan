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
      <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> تنظیمات کاربری</a></li>
  </ul><!--/control-nav-->

</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">تنظیمات کاربری</h3>
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

                        <th>نام کاربری</th>
                        <th>پسورد</th>
                        <th>حوزه</th>
                        <th>نام واحد</th>


                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <? global $admin_info;
                    $cn = 1;
                    if (isset($list['list'])) {


                    ?>
                        <tr>

                            <td><?php echo $list['list']['username']; ?></td>
                            <td><?php echo $list['list']['password']; ?></td>
                            <td><?php echo $list['list']['name']; ?></td>
                            <td><?php echo $list['list']['family']; ?></td>


                            <td>
                                <a href="<?= RELA_DIR ?>admin/?component=admin&action=editadmin&id=<?php echo $fields['admin_id']; ?>">ویرایش</a>


                            </td>
                        </tr>
                        <?


                    }
                    ?>
                    </tbody>
                    <!--<tfoot>
                        <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                        <th><input type="text" name="search_2" class="search_init form-control"/></th>
                        <th><input type="text" name="search_3" class="search_init form-control"/></th>
                        <th><input type="text" name="search_4" class="search_init form-control"/></th>
                        <th><input type="text" name="search_5" class="search_init form-control"/></th>
                        <th><input type="text" name="search_6" class="search_init form-control"/></th>

                        <th><input type="hidden" name="search_7" class="search_init form-control"/></th>

                    </tfoot>-->
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->



