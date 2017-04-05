<div class="col-md-12 col-xs-12">
    <div class='table-responsive'>
        <table id='dtSupplier' class='table table-striped table-bordered table-full-width' cellspacing='0' width='100%'>
            <thead>
                <tr>
                    <th class='text-center'><button type="button" class="btn btn-custom" id="btnAddRow">+</button></th>
                    <th class='text-center' colspan="4">EBAY URL</th>
                    <th class='text-center' colspan="5">SU URL</th>
                    <th class='text-center' colspan="4">LOGICAL OPERATIONS</th>
                    <th class='text-center'></th>
                </tr>
                <tr>
                    <th class="text-center">Combined ID</th>
                    <!-- EBAY URL -->
                    <th class="text-center">eBay ID</th>
                    <th class="text-center">eBay Name</th>
                    <th class="text-center">eBay Fee</th>
                    <th class="text-center">Paypal Fee</th>
                    <!-- SU URL -->
                    <th class="text-center">SU</th>
                    <th class="text-center">SU Link</th>
                    <th class="text-center">SU ID</th>
                    <th class="text-center">SU Name</th>
                    <th class="text-center">Cost</th>
                    <!-- LOGICAL OPERATIONS -->
                    <th class="text-center">RRP</th>
                    <th class="text-center">ERP</th>
                    <th class="text-center">Estimate Profit (<?php echo $curUnit_3; ?>)</th>
                    <th class="text-center">Note</th>
                    <!-- Buttons -->
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tfoot>
            <tr>
                <th class="text-center isSearch">Combined ID</th>
                <!-- EBAY URL -->
                <th class="text-center isSearch">eBay ID</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <!-- SU URL -->
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center isSearch">SU ID</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <!-- LOGICAL OPERATIONS -->
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <!-- Buttons -->
                <th class="text-center"></th>
            </tr>
            </tfoot>
            <tbody>
                <?php
                $stt = 1;
                foreach($supplierInfo as $info)
                { ?>
                <tr data-stt=<?php echo $stt ?>>
                    <td class="text-center"><label class="lbl-combinedID" id="txtCombineID_<?php echo $stt ?>"><?php echo $info['combined_id']; ?></label></td>
                    <td>
                        <input type="text" name="ebayID" id="txtEbayID_<?php echo $stt ?>" class="form-control min-width-100" value = "<?php echo $info['eBay_id']; ?>"/>
                        <label class="hidden" id="lbEbayID_<?php echo $stt ?>"><?php echo $info['eBay_id']; ?></label>
                    </td>
                    <td><label id="txtEbayName_<?php echo $stt ?>" class="wrap-text-200 cls-copy" title='Click to copy'><?php echo $info['eBay_name']; ?></label></td>
                    <td class="text-center"><label id="txtEbayFee_<?php echo $stt ?>"><?php echo $info['eBay_fee']; ?></label></td>
                    <td class="text-center"><label id="txtPaypalFee_<?php echo $stt ?>"><?php echo $info['paypal_fee']; ?></label></td>
                    <td>
                        <select>
                            <option>Aliexpress</option>
                        </select>
                    </td>
                    <td><input type="text" name="SULink" id="txtSULink_<?php echo $stt ?>" class="form-control SULink min-width-100" value = "<?php echo $info['su_url']; ?>"/></td>
                    <td class="text-center"><label id="txtSUID_<?php echo $stt ?>" class="cls-copy" title='Click to copy'><?php echo $info['su_id']; ?></label></td>
                    <td><label id="txtSUName_<?php echo $stt ?>" class="wrap-text-200 cls-copy" title='Click to copy'><?php echo $info['su_name']; ?></label></td>
                    <td class="text-center"><label id="txtSUCost_<?php echo $stt ?>"><?php echo $info['cost']; ?></label></td>
                    <td class="text-center min-width-90"><label id="txtRRP_<?php echo $stt ?>"><?php echo $info['rrp']; ?></label>
                        <?php if($info['rrp_status'] == 1) { ?>
                        <i class="fa fa-angle-double-up red-color"></i>
                        <?php } else if($info['rrp_status'] == -1) { ?>
                        <i class="fa fa-angle-double-down green-color"></i>
                        <?php } else { ?>
                        <i class="fa fa-minus black-color"></i>        
                        <?php } ?>
                    </td>
                    <td class="text-center"><label id="txtERP_<?php echo $stt ?>"><?php echo $info['erp']; ?></label></td>
                    <td class="text-center"><label id="txtEstimateProfit_<?php echo $stt ?>"><?php echo $info['estimate_profit']; ?></label></td>
                    <td><input type="textarea" name="note" id="txtNote_<?php echo $stt ?>" value="<?php echo $info['note']; ?>"/></td>
                    <td><button type="button" class="btn btn-custom" name="btnSave" id="btnSave_<?php echo $stt ?>">Save</button></td>
                </tr>
                <?php $stt++; } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // Press enter event
        $(document).on('keypress','input[name="SULink"]', function(e){
            var theRow = $(this).closest('tr');
            var tr_stt = theRow.attr("data-stt");
            var EBayID = $("#txtEbayID_"+tr_stt).val();
            var ERP = $("#txtERP_"+tr_stt).text();
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) {
                var SUurl = $(this).val();
                if(SUurl == ""){
                    return false;
                }
                
                if(ERP == ""){
                    ERP = 0;
                }
                
                $.ajax({
                    url:"<?php echo base_url('getItemForAliExpress');?>",
                    type: "POST",
                    data:{
                        SUurl: SUurl,
                        ERP: ERP
                    },
                    dataType:"json",
                    success:function(data)
                    {
                        var productID = data['id'];
                        var name = data['name'];
                        var price = data['price'];
                        var estProfit = data['estProfit'];
                        var RRP = data['RRP'];
                        var combineID = $("#txtCombineID_"+tr_stt).text();
                        $("#txtSUID_"+tr_stt).text(productID);
                        $("#txtSUName_"+tr_stt).text(name);
                        $("#txtSUCost_"+tr_stt).text(price);
                        $("#txtRRP_"+tr_stt).text(RRP);
                        
                        if (EBayID != "")
                        {
                            //$("#txtCombineID_"+tr_stt).text(EBayID + itemID);
                            if(ERP != ""){
                                $("#txtEstimateProfit_"+tr_stt).text(estProfit);
                            }
                        }
                    }
                });
            }
        });
        
        $(document).on('keypress','input[name="ebayID"]', function(e){
            var theRow = $(this).closest('tr');
            var tr_stt = theRow.attr("data-stt");
            var SUID = $("#txtSUID_"+tr_stt).val();
            var SUCost = $("#txtSUCost_"+tr_stt).text();
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) {
                var ebayURL = $(this).val();
                $("#lbEbayID_"+tr_stt).text(ebayURL);
                
                if(ebayURL == ""){
                    return false;
                }
                
                if(SUCost == ""){
                    SUCost = 0;
                }
                
                $.ajax({
                    url:"<?php echo base_url('getItemForEbay');?>",
                    type: "POST",
                    data:{
                        ebayURL: ebayURL,
                        SUCost: SUCost
                    },
                    dataType:"json",
                    success:function(data)
                    {
                        var name = data['name'][0];
                        var ebayPrice = data['ebayPrice'];
                        var ebayFee = data['ebayFee'];
                        var paypalFee = data['paypalFee'];
                        var estProfit = data['estProfit'];
                        //var combineID = $("#txtCombineID_"+tr_stt).text();
                        $("#txtEbayName_"+tr_stt).text(name);
                        $("#txtEbayFee_"+tr_stt).text(ebayFee);
                        $("#txtPaypalFee_"+tr_stt).text(paypalFee);
                        $("#txtERP_"+tr_stt).text(ebayPrice);
                        if (SUID != "")
                        {
                            //$("#txtCombineID_"+tr_stt).text(itemID + SUID);
                            if(SUCost != ""){
                                $("#txtEstimateProfit_"+tr_stt).text(estProfit);
                            }
                        }
                    }
                });
            }
        });
        
        // Add new a row
        $("#btnAddRow").click(function(){
            var stt = 1;
			if($(".dataTables_empty").length > 0){
				$(".dataTables_empty").remove();
				stt = 0;
			}
			
            var szHTML = "";
            stt += $('#dtSupplier > tbody > tr').length;
            szHTML += "<tr data-stt='"+stt+"'>";
            // Add 20 column to a row
            szHTML += "<td class='text-center'><label id='txtCombineID_"+stt+"'>"+stt+"</label></td>";
            szHTML += "<td><input type='text' name='ebayID' id='txtEbayID_"+stt+"' class='form-control min-width-100'/><label class='hidden' id='lbEbayID_"+stt+"'></label></td>";
            szHTML += "<td><label id='txtEbayName_"+stt+"' class='wrap-text-200 cls-copy' title='Click to copy'></label></td>";
            szHTML += "<td class='text-center'><label id='txtEbayFee_"+stt+"'></label></td>";
            szHTML += "<td class='text-center'><label id='txtPaypalFee_"+stt+"'></label></td>";
            szHTML += "<td><select><option>Aliexpress</option></select></td>";
            szHTML += "<td><input type='text' name='SULink' id='txtSULink_"+stt+"' class='form-control SULink min-width-100'/></td>";
            szHTML += "<td class='text-center'><label id='txtSUID_"+stt+"' class='cls-copy' title='Click to copy'></label></td>";
            szHTML += "<td><label id='txtSUName_"+stt+"' class='wrap-text-200 cls-copy' title='Click to copy'></label></td>";
            szHTML += "<td class='text-center'><label id='txtSUCost_"+stt+"'></label></td>";
            szHTML += "<td class='text-center min-width-90'><label id='txtRRP_"+stt+"'></td>";
            szHTML += "<td class='text-center'><label id='txtERP_"+stt+"'></td>";
            szHTML += "<td class='text-center'><label id='txtEstimateProfit_"+stt+"'></td>";
            szHTML += "<td><input type='textarea' name='note' id='txtNote_"+stt+"'/></td>";
            szHTML += "<td><button type='button' class='btn btn-custom' name='btnSave' id='btnSave_"+stt+"'>Save</button></td>";
            szHTML += "</tr>";
            $('#dtSupplier > tbody:last-child').append(szHTML);
        });
        
        $(document).on("click","button[name='btnSave']", function(){
            
            var base_url = '<?php echo base_url();?>';
            var theRow = $(this).closest('tr');
            var tr_stt = theRow.attr("data-stt");
            
            var CombinedID = $("#txtCombineID_"+tr_stt).text();
            
            var EBayID = $("#txtEbayID_"+tr_stt).val();
            var EBayName = $("#txtEbayName_"+tr_stt).text();
            var EBayFee = $("#txtEbayFee_"+tr_stt).text();
            var PaypalFee = $("#txtPaypalFee_"+tr_stt).text();
            
            var SULink = $("#txtSULink_"+tr_stt).val();
            var SUID = $("#txtSUID_"+tr_stt).text();
            var SUName = $("#txtSUName_"+tr_stt).text();
            var SUCost = $("#txtSUCost_"+tr_stt).text();
            
            var RRP = $("#txtRRP_"+tr_stt).text();
            var ERP = $("#txtERP_"+tr_stt).text();
            var EstimateProfit = $("#txtEstimateProfit_"+tr_stt).text();
            var Note = $("#txtNote_"+tr_stt).val();
            
            $.ajax({
               type: "POST",
               url: base_url + "admin-save-supplier",
               data: {
                 CombinedID: CombinedID,
                 EBayID: EBayID,
                 EBayName: EBayName,
                 EBayFee: EBayFee,
                 PaypalFee: PaypalFee,
                 SULink: SULink,
                 SUID: SUID,
                 SUName: SUName,
                 SUCost: SUCost,
                 RRP: RRP,
                 ERP: ERP,
                 EstimateProfit: EstimateProfit,
                 Note: Note
               },
               dataType: "text",
               success:function(data)
               {
                   if (data != "")
                   alert(data);
               }
            });
        });
        
        var ClipboardHelper = {
            copyElement: function ($element)
            {
               this.copyText($element.text())
            },
            copyText:function(text) // Linebreaks with \n
            {
                var $tempInput =  $("<textarea>");
                $("body").append($tempInput);
                $tempInput.val(text).select();
                document.execCommand("copy");
                $tempInput.remove();
            }
        };
        
        $(document).on('click','.cls-copy', function(e) {
            console.log($(this).text());
            ClipboardHelper.copyText($(this).text());
        });
    });
</script>