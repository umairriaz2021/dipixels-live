

jQuery(document).ready(function($){
    var check = $('#checkMethod').val();
                if(check === 'stripe')
                {
                    $('.stripe_checkout1').on('click',function(){
                        $('#stripeForm').fadeIn();
                    });
                }
              
        $('#ourForm').on('submit',function(e){
                e.preventDefault();
                var check = $('#checkMethod').val();
                // if(check === 'paypal'){
                // var pay = $('#pay_curr').val();
                // var nonce = $('#createNonce').val();
                // var currency = $('#currency').val();
                // var desc = $('#desc').val();
                // var param = 'pay_paypal';
                // var action = 'stripelibrary';    
                // $.ajax({
                //     url:myajaxurl,
                //     type:'POST',
                //     data:{pay:pay,nonce:nonce,desc:desc,currency:currency,param:param,action:action},
                //     success:function(res)
                //     {
                //         console.log(res);
                //     }

                // });
                // }
                if(check == 'stripe')
                {
                    var pay = $('#pay_curr').val();
                    var nonce = $('#createNonce').val();
                    var desc = $('#desc').val();
                    var email = $('#s_email').val();
                    var cardNumber = $('#card_number').val();
                    var month = $('#month').val();
                    var year = $('#year').val();
                    console.log('year',year);
                    var cvc_card = $('#cvc_card').val();
                    var currency = $('#currency').val();
                    var param = 'pay_stripe';
                    var action = 'stripelibrary'; 
                    $.ajax({
                        url:myajaxurl,
                        type:'POST',
                        data:{pay:pay,nonce:nonce,year:year,desc:desc,currency:currency,email:email,cardNumber:cardNumber,month:month,cvc_card:cvc_card,param:param,action:action},
                        success:function(res)
                        {
                            console.log('res',res)
                            var data = $.parseJSON(res);
                            if(data.status==200)
                            {
                                $('.succ_msg').html(`<p class="alert alert-success">${data.message}</p>`);
                            }
                            else /*if(data.status==400)*/{
                                $('.succ_msg').html(`<p class="alert alert-danger" >${data.message}</p>`);
                            }
                        }
    
                    });

                }     
        });
    });