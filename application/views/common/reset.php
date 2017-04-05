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
    
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>templates/build/css/custom.css" rel="stylesheet">
    
    <title>Change Password | Drop Ship Planner</title>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
              <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 login-center">
                <div class="x_panel">
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" novalidate action="<?php echo base_url('change-reset-password');?>">
                      <span class="section">Change Password</span>
                      <div class="form-group">
                        <?php if(isset($error)) echo "<span class='error-red'>".$error."</span>";?>
                      </div>
                      <input type="hidden" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-4">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-4">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="repeat_password" type="password" name="repeat_password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 col-xs-12">
                            <button id="btnLogin" type="submit" class="btn btn-custom">Save</button>
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
    <!-- validator -->
    <script src="<?php echo base_url();?>templates/vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>templates/build/js/custom.min.js"></script>

    <!-- validator -->
    <script>

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        var pwd = $("#password").val();
        var repeat = $("#repeat_password").val();
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }
        
        if(pwd != repeat){
            submit = false;
            alert("Password is not matched.");
        }
        
        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
  </body>
</html>