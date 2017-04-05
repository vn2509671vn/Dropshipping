<div class="col-md-12 col-xs-12">
    <form class="form-horizontal" method="POST" action="<?php echo base_url('change-user-info');?>">
        <div class='form-group'>
            <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($msg)) echo $msg;?></span>
        </div>
        <div class='form-group'>
            <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($totalFee)) echo "Total Fee: ".$totalFee;?></span>
        </div>
        <div class='form-group'>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Full Name </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12" name="fullname"  type="text" value="<?php echo $userInfo['user_name']; ?>">
                <strong class='error-red'><?php echo form_error('fullname'); ?></strong>
            </div>
        </div>
        <div class='form-group'>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Phone Number </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="phonenumber" class="form-control col-md-7 col-xs-12" name="phonenumber"  type="text" value="<?php echo $userInfo['user_phone']; ?>">
                <strong class='error-red'><?php echo form_error('phonenumber'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo $userInfo['user_birthday']; ?>">
                <strong class='error-red'><?php echo form_error('birthday'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="gender">
                    <option value="male" <?php if($userInfo['user_gender'] == "male") echo "selected" ?>>Male</option>
                    <option value="female" <?php if($userInfo['user_gender'] == "female") echo "selected" ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="address" name="address" class="form-control col-md-7 col-xs-12"><?php echo $userInfo['user_address']; ?></textarea>
                <strong class='error-red'><?php echo form_error('address'); ?></strong>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="country" name="country" class="form-control col-md-7 col-xs-12">
                    <option value="US" <?php if($userInfo['user_country'] == "US") echo "selected" ?>>USA</option>
                    <option value="UK" <?php if($userInfo['user_country'] == "UK") echo "selected" ?>>UK</option>
                    <option value="AU" <?php if($userInfo['user_country'] == "AU") echo "selected" ?>>Australia</option>
                    <option value="CA" <?php if($userInfo['user_country'] == "CA") echo "selected" ?>>Canada (English)</option>
                    <option value="IE" <?php if($userInfo['user_country'] == "IE") echo "selected" ?>>Ireland</option>
                    <option value="DE" <?php if($userInfo['user_country'] == "DE") echo "selected" ?>>Deutschland</option>
                    <option value="FR" <?php if($userInfo['user_country'] == "FR") echo "selected" ?>>France</option>
                    <option value="ES" <?php if($userInfo['user_country'] == "ES") echo "selected" ?>>España</option>
                    <option value="IT" <?php if($userInfo['user_country'] == "IT") echo "selected" ?>>Italia</option>
                    <option value="NL" <?php if($userInfo['user_country'] == "NL") echo "selected" ?>>Nederland</option>
                    <option value="BENL" <?php if($userInfo['user_country'] == "BENL") echo "selected" ?>>België</option>
                    <option value="BEFR" <?php if($userInfo['user_country'] == "BEFR") echo "selected" ?>>Belgique</option>
                    <option value="AT" <?php if($userInfo['user_country'] == "AT") echo "selected" ?>>Österreich</option>
                    <option value="CH" <?php if($userInfo['user_country'] == "CH") echo "selected" ?>>Schweiz</option>
                    <option value="MY" <?php if($userInfo['user_country'] == "MY") echo "selected" ?>>Malaysia</option>
                    <option value="IN" <?php if($userInfo['user_country'] == "IN") echo "selected" ?>>India</option>
                    <option value="SG" <?php if($userInfo['user_country'] == "SG") echo "selected" ?>>Singapore</option>
                    <option value="PH" <?php if($userInfo['user_country'] == "PH") echo "selected" ?>>Philippines</option>
                    <option value='VN' <?php if($userInfo['user_country'] == "VN") echo "selected" ?>>Việt Nam</option>
                    <option value='other' <?php if($userInfo['user_country'] == "other") echo "selected" ?>>Other</option>
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" readonly value="<?php echo $userInfo['user_email']; ?>">
                <strong class='error-red'><?php echo form_error('email'); ?></strong>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <input type="submit" name="submit" value="Update" class="btn btn-custom">
            </div>
        </div>
    </form>
</div>