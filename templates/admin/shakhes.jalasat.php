<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم جلسات</h3>
        </div>
        <div class="panel-body">
            <form>
                <table class="form">
                    <tr>
                        <td>زمان برگزاری*</td>
                        <td><input class="form-control date"></td>

                        <td>اعضای هیات رئیسه حاضر در جلسه*</td>
                        <td><input class="form-control"></td>
                    </tr>
                    <tr>
                        <td>تعداد شرکت کنندگان*</td>
                        <td><input class="form-control"></td>

                        <td>مقطع*</td>
                        <td><input class="form-control"></td>
                    </tr>
                    <tr>
                        <td>رشته*</td>
                        <td><input class="form-control"></td>

                        <td>تعداد کل دانشجویان مشمول*</td>
                        <td><input class="form-control"></td>
                    </tr>
                    <tr>
                        <td>رئوس موضوعات طرح شده در جلسه*</td>
                        <td><input class="form-control"></td>
                    </tr>

                </table>
                <button class="btn btn-warning btn-large">ثبت موقت</button>
                <button class="btn btn-success btn-large">تایید نهایی</button>
            </form>
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست جلسات</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>زمان برگزاری</th>
                    <th>اعضای هیات رئیسه حاضر در جلسه</th>
                    <th>تعداد شرکت کنندگان*</th>
                    <th>مقطع</th>
                    <th>رشته</th>
                    <th>تعداد کل دانشجویان مشمول</th>
                    <th>رئوس موضوعات طرح شده در جلسه*</th>
                </tr>
                <?php
                if ($jalasat['recordsCount'] > 0) :
                    foreach ($jalasat['list'] as $v) :
                ?>
                        <tr>
                            <td><?= $v['admin_id'] ?></td>
                            <td><?= $v['date'] ?></td>
                            <td><?= $v['manager_list'] ?></td>
                            <td><?= $v['member_count'] ?></td>
                            <td><?= $v['grade'] ?></td>
                            <td><?= $v['course'] ?></td>
                            <td><?= $v['eligible_students'] ?></td>
                            <td><?= $v['subject'] ?></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </table>
        </div>
    </div>
</div>

<style>
    form {
        text-align: center;
    }

    .form {
        margin: auto;
    }

    .form td {
        padding: 1em;
        text-align: left;
    }
</style>