<div class="row smallSpace"></div>
<script>
    $(document).ready(function() {
        $('#filter_columns').change(function() {
            var filter = $(this).val();
            //if ($(this).val() == 0) {
            location.href = window.location.origin + '/admin/?component=shakhes&filter_columns=' + filter;
            //}
        });
    });
</script>
<style>
    .select2-search-choice-close {
        left: 3px;
        right: auto;
    }
</style>
<div class="content-body">
    <div class="row" style="margin-bottom: 1em;">
        <div class="col-md-12">
            <select multiple name="filter_columns" id="filter_columns">
                <option value="1">واحد های زیر مجموعه</option>
                <?php foreach ($admins as $admin) : ?>

                    <option value='<?= $admin['admin_id'] ?>' <?= ($admin['selected'] == 'true') ? 'selected' : ''; ?>><?= $admin['name'] . ' ' . $admin['family'] ?></option>

                <?php endforeach; ?>
                <option value="2">کل واحد</option>
                <option value="3">دانشگاه</option>
            </select>
        </div>
    </div>
    
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">گزارش شاخص</h3>
        </div>
        <div class="panel-body">
            <div id="container" style="overflow: auto;">
 <? 
            if($msg){
                echo $msg;
            }
            ?>

                <form action="<?=RELA_DIR?>admin/?component=shakhes&action=adminSetting" method="post">
                
                
                    <table class="table table-striped table-bordered rtl">
                        <tr>
                            <td>کد قلم</td>
                            <td>هدف</td>
                            <td>قلم</td>
                            <td>مالک قلم</td>
                            <td>وارد کننده</td>
                            <td>نمایش برای</td>
                            <td>تایید کننده اول</td>
                            <td>تایید کننده دوم</td>
                        </tr>
                        <?php foreach ($ghalam as $item) : ?>
                            <tr>
                                <td><?= $item['ghalam_id'] ?></td>
                                <td><?= $item['kalan_no'] ?></td>
                                <td style="white-space:nowrap"><?= $item['ghalam'] ?></td>
                                <td>
                                    <select  name="import[<?=$item['ghalam_id']?>][motevali_admin_id][]" multiple>
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?=$admin['admin_id']?>" 
                                            <?php echo ($admin['selected'] == 'true')?'selected' :''; ?>
                                            >
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                            </option>    
                                        <?php endforeach ?>
                                    </select>  
                                </td>
                                <td>
                                    <select name="import[<?=$item['ghalam_id']?>][import_admin]">
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?=$admin['admin_id']?>" 
                                            <?php echo ($admin['selected'] == 'true')?'selected' :''; ?>
                                            >
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                            </option>    
                                        <?php endforeach ?>
                                    </select>  
                                </td>
                                <td>
                                    <select multiple name="import[<?=$item['ghalam_id']?>][display_admin][]">
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?=$admin['admin_id']?>" 
                                            <?php echo ($admin['selected'] == 'true')?'selected' :''; ?>
                                            >
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                            </option>    
                                        <?php endforeach ?>
                                    </select>  
                                </td>
                                <td>
                                    <select name="import[<?=$item['ghalam_id']?>][confirm_admin_1]">
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?=$admin['admin_id']?>" 
                                            <?php echo ($admin['selected'] == 'true')?'selected' :''; ?>
                                            >
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                            </option>    
                                        <?php endforeach ?>
                                    </select>  
                                </td>
                                <td>
                                    <select name="import[<?=$item['ghalam_id']?>][confirm_admin_2]">
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?=$admin['admin_id']?>" 
                                            <?php echo ($admin['selected'] == 'true')?'selected' :''; ?>
                                            >
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                            </option>    
                                        <?php endforeach ?>
                                    </select>  
                                </td>
                             
                            </tr>
                        <?php endforeach ?>
                    </table>


                    <?php foreach ($pagination as $k => $link): ?>
                        <a class="btn btn-default <?=(($k+1) == $page)?'active':''?>" href="<?=$link?>"><?=$k+1?></a>
                    <?php endforeach?>
                    <br>
                    <button style="margin-top: 1em;" class="btn btn-success btn-large">
                        ثبت
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>