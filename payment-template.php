<?php
/*
Template Name: Payment Page
*/

get_header();



?>
<style>
    .paymentClass{
    padding: 16rem 0;
    z-index: 1000;
}
.d_logo img {
    background-color: #000;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 20px;
}
input#pay_curr {
    border-bottom: 1px solid #ccc;
    background: transparent !important;
    box-shadow: none !important;
    border-top: 0;
    border-right: 0;
    border-left: 0;
    margin-left: 12px;
    font-size: 3.5rem;
    -webkit-appearance: none !important;
    outline: none;
    color:#4f92e9;
    padding-left:24px;
    font-weight: 600;
}
input#pay_curr::placeholder {
    color: #4f92e9;
    font-weight: 600;
    padding-left: 24px;
}
label.label1 {
    font-weight: 600 !important;
    color: #4f92e9;
    font-size: 3rem;
}
input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
input#desc {
    background: transparent;
    box-shadow: none;
}
.desc_field label {
    font-size: 20px;
    margin-top: 28px;
    font-weight: 600;
}
/* button.btn.btn-lg {
    background: #ffc439;
    width: 200px;
} */
input[type="image"] {
    background: #ffc439;
    width: 170px;
    padding: 5px 24px;
    border-radius: 10px;
}
button.stripe_checkout,button.stripe_checkout1{
    background: rgb(0, 116, 212) !important;
}
.form-control{
    padding: 0.375rem 0.75rem !important;
}

