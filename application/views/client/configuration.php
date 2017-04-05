<div class="col-md-offset-3 col-md-6 col-xs-12">
    <form method="POST" action="<?php echo base_url('change-config');?>">
        <div class='form-group'>
            <label class='error-red'><?php if(isset($msg)) echo $msg;?></label>
        </div>
        <div class='form-group'>
            <label for="fullname">Do you have an eBay store or you are just a normal eBay seller? </label>
            <div class="radio">
                <label>
                    <input type="radio" name="epOption" value="ep1" <?php if($userConfig['config_ep'] == 'ep1') echo "checked"; else if($userConfig['config_ep'] == '') echo "checked";?>>
                    No, I am just a normal eBay seller.
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="epOption" value="ep2" <?php if($userConfig['config_ep'] == 'ep2') echo "checked";?>>
                    Yes, I have an eBay store.
                </label>
            </div>
            <strong class='error-red'><?php echo form_error('epOption'); ?></strong>
        </div>
        <div class='form-group'>
            <label>Current Currencise:</label>
            <div class="col-md-12 col-xs-12">
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered table-full-width' cellspacing='0' width='100%'>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <select class="form-control" id="paypalUnit" name='paypalUnit'>
                                    <option value="USD" <?php if($userConfig['config_currency_unit_paypal'] == 'USD') echo "selected";?>>$ USD</option>
                                    <option value="EUR" <?php if($userConfig['config_currency_unit_paypal'] == 'EUR') echo "selected";?>>€ EUR</option>
                                    <option value="AUD" <?php if($userConfig['config_currency_unit_paypal'] == 'AUD') echo "selected";?>>$ AUD</option>
                                    <option value="CAD" <?php if($userConfig['config_currency_unit_paypal'] == 'CAD') echo "selected";?>>$ CAD</option>
                                    <option value="GBP" <?php if($userConfig['config_currency_unit_paypal'] == 'GBP') echo "selected";?>>£ GBP</option>
                                    <option value="RUB" <?php if($userConfig['config_currency_unit_paypal'] == 'RUB') echo "selected";?>>руб. RUB</option>
                                    <option value="JPY" <?php if($userConfig['config_currency_unit_paypal'] == 'JPY') echo "selected";?>>¥ JPY</option>
                                    <option value="VND" <?php if($userConfig['config_currency_unit_paypal'] == 'VND') echo "selected";?>>₫ VND</option>
                                </select>
                            </td>
                            <td class="text-center">Paypal</td>
                            <td class="text-center">=</td>
                            <td><input type="text" id="mValue" class="form-control" name='mValue' value="<?php echo $userConfig['config_currency_unit_paypal_value'];?>"/></td>
                            <td>
                                <select class="form-control" id="mUnit" name='mUnit'>
                                    <option value="USD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'USD') echo "selected";?>>$ USD</option>
                                    <option value="EUR" <?php if($userConfig['config_currency_unit_paypal_su'] == 'EUR') echo "selected";?>>€ EUR</option>
                                    <option value="AUD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'AUD') echo "selected";?>>$ AUD</option>
                                    <option value="CAD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'CAD') echo "selected";?>>$ CAD</option>
                                    <option value="GBP" <?php if($userConfig['config_currency_unit_paypal_su'] == 'GBP') echo "selected";?>>£ GBP</option>
                                    <option value="RUB" <?php if($userConfig['config_currency_unit_paypal_su'] == 'RUB') echo "selected";?>>руб. RUB</option>
                                    <option value="JPY" <?php if($userConfig['config_currency_unit_paypal_su'] == 'JPY') echo "selected";?>>¥ JPY</option>
                                    <option value="VND" <?php if($userConfig['config_currency_unit_paypal_su'] == 'VND') echo "selected";?>>₫ VND</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <select class="form-control" id="suUnit" name='suUnit'>
                                    <option value="USD" <?php if($userConfig['config_currency_unit_su'] == 'USD') echo "selected";?>>$ USD</option>
                                    <option value="EUR" <?php if($userConfig['config_currency_unit_su'] == 'EUR') echo "selected";?>>€ EUR</option>
                                    <option value="AUD" <?php if($userConfig['config_currency_unit_su'] == 'AUD') echo "selected";?>>$ AUD</option>
                                    <option value="CAD" <?php if($userConfig['config_currency_unit_su'] == 'CAD') echo "selected";?>>$ CAD</option>
                                    <option value="GBP" <?php if($userConfig['config_currency_unit_su'] == 'GBP') echo "selected";?>>£ GBP</option>
                                    <option value="RUB" <?php if($userConfig['config_currency_unit_su'] == 'RUB') echo "selected";?>>руб. RUB</option>
                                    <option value="JPY" <?php if($userConfig['config_currency_unit_su'] == 'JPY') echo "selected";?>>¥ JPY</option>
                                    <option value="VND" <?php if($userConfig['config_currency_unit_su'] == 'VND') echo "selected";?>>₫ VND</option>
                                </select>
                            </td>
                            <td class="text-center">SU</td>
                            <td class="text-center">=</td>
                            <td><input type="text" id="nValue" class="form-control" name='nValue' value="<?php echo $userConfig['config_currency_unit_su_value'];?>"/></td>
                            <td>
                                <select class="form-control" id="nUnit">
                                    <option value="USD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'USD') echo "selected";?>>$ USD</option>
                                    <option value="EUR" <?php if($userConfig['config_currency_unit_paypal_su'] == 'EUR') echo "selected";?>>€ EUR</option>
                                    <option value="AUD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'AUD') echo "selected";?>>$ AUD</option>
                                    <option value="CAD" <?php if($userConfig['config_currency_unit_paypal_su'] == 'CAD') echo "selected";?>>$ CAD</option>
                                    <option value="GBP" <?php if($userConfig['config_currency_unit_paypal_su'] == 'GBP') echo "selected";?>>£ GBP</option>
                                    <option value="RUB" <?php if($userConfig['config_currency_unit_paypal_su'] == 'RUB') echo "selected";?>>руб. RUB</option>
                                    <option value="JPY" <?php if($userConfig['config_currency_unit_paypal_su'] == 'JPY') echo "selected";?>>¥ JPY</option>
                                    <option value="VND" <?php if($userConfig['config_currency_unit_paypal_su'] == 'VND') echo "selected";?>>₫ VND</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class='form-group'>
            <label for="fullname">Minimum Profit Percentage: </label>
            <input type="number" class="form-control" name="min_profit_per" min="0" id="min_profit_per" value="<?php echo $userConfig['config_min_profit_per'];?>">
            <strong class='error-red'><?php echo form_error('min_profit_per'); ?></strong>
        </div>
        <div class='form-group'>
            <label for="fullname">Announce to email: </label>
            <input type="email" class="form-control" name="announce_email" min="0" id="announce_email" required value="<?php echo $userConfig['config_announce_email'];?>">
            <strong class='error-red'><?php echo form_error('announce_email'); ?></strong>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="btn btn-custom">
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       $("#nUnit").change(function(){
            var selectedValue = $(this).val();
            $("#mUnit").val(selectedValue);
       });
       
       $("#mUnit").change(function(){
           var selectedValue = $(this).val();
            $("#nUnit").val(selectedValue);
       });
    });
</script>