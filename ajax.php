<?php
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function tableLoopFinalResult($data,$args)
{
	 $nn = [];
    foreach($data as $key => $val)
    {

    if(in_array($val->term_taxonomy_id,$args))
    {
        
        array_push($nn,$val->object_id);
    }
    
    }

    return $nn;
}
function tableLoopAjax($data,$id)
{
    $nn = [];
    foreach($data as $key => $val)
    {

    if($val->term_taxonomy_id == $id)
    {
        
        array_push($nn,$val->object_id);
    }
    
    }

    return $nn;
}
function getProductsByCatAjax($arg)
{
   
    $data = $wpdb->get_results("SELECT object_id,term_taxonomy_id from wp_term_relationships where term_taxonomy_id IN ($arg[0],$arg[1],$arg[2],$arg[3],$arg[4])");
    
    $nn = tableLoopAjax($data,$arg[0]);
    $bc = tableLoopAjax($data,$arg[1]);
    $cc = tableLoopAjax($data,$arg[2]);
	$dc = tableLoopAjax($data,$arg[3]);
	$cd = tableLoopAjax($data,$arg[4]);

$array1 = [];
$array1['item_id'] = $arg[0];
$array1['products'] = $nn;
$array2 = [];
$array2['item_id'] = $arg[1];
$array2['products'] = $bc;
$array3 = [];
$array3['item_id'] = $arg[2];
$array3['products'] = $cc;
$array4 = [];
$array4['item_id'] = $arg[3];
$array4['products'] = $dc;	
$array5 = [];
$array5['item_id'] = $arg[4];
$array5['products'] = $cd;	
$merge1 = $array1 + $array2 + $array3 + $array4 + $array5;
//$merge2 = array_merge($merge1,$array3);
return [$array1,$array2,$array3,$array4,$array5];

}

if($_POST['param'] === 'productData')
{
	$pid = intval($_POST['prod_id']);
	$product = getProduct($pid);
	if($product->get_short_description())
	{
		$prodName = wp_strip_all_tags($product->get_short_description());
	}
	else{
		$prodName = $product->get_name();
	}	
	$output = '';
	$output .= '<div class="row prodDetails">';
	$output .= '<div class="col-md-12 col-sm-12 d-block">';
	$output .= '<div class="prodImage">';
	$output .= '<img src="'.wp_get_attachment_url($product->get_image_id()).'" class="img-fluid" alt="">';
	$output .= '<div class="prodDetails">';
	$output .= '<h4>'.$prodName.'</h4>';
	$output .=  $product->get_description();
	$output .= '<div class="prod_counter my-3">';
	$output .=  '<button id="addProd">+</button>';
	$output .= '<input type="number" min="0" value="0" id="count_input">';
	$output .=  '<button id="remProd">-</button>';
	$output .=  '<div id="counter_total">0</div>';
	$output .= '</div>';
	$output .= '<div class="form-group">';
	$output .= '<button class="btn btn-primary btn-block updateCart" data-attr="'.$product->get_id().'">Add to cart</button>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	echo json_encode(['status'=>200,'output'=>$output,'price'=>$product->get_price()]);						
}

if($_POST['param'] === 'search_result')
{
	 $search = strtolower($_POST['search']);
	 $args = [65,66,67,68,69];
	 $data = $wpdb->get_results("SELECT object_id,term_taxonomy_id from wp_term_relationships where term_taxonomy_id IN (65,66,67,68,69)");
	 //getProductsByCatAjax
	$ab1 = tableLoopAjax($data,65);
	$ab2 = tableLoopAjax($data,66);
	$ab3 = tableLoopAjax($data,67);
	$ab4 = tableLoopAjax($data,68);
	$ab5 = tableLoopAjax($data,69);
	$array1 = [];
	$array1['item_id'] = 65;
	$array1['products'] = $ab1;
	$array2 = [];
	$array2['item_id'] = 66;
	$array2['products'] = $ab2;
	$array3 = [];
	$array3['item_id'] = 67;
	$array3['products'] = $ab3;
	$array4 = [];
	$array4['item_id'] = 68;
	$array4['products'] = $ab4;	
	$array5 = [];
	$array5['item_id'] = 69;
	$array5['products'] = $ab5;	
	$merge1 = [$array1,$array2,$array3,$array4,$array5];
	$output = '';
	//$output .= '<div class="row">';
	if(!empty($search))
	{
		foreach($merge1 as $key => $val)
	{  
	   $output .= '<div class="col-sm-12 col-12 d-block my-3">';		
	   $output .= '<h4>'.get_term($val['item_id'],'product_cat')->name.'</h4>';
	   $output .= '</div>';
// 	   $temid = get_term($val['item_id'],'product_cat')->name;
// 	   $output .= '<div class="row">';
// 	   $output .= '<div class="col-sm-12 col-12 d-block my-3">';
// 	   $output .= "<h3>$temid</h3>";
// 	   $output .= '</div>';
 	   
		foreach($val['products'] as $pid)
		{
			$product = getProduct($pid);
			
			if(preg_match("/$search/i",strtolower($product->get_name())))
			{
				$prod_id1[] = $product->get_id();
				$prod_id2[] = get_the_terms($product->get_id(), 'product_cat')[0]->name;
				$image = wp_get_attachment_url($product->get_image_id());
				$price = wc_price($product->get_price());
				$pr_name = $product->get_name();
				$prod_id = $product->get_id();
				
				$output .= '<div class="col-md-3 col-sm-6 col-4 d-block text-center">';
				$output .= "<a href='javascript:void(0)' id='showPopup' data-toggle='modal' data-id='$prod_id' data-target='#prodModal'>";
				$output .= '<div class="card pcard">';
				$output .= "<img src='$image' class='img-fluid'>";
				$output .= '</a>';
				$output .= '<span class="checkIcon"><i class="fas fa-check"></i></span>';
				$output .= '</div>';
				$output .= "<p class='pr'>$price</p>";
				$output .= "<p>$pr_name</p>";
				$output .= '</div>';
				
			}
			else{
				$msg = array('status'=>202);
			}
			
		}
		$msg = array('status'=>200,'output'=>$output,'pro'=>$prod_id1,'pros'=>$prod_id2);
	}
	}
	else{
		$msg =  array('status'=>201);
	}
	
	echo json_encode($msg);
	
	
	
}
if($_POST['param'] === 'cartUpdate')
{
	
	$productId = intval($_POST['pid']);
	$qty = intval($_POST['qty']);
	$price = floatval($_POST['price']);
	
	$cart = cartUpdate($productId,$qty,$price);
	
	echo json_encode(['status'=>200,'cart'=>$cart]);
	
}

if($_REQUEST['param'] === 'getCart')
{
	//clearCart();
	$cart = getCart();

 	echo json_encode(['status'=>200,'output'=>$cart['output'],'items'=>$cart['items'],'subtotal'=>$cart['subtotal'],'total'=>$cart['total']]);
}

if($_REQUEST['param'] === 'removeCartItem')
{
	$key = $_REQUEST['key'];
	$cartRemove = cartRemove($key);
	echo json_encode(['status'=>200]);
}