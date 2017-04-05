<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>templates/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Custom Bootstrap -->
    <link href="<?php echo base_url();?>templates/bootstrap/thangtgm_custom.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>templates/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>templates/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>templates/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>templates/build/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>templates/bootstrap/thangtgm_custom.css" rel="stylesheet" />
    
    <title>Register | Drop Ship Planner</title>
</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo base_url();?>register" novalidate>
                      <span class="section">Register</span>
                      <div class='form-group'>
                        <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($msg)) echo $msg;?></span>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" name="fullname"  type="text" value="<?php echo set_value('fullname'); ?>">
                          <strong class='error-red'><?php echo form_error('fullname'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Phone Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phonenumber" name="phonenumber" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('phonenumber'); ?>">
                          <strong class='error-red'><?php echo form_error('phonenumber'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo set_value('birthday'); ?>">
                          <strong class='error-red'><?php echo form_error('birthday'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" name="address" class="form-control col-md-7 col-xs-12"><?php echo set_value('address'); ?></textarea>
                          <strong class='error-red'><?php echo form_error('address'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="country" name="country" class="form-control col-md-7 col-xs-12">
                            <option value="US">USA</option>
                            <option value="UK">UK</option>
                            <option value="AU">Australia</option>
                            <option value="CA">Canada (English)</option>
                            <option value="IE">Ireland</option>
                            <option value="DE">Deutschland</option>
                            <option value="FR">France</option>
                            <option value="ES">España</option>
                            <option value="IT">Italia</option>
                            <option value="NL">Nederland</option>
                            <option value="BENL">België</option>
                            <option value="BEFR">Belgique</option>
                            <option value="AT">Österreich</option>
                            <option value="CH">Schweiz</option>
                            <option value="MY">Malaysia</option>
                            <option value="IN">India</option>
                            <option value="SG">Singapore</option>
                            <option value="PH">Philippines</option>
                            <option value='VN'>Việt Nam</option>
                            <option value='other'>Other</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('email'); ?>">
                          <strong class='error-red'><?php echo form_error('email'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('password'); ?>">
                          <strong class='error-red'><?php echo form_error('password'); ?></strong>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="confirm_password" type="password" name="confirm_password" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('confirm_password'); ?>">
                          <strong class='error-red'><?php echo form_error('confirm_password'); ?></strong>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                          <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-custom">
                          <a href="<?php echo base_url();?>" class="btn btn-custom">Go to Login</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>templates/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>templates/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>templates/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>templates/vendors/nprogress/nprogress.js"></script>
    
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>templates/build/js/custom.min.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>templates/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- validator -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
      });
    </script>
    <!-- /validator -->
  </body>
</html>