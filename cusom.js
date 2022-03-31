jQuery(document).ready(function($){
     jQuery('.slider-wrapper').slick({
		   dots: true,
		 infinite: true,
		 speed: 500,
		   slidesToShow: 1,
		 slidesToScroll: 1
  });
jQuery('.slider-wrapper .slick-dots li:first-child button').text('Corporate Design');
jQuery('.slider-wrapper .slick-dots li:nth-child(2) button').text('Web Design & Development');
jQuery('.slider-wrapper .slick-dots li:nth-child(3) button').text('Mobile App Design & Development');
jQuery('.slider-wrapper .slick-dots li:nth-child(4) button').text('Digital Marketing');
   
    // $('#wpcf7-f6930-o1').find('form .wpcf7-form').on('submit',function(e){
    //   e.preventDefault();
    //   console.log('Hello');
    //     window.onload((event) => {
    //         console.log('hello');
    //         var cht = ['#name1','#email1','#phone1'];
    //         cht.forEach((item) => {
    //             $(item).keyup(() => {
    //                 console.log('hello',item);
    //                 if($(item).val().length > 0)
    //                 {
    //                     $('#sub').prop('disabled',false);
    //                 }
    //             })
    //         })
    //     })
    // });
    // jQuery('form.wpcf7-form').on('submit',function(e){
    //     e.preventDefault();
    //     console.log('hello');
    // })
        
       


    
 
   
//     if(name !== '' && email !== '' &&  phone !== '')
//     {
        
//       $('#phone1').keyup(function(){
//         var phone = jQuery('#phone1').val();
//         if(name.length > 1)
//         {
//             $('#sub').prop('disabled',true);
//         }
//   });
    
   // }
    // $('#name1').keyup(function(){
        
    //     if(name.length == '')
    //     {
    //         jQuery('#name1').after('<span style="margin:10px 0; color:red;">Name is required</span>');
    //     }
    // });
    setTimeout(() => {
        jQuery('span.tp-bullet-title').eq(0).text('Corporate Design')
        jQuery('span.tp-bullet-title').eq(1).text('Web Design & Development')
        jQuery('span.tp-bullet-title').eq(2).text('Mobile App Design & Development')
		jQuery('span.tp-bullet-title').eq(3).text('Digital Marketing')
        jQuery('span.tp-bullet-title').eq(4).text('Video Animation & Production')        
    	jQuery('span.tp-bullet-title').eq(5).text('Content Writing')

    },3000);
    // $('#label_3_6_1').click(function(){
    //     $('#input_3_1').attr('data-name','stripe');
    // });
        localStorage.setItem('method','paypal');
        var nn = [];
        $('.gfield-choice-input').change(function () {
            if ($(this).prop("checked")) {
                if($(this).val() === 'PayPal')
                {
                    $('#input_3_1').val('');
                    $('#input_3_3').val('');
                    $('#input_3_4').val('');
                    $('.wrapId').hide();
                    localStorage.setItem('method',$(this).val());
                    $('#gform_submit_button_3').prop('disabled',false);

                }
                else if($(this).val() === 'Stripe')
                {
                    $('#input_3_1').val('');
                    $('#input_3_3').val('');
                    $('#input_3_4').val('');
                    $('.wrapId').hide();
                    localStorage.setItem('method',$(this).val());
                    $('#gform_submit_button_3').prop('disabled',false);    
                }
                
                
               //var abc = jQuery(this).val();
            }
           
            //console.log(abc);
            // not checked
        });
        // function CopyToClipboard(value, showNotification, notificationText) {
        //     var $temp = $("<input>");
        //     $("body").append($temp);
        //     $temp.val(value).select();
        //     document.execCommand("copy");
        //     $temp.remove();
        
        //     if (typeof showNotification === 'undefined') {
        //         showNotification = true;
        //     }
        //     if (typeof notificationText === 'undefined') {
        //         notificationText = "Copied to clipboard";
        //     }
        
        //     var notificationTag = $("div.copy-notification");
        //     if (showNotification && notificationTag.length == 0) {
        //         notificationTag = $("<div/>", { "class": "copy-notification", text: notificationText });
        //         $("body").append(notificationTag);
        
        //         notificationTag.fadeIn("slow", function () {
        //             setTimeout(function () {
        //                 notificationTag.fadeOut("slow", function () {
        //                     notificationTag.remove();
        //                 });
        //             }, 1000);
        //         });
        //     }
        // }

        $('#input_3_4').attr('type','number');
        $('#input_3_4').attr('min',0);
   $('#gform_submit_button_3').on('click',function(e){
       e.preventDefault();
       
       var method = localStorage.getItem('method');
       var currency = $('#input_3_8').val();
       var title = $('#input_3_1').val();
       var desc = $('#input_3_3').val();
       var amount = $('#input_3_4').val();
       if(method !=='' && currency !== '' && title !== '' && amount !== '') 
       {
        var encode = `${method}-${currency}-${amount}-${desc}`;
        var fullurl = `${window.location.origin}/payment/?check=${btoa(encode)}`;
        

           var html = `<div class="wrapId">
           <div class="ginput_container ginput_container_text" style="padding:20px 0;">
           <div class="search">
           <input name="input_4" id="input_3_99" type="text" value="${fullurl}" class="large" aria-required="true" aria-invalid="false">
           <button type="button" id="cd" style="cursor:pointer; background:rgb(0, 116, 212);"  class="searchButton">
                <i class="fa fa-file" style="color:white;"></i>
             </button>
             <div class="copy-notification" style="display:none;">
             <span style="background:red; margin-top:15px; padding:10px; color:#fff;">
             Copied
             </span>
             </div>
           </div>
           </div>
           </div>
                 `;
           $('#input_3_8').fadeIn().after(html);
          $('#cd').on('click',() => {
            var copyText = document.getElementById('input_3_99');
          
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
          
             /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
          
            /* Alert the copied text */
            
           $('.copy-notification').fadeIn();
           setTimeout(() => {
            $('.copy-notification').fadeOut()
           },2000)
            
          })
       }
       $('#gform_submit_button_3').prop('disabled',true);
   });
	
  $('.inputSearch').on('keyup',function(){
	  var search = $(this).val();
	  var param = 'search_result';
	  var action = 'prodLibrary';
	  $.ajax({
		  url:ajaxurl,
		  type:'POST',
		  data:{search:search,param:param,action:action},
		  success:function(yes)
		  {
			  
			  var data = $.parseJSON(yes);
			  if(data.status==200)
			  {
				  if(data.pro != null)
				  {
					  
					$('.prdRow').hide();
				   
				      $('.searchResult').html(data.output);
					  var bs = []; jQuery(this).remove();
					  for(var i = 0; i < data.pros.length; i++)
						{
						   bs.push(data.pros[i].replace('&amp;','&'));
						   
						}
					  
					 jQuery('.searchResult').find('h4').each(function(index,element){
						if(!bs.includes(jQuery(element).text()))
						{
							jQuery(this).remove();
						}
						
					});
				  }
				  else{
					  $('.prdRow').hide();
					  $('.searchResult').html('<div class="d-flex justify-content-center align-items-center w-100 border-1 vh-50 bg-secondary py-5 mx-3 text-white"><h4>No Match</h4></div>');
				  }
				  
			  }
			  else if(data.status==201)
			  {
				  $('.searchResult').html('');
				   $('.prdRow').fadeIn();
				  
			  }
			  
			  
		  }
		  
	  });
  });
  $(document).on('click','#showPopup',function(){
	     $('#dataShow').html('');
         var prod_id =  $(this).attr('data-id');
         var param = 'productData';
         var action = 'prodLibrary';
         $.ajax({
                url:ajaxurl,
                type:'POST',
                data:{prod_id:prod_id,param:param,action:action},
			    dataType:'json',
                success:function(res)
                {
					
					$('#dataShow').html(res.output);
					$('.updateCart').prop('disabled',true);
					jQuery('#addProd').click(function(){
						 increment();
						
						var count1 = $('#count_input').val();
						if(count1 > 0)
						{
							$('.updateCart').prop('disabled',false);
							var price = (res.price * count1);
							
							jQuery('#counter_total').text('$'+price);
							
							localStorage.setItem('counterTotal',parseFloat(price));
							localStorage.setItem('qty',parseInt(count1));
						}
						
					   });
					   jQuery('#remProd').click(function(){
						   	
						   decrement();
						  	
							var count1 = $('#count_input').val();
						    if(count1 == 0)
								{
									$('.updateCart').prop('disabled',true);
									jQuery('#counter_total').text(0);
									  localStorage.setItem('counterTotal',0)
									localStorage.setItem('qty',0);
								}
						       else{
								    var price = parseFloat(jQuery('#counter_total').text().replace('$',''));
								   
								    
								    $('.updateCart').prop('disabled',false);
									//var price1 = (res.price * count1);
								   jQuery('#counter_total').text('$'+ parseFloat(price - res.price));
								   localStorage.setItem('counterTotal',parseFloat(price - res.price))
								   localStorage.setItem('qty',parseInt(count1));
							   }
						   		
						
					   });
					
					   jQuery('.updateCart').on('click',function(){
						   var price = localStorage.getItem('counterTotal');
						   var qty = localStorage.getItem('qty');
						   var pid = jQuery(this).attr('data-attr');
						
						   var action = 'prodLibrary';
						   var param = 'cartUpdate';
						   $.ajax({
							   url:ajaxurl,
							   method:'POST',
							   data:{price:price,qty:qty,pid:pid,action:action,param:param},
							   success:function(dd)
							   {
								   var data = $.parseJSON(dd);
								   $('#prodModal').modal('hide');
								   getCart();
								   removeItem('#removeCart');
							   }
						   });
					   });
                }
         });
   });
	getCart();
	function getCart()
	{
		  var action = 'prodLibrary';
		  var param = 'getCart';
		$.ajax({
			 url:ajaxurl,
			 method:'POST',
		     data:{action:action,param:param},
			success:function(vv)
			{
				
				var data = $.parseJSON(vv);
				removeItem('#removeCart');
				
				if(data.status==200)
					{
						console.log('data',data);
						$('#cartItems').text(data.items);
						$('#cartTotal').text(`$${data.subtotal}`);
						$('#cardData').html(data.output);
						$('#gtotal').text(`$${data.total}`);
						removeItem('#removeCart');
						
						
					}
			}
		});
	}
	function removeItem(id)
	{
		$('.cartData').on('click',id,function(){
			
							var key = $(this).attr('data-key');
							
							var param = 'removeCartItem';
							var action = 'prodLibrary';
							$.ajax({
								url:ajaxurl,
								type:'POST',
								data:{key:key,param:param,action:action},
								success:function(ss)
								{
									var data = $.parseJSON(ss);
									if(data.status==200)
										{
											getCart();
										}
								}
							});
						});
	}
	function increment() {
      document.querySelector('#count_input').stepUp();
   }
   function decrement() {
       document.querySelector('#count_input').stepDown();
   }
  
})