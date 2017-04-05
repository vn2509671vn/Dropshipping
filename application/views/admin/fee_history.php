<div class="col-md-12 col-xs-12">
    <div class='table-responsive'>
        <table id='dtFeeHistory' class='table table-striped table-bordered table-full-width' cellspacing='0' width='100%'>
            <caption>
                <button type="button" class="btn btn-custom" name="btnCompute" id="btnCompute">Compute fee and send mail</button>
            </caption>
            <thead>
                <tr>
                    <th class='text-center'>#</th>
                    <th class='text-center'>User Name</th>
                    <th class='text-center'>User Mail</th>
                    <th class='text-center'>Fee</th>
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stt = 1;
                    foreach($history_list as $history){
                ?>
                <tr>
                    <td class='text-center'><?php echo $stt;?></td>
                    <td class='text-center'><strong><?php echo $history['user_name'];?></strong></td>
                    <td class='text-center'><?php echo $history['user_email'];?></td>
                    <td class='text-center'><strong><?php echo $history['fee'];?></strong></td>
                    <td class='text-center'><?php echo $history['date'];?></td>
                    <td class='text-center'><?php if($history['status']) echo "Paid"; else echo "Not Yet";?></td>
                    <td class='text-center'>
                        <?php if($history['status']){ ?>
                        <button type="button" class="btn btn-custom btn-xs btnNotYet" data-userid="<?php echo $history['user_id']; ?>" data-month="<?php echo $history['month']; ?>" data-year="<?php echo $history['year']; ?>">Not Yet</button>
                        <?php } else { ?>
                        <button type="button" class="btn btn-custom btn-xs btnPaid" data-userid="<?php echo $history['user_id']; ?>" data-month="<?php echo $history['month']; ?>" data-year="<?php echo $history['year']; ?>">Paid</button>
                        <?php } ?>
                    </td>
                </tr>
                <?php $stt++; } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#dtFeeHistory").DataTable();
        
        $("#btnCompute").click(function(){
             $.ajax({
                    url:"<?php echo base_url('computeFeeHistory');?>",
                    type: "POST",
                    dataType:"json",
                    success:function(data)
                    {
                        if(data){
                            alert("Compute fee successful");
                            window.location.reload();
                        }
                        else {
                            alert("Error: Compute fee unsuccessful");
                        }
                    }
                })
        });
        
        $(".btnPaid").click(function(){
            var user_id = $(this).data('userid'); // get user_id from click
            var month = $(this).data('month');
            var year = $(this).data('year');
            var status = 1;
            var r = confirm("Are you sure this user paid?");
            if (r == true) {
                $.ajax({
                    url:"<?php echo base_url('updateFeeHistory');?>",
                    type: "POST",
                    data: {
                        user_id: user_id,
                        month : month,
                        year : year,
                        status: status
                    },
                    dataType:"json",
                    success:function(data)
                    {
                        if(data){
                            alert("Update status successful");
                            window.location.reload();
                        }
                        else {
                            alert("Error: Update status unsuccessful");
                        }
                    }
                })
            }
        });
        
        $(".btnNotYet").click(function(){
            var user_id = $(this).data('userid'); // get user_id from click
            var month = $(this).data('month'); // get user_id from click
            var year = $(this).data('year'); // get user_id from click
            var status = 0;
            var r = confirm("Are you sure this user not yet paid?");
            if (r == true) {
                $.ajax({
                    url:"<?php echo base_url('updateFeeHistory');?>",
                    type: "POST",
                    data: {
                        user_id: user_id,
                        month : month,
                        year : year,
                        status: status
                    },
                    dataType:"json",
                    success:function(data)
                    {
                        if(data){
                            alert("Update status successful");
                            window.location.reload();
                        }
                        else {
                            alert("Error: Update status unsuccessful");
                        }
                    }
                })
            }
        });
    })
</script>