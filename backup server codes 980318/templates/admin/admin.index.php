<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
    <li><a class="rtl text-24">  <i class="sidebar-icon fa fa-advetisepaper-o"></i></a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="col-md-12 text-center">
        <?php if($msg!='')
        { ?>
            <?= $msg ?>
            <?php
        }else{

        ?>  <img width="100" src="<?php echo RELA_DIR;?>templates/<?php echo CURRENT_SKIN; ?>/images/logo@2x.png" >
            <span style="font-size: 2em"  > کاربر گرامی؛  <?=$admin_info['name']?> <?=$admin_info['family']?> خوش آمدید</span>

<?}?>

    </div>
    <?if($admin_info['parent_id'] == 0):?>
  <div class="col-md-3" style="display: ">
    <div id="overall-visitor" class="panel panel-animated panel-primary bg-primary">
      <div class="panel-body">

        <p class="lead">کاربران آنلاین</p><!--/lead as title-->

          <ul class="list-percentages row ">

            <li class="col-xs-12">
              <p class="text-ellipsis"></p>
              <p class="text-lg"><strong><?php echo $list['admin_count'];?></strong></p>
            </li>


          </ul><!--/list-percentages-->
        <p class="helper-block">

        </p><!--/help-block-->
      </div><!--/panel-body-->
    </div><!--/panel overal-visitor-->
  </div><!--/cols-->
    <? endif;?>
  <div class="col-md-3" style="display: none">
    <div id="overall-visitor" class="panel panel-animated panel-success bg-success">
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
            <p class="text-lg"><strong><?php echo $list['artists_products_count'];?></strong></p>
          </li>

        </ul><!--/list-percentages-->
        <p class="helper-block">

        </p><!--/help-block-->
      </div><!--/panel-body-->
    </div><!--/panel overal-visitor-->
  </div>
  <div class="col-md-3" style="display: none">
    <div id="overall-visitor" class="panel panel-animated panel-danger bg-danger">
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