<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    if(is_page_template('payment-template.php') || is_page_template('pricing-template.php') ){

        wp_enqueue_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrapJs','https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js');
    }

   	 wp_enqueue_script('child-custom', get_stylesheet_directory_uri().'/custom-js/cusom.js', ['jquery'],false,true);
 	 wp_localize_script('child-custom','ajaxurl',admin_url('admin-ajax.php'));
}

add_theme_support( 'custom-logo' );

function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function customwidget() {
        register_sidebar( array(
        'name' => __( 'Site Logo', 'twentyten' ),
        'id' => 'site',
        'description' => __( 'The Site Logo widget area', 'twentyten' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
        register_sidebar( array(
        'name' => __( 'Top Social Icon', 'twentyten' ),
        'id' => 'social',
        'description' => __( 'The social widget area', 'twentyten' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
        register_sidebar( array(
        'name' => __( 'Banner Content', 'twentyten' ),
        'id' => 'baner',
        'description' => __( 'The banner content widget area', 'twentyten' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'customwidget' );

function blog( $atts ){
  global $post;
$temp_post=$post;
$args = array( 'post_type' => 'post', 'posts_per_page' => 4);
$output .='<ul>';  
$outputposts = get_posts( $args );
foreach($outputposts as $post) : setup_postdata($post);
 $output .= '<li><a href="'.get_the_permalink().'">';
   $output .='<div class="zoom">'. get_the_post_thumbnail( $post->ID, 'full' ).'</div>';
   $output .= '<h3>'.get_the_title().'</h3>';
  $output .= '</a></li>';
endforeach;
$output .= '</ul>';
$post=$temp_post;
return $output;
}
add_shortcode( 'blog', 'blog' );
add_filter('use_block_editor_for_post', '__return_false', 10);

add_action( 'woocommerce_after_shop_loop_item_title', 'bbloomer_ins_woocommerce_product_excerpt', 35, 2 );
 
function bbloomer_ins_woocommerce_product_excerpt() {
     the_excerpt();
}



function product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 4
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">'.$get_post->post_title.'</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("product_shortcode","product_shortcode");







function Service_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col product-col-1">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">'.$get_post->post_title.'</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
               <span class="pro-price-1">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                              <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/brand-guide.png">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
            
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("Service_product_shortcode","Service_product_shortcode");


function logo_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">Logo & Identity</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("logo_product_shortcode","logo_product_shortcode");



function web_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">Web & App Design</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("web_product_shortcode","web_product_shortcode");

function business_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">Business & Advertising</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("business_product_shortcode","business_product_shortcode");


function Clothing_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">Clothing & Merchandise</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("Clothing_product_shortcode","Clothing_product_shortcode");

function art_product_shortcode(){
    $output = '<div class="product-wrapper">';
    $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
             );
    $get_posts = get_posts($args);
    foreach ($get_posts as $key => $get_post) {
        $product = wc_get_product( $get_post->ID );
      $imglink = get_the_post_thumbnail_url($get_post->ID);
       $output.='<div class="product-col">
                    <div class="pro-top">
                        <div class="pro-top-l">
                            <h2 class="pro-title">Art & Illustration</h2>
                            <span class="pro-price">$'.$product->get_regular_price().'</span>
                        </div>
                        <div class="pro-top-r">
                            <img src="'.$imglink.'">
                        </div>
                    </div>
                    <div class="packeg-option">
                        <ul>
                            <li>3 Design Concepts</li>
                            <li>Unlimited Revision</li>
                            <li>FREE Mockup</li>
                            <li>Grayscale Version</li>
                        </ul>
                    </div>
                    <div class="free-option">
                        <ul>
                            <li><span class="free">FREE</span>Web Icon (Favicon)</li>
                            <li><span class="free">FREE</span>Live Support 24/7</li>
                            <li><span class="free">FREE</span>Final Formats</li>
                        </ul>
                    </div>
                    <div class="option-img">
                        <img src="https://explainervideoz.com/stagging/dipixels/wp-content/uploads/2021/10/psd.png">
                    </div>
                    <div class="tick-option">
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 24 Hrs Turnaround Time</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Money Back Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Satisfaction Guarantee</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> 100% Ownership Rights</li>
                        </ul>
                    </div>
                    <div class="order-now">
                        <a href="'.site_url().'/cart/?add-to-cart='.$get_post->ID.'">Order Now</a>
                    </div>
                </div>';
    }
    $output.= '</div>';
   return $output; 
}
add_shortcode("art_product_shortcode","art_product_shortcode");




// wp_enqueue_script('customjs', get_stylesheet_directory_uri() . '/custom-js/custom.js', array(), '1.0.0', 'true' );





// Register Custom Post Type
function work() {

  $labels = array(
    'name'                  => _x( 'work', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'work', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Works', 'text_domain' ),
    'name_admin_bar'        => __( 'Works', 'text_domain' ),
    'archives'              => __( 'Work Archives', 'text_domain' ),
    'attributes'            => __( 'Work Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Work:', 'text_domain' ),
    'all_items'             => __( 'All Works', 'text_domain' ),
    'add_new_item'          => __( 'Add New Work', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Work', 'text_domain' ),
    'edit_item'             => __( 'Edit Work', 'text_domain' ),
    'update_item'           => __( 'Update Works', 'text_domain' ),
    'view_item'             => __( 'View Work', 'text_domain' ),
    'view_items'            => __( 'View Works', 'text_domain' ),
    'search_items'          => __( 'Search Work', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'work', 'text_domain' ),
    'description'           => __( 'Post work Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'works', $args );

}
add_action( 'init', 'work', 0 );





add_action( 'init', 'create_Addtype_hierarchical_taxonomy', 0 );
 
 
function create_Addtype_hierarchical_taxonomy() {
 

 
  $labels = array(
    'name' => _x( 'work-Type', 'taxonomy general name' ),
    'singular_name' => _x( 'work-Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search work-Type' ),
    'all_items' => __( 'All work-Type' ),
    'parent_item' => __( 'Parent work-Type' ),
    'parent_item_colon' => __( 'Parent work-Type' ),
    'edit_item' => __( 'Edit work-Type' ), 
    'update_item' => __( 'Update work-Type' ),
    'add_new_item' => __( 'Add New work-Type' ),
    'new_item_name' => __( 'New work-Typet Name' ),
    'menu_name' => __( 'Works' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('work-Type',array('works'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'work-Type' ),
  ));
 
}
add_filter( 'gppcmt_enable_pretty_id', '__return_true' );

function getProduct($id)
{
  $product = wc_get_product($id);
  
  return $product;
}
function cartUpdate($pid,$qty,$price)
{
	
	include_once ABSPATH.'wp-content/plugins/woocommerce/woocommerce.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-cart-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-notice-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-template-hooks.php';
	if ( null === WC()->session ) {
    	$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
    	WC()->session = new $session_class();
		WC()->session->init();
	}
	if ( null === WC()->customer ) {
    	WC()->customer = new WC_Customer( wp_get_current_user()->ID, true );
	}
	if ( null === WC()->cart ) {
		WC()->cart = new WC_Cart();
	}
	$cart_items = WC()->cart->get_cart();
	$key = WC()->cart->add_to_cart($pid,$qty);
	return $key;
}
function getCart()
{
	include_once ABSPATH.'wp-content/plugins/woocommerce/woocommerce.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-cart-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-notice-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-template-hooks.php';
	if ( null === WC()->session ) {
    	$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
    	WC()->session = new $session_class();
		WC()->session->init();
	}
	if ( null === WC()->customer ) {
    	WC()->customer = new WC_Customer( wp_get_current_user()->ID, true );
	}
	if ( null === WC()->cart ) {
		WC()->cart = new WC_Cart();
	}
	$cart = WC()->cart->get_cart();
	
	$output = '';
	foreach($cart as $cart_item_key => $cart_item){
			
			$productid = $cart_item['product_id'];
		   	$productes = $cart_item['data'];
			$prod_title = wc_get_product($productid)->get_name();
			$prodImage = wp_get_attachment_url(getProduct($productid)->get_image_id());
			$prodQty = $cart_item['quantity'];
			$cartPrice = WC()->cart->get_product_subtotal( $productes, $prodQty );
			$output .= '<div class="cartData">';
			$output .= '<p><button class="btn" id="removeCart" data-id="'.$productid.'" data-key="'.$cart_item_key.'"><i class="fas fa-trash-alt"></i></button>'.$prod_title.' <strong>x</strong> <span>'.$prodQty.'</span></p>';
			$output .= '<p>'.$cartPrice.'</p>';
			$output .= '</div>';	
			
			}

	return ['output'=>$output,'items'=>WC()->cart->get_cart_contents_count(),'subtotal'=>WC()->cart->get_subtotal(),'total'=> WC()->cart->total];
}

function clearCart()
{
	include_once ABSPATH.'wp-content/plugins/woocommerce/woocommerce.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-cart-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-notice-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-template-hooks.php';
	if ( null === WC()->session ) {
    	$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
    	WC()->session = new $session_class();
		WC()->session->init();
	}
	if ( null === WC()->customer ) {
    	WC()->customer = new WC_Customer( wp_get_current_user()->ID, true );
	}
	if ( null === WC()->cart ) {
		WC()->cart = new WC_Cart();
	}
	WC()->cart->empty_cart();
	
}

function cartRemove($key)
{
	include_once ABSPATH.'wp-content/plugins/woocommerce/woocommerce.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-cart-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-notice-functions.php';
	include_once ABSPATH.'wp-content/plugins/woocommerce/includes/wc-template-hooks.php';
	if ( null === WC()->session ) {
    	$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
    	WC()->session = new $session_class();
		WC()->session->init();
	}
	if ( null === WC()->customer ) {
    	WC()->customer = new WC_Customer( wp_get_current_user()->ID, true );
	}
	if ( null === WC()->cart ) {
		WC()->cart = new WC_Cart();
	}
		
	 $delete = WC()->cart->remove_cart_item($key);
	 return $delete;
}

function prodLib()
  {
	global $wpdb;
  require_once get_stylesheet_directory().'/inc/ajax.php';
  //echo "<pre>"; print_r($_POST);die;
  wp_die();
  }
add_action('wp_ajax_nopriv_prodLibrary','prodLib');
add_action('wp_ajax_prodLibrary','prodLib');


function add_theme_codes() {

 wp_enqueue_style( 'slickcss', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css', 'all');
 wp_enqueue_style( 'slickthemecss', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css', 'all');

}

add_action( 'wp_enqueue_scripts', 'add_theme_codes' );

function testfunction(){
  $output = '';
  $output.='
    <div class="slider-wrapper">
      <div class="home-slider" style="background: url(https://www.dipixels.com/wp-content/uploads/2022/03/Group-1491-2.png);">
        <div class="left">
          <h2>Hi, We Are</h2>
          <h3>Dipixels</h3>
          <h4>Corporate Design</h4>
          <p>Our customized corporate designs capture the true essence of what you stand for.</p>
          <a href="#">LETS Talk</a>
        </div>
        <div class="right">
          <div class="img">
            <img src="https://www.dipixels.com/wp-content/uploads/2022/03/web-development-responsive-web-design-business-website-d3b1b3ad6be2d1202926239f1677a48d-1.png">
          </div>
        </div>
      </div>
      <div class="home-slider" style="background: url(https://www.dipixels.com/wp-content/uploads/2022/03/Group-1491-2.png);">
        <div class="left">
          <h2>Hi, We Are</h2>
          <h3>Dipixels</h3>
          <h4>Web Design & Development</h4>
          <p>Allow us to create and design the perfect website for you so you can thrive with your head held high.</p>
          <a href="#">LETS Talk</a>
        </div>
        <div class="right">
          <div class="img">
            <img src="https://www.dipixels.com/wp-content/uploads/2022/03/web-development-responsive-web-design-business-website-d3b1b3ad6be2d1202926239f1677a48d-1.png">
          </div>
        </div>
      </div>
      <div class="home-slider" style="background: url(https://www.dipixels.com/wp-content/uploads/2022/01/DESIG.png);">
        <div class="left">
          <h2>Hi, We Are</h2>
          <h3>Dipixels</h3>
          <h4>Mobile App Design & Development</h4>
          <p>Dipixels excels in creating the most user-friendly mobile apps for both iOS and Android that are designed keeping your brand in mind.</p>
          <a href="#">LETS Talk</a>
        </div>
        <div class="right">
          <div class="img">
            <img src="https://www.dipixels.com/wp-content/uploads/2022/01/9.png">
          </div>
        </div>
      </div>
	  <div class="home-slider" style="background: url(https://www.dipixels.com/wp-content/uploads/2022/01/app.png);">
        <div class="left">
          <h2>Hi, We Are</h2>
          <h3>Dipixels</h3>
          <h4>Digital Marketing</h4>
          <p>In this digital world, our experts can market your brand online to the right audience to get you the engagement your brand is meant for.</p>
          <a href="#">LETS Talk</a>
        </div>
        <div class="right">
          <div class="img">
            <img src="/wp-content/uploads/2022/01/NicePng_social-media-marketing-png_2412049.png">
          </div>
        </div>
      </div>
    </div>
    <div class="banner-btn">
        <div class="pip">
          <img src="https://www.dipixels.com/wp-content/uploads/2022/03/Scroll-Group-1.png">
        </div>
        <div class="click">
          <a href="#"><img src="https://www.dipixels.com/wp-content/uploads/2022/03/mouse.png"></a>
        </div>
    </div>
	<div class="loogos">
		<div class="inner-logo">
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo2.png">
			</div>
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo3.png">
			</div>
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo4.png">
			</div>
			<div class="col-logo">
				
			</div>
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo5.png">
			</div>
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo6.png">
			</div>
			<div class="col-logo">
				<img src="https://www.dipixels.com/wp-content/uploads/2021/08/creative-logo1.png">
			</div>
		</div>
	</div>
  ';
  return $output;
}
add_shortcode('testfunction','testfunction');

function wpdocs_theme_name_scripts() {
    wp_enqueue_script( 'script-name', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array(), '1.8.1', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );