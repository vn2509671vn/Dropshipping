<div class="col-md-12 col-xs-12">
    <?php if($this->session->flashdata('msg')) { ?>
        <div class="alert alert-info  alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> <strong>Alert! </strong>
                <?php echo $this->session->flashdata('msg'); ?></h2> 
            </div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-bordered" class='table table-striped table-bordered table-full-width' cellspacing='0' width='100%'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>User Phone</th>
                    <th>User Birthday</th>
                    <th>User Gender</th>
                    <th>User Address</th>
                    <th>User Country</th>
                    <th>User Email</th>
                    <th>User Password</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                
                <?php 
                        $i=1; 
                        $count =0;
                        foreach($listUser as $user) { 
                            $count++;
                ?>
                    <tr>
                        <td class='text-center'><?php echo $i; ?></td>
                        <td><?php echo $user['user_name']; ?></td>
                        <td class='text-center'><?php echo $user['user_phone']; ?></td>
                        <td class='text-center'><?php echo $user['user_birthday']; ?></td>
                        <td class='text-center'><?php echo $user['user_gender']; ?></td>
                        <td><?php echo $user['user_address']; ?></td>
                        <td class='text-center'><?php echo $user['user_country']; ?></td>
                        <td><?php echo $user['user_email']; ?></td>
                         <td><?php echo $user['user_password']; ?></td>
                        <td class='text-center'><?php echo ($user['user_status'] == 1) ? 'Active' : 'Locked' ; ?></td>
                        <td class='text-center'><?php echo ($user['user_free_acc'] == 1) ? 'Free' : 'Paid' ; ?></td>
                        <td>
                            <?php if($user['user_free_acc'] == 1) { ?>
                            <button type="button" class="btn btn-custom btn-xs btnPaid" data-userid="<?php echo $user['user_id']; ?>">Paid</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-custom btn-xs btnFree" data-userid="<?php echo $user['user_id']; ?>">Free</button>
                            <?php } ?>
                            
                            <?php if($user['user_status'] == 1) { ?>
                            <button type="button" class="btn btn-custom btn-xs btnLock" data-userid="<?php echo $user['user_id']; ?>">Lock</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-custom btn-xs btnUnLock" data-userid="<?php echo $user['user_id']; ?>">UnLock</button>
                            <?php } ?>
                            <button type="button" class="btn btn-custom btn-xs btnLogin" id="btnLogin" data-userid="<?php echo $user['user_id']; ?>">Login</button>
                             <!-- <button type="button" class="btn btn-info btn-xs" id="btnUpdate">Update</button> -->
                        </td>
                    </tr>
                <?php $i++;} ?>
            </tbody>
            <tfoot>
                <td>Total</td>
                <td class='text-center'><?php  echo $count;?></td>
            </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $(".btnLock").click(function(){
        user_id = $(this).data('userid'); // get user_id from click
        var r = confirm("Are you sure you want to lock this user?");
        if (r == true) {
            window.location = 'admin-lock-account/' + user_id;
        } else {
            
        }
    });
});

$(document).ready(function(){
    $(".btnUnLock").click(function(){
        user_id = $(this).data('userid'); // get user_id from click
        var r = confirm("Are you sure you want to unlock this user?");
        if (r == true) {
            window.location = 'admin-unlock-account/' + user_id;
        } else {
            
        }
    });
});

$(document).ready(function(){
    $(".btnPaid").click(function(){
        user_id = $(this).data('userid'); // get user_id from click
        var r = confirm("Are you sure you want to change account type to Paid?");
        if (r == true) {
            window.location = 'admin-paid-account/' + user_id;
        } else {
            
        }
    });
});

$(document).ready(function(){
    $(".btnFree").click(function(){
        user_id = $(this).data('userid'); // get user_id from click
        var r = confirm("Are you sure you want to change account type to Free?");
        if (r == true) {
            window.location = 'admin-free-account/' + user_id;
        } else {
            
        }
    });
});

$(document).ready(function(){
    $(".btnLogin").click(function(){
        user_id = $(this).data('userid'); // get user_id from click
            window.location = 'admin-login/' + user_id;
    });
});

</script>
