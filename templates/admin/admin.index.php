<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
    <li><a class="rtl text-24">  <i class="sidebar-icon fa fa-advetisepaper-o"></i></a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="col-md-12 text-center" style="margin-bottom: 30px">
        <?php if($msg!='')
        { ?>
            <?= $msg ?>
            <?php
        }else{

        ?>  <img width="100" src="<?php echo RELA_DIR;?>templates/<?php echo CURRENT_SKIN; ?>/images/logo@2x.png" >
            <span style="font-size: 2em"  > کاربر گرامی؛  <?=$admin_info['name']?> <?=$admin_info['family']?> خوش آمدید</span>
<?}?>

    </div>
    <?if($admin_info['parent_id'] == 0 ):?>
        <div class="col-md-2 " style="display: none" >
            <div id="overall-visitor" class="panel panel-animated panel-success bg-cloud">
                <div class="panel-body">

                    <p class="lead">کاربران آنلاین</p><!--/lead as title-->

                    <ul class="list-percentages row ">

                        <li class="col-xs-12">
                            <p class="text-ellipsis"></p>
                            <p class="text-lg"><strong><?php echo $export['admin_count'];?></strong></p>
                        </li>


                    </ul><!--/list-percentages-->
                    <p class="helper-block">

                    </p><!--/help-block-->
                </div><!--/panel-body-->
            </div><!--/panel overal-visitor-->
        </div><!--/cols-->
    <? endif;?>

        <div class="col-md-12" >
    <div id="overall-visitor" class="panel panel-animated panel-success bg-cloud">
      <div class="panel-body">

          <style>
                .admins span{ background: #f8ffcf; display: inherit; margin: 3px; padding: 5px; box-shadow: 0 2px 3px rgba(0,0,0,0.2) }
          </style>
          <script>
              $(document).ready(function () {
                  $('.admins div').hide();

                  var s = $('#status').val();

                  $('.admins div[data-status='+s+']').show();

                  $('#status').change(function () {
                      $('.admins div').hide();
                      if($(this).val() == '0,1,2,3'){

                          $('.admins div[data-status=0],.admins div[data-status=1] , .admins div[data-status=2] ,.admins div[data-status=3]').show();
                      }else{
                          $('.admins div[data-status='+$(this).val()+']').show();
                      }

                  });
              });
          </script>


        <p class="lead">دوره ارزیابی <?=$season?></p><!--/lead as title-->
          <select id="status">
              <option value="0">عدم ورود اطلاعات</option>
              <option value="1">ثبت موقت اطلاعات</option>
              <option value="2">ارسال به مافوق</option>
              <option value="4">تایید  توسط مافوق</option>
              <option value="0,1,2,3">عدم ثبت نهایی اطلاعات</option>
              <option value="4"> ثبت نهایی اطلاعات توسط واحد</option>
              <?if($admin_info['parent_id'] == 0):?>
                  <option value="5">ارزیاب</option>
                  <option value="6">تایید اولیه</option>
              <? endif;?>
              <option value="7">تایید نهایی مرکز ارزیابی</option>
          </select>

          <div class="admins row">


              <? foreach ($child as $v):?>
                <div class="col-md-2 col-xs-12 col-sm-4 " data-status="<?=$v['status']?>">
                    <span><a href="<?=RELA_DIR?>admin/?component=form&q=,<?=$v['admin_id']?>,"><?=readMore($v['name'].' '.$v['family'],55,0)?></a></span>
                </div>
              <? endforeach;?>

          </div><!--/list-percentages-->

      </div><!--/panel-body-->
    </div><!--/panel overal-visitor-->
  </div>

  <div class="col-md-3" style="display: none">
    <div id="overall-visitor" class="panel panel-animated panel-success ">
      <div class="panel-body">
        <div class="panel-actions-fly">
          <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh" class="btn-panel">
            <i class="glyphicon glyphicon-refresh"></i>
          </button><!--/btn-panel-->
          <a href="#" title="Go to system stats page" class="btn-panel">
            <i class="glyphicon glyphicon-stats"></i>
          </a><!--/btn-panel-->
        </div><!--/panel-action-fly-->

        <p class="lead"></p><!--/lead as title-->

        <ul class="list-percentages row ">
          <li class="col-xs-12">
            <p class="text-ellipsis"></p>
            <p class="text-lg"><strong><?php echo $list['event_count'];?></strong></p>
          </li>


        </ul><!--/list-percentages-->
        <p class="helper-block">

        </p><!--/help-block-->
      </div><!--/panel-body-->
    </div><!--/panel overal-visitor-->
  </div>

</div><!--/content-body -->