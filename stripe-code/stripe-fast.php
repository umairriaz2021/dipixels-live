<?php
 /*
Plugin Name: Stripe Fast Pay
Plugin URI: https://stripepay.er
Description: This is stripe pay simple plugin
Author Name: Umair Riaz
Author URI: https://facebook.com/umair-riaz
Version: 1.0.0
*/

require_once plugin_dir_path(__FILE__).'vendor/stripe/stripe-php/init.php';
function addsomescripts(){
 
    if(is_page_template('payment-template.php') )
	{
	
		wp_enqueue_script('ourscripts',plugins_url('/assets/js/main.js',__FILE__),array('jquery'),false,true);
		wp_localize_script('ourscripts','myajaxurl', admin_url('admin-ajax.php'));
	}


}
add_action('wp_enqueue_scripts','addsomescripts');


// function stripeForm()
// {
//   if(is_user_logged_in())
//   {
//     $user_id = wp_get_current_user()->ID;
    
     

//     $strKey = 'sk_test_51IWUaUFobdqNGyaTx4EILiJLPtFzT1YYM2rETBbZv0S1gSfUspEvIxJQiUaL3VcSVM4ISz1zQBlgV5TaVYzwQJmB00OKbYJEcF';
//     $stripe = new \Stripe\StripeClient($strKey);
   
//         \Stripe\Stripe::setApiKey($strKey);
//         $token = get_user_meta($user_id,'_stripe_customer_id',true);  
//         $get_source = $stripe->customers->retrieve(
//            $token,
//            []
//          );
//         $card = $stripe->customers->retrieveSource(
//            $token,
//            $get_source->default_source,
//            []
//          );   
//          $cardHolder = get_user_meta($user_id,'_stripe_card_holder',true);
//          $email = get_user_by('id',$user_id)->user_email;         
//          $exp_month = $card->exp_month;
//          $exp_year = $card->exp_year;
//          $card_type = $card->brand;
//          $last4 = $card->last4;
//   } 
//   require_once plugin_dir_path(__FILE__).'view/stripe_form.php';

// }
// add_shortcode('add-stripe-form','stripeForm');



function email_notify_to_student()
{
$to = 'info@dipixels.com';
$bb = 'dipixelss@gmail.com';
$subject = 'Stripe payment Done';
$body = '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><td align="center" valign="top">Thank you for your payment</tr></table>';
	
// $body = '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
// <tbody><tr>
//     <td align="center" valign="top">
//         <div id="m_889406912395423641template_header_image">
//                                     </div>
//         <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_889406912395423641template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
//             <tbody><tr>
//                 <td align="center" valign="top">
                    
//                     <table border="0" cellpadding="0" cellspacing="0" width="100%" id="m_889406912395423641template_header" style="background-color:#18a856;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
//                         <tbody><tr>
//                             <td id="m_889406912395423641header_wrapper" style="padding:36px 48px;display:block">
//                                 <h1 style="text-align:center; font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff;background-color:inherit">Congratulation</h1>
//                             </td>
//                         </tr>
//                     </tbody></table>
                    
//                 </td>
//             </tr>
//             <tr>
//                 <td align="center" valign="top">
                    
//                     <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_889406912395423641template_body">
//                         <tbody><tr>
//                             <td valign="top" id="m_889406912395423641body_content" style="background-color:#ffffff">
                                
//                                 <table border="0" cellpadding="20" cellspacing="0" width="100%">
//                                     <tbody><tr>
//                                         <td valign="top" style="padding:48px 48px 32px">
//                                             <div id="m_889406912395423641body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

// <p style="margin:0 0 16px">Hi '.$full_name.',</p>
// <p style="margin:0 0 16px">Your lesson has been marked completed by '.$inst.'</p>
// <p style="margin:0 0 16px">Please check your profile</p>
// <a href="https://learnhowtu.com/sign-in/?redirect_to=https://learnhowtu.com/" style="color:#96588a;font-weight:normal;text-decoration:underline" target="_blank" >Login to Pay Now</a>


// </tbody></table>';
$headers = [];
$headers[] = "From: Test <$to>";
$headers[] = "Cc: $bb";
$headers[] = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );
}



function stripeAjax()
{


// update Card Details

    // if($_REQUEST['param'] === 'pay_paypal')
    // {
    //   $user = get_user_by('id',2);
    //   $nonce = $_REQUEST['nonce'];
    //   if(wp_verify_nonce( $nonce,'payNow'))
    //   {
         
    //   }
    //   else{
    //     echo "No Result";
    //   }
    // }
     // Payment from Stripe   
     if($_REQUEST['param'] === 'pay_stripe'){

      $user = get_user_by('id',2);
      $total = $_REQUEST['pay'];
      $nonce = $_REQUEST['nonce'];
      $desc = $_REQUEST['desc'];
      $currency = $_REQUEST['currency'];
      $email = $_REQUEST['email'];
      $card_num = $_REQUEST['cardNumber'];
      $card_month = $_REQUEST['month'];
      $card_cvc = $_REQUEST['cvc_card'];
      $card_year = $_REQUEST['year'];
      $stripe_key = get_option('stripe_live');
      if(!wp_verify_nonce($nonce,'payNow'))
      {
        echo json_encode(['status'=>401,'message'=>'Wrong nonce']);die;
      }
      
      wp_update_user(['ID'=>$user->ID,'user_email'=>$email]);
      //echo "<pre>"; print_r($_REQUEST);die;
      
      
      //$strKey = 'sk_test_51KbOQZAzo9ZhXCJbKadcpXGpLtjTHeheQTDggHRwCBOmzMl3KJp8tCfmQl7ovnURcD3dJmdRi45b8HC35ubSABeh00p17SzgQY';
      
      
      
      
       //$get_token = get_user_meta($user_id,'_stripe_customer_id',true);
       try {
        
        $stripe = new \Stripe\StripeClient($stripe_key);
        $token = $stripe->tokens->create([
          'card' => [
            'number' => $card_num,
            'exp_month' => $card_month,
            'exp_year' => $card_year,
            'cvc' => $card_cvc,
          ],
        ]);
     
        $totalNoDec = ($total*100);
      
        $charge =  $stripe->charges->create(array(
          "amount" => $totalNoDec,
          "currency" => $currency,
          "source" => $token
          ));
    
       
        $status =  $charge['succeeded'];
         if($charge['status'] == "succeeded"){
           
           $all['payment_done'] = "1";
		   email_notify_to_student();	
    $message = array('status'=>200,'data'=>$charge,'message'=>'Your payment done successfully');			   
   }else{
       $message = array('status'=>400,'message'=>'Your Token is not generated successfully','result'=>[]);
     }
     }
     catch (Exception $e) {
     $error = $e->getMessage();
      $all['payment_done'] = "0";
      $message = array('status'=>400,'message'=>$error);
   }
    echo json_encode($message);

  }
     // Payment from Stripe Ends   

    

 wp_die();

}

add_action('wp_ajax_nopriv_stripelibrary','stripeAjax');
add_action('wp_ajax_stripelibrary','stripeAjax');





?>
