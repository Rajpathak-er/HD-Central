<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper testtt">
		<?php
		
		$product_type = get_post_meta(get_the_ID(),'product_type',true);
		if($product_type  == 'ebay'){
			//echo "---ttttt";
			$car_gallery = get_post_meta( get_the_ID(), 'gallery', true );
			$featured_image_url =  $car_gallery;//get_post_meta(get_the_ID(),'featured_image_url',true);
			 
			if($featured_image_url){
				// // echo '<div data-thumb="'.$featured_image_url.'" class="woocommerce-product-gallery__image--feature woocommerce-product-gallery__image test1"><a href="'.$featured_image_url.'"><img src="'.$featured_image_url.'" class="wp-post-image custom_image"></a></div>';
				// echo '<div data-thumb="'.$featured_image_url.'" class="woocommerce-product-gallery__image--feature woocommerce-product-gallery__image test1"><img src="'.$featured_image_url.'" class="wp-post-image custom_image"></div>';
				
				$main_image = true;
				 
				$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
				$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
				$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
				$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
				$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$thumbnail_src     = $featured_image_url;
				$full_src          = $featured_image_url;
				$alt_text          = "";
				$image             = wp_get_attachment_image(
					$attachment_id,
					$image_size,
					false,
					apply_filters(
						'woocommerce_gallery_image_html_attachment_image_params',
						array(
							'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
							'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
							'data-src'                => esc_url( $full_src ),
							'data-large_image'        => esc_url( $full_src ),
							'data-large_image_width'  => esc_attr( $full_src ),
							'data-large_image_height' => esc_attr( $full_src ),
							'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
						),
						$attachment_id,
						$image_size,
						$main_image
					)
				);

				// echo '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src ) . '">' . $image . '</a></div>';
				
				echo '<div data-thumb="' . esc_url( $thumbnail_src ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src ) . '"><img src="'.$full_src.'" class="wp-post-image" alt="" title="" data-caption="" data-src="'.$full_src.'" data-large_image="'.$full_src.'" data-large_image_width="" data-large_image_height="" srcset="" sizes="" draggable="false"></a></div>';	 
				 
			 }else{
				 echo '<div class="woocommerce-product-gallery__image--placeholder"><img src="'.esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ).'" class="wp-post-image 11"></div>';
			 }
			 
		}else{
			//echo "---".$product->get_image_id();
			if ( $product->get_image_id() ) {
				$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		
		}

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
