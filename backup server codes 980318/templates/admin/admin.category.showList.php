<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

// DataTable
        var table = $('#example').DataTable();

// Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
////
// Apply the search

    });
</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-tasks"></i> لیست دسته بندی</a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <!-- separator -->
    <div class="xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست دسته بندی </h3>
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
                <a href="<?= RELA_DIR ?>admin/?component=category&action=add" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i> افزودن دسته بندی جدید</a>
            </div>
            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام دسته بندی</th>
                        <th>آدرس اینترنتی</th>
                        <th>کلمات کلیدی</th>
                        <th>توضیحات کلیدی</th>
                        <!--<th>نام تصویر</th>-->
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tfoot>
                        <th><input type="text" name="search_10" value="" class="search_init form-control"/></th>
                        <th><input type="text" name="search_20" value="" class="search_init form-control"/></th>
                        <th><input type="text" name="search_30" value="" class="search_init form-control"/></th>
                        <th><input type="text" name="search_40" value="" class="search_init form-control"/></th>
                        <th><input type="text" name="search_50" value="" class="search_init form-control"/></th>
                        <!--<th><input type="text" name="search_60" value="" class="search_init form-control"/></th>-->
                        <th><input type="text" name="search_70" value="" class="search_init form-control"/></th>
                    </tfoot>
                    <tbody>
                    <?php foreach ($list['list'] as $id => $fields) {
                    ?>
                        <tr>
                            <td><?php echo $fields['dataTableCount']; ?></td>
                            <td><?php echo $fields['export']; ?></td>
                            <td><?php echo $fields['url']; ?></td>
                            <td><?php echo $fields['meta_keyword']; ?></td>
                            <td><?php echo $fields['meta_description']; ?></td>
                            <td style="display: none" dir="ltr" align="center"><img height="60px" src="<?= $fields['img_name'] ?>"/></td>
                            <td>
                                <a href="<?= RELA_DIR ?>admin/?component=category&action=edit&id=<?php echo $fields['Category_id']; ?>">ویرایش</a>
                                <a href="<?= RELA_DIR ?>admin/?component=category&action=delete&id=<?php echo $fields['Category_id']; ?>">حذف</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                موارد یافت شده
                    <?php echo $list['recordsCount']; ?>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>

<!--/content -->
