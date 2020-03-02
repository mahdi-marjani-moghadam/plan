<div class="row smallSpace"></div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <select multiple>
                <option value="1">واحد های زیر مجموعه</option>
                <option value="2">کل واحد</option>
                <option value="3">دانشگاه</option>
            </select>
        </div>
    </div>
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">گزارش شاخص</h3>
        </div>
        <div class="panel-body">
            <div id="container">



                <table class="table table-striped table-bordered rtl">
                    <tr>
                        <td>کد قلم</td>
                        <td>هدف</td>
                        <td>قلم</td>
                    </tr>
                    <? foreach ($ghalam as $item) : ?>
                        <tr>
                            <td><?= $item['ghalam_id'] ?></td>
                            <td><?= $item['kalan_no'] ?></td>
                            <td><?= $item['ghalam'] ?></td>
                        </tr>
                    <? endforeach ?>
                </table>



            </div>
        </div>
    </div>
</div>