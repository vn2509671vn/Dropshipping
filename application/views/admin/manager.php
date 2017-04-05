<div class="col-md-12">
    <form class="form-horizontal" method="POST" action="<?php echo base_url('update-manager');?>">
        <div class='form-group'>
            <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($msg)) echo $msg;?></span>
        </div>
        <div class='form-group'>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pp">PP </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="pp" class="form-control col-md-7 col-xs-12" name="pp"  type="text" value="<?php echo $adminInfo['pp']; ?>">
                <strong class='error-red'><?php echo form_error('pp'); ?></strong>
            </div>
        </div>
        <div class='form-group'>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ep1">EP1 </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="ep1" class="form-control col-md-7 col-xs-12" name="ep1"  type="text" value="<?php echo $adminInfo['ep1']; ?>">
                <strong class='error-red'><?php echo form_error('ep1'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ep2">EP2 </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="ep2" class="form-control col-md-7 col-xs-12" name="ep2"  type="text" value="<?php echo $adminInfo['ep2']; ?>">
                <strong class='error-red'><?php echo form_error('ep2'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f">F </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="f" class="form-control col-md-7 col-xs-12" name="f"  type="text" value="<?php echo $adminInfo['f']; ?>">
                <strong class='error-red'><?php echo form_error('f'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fee_percent">FEE </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="fee_percent" class="form-control col-md-7 col-xs-12" name="fee"  type="text" value="<?php echo $adminInfo['fee']; ?>">
                <strong class='error-red'><?php echo form_error('fee'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="advertisement_1">ADVERTISEMENT LINK 1 </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="advertisement_1" class="form-control col-md-7 col-xs-12" name="advertisement_1"  type="text" value="<?php echo $adminInfo['advertisement_1']; ?>">
                <strong class='error-red'><?php echo form_error('advertisement_1'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="advertisement_2">ADVERTISEMENT LINK 2 </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="advertisement_2" class="form-control col-md-7 col-xs-12" name="advertisement_2"  type="text" value="<?php echo $adminInfo['advertisement_2']; ?>">
                <strong class='error-red'><?php echo form_error('advertisement_2'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="advertisement_3">ADVERTISEMENT LINK 3 </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="advertisement_3" class="form-control col-md-7 col-xs-12" name="advertisement_3"  type="text" value="<?php echo $adminInfo['advertisement_3']; ?>">
                <strong class='error-red'><?php echo form_error('advertisement_3'); ?></strong>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 text-right">
                <input type="submit" name="submit" value="Update" class="btn btn-custom">
                
            </div>
            
            <div class="col-md-6 text-left">
         	    <button type="button" onclick="location='admin-displayuser'" class="btn btn-custom"><span>User Info</span></button>	
            </div>
        </div>
    </form>
</div>