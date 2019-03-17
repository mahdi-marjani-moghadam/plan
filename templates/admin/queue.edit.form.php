<!--script-->
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function()
    {
        var DSTOption = $('#DSTOption');
        DSTOption.click(function()
        {
            $.ajax
            ({
                type:'POST',
                url:'dstOption.php?action=dstOption',
                data:{"DSTOption":DSTOption.val()},
                success: function (html)
                {
                    $('#subDstOption').html(html);
                }
            });
        });
    });
</script>
<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>Edit Queue</h2>
    </div><!--/content-header -->

    <div class="content-body">

        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">Edit Queue</h3>
                <div class="panel-actions">
                    <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                        <i class="fa fa-expand"></i>
                    </button>
                    <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div><!-- /panel-actions -->
            </div><!-- /panel-heading -->

            <?php if($msg!=null)
            { ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                    <?= $msg ?>
                </div>
            <?php
            }
            ?>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                        <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal form-bordered" autocomplete="off" novalidate="novalidate" method="post">
                            <input name="queue_id" id=queue_id type="hidden" value="<?=$list['QueueList']['queue_id']?>"/>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Queue_Name">نام:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="Queue_Name" id="Queue_Name" autocomplete="off" placeholder="Queue نام " required value="<?=$list['QueueList']['Queue_Name']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Queue_Ext_Number">Queue Ext No:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="Queue_Ext_Number" id="Queue_Ext_Number" autocomplete="off" placeholder="Queue Ext Number" required value="<?=$list['QueueList']['Queue_Ext_Number']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Queue_Pass">Queue Password:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="Queue_Pass" id="Queue_Pass" autocomplete="off" placeholder="Queue Password" required value="<?=$list['QueueList']['Queue_Pass']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Max_Wait_Time">Maximum Wait Time:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="Max_Wait_Time" id="Max_Wait_Time" autocomplete="off" placeholder="Maximum Wait Time" required value="<?=$list['QueueList']['Max_Wait_Time']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="agent">Agent:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select data-input="select2" placeholder="Choose extensions" multiple="" tabindex="-1" class="select2-offscreen" name="Agents_No[]" >
                                                <?php foreach($list['Agents_No'] as $key=>$value){
                                                    ?>
                                                    <option value="<?php echo $value['Extension_No'];?>"><?php echo $value['Extension_No'];?></option>


                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">

                                </div>
                            </div>

                            <div class="row xsmallSpace hidden-xs"></div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Position_Announcement">Announcements:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="Position_Announcement" id="Position_Announcement" type="checkbox"> Position Announcement
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input name="Hold_Time_Announcement" id="Hold_Time_Announcement" type="checkbox"> Hold time Announcement
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Frequency">Frequency:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select class="valid" name="Frequency" id="Frequency" required  value="<?=$list['QueueList']['Frequency']?>">
                                                <option>15</option>
                                                <option>30</option>
                                                <option>60</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Recording">Recording:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <div class="checkbox">
                                                <label>
                                                    <input id="Recording" name="Recording" type="checkbox"> Recording
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="Ring_Strategy">Ring Strategy:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select class="valid" name="Ring_Strategy" id="Ring_Strategy"  value="<?=$list['QueueList']['Ring_Strategy']?>" required>
                                                <option>Strategy 1</option>
                                                <option>Strategy 2</option>
                                                <option>Strategy 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="DSTOption">Fail over DST:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select class="valid" name="DSTOption" id="DSTOption" required>
                                                <?php foreach($list['DSTList'] as $key=>$value) {
                                                    ?>
                                                    <option <?php echo $value['DstOptionID'] == $list['dst_option_id'] ? 'selected' : '' ?> value="<?=$value['DstOptionID']?>"><?=$value['OptionValue']?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="DSTOption">Fail over DST:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right" id="subDstOption" >

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--subDstOption-->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                </div>
                            </div>

                            <div class="row xsmallSpace hidden-xs"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right">
                                        <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                            <input type="hidden"  name="action" id="action" value="update">
                                            <i class="fa fa-plus"></i>
                                            اضافه کردن
                                        </button>
                                    </p>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/content -->


