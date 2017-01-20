<?php
/*
Plugin Name: AMP WooCommerce
Description: WooCommerce for AMP (Accelerated Mobile Pages). This is simple plugin enables e-commerce store with WooCommerce for AMP pages.
Author: Mohammed Kaludi
Version: 0.1
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) exit;
// Enable WooCommerce support for AMP
	function amp_woocommerce_add_woocommerce_support() {

		// Check if the dependent plugins are activated, if not, then return.
		// As there is no use of this plugin, if parent plugins are not activated.
		if ( ! defined( 'AMP__FILE__' ) ) {  return; }

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
		add_post_type_support( 'product', AMP_QUERY_VAR );

	}
	add_action( 'amp_init', 'amp_woocommerce_add_woocommerce_support',11);

	add_filter( 'amp_post_template_file', 'amp_woocommerce_custom_woocommerce_template', 10, 3 );

	function amp_woocommerce_custom_woocommerce_template( $file, $type, $post ) {
		global  $redux_builder_amp;
		if ( 'single' === $type && 'product' === $post->post_type ) {

			if ( class_exists( 'Ampforwp_Init' ) && $redux_builder_amp['amp-design-selector'] == 2) {
					$file = dirname(__FILE__) . '/templates/ampforwp-wc.php';
			} else {
					$file = dirname(__FILE__) . '/templates/wc.php';
			}

		}
		return $file;
	}

/* Add WooCommerce elements in the page

	1. Add WooCommerce container
	2. Add Custom Style for WooCommerce Page
	3. Add WooCommerce gallery
	4. Add WooCommerce amp-carousel script
	5. Remove Default Post Meta from header
	6. Add WooCommerce Meta information
	7. Add Product Description
*/
	// 1. Add WooCommerce container
	// Add container for WooCommerce elements
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_starts',9);
	function amp_woocommerce_container_starts(){
		echo ' <div class="amp-woocommerce-container">' ;
	}

	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_ends',20);
	function amp_woocommerce_container_ends(){
		echo ' </div>' ;
	}

	// 2. Add Custom Style for WooCommerce Page
	add_action('amp_post_template_css','amp_woocommerce_custom_style');
	function amp_woocommerce_custom_style() {
		if ( function_exists( 'is_on_sale' ) ) {
			global $woocommerce;
			$amp_woocommerce_sale =	$woocommerce->product_factory->get_product()->is_on_sale();
			if ( $amp_woocommerce_sale == 1 ) { ?>
				.amp-wp-article-featured-image::before {
					content: 'Sale';
					background: #0a89c0;
					padding: 20px 15px;
					border-radius: 50%;
					color: #fff;
					position: relative;
					z-index: 1;
					left: 5%px;
					top: 30px;
				}
			<?php } ?>
				.amp-woocommerce-container amp-carousel {
					background: none;
				}
				.ampforwp-add-to-cart-button a {
					background: #0a89c0;
					color: #fff;
					padding: 10px 8px;
					text-decoration: none;
				}

			<?php
		}?>
	.amp-wp-meta.amp-woocommerce-add-cart{
				display: block;
		}



/*------ raju -styles ------ */

* http://cssreset.com
*/
input,select{vertical-align:middle}
*,*:after,*:before {box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}

.main-container{
	width:100%;
}
.amp-buttons{
	width:50%;
	height:auto;
	float:left;
	line-height:0;
	padding-bottom:20px;
}
.amp-img > img{
	width:100%;
	height:auto;
}
.amp-img{
	position:relative;
}

.price{
   position:absolute;
   top:15px;
   right:15px;
   bottom:auto;
}
.price{
   background:#ccc;
   padding:20px 20px;
   margin-top:20px;
}
.add-cart {
  bottom: 40px;
  position: absolute;
  right: 15px;
}
.add-cart a{
   background:#ccc;
   padding:10px 20px;
}
.amp-buttons:nth-child(odd){
	padding:10px 10px 0px 10px;
}
.add-cart:hover a{
  background-color:#0077B5;
   transition: all 0.3s ease-in-out 0s;
  -webkit-transition: all 0.3s ease-in-out 0s;
  -moz-transition: all 0.3s ease-in-out 0s;
  -ms-transition: all 0.3s ease-in-out 0s;
  -o-transition: all 0.3s ease-in-out 0s;
  color:#ffffff
}
.amp-img {
  margin-top: 20px;
}
.product-size {
  padding-top: 20px;
  text-align: center;
}
.amp-wp-meta.amp-woocommerce-price {
  float: left;
  width: 50%;
}
.amp-wp-meta.amp-woocommerce-add-cart {
   float: left;
   width: 30%;
   text-align:right;
}
.Add-to-cart {
  float: right;
  width: 20%;
  text-align:right;
  font-size:12px;
}
.amp-wp-content, .amp-wp-title-bar div, .amp-woocommerce-container {
  clear: both;
}
.amp-woocommerce-container > div {
  padding-top: 20px;
}
.ampforwp-add-to-cart-button {
  display: none;
}
.amp-wp-content.the_content.amp-wp-article-content p {
  text-align: justify;
}
.varients-title {
  text-align: center;
}
.varients-title h3 {
  color: #373737;
  font-size: 16px;
  letter-spacing: 0.5px;
  margin: 0;
}
/* responsive styles for mobile */
@media (max-width:767px){
.amp-wp-content, .amp-wp-content.post-title-meta.amp-wp-article-header{
	width: 100%;
	padding:0 10px;
}
.amp-img {
  margin-top: 14px;
}
.amp-buttons {
  width:50%;
  padding-bottom: 5px;
}
.price {
  font-size: 9px;
  margin-top: 5px;
  padding: 11px;
  top:0px;
}
.product-size {
  font-size: 11px;
}
.add-cart {
  bottom: 25px;
  font-size: 11px;
  left: 0;
  margin: 0 auto;
  position: absolute;
  right: 0;
  text-align: center;
  top: auto;
}
.add-cart a {
  padding: 6px 10px;
}
.amp-conatiner {
  clear: both;
  margin: 0 auto;
  width: 100%;
}
.add-cart a {
  padding: 4px 8px;
}
.product-size {
  padding-top: 10px;
}
.amp-wp-meta.amp-woocommerce-price {
  float: left;
  width: 60%;
}
.amp-wp-meta.amp-woocommerce-add-cart {
  display:none;
}
.amp-wp-meta.amp-woocommerce-add-cart {
  float: left;
  text-align: center;
  width: 30%;
}
.Add-to-cart {
  float: right;
  font-size: 12px;
  text-align: right;
  width: 30%;
}
.amp-wp-content, .amp-wp-content.post-title-meta.amp-wp-article-header {
  clear: both;
}
.amp-wp-content.the_content.amp-wp-article-content p {
  text-align: justify;
  line-height:21px;
}
.amp-woocommerce-container > div {
  padding-top: 10px;
}
}
@media (min-width:768px) and (max-width:979px){
.amp-wp-content{
	width: 750px;
}
.price {
  margin-top: 5px;
}
}
@media (min-width:980px) and (max-width:1199px){
.amp-wp-content{
	width: 950px;
}
}
@media (min-width:480px) and (max-width:767px){
.amp-buttons {
  width: 50%;
}
.price {
  top: 10px;
}
.add-cart {
  font-size: 15px;
  bottom:35px;
}
.product-size {
  font-size: 15px;
}
.price {
  font-size: 14px;
  padding: 15px;
}
.add-cart a {
  padding: 6px 15px;
}
.product-size {
  padding-top: 20px;
}
.amp-wp-meta.amp-woocommerce-price {
  width: 50%;
}
.amp-wp-meta {
  font-size: 12px;
}
.amp-wp-meta.amp-woocommerce-add-cart {
  float: left;
  text-align: right;
  width: 20%;
}
}

		<?php
	}

	// 3. Add WooCommerce gallery
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_wc_elements_gallery');

	function amp_woocommerce_add_wc_elements_gallery(){
		if ( ! function_exists( 'get_gallery_attachment_ids' ) ) {
			global $woocommerce;
				$amp_woocommerce_gallery =	$woocommerce->product_factory->get_product()->get_gallery_attachment_ids();
				if ( $amp_woocommerce_gallery ) { ?>
					<amp-carousel width="400"
					  height="300"
					  layout="responsive"
					  autoplay
					  delay="2000"
					  type="slides">
						<?php
						foreach ($amp_woocommerce_gallery as $amp_woocommerce_image) {
							$attachment_image = wp_get_attachment_image_src( $amp_woocommerce_image, $size = 'large');
							$attachment_image = $attachment_image[0];
							?>
							<amp-img src="<?php echo esc_url($attachment_image); ?>"
							    width="400"
							    height="300"
							    layout="responsive"></amp-img>
							<?php
						} ?>
					</amp-carousel>
					<?php
				}
		}
	}

	// 4. Add WooCommerce amp-carousel script only if WC galley is available
	add_action('amp_post_template_head','amp_woocommerce_add_amp_carousel_script');

	function amp_woocommerce_add_amp_carousel_script() {
		if ( ! function_exists( 'get_gallery_attachment_ids' ) ) { ?>
			 	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
			<?php
		}
	}

	// 5. Remove Default Post Meta from header

	// removed directly for now, but will use filters

		// 	// 5.1 Remove Meta Author info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_author' );
		// function amp_woocommerce_remove_meta_author( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-author', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.2 Remove Meta Time info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_time' );
		// function amp_woocommerce_remove_meta_time( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-time', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.3 Remove Comments button

		// if ( 'product' === $post->post_type ) {
		// 	add_filter( 'amp_post_article_footer_meta', 'amp_woocommerce_remove_comment_button' );
		// }

		// function amp_woocommerce_remove_comment_button( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-comments-link', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }

	// 6. Add WooCommerce Meta information
	add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_add_wc_meta' );
	function amp_woocommerce_add_wc_meta( $meta_parts ) {
		$meta_parts[] = 'amp-woocommerce-meta-info';
		return $meta_parts;
	}

	add_filter( 'amp_post_template_file', 'amp_woocommerce_add_wc_meta_path', 10, 3 );
	function amp_woocommerce_add_wc_meta_path( $file, $type, $post ) {
		if ( 'amp-woocommerce-meta-info' === $type  && 'product' === $post->post_type ) {

			$file = dirname( __FILE__ ) . '/templates/amp-woocommerce-meta-info.php';

		}
		return $file;
	}

	// 7. Add Product Description
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_product_description', 11);

	function amp_woocommerce_add_product_description(){
		woocommerce_template_single_excerpt();
	}

    