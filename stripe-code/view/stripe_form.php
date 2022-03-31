<?php
  
  $cardHolder = get_user_meta($user_id,'_stripe_card_holder',true);
  $email = get_user_by('id',$user_id)->user_email;         
  $exp_month = $card->exp_month;
  $exp_year = $card->exp_year;
  $card_type = $card->brand;
  $last4 = $card->last4;

?>


<div id="update_strip_form" class="w-75" >
<div class="container">
<div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="w-100 py-3" id="mess">

                </div>
                <div class="form-group">
                    <label for="card_holder_name">Card Holder Name</label>
                    <input type="text" class="form-control rounded-0" value="<?php echo $cardHolder; ?>" id="card_holder_name"  placeholder="Enter card holder name">
                    <div class="error_name py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_holder_name">Card Type</label>
                    <input type="card_type" class="form-control rounded-0" disabled value="<?php echo $card_type; ?>">
             
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_holder_name">Email</label>
                    <input type="email" class="form-control rounded-0" id="card_holder_email" name="card_holder_email" disabled value="<?php echo $email; ?>"  placeholder="Enter card holder email">
                    <div class="error_email py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_holder_name">Card Number</label>
                    <input type="number" class="form-control rounded-0" id="card_number" name="card_number" value="<?php echo $last4; ?>" placeholder="Enter card holder number">
                    <div class="error_number py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_expiry">Expiry Month / Year</label>
                    <div class="d-flex flex-row">
                    <select name="month" id="month"
                            class="form-control rounded-0 w-25" style="font-size:1rem;">
                            <option value="08" <?php echo ($exp_month == 8) ? 'selected' : ''; ?> >08</option>
                            <option value="09" <?php echo ($exp_month == 9) ? 'selected' : ''; ?>>9</option>
                            <option value="10" <?php echo ($exp_month == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="11" <?php echo ($exp_month == 11) ? 'selected' : ''; ?>>11</option>
                            <option value="12" <?php echo ($exp_month == 12) ? 'selected' : ''; ?>>12</option>
                        </select>
                        <select name="year" id="year"
                            class="form-control rounded-0 w-25 ml-3" style="font-size:1rem;">
                            <option value="18" <?php echo ($exp_year == 2018) ? 'selected' : ''; ?>>2018</option>
                            <option value="19" <?php echo ($exp_year == 2019) ? 'selected' : ''; ?>>2019</option>
                            <option value="20" <?php echo ($exp_year == 2020) ? 'selected' : ''; ?>>2020</option>
                            <option value="21" <?php echo ($exp_year == 2021) ? 'selected' : ''; ?>>2021</option>
                            <option value="22" <?php echo ($exp_year == 2022) ? 'selected' : ''; ?>>2022</option>
                            <option value="23" <?php echo ($exp_year == 2023) ? 'selected' : ''; ?>>2023</option>
                            <option value="24" <?php echo ($exp_year == 2024) ? 'selected' : ''; ?>>2024</option>
                            <option value="25" <?php echo ($exp_year == 2025) ? 'selected' : ''; ?>>2025</option>
                            <option value="26" <?php echo ($exp_year == 2026) ? 'selected' : ''; ?>>2026</option>
                            <option value="27" <?php echo ($exp_year == 2027) ? 'selected' : ''; ?>>2027</option>
                            <option value="28" <?php echo ($exp_year == 2028) ? 'selected' : ''; ?>>2028</option>
                            <option value="29" <?php echo ($exp_year == 2029) ? 'selected' : ''; ?>>2029</option>
                            <option value="30" <?php echo ($exp_year == 2030) ? 'selected' : ''; ?>>2030</option>
                        </select>
                        
            </div>
           
                    </div>
                   
                 
            </div>
            <div class="col-md-4 col-sm-12 col-12 d-block">
            <label for="cvc_card">CVC</label>
            <input type="number" name="cvc_card" min="3"  id="cvc_card" class="form-control rounded-0 w-50">
            <div class="error_cvc py-2"></div>    
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg ml-2" id="update_stripe_btn">Update Card</button>
        </div>
        </div>
</div>
</div>