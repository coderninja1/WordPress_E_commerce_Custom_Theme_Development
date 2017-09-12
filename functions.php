
<?php
function proairsupply_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'proairsupply' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'proairsupply' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Blog-Sidebar', 'proairsupply' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Add widgets here to appear in your blog sidebar.', 'proairsupply' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	// First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'tutsplus' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
	// Second Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'tutsplus' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
	// Third Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'tutsplus' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
	// Fourth Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'tutsplus' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
}
add_action( 'widgets_init', 'proairsupply_widgets_init' );
?>

<?php
function register_my_widget() {
    register_widget( 'footer_column_widget_1' );
    register_widget( 'footer_column_widget_2' );
    register_widget( 'footer_column_widget_3' );
    register_widget( 'footer_column_widget_4' );
    register_widget( 'reuest_a_quote_form' );
    register_widget( 'search' );
    register_widget( 'product_categories' );
    register_widget( 'latest_posts' );
    register_widget( 'post_categories' );
    register_widget( 'post_archives' );
    register_widget( 'post_tags' );
}
add_action( 'widgets_init', 'register_my_widget' );
?>
<?php 
class product_categories extends WP_Widget{
  public function product_categories() {
   $widget_ops = array( 'classname' => 'product_categories', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
   $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'product_categories-widget' );
   $this->WP_Widget( 'product_categories-widget', __('Product Categories Widget ', 'proairsupply'), $widget_ops, $control_ops );
  }
  function widget( $args, $instance ){
     $taxonomy     = 'product_cat';
     $orderby      = 'name';  
     $show_count   = 0;      // 1 for yes, 0 for no
     $pad_counts   = 0;      // 1 for yes, 0 for no
     $hierarchical = 1;      // 1 for yes, 0 for no  
     $title        = '';  
     $empty        = 0;
     $args = array(
      'taxonomy'     => $taxonomy,
      'orderby'      => $orderby,
      'show_count'   => $show_count,
      'pad_counts'   => $pad_counts,
      'hierarchical' => $hierarchical,
      'title_li'     => $title,
      'hide_empty'   => $empty
     );
      $all_categories = get_categories( $args );
      
      echo '<div class="product-categories panel-custom">
      <div class="panel-custom-heading">Product Categories</div>
       <div class="panel-custom-body">
     <div class="panel-group">
      <ul class="list-product-categories accordion"  id="accordion" role="tablist" aria-multiselectable="true">';
      $i = 1;
    foreach ($all_categories as $cat) {
		// echo "<pre>";
		// print_r($cat);
     if($cat->category_parent == 0) {
      $category_id = $cat->term_id;       
      $args2 = array(
        'taxonomy'     => $taxonomy,
        'child_of'     => 0,
        'parent'       => $category_id,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
      );
      $sub_cats = get_categories( $args2 );
        if("clicked-".$i == "clicked-1"){
        $collapse_status = "in";
       }
       else{
        $collapse_status = "";
       }
       
       echo '<script type="text/javascript">';
       echo 'jQuery(document).ready(function($){
				
				var count = $("#accordion > li").size();
				if(count >= "15"){
					$("#accordion").css({"overflow-y":"scroll","height":"690px"});
				}


				var url = window.location.href;
				// console.log(url);
					var lis = document.getElementById("accordion").getElementsByTagName("ul");
					var idArray = [];
					for ( var counter = 0; counter < lis.length; counter++)
					{
					idArray.push( lis[ counter ].id );
					}
					
					
					if("collapse-'.$category_id.'" == idArray[0] && !$("#collapse-'.$category_id.'").hasClass(".text-color-blue") ){
						$("#clicked-'.$i.' #cat-list-'.$i.' i").addClass("more-less fa fa-caret-right");
						$("#collapse-'.$category_id.'").removeClass("in");
						
					} 
										 
				
						 
				function toggleIcon(e) {
					$(e.target)
						.prev(".accordion-toggle")
						.find(".more-less")
						.toggleClass("fa-caret-right fa-caret-down");
				}
				$(".list-product-categories").on("hidden.bs.collapse", toggleIcon);
				$(".list-product-categories").on("shown.bs.collapse", toggleIcon);
				
			
				
				 $(".panel a").on("click", function(){
					$(".panel a").removeClass("text-color-blue");
					$(this).addClass("text-color-blue");
				}); 
							
        });';
        
       echo '</script>';
       
        if(empty($sub_cats)){
			echo '<script type="text/javascript">
				
				jQuery(document).ready(function($){
					
					function getLastPart(url) {
						var parts = url.split("/");
						return (url.lastIndexOf("/") !== url.length - 1 ? parts[parts.length - 1] : parts[parts.length - 2]);
					}
					
					var url = window.location.href;
					var lastPart = getLastPart(url);
					var split_sub_cat = lastPart.split("-");
					if(lastPart == "'. $cat->slug .'"){
						
						$("#clicked-'.$i.' a:contains('. $cat->name .')").addClass("text-color-blue");
					}
				});
				
		  </script>';	
		   $arrow = '<i class=""></i>';
		   $category_list = '<a  href="'. get_term_link($cat->slug, 'product_cat') .'">
         '. $cat->name .'</a>';
	    }else{ 
		   $arrow = '<i class="more-less fa fa-caret-right"></i>';
		   $category_list = '<a id="cat-list-'.$i.'" class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-'.$category_id.'">
         '. $cat->name .$arrow.'</a>';
	    }
        echo '<li class="panel" id="clicked-'.$i.'">'.$category_list;
         echo ' <ul id="collapse-'.$category_id.'" class="panel-collapse collapse '.$collapse_status.'" role="tabpanel">';
         foreach($sub_cats as $sub_category) {
			 
			echo '<script type="text/javascript">
					jQuery(document).ready(function($){
					
						function getLastPart(url) {
								var parts = url.split("/");
								return (url.lastIndexOf("/") !== url.length - 1 ? parts[parts.length - 1] : parts[parts.length - 2]);
						}
							
							var url = window.location.href;
							var lastPart = getLastPart(url);
							var split_sub_cat = lastPart.split("-");
							
							if(lastPart == "'. $sub_category->slug .'"){
								
								
								var lis = document.getElementById("accordion").getElementsByTagName("ul");
								var idArray = [];
								for ( var counter = 0; counter < lis.length; counter++)
								{
								idArray.push( lis[ counter ].id );
								}
								// alert("collapse-'.$category_id.'")
								if("collapse-'.$category_id.'" == idArray[0]){
									$("#clicked-'.$i.' #cat-list-'.$i.' i").removeClass("more-less fa fa-caret-down");
									//$("#clicked-'.$i.' #cat-list-'.$i.' i").addClass("more-less fa fa-caret-right");
									$("#collapse-'.$category_id.'").removeClass("in");
								}
								
								var sub_cat_text = $("#collapse-'.$category_id.' li a").text();
								$("#collapse-'.$category_id.' li a:contains('. $sub_category->name .')").addClass("text-color-blue");
								var closest_ul = $("#collapse-'.$category_id.' li a").closest("ul").addClass("in");
								
								var prev_li = $("#collapse-'.$category_id.' li a").closest("ul").parent().attr("id");
								$("#"+prev_li).children("a").addClass("text-color-blue");
								$("#"+prev_li).children("a").children("i").removeClass("fa-caret-right");
								$("#"+prev_li).children("a").children("i").addClass("fa-caret-down");
								
							}
					});
			</script>';
			
          echo '<li><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name.'</a></li>';
         }   
         echo '</li></ul></li>';  
      // }
      $i++;   
     }   
         
    }
    echo '</ul>
      </div>
       </div>
       </div>';
       }
    
 
}

