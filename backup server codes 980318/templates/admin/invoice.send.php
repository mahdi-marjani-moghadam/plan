<!--script-->
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function()
    {
        
    });
</script>

<div class="content">
  <div class="content-header">
    <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>.</h2>
  </div>
  <!--/content-header -->
  
  <div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
      <div class="panel-heading bg-white">
        <h3 class="panel-title rtl"></h3>
        <div class="panel-actions">
          <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه"> <i class="fa fa-expand"></i> </button>
          <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن"> <i class="fa fa-caret-down"></i> </button>
        </div>
        <!-- /panel-actions --> 
      </div>
      <!-- /panel-heading -->
     
      <?php if($list['msg']!=null) 
      { ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
         <?= $list['msg'] ?>
         <span style="color:#408ca3; font-weight:bold;" >
         <?='&nbsp;&nbsp;شماره فاکتور :&nbsp;'.$list['invoice_id'];?>
         </span>
      </div>
      <?php
      } ?>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8  center-block"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/content --> 