</style>
<div class="paymentHeader1">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
             
               <div class="paymentClass d-flex justify-content-center">
               <div class="card text-center rounded cus-card" style="width:35rem">
                <div class="card-body cus-body">
                <?php 
               if(isset($_GET['check']))
               {
                   $ex = explode('-',base64_decode($_GET['check']));
                   if($ex[1] == 'GBP')
				   {
					   $curr = 'EUR';
				   }
				   else{
					   $curr = strtoupper($ex[1]);
				   }
				   $url = "https://www.paypal.com/sdk/js?client-id=AVyJLLFd21AS53NXC2gEWE7W2MI2MX-sbLUpV3LMkvxC59ngB4J7w-LKevUYm0kCds_2ro6A_LWpMvkx&currency=$curr&commit=false";
               }
               ?>
                    <div class="d_logo"><img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/11/logo.png" class="img-fluid" id="d_logo"></div>
                    <?php if(strtolower($ex[0]) !== 'paypal'): ?>
                    <form id="ourForm" method="POST">
                    <?php endif; ?>
                    <input type="hidden" id="checkMethod" value="<?php echo strtolower($ex[0]); ?>">
                    <input type="hidden" id="createNonce" value="<?php echo wp_create_nonce( 'payNow' ); ?>">
                    <input type="hidden" id="currency" value="<?php echo $ex[1]; ?>">
                    <div class="d-flex justify-content-center cus-currency">
                    <?php if(strtolower($ex[1]) == 'usd'): ?>        
                    <label for="pay_curr" class="label1"><?php echo '$';?></label>
                    <?php elseif(strtolower($ex[1]) == 'gbp'): ?>
                    <label for="pay_curr" class="label1"><?php echo '£';?></label>
                    <?php elseif(strtolower($ex[1]) == 'cad'): ?>
                        <label for="pay_curr" class="label1"><?php echo '$';?></label>
                    <?php endif; ?>
                    <?php if ( strpos( $ex[2], "." ) !== false ):?>
                    <input type="number" class="w-50" name="pay_curr"  disabled value="<?php echo $ex[2]; ?>" id="pay_curr" placeholder="0.00">
                    <?php else: ?>
                        <input type="number" class="w-50" name="pay_curr"  disabled value="<?php echo $ex[2].'.00'; ?>" id="pay_curr" placeholder="0.00">
                    <?php endif; ?>
                    </div>
                    <div class="form-group desc_field">
                        <label for="desc">Description: </label>
                        <input type="text" name="desc" id="desc" value="<?php echo $ex[3]; ?>" class="form-control border-0 bg-none" placeholder="description..">
                    </div>
                    <?php if(strtolower($ex[0]) === 'paypal'): ?>
                    <div class="form-group">
                     <div id="paypal-button-container"></div>
						<?php /*echo do_shortcode('[wp_paypal button="buynow" name="Your payment" amount="'.$ex[2].'" currency="'.$ex[1].'"]');*/?>   
                    <!-- <button type="submit" class="btn btn-lg "><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxcHgiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAxMDEgMzIiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaW5ZTWluIG1lZXQiIHhtbG5zPSJodHRwOiYjeDJGOyYjeDJGO3d3dy53My5vcmcmI3gyRjsyMDAwJiN4MkY7c3ZnIj48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDEyLjIzNyAyLjggTCA0LjQzNyAyLjggQyAzLjkzNyAyLjggMy40MzcgMy4yIDMuMzM3IDMuNyBMIDAuMjM3IDIzLjcgQyAwLjEzNyAyNC4xIDAuNDM3IDI0LjQgMC44MzcgMjQuNCBMIDQuNTM3IDI0LjQgQyA1LjAzNyAyNC40IDUuNTM3IDI0IDUuNjM3IDIzLjUgTCA2LjQzNyAxOC4xIEMgNi41MzcgMTcuNiA2LjkzNyAxNy4yIDcuNTM3IDE3LjIgTCAxMC4wMzcgMTcuMiBDIDE1LjEzNyAxNy4yIDE4LjEzNyAxNC43IDE4LjkzNyA5LjggQyAxOS4yMzcgNy43IDE4LjkzNyA2IDE3LjkzNyA0LjggQyAxNi44MzcgMy41IDE0LjgzNyAyLjggMTIuMjM3IDIuOCBaIE0gMTMuMTM3IDEwLjEgQyAxMi43MzcgMTIuOSAxMC41MzcgMTIuOSA4LjUzNyAxMi45IEwgNy4zMzcgMTIuOSBMIDguMTM3IDcuNyBDIDguMTM3IDcuNCA4LjQzNyA3LjIgOC43MzcgNy4yIEwgOS4yMzcgNy4yIEMgMTAuNjM3IDcuMiAxMS45MzcgNy4yIDEyLjYzNyA4IEMgMTMuMTM3IDguNCAxMy4zMzcgOS4xIDEzLjEzNyAxMC4xIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDM1LjQzNyAxMCBMIDMxLjczNyAxMCBDIDMxLjQzNyAxMCAzMS4xMzcgMTAuMiAzMS4xMzcgMTAuNSBMIDMwLjkzNyAxMS41IEwgMzAuNjM3IDExLjEgQyAyOS44MzcgOS45IDI4LjAzNyA5LjUgMjYuMjM3IDkuNSBDIDIyLjEzNyA5LjUgMTguNjM3IDEyLjYgMTcuOTM3IDE3IEMgMTcuNTM3IDE5LjIgMTguMDM3IDIxLjMgMTkuMzM3IDIyLjcgQyAyMC40MzcgMjQgMjIuMTM3IDI0LjYgMjQuMDM3IDI0LjYgQyAyNy4zMzcgMjQuNiAyOS4yMzcgMjIuNSAyOS4yMzcgMjIuNSBMIDI5LjAzNyAyMy41IEMgMjguOTM3IDIzLjkgMjkuMjM3IDI0LjMgMjkuNjM3IDI0LjMgTCAzMy4wMzcgMjQuMyBDIDMzLjUzNyAyNC4zIDM0LjAzNyAyMy45IDM0LjEzNyAyMy40IEwgMzYuMTM3IDEwLjYgQyAzNi4yMzcgMTAuNCAzNS44MzcgMTAgMzUuNDM3IDEwIFogTSAzMC4zMzcgMTcuMiBDIDI5LjkzNyAxOS4zIDI4LjMzNyAyMC44IDI2LjEzNyAyMC44IEMgMjUuMDM3IDIwLjggMjQuMjM3IDIwLjUgMjMuNjM3IDE5LjggQyAyMy4wMzcgMTkuMSAyMi44MzcgMTguMiAyMy4wMzcgMTcuMiBDIDIzLjMzNyAxNS4xIDI1LjEzNyAxMy42IDI3LjIzNyAxMy42IEMgMjguMzM3IDEzLjYgMjkuMTM3IDE0IDI5LjczNyAxNC42IEMgMzAuMjM3IDE1LjMgMzAuNDM3IDE2LjIgMzAuMzM3IDE3LjIgWiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMwMDMwODciIGQ9Ik0gNTUuMzM3IDEwIEwgNTEuNjM3IDEwIEMgNTEuMjM3IDEwIDUwLjkzNyAxMC4yIDUwLjczNyAxMC41IEwgNDUuNTM3IDE4LjEgTCA0My4zMzcgMTAuOCBDIDQzLjIzNyAxMC4zIDQyLjczNyAxMCA0Mi4zMzcgMTAgTCAzOC42MzcgMTAgQyAzOC4yMzcgMTAgMzcuODM3IDEwLjQgMzguMDM3IDEwLjkgTCA0Mi4xMzcgMjMgTCAzOC4yMzcgMjguNCBDIDM3LjkzNyAyOC44IDM4LjIzNyAyOS40IDM4LjczNyAyOS40IEwgNDIuNDM3IDI5LjQgQyA0Mi44MzcgMjkuNCA0My4xMzcgMjkuMiA0My4zMzcgMjguOSBMIDU1LjgzNyAxMC45IEMgNTYuMTM3IDEwLjYgNTUuODM3IDEwIDU1LjMzNyAxMCBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA2Ny43MzcgMi44IEwgNTkuOTM3IDIuOCBDIDU5LjQzNyAyLjggNTguOTM3IDMuMiA1OC44MzcgMy43IEwgNTUuNzM3IDIzLjYgQyA1NS42MzcgMjQgNTUuOTM3IDI0LjMgNTYuMzM3IDI0LjMgTCA2MC4zMzcgMjQuMyBDIDYwLjczNyAyNC4zIDYxLjAzNyAyNCA2MS4wMzcgMjMuNyBMIDYxLjkzNyAxOCBDIDYyLjAzNyAxNy41IDYyLjQzNyAxNy4xIDYzLjAzNyAxNy4xIEwgNjUuNTM3IDE3LjEgQyA3MC42MzcgMTcuMSA3My42MzcgMTQuNiA3NC40MzcgOS43IEMgNzQuNzM3IDcuNiA3NC40MzcgNS45IDczLjQzNyA0LjcgQyA3Mi4yMzcgMy41IDcwLjMzNyAyLjggNjcuNzM3IDIuOCBaIE0gNjguNjM3IDEwLjEgQyA2OC4yMzcgMTIuOSA2Ni4wMzcgMTIuOSA2NC4wMzcgMTIuOSBMIDYyLjgzNyAxMi45IEwgNjMuNjM3IDcuNyBDIDYzLjYzNyA3LjQgNjMuOTM3IDcuMiA2NC4yMzcgNy4yIEwgNjQuNzM3IDcuMiBDIDY2LjEzNyA3LjIgNjcuNDM3IDcuMiA2OC4xMzcgOCBDIDY4LjYzNyA4LjQgNjguNzM3IDkuMSA2OC42MzcgMTAuMSBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA5MC45MzcgMTAgTCA4Ny4yMzcgMTAgQyA4Ni45MzcgMTAgODYuNjM3IDEwLjIgODYuNjM3IDEwLjUgTCA4Ni40MzcgMTEuNSBMIDg2LjEzNyAxMS4xIEMgODUuMzM3IDkuOSA4My41MzcgOS41IDgxLjczNyA5LjUgQyA3Ny42MzcgOS41IDc0LjEzNyAxMi42IDczLjQzNyAxNyBDIDczLjAzNyAxOS4yIDczLjUzNyAyMS4zIDc0LjgzNyAyMi43IEMgNzUuOTM3IDI0IDc3LjYzNyAyNC42IDc5LjUzNyAyNC42IEMgODIuODM3IDI0LjYgODQuNzM3IDIyLjUgODQuNzM3IDIyLjUgTCA4NC41MzcgMjMuNSBDIDg0LjQzNyAyMy45IDg0LjczNyAyNC4zIDg1LjEzNyAyNC4zIEwgODguNTM3IDI0LjMgQyA4OS4wMzcgMjQuMyA4OS41MzcgMjMuOSA4OS42MzcgMjMuNCBMIDkxLjYzNyAxMC42IEMgOTEuNjM3IDEwLjQgOTEuMzM3IDEwIDkwLjkzNyAxMCBaIE0gODUuNzM3IDE3LjIgQyA4NS4zMzcgMTkuMyA4My43MzcgMjAuOCA4MS41MzcgMjAuOCBDIDgwLjQzNyAyMC44IDc5LjYzNyAyMC41IDc5LjAzNyAxOS44IEMgNzguNDM3IDE5LjEgNzguMjM3IDE4LjIgNzguNDM3IDE3LjIgQyA3OC43MzcgMTUuMSA4MC41MzcgMTMuNiA4Mi42MzcgMTMuNiBDIDgzLjczNyAxMy42IDg0LjUzNyAxNCA4NS4xMzcgMTQuNiBDIDg1LjczNyAxNS4zIDg1LjkzNyAxNi4yIDg1LjczNyAxNy4yIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDA5Y2RlIiBkPSJNIDk1LjMzNyAzLjMgTCA5Mi4xMzcgMjMuNiBDIDkyLjAzNyAyNCA5Mi4zMzcgMjQuMyA5Mi43MzcgMjQuMyBMIDk1LjkzNyAyNC4zIEMgOTYuNDM3IDI0LjMgOTYuOTM3IDIzLjkgOTcuMDM3IDIzLjQgTCAxMDAuMjM3IDMuNSBDIDEwMC4zMzcgMy4xIDEwMC4wMzcgMi44IDk5LjYzNyAyLjggTCA5Ni4wMzcgMi44IEMgOTUuNjM3IDIuOCA5NS40MzcgMyA5NS4zMzcgMy4zIFoiPjwvcGF0aD48L3N2Zz4" alt="paypal Button" class="img-fluid"></button> -->
                    </div>
                    <?php else: ?>
                        <div class="form-group">
                       <button type="button" class="btn btn-lg stripe_checkout1 text-white">Checkout</button>
                    </div>
                    <?php endif; ?>
                    <div class="row text-left" id="stripeForm" style="display:none;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="s_email">Email</label>
                                <input type="text" name="s_email" id="s_email" class="form-control rounded-0">
                            </div>
                           
                            <div class="form-group">
                                <label for="card_holder_name">Card Number</label>
                                <input type="number" class="form-control rounded-0" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" maxlength="16" min="13" id="card_number" name="card_number" placeholder="Enter card number">
                                <div class="error_number py-2"></div>
                            </div>
                            <div class="form-group text-center">
                    <label for="card_expiry" >Expiry Month / Year / CVC</label>
                    <div class="d-flex flex-row justify-content-center">
                    <select name="month" id="month"
                            class="form-control rounded-0 w-25">
                          
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select name="year" id="year"
                            class="form-control rounded-0 w-25 ml-3">
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
                            <option value="28">2028</option>
                            <option value="29">2029</option>
                            <option value="30">2030</option>
                        </select>
                        
         
            <input type="number" name="cvc_card" min="3"  id="cvc_card" class="form-control rounded-0 w-25 ml-3">
            <div class="error_cvc py-2"></div>    

                        
            </div>
            <div class="form-group mt-3">
                       <div class="succ_msg my-3"></div>
                       <button type="submit" class="btn btn-lg  stripe_checkout text-white">Pay</button>
                    </div>
                        </div>
                    </div>
                    <?php if(strtolower($ex[0]) !== 'paypal'): ?>
                    </form>
                    <?php endif; ?>
                    
                </div>
              
                </div>
                    
            </div>
            
           </div>
       </div>
   </div> 
</div>
<?php 
			
?>
<!-- <script>
var currency = (document.querySelector('#currency').value == 'GBP') ? 'EUR': document.querySelector('#currency').value;
var url = 'https://www.paypal.com/sdk/js?client-id=AVyJLLFd21AS53NXC2gEWE7W2MI2MX-sbLUpV3LMkvxC59ngB4J7w-LKevUYm0kCds_2ro6A_LWpMvkx&currency=&commit=false';
var final_url = url.replace('currency=',`currency=${currency}`);

</script> -->

	<script src='<?php echo $url; ?>'></script>
<script>
jQuery(document).ready(function($){
    if($('#checkMethod').val() === 'paypal')
	{
		var price = parseFloat($('#pay_curr').val());  
    	console.log(price);
		paypal.Buttons({
            createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: price
                }
                }],
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                }
            });
            },
            onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
            },
            onError: function (err) {
                // For example, redirect to a specific error page
                //window.location.href = "/your-error-page-here";
                console.log("Error Occured")
            }
        }).render('#paypal-button-container');
	}
})
</script>
<?php get_footer(); ?>