class reuest_a_quote_form extends WP_Widget{
		public function __construct() {
			$widget_ops = array( 'classname' => 'rq_a_form', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rq_a_form-widget' );
			$this->WP_Widget( 'rq_a_form-widget', __('Request a quote Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		public function widget( $args, $instance ){
			echo $args['before_widget'];

			echo '<div class="sec-request-quote panel-custom">
					  <div class="panel-custom-heading">Request a quote</div>
					  <div class="panel-custom-body">
						<form method="POST">
						  <div class="form-group">
							'.do_shortcode('[contact-form-7 id="422" title="Request a quote"]').'
						  </div>
						 </form>
					  </div>
					</div>';
					
			echo $args['after_widget'];
			
		}
		
		
		
		/* public function form($instance) {} */
	
	
}


class footer_column_widget_1 extends WP_Widget{
		function footer_column_widget_1() {
			$widget_ops = array( 'classname' => 'column_one', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'column_one-widget' );
			$this->WP_Widget( 'column_one-widget', __('Footer Column One Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		function widget( $args, $instance ){
			echo $args['before_widget'];

			echo '<div class="col-md-2 col-sm-6 col-quick-links">
			  <h3>Quick Links</h3>
			  <ul>
				<li><a href='.get_template_directory_uri() . '/home >Home</a></li>
				<li><a href='.get_template_directory_uri() . '/about-us>About Us</a></li>
				<li><a href='.get_template_directory_uri() . '/shop>Products</a></li>
				<li><a href='.get_template_directory_uri() . '/blog>Blog</a></li>
				<li><a href='.get_template_directory_uri() . '/terms-conditions/>Terms & Conditions</a></li>
			  </ul>
			</div>';

			echo $args['after_widget'];
		}
		
		/* function form() {} */
	
	
}



class footer_column_widget_2 extends WP_Widget{
		function footer_column_widget_2() {
			$widget_ops = array( 'classname' => 'column_two', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'column_two-widget' );
			$this->WP_Widget( 'column_two-widget', __('Footer Column Two Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		function widget( $args, $instance ){
			echo $args['before_widget'];

			echo "<div class='col-md-5 col-sm-6 col-newsletter'>
					  <h3>Sign up for newsletter</h3>
					  <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took</p>
					  
					</div>";

			echo $args['after_widget'];
		}
		
		/* function form() {} */
}


class footer_column_widget_3 extends WP_Widget{
		function footer_column_widget_3() {
			$widget_ops = array( 'classname' => 'column_three', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'column_three-widget' );
			$this->WP_Widget( 'column_three-widget', __('Footer Column Three Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		function widget( $args, $instance ){
			echo $args['before_widget'];
			global $wpdb;
			$query = $wpdb->get_row("SELECT contact_no FROM pro_above_header_details WHERE Id='1'");
			if(!empty($query)){
				$contact_no = $query->contact_no;
			}
			echo '<div class="col-md-2 col-sm-6 col-contact">
					  <h3>Contact Us</h3>
					  <p>Lorem Ipsum is simply dummy text of the</p>
					  
					  <p><a href="tel:'.$contact_no.'">'.$contact_no.'</a></p>
					</div>';

			echo $args['after_widget'];
		}
		
		/* function form() {} */
}



class footer_column_widget_4 extends WP_Widget{
		function footer_column_widget_4() {
			$widget_ops = array( 'classname' => 'column_four', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'column_four-widget' );
			$this->WP_Widget( 'column_four-widget', __('Footer Column Four Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		function widget( $args, $instance ){
			echo $args['before_widget'];
			
			global $wpdb;
			$query = $wpdb->get_row("SELECT toll_free_no FROM pro_above_header_details WHERE Id='1'");
			if(!empty($query)){
				$toll_free_no = $query->toll_free_no;
			}
			// echo $toll_free_no;
			
			echo '<div class="col-md-3 col-sm-6 col-help">
					  <h3>We can help you! Call toll free</h3>
					  <p><a href="tel:'.$toll_free_no.'">'.$toll_free_no.'</a><br>
						Call today for expert selection<br>
						We will respond fast!</p>
					  <img src="'.get_template_directory_uri() . '/images/logo-geo-trust.jpg" alt="Geo Trust"> <img src="'.get_template_directory_uri() . '/images/logo-trust-wave.png" alt="Trust Wave"> 
				</div>';

			echo $args['after_widget'];
		}
		
		/* function form() {} */
}



class latest_posts extends WP_Widget{
		public function __construct() {
			$widget_ops = array( 'classname' => 'latest_posts', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest_posts-widget' );
			$this->WP_Widget( 'latest_posts-widget', __('Latest Post Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		public function widget( $args, $instance ){
			echo $args['before_widget'];

			echo '<div class="box-latest-post">
                                <h3>Latest Post</h3>';?>
								<?php
									$args = array( 'numberposts' => '2' );
									$recent_posts = wp_get_recent_posts($args);
									foreach( $recent_posts as $recent ) {
										printf( '<p><a href="%1$s">%2$s</a></p>',
											esc_url( get_permalink( $recent['ID'] ) ),
											apply_filters( 'the_title', $recent['post_title'], $recent['ID'] )
										);
									}
								?>
                                <?php echo '</div>';
					
			echo $args['after_widget'];
			
		}
		
		
		
		/* public function form($instance) {} */
	
	
}


class post_categories extends WP_Widget{
		public function __construct() {
			$widget_ops = array( 'classname' => 'post_categories', 'description' => __('A widget that displays the authors name ', 'proairsupply') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'post_categories-widget' );
			$this->WP_Widget( 'post_categories-widget', __('Post Categories Widget ', 'proairsupply'), $widget_ops, $control_ops );
		}
		public function widget( $args, $instance ){
			echo $args['before_widget'];
				
			echo '<div class="box-category">
                            	<h3>Category</h3>
                                <ul class="list-unstyled">';
								$categories = get_categories( array(
									'orderby' => 'name',
									'parent'  => 0
								) );
								 
								foreach ( $categories as $category ) {
									printf( '<a href="%1$s">%2$s</a><br />',
										esc_url( get_category_link( $category->term_id ) ),
										esc_html( $category->name )
									);
								}
								
								/* $category_detail = get_the_category( $post->ID );
								foreach($category_detail as $cd){
									echo '<li><a href="#">'.$cd->cat_name.'</a></li>';
								} */									
                                echo '</ul>
                            </div>';
					
			echo $args['after_widget'];
			
		}
		
		
		
		/* public function form($instance) {} */
	
	
}




/******Logo slider shorcode*******/
function client_logo(){
 $args = array(
 'post_type'   => 'logosliderwp',
    'post_status' => 'publish'
);
$testimonials = new WP_Query( $args );
?>
 <div class="sec-clients block push-top-2">
        <div class="heading-three">
            <h3><i class="fa fa-user"></i> Our Clients</h3>
        </div>
        <div class="row client-slider">
           
   <?php
    if( $testimonials->have_posts() ) :
     while( $testimonials->have_posts() ) {
      $testimonials->the_post();
      $post_id = get_the_id();
       if (has_post_thumbnail( $post_id ) ):
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
        ?>
          <div class="item col-xs-4 col-md-2"><a href="#" title="#"><img src="<?php echo $image[0]; ?>" class="img-responsive"></a> </div>   
        <?php
       endif; 
     }
     wp_reset_postdata();
     else :
      esc_html_e( '' );
     endif;
   ?>
             
        </div>
          <!-- Slider --> 
    </div>
<?php 
}
add_shortcode('get_client_logo','client_logo');
?>

<?php

/***Dynamic Site Logo Change******/
function m1_customize_register( $wp_customize ) {
		$wp_customize->add_section( 'cd_colors' , array(
    'title'      => 'Colors',
    'priority'   => 30,
) );
	$wp_customize->add_setting( 'background_color' , array(
    'default'     => '#43C6E4',
    'transport'   => 'refresh',
) );
    $wp_customize->add_setting( 'm1_logo' ); // Add setting for logo uploader
	
	// Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm1_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'm1' ),
        'section'  => 'title_tagline',
        'settings' => 'm1_logo',
    ) ) );
	
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
	'label'        => 'Background Color',
	'section'    => 'cd_colors',
	'settings'   => 'background_color',
) ) );



}
add_action( 'customize_register', 'm1_customize_register' );

add_action( 'wp_head', 'cd_customizer_css');
function cd_customizer_css()
{
    ?>
         <style type="text/css">
             body { background: #<?php echo get_theme_mod('background_color', '#43C6E4'); ?>; }
         </style>
    <?php
}


