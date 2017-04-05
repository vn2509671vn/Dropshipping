<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>templates/bootstrap/bootstrap.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>templates/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Datatables -->
    <link href="<?php echo base_url();?>templates/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>templates/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>templates/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>templates/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>templates/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>templates/build/css/custom.css" rel="stylesheet" />
    
    <link href="<?php echo base_url();?>templates/bootstrap/thangtgm_custom.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>templates/bootstrap/jquery.js"></script>
    <!-- Plugin for datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script src="<?php echo base_url();?>templates/bootstrap/dataTables.bootstrap.js"></script>

    <!-- Plugin for swal alert -->
    <script src="<?php echo base_url();?>templates/bootstrap/sweetalert-dev.js"></script>
    <link href="<?php echo base_url();?>templates/bootstrap/sweetalert.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>templates/bootstrap/sweetalert.min.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>templates/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <title><?php echo $title;?></title>
</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url();?>" class="site_title">
                <span>Drop Ship Planner</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Xin chào,</span>
                <h2><strong><?php echo $userInfo['user_name'];?></strong></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="http://dropshipplanner.com/"><i class="fa fa-home"></i> Home </a></li>
                  <li><a href="<?php echo base_url('profile');?>"><i class="fa fa-edit"></i> Profile </a></li>
                  <li><a href="<?php echo base_url('configuration');?>"><i class="fa fa-bar-chart-o"></i> Configuration </a></li>
                  <li><a href="<?php echo base_url('supplier');?>"><i class="fa fa-users"></i> Supplier </a>
                  </li>
                  <?php if ($userInfo['user_role'] == 1)
                  {?>
                  <li><a href="<?php echo base_url('admin-manager');?>"><i class="fa fa-users"></i> Manager </a>
                  <li><a href="<?php echo base_url('admin-fee-history');?>"><i class="fa fa-table"></i> Fee History </a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
              <div class="menu_section">
                <div class="ads-left-menu">
                  
                </div>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <div class="nav ads-header">
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <strong><?php echo $userInfo['user_name'];?></strong>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a data-toggle="modal" data-target="#changePass"> Change Password</a></li>
                    <li><a href="<?php echo base_url('logout');?>"><i class="fa fa-sign-out pull-right"></i>Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!-- Include content -->
            <?php $this->load->view($template, isset($data)?$data:NULL); ?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-left">
            <strong>© 2017-<span style="font-weight:bold;">2069</span>, <a>ThangTGM</a></strong>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePass" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <form id="formChangePass">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="oldpwd">Old Password:</label>
                            <input type="password" class="form-control" id="oldpwd" required />
                        </div>
                        <div class="form-group">
                            <label for="newpwd">New Password:</label>
                            <input type="password" class="form-control" id="newpwd" required />
                        </div>
                        <div class="form-group">
                            <label for="repeatnewpwd">Repeat New Password:</label>
                            <input type="password" class="form-control" id="repeatnewpwd" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom" id="btnChangePwd">Save</button>
                        <button type="button" class="btn btn-custom" id="btnCloseformChangePass" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Modal -->
    
    <!-- Scroll to top button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    
    <!-- jQuery -->
    <script src="<?php echo base_url();?>templates/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>templates/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>templates/vendors/fastclick/lib/fastclick.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>templates/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>templates/build/js/custom.min.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>templates/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>templates/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- validator -->
    <script>
      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
        
      $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';
        $('#birthday').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        
        $('#formChangePass').submit(function(){
          var old_pwd = $('#oldpwd').val();
          var new_pwd = $('#newpwd').val();
          var repeatnewpwd = $('#repeatnewpwd').val();
          if(new_pwd == repeatnewpwd){
            $.ajax({
               type: "POST",
               url: base_url + "change-password", 
               data: {
                 old_pwd: old_pwd,
                 new_pwd: new_pwd
               },
               dataType: "text",
               success: 
                    function(msg){
                      alert(msg);
                      $('#btnCloseformChangePass').click();
                    }
            });
          }
          else {
            alert("Password not matched.");
          }
          return false;
        });
        
        // Setup - add a text input to each footer cell
        $('#dtSupplier tfoot th').each( function () {
          if($(this).hasClass("isSearch")){
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search" />' );
          }
        });
     
        // DataTable
        var table = $('#dtSupplier').DataTable({
          bSort: false
        });
     
        // Apply the search
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        });
        
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }
      });
    </script>
    <!-- /validator -->
  </body>
</html>