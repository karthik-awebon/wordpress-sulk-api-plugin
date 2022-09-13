	<?php
/**
 * @package Sulks App API V1
 */
/*
Plugin Name: Sulks App API V1
Description: This Plugin adds custom apis for Sulks App Which is used for Mobile development
Author: Karthikeyan Balasubramanian
Author URI: https://www.linkedin.com/in/karthikawebon/
*/

require_once plugin_dir_path(__FILE__) . 'class-sulksapp-post.php';
require_once plugin_dir_path(__FILE__) . 'class-shop-category.php';

add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    // exception for token api
    $validate_uri = strpos($_SERVER['REQUEST_URI'], '/jwt-auth/v1/token');
    if ( ! is_user_logged_in() && ($validate_uri === false)) {
        return new WP_Error(
            'jwt_auth_invalid_token',
            __( 'Please send a valid token' ),
            array( 'status' => 401 )
        );
    }

    return $result;
});



add_filter( 'jwt_auth_expire', function ( $issuedAt ) {
    return $issuedAt + (HOUR_IN_SECONDS * 1);
});


function get_retro_home_data( $data ) {

	$retroHomeResponse = new stdClass;


	$categorySlug = 'retro';

	$wpPosts = get_posts( ['numberposts' => 1, 'category_name' => $categorySlug, 'sort_order' => 'desc'] );

	$mainbanners = get_sluk_posts($wpPosts,$categorySlug);

	$retroHomeResponse->mainbanner = $mainbanners[0];


	$categorySlug = 'news-retro';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retronews = get_sluk_posts($wpPosts,$categorySlug);

	$retroHomeResponse->retronews = $retronews;



	$categorySlug = 'reviews-retro';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retroreviews = get_sluk_posts($wpPosts,$categorySlug);

	$retroHomeResponse->retroreviews = $retroreviews;


	$categorySlug = 'sunday-sluk-retro';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retrofeatures = get_sluk_posts($wpPosts,$categorySlug);

	$retroHomeResponse->retrofeatures = $retrofeatures;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$retroHomeResponse->latestinshop = $latestinshop;

 
  return $retroHomeResponse;
}

function get_features_data( $data ) {

	$featuresResponse = new stdClass;

	$categorySlug = 'sunday-sluk-retro';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retrofeatures = get_sluk_posts($wpPosts,$categorySlug);

	$featuresResponse->retrofeatures = $retrofeatures;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$featuresResponse->latestinshop = $latestinshop;

 
  return $featuresResponse;
}

function get_news_data( $data ) {

	$newsResponse = new stdClass;


	$categorySlug = 'news-retro';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retronews = get_sluk_posts($wpPosts,$categorySlug);

	$newsResponse->retronews = $retronews;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$newsResponse->latestinshop = $latestinshop;

 
  return $newsResponse;
}

function get_reviews_data( $data ) {

	$reviewsResponse = new stdClass;



	$categorySlug = 'reviews-retro';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$retroreviews = get_sluk_posts($wpPosts,$categorySlug);

	$reviewsResponse->retroreviews = $retroreviews;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$reviewsResponse->latestinshop = $latestinshop;

 
  return $reviewsResponse;
}

function get_modern_home_data( $data ) {

	$metroHomeResponse = new stdClass;


	$categorySlug = 'modern-big-story';

	$wpPosts = get_posts( ['numberposts' => 1, 'category_name' => $categorySlug, 'sort_order' => 'desc'] );

	$mainbanners = get_sluk_posts($wpPosts,$categorySlug);

	$metroHomeResponse->mainbanner = $mainbanners[0];


	$categorySlug = 'modern';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$newmodernsluk = get_sluk_posts($wpPosts,$categorySlug);

	$metroHomeResponse->newmodernsluk = $newmodernsluk;



	$categorySlug = 'modern-competitions';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$competitions = get_sluk_posts($wpPosts,$categorySlug);

	$metroHomeResponse->competitions = $competitions;


	$categorySlug = 'videos-modern';

	$wpPosts = get_posts( ['numberposts' => 3, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$videos = get_sluk_posts($wpPosts,$categorySlug);

	$metroHomeResponse->videos = $videos;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$metroHomeResponse->latestinshop = $latestinshop;

 
  return $metroHomeResponse;
}

function get_modern_features_data( $data ) {

	$featuresResponse = new stdClass;


	$id = 0;
	$image_url = 'https://sluksapp.wpengine.com/wp-content/uploads/2016/03/Loaf-of-bread.png';
	$category = '';
	$title = 'Just nipping out for a loaf of bread';
	$description = '';
	$content = '';
	$published_date = '';
	$featuresResponse->mainbanner = new SulkAppPost($id,$image_url,$category,$title,$description,$content,$published_date);



	$categorySlug = 'sunday-sluk-modern';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$modernfeatures = get_sluk_posts($wpPosts,$categorySlug);

	$featuresResponse->modernfeatures = $modernfeatures;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$featuresResponse->latestinshop = $latestinshop;

 
  return $featuresResponse;
}

function get_modern_news_data( $data ) {

	$newsResponse = new stdClass;

	$id = 0;
	$image_url = 'https://sluksapp.wpengine.com/wp-content/uploads/2016/03/hycraulic.png';
	$category = '';
	$title = 'Work in comfort with a hydraulic bench';
	$description = '';
	$content = '';
	$published_date = '';
	$newsResponse->mainbanner = new SulkAppPost($id,$image_url,$category,$title,$description,$content,$published_date);

	$categorySlug = 'news-modern';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$modernnews = get_sluk_posts($wpPosts,$categorySlug);

	$newsResponse->modernnews = $modernnews;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$newsResponse->latestinshop = $latestinshop;

 
  return $newsResponse;
}

function get_modern_reviews_data( $data ) {

	$reviewsResponse = new stdClass;


	$id = 0;
	$image_url = 'https://sluksapp.wpengine.com/wp-content/uploads/2016/01/MTF_1997.jpg';
	$category = '';
	$title = 'Vespa GTS 300';
	$description = '';
	$content = '';
	$published_date = '';
	$reviewsResponse->mainbanner = new SulkAppPost($id,$image_url,$category,$title,$description,$content,$published_date);



	$categorySlug = 'reviews-modern';

	$wpPosts = get_posts( ['numberposts' => 10, 'category_name' => $categorySlug, 'sort_order' => 'desc', 'orderby' => 'date'] );

	$mordernreviews = get_sluk_posts($wpPosts,$categorySlug);

	$reviewsResponse->mordernreviews = $mordernreviews;


	$wpPosts = get_posts( ['numberposts' => 3, 'post_type' => 'product', 'sort_order' => 'desc', 'orderby' => 'date'] );

	$latestinshop = get_sluk_posts($wpPosts,'product');

	$reviewsResponse->latestinshop = $latestinshop;

 
  return $reviewsResponse;
}

function get_shop_category( $data ) {

	$shopCategoryResponse = new stdClass;

	$args = array(
	    'taxonomy'   => "product_cat",
	);

	$product_categories = get_terms($args);

	$slugShopCategories = [];
	foreach ($product_categories as $product_category) {

		$id = $product_category->term_id;

		$thumbnail_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true );
	    $image_url = wp_get_attachment_url( $thumbnail_id ); 

		$category_name = $product_category->name;
		$number_of_products = $product_category->count;

		$slugShopCategory = new SulkShopCategory($id,$image_url,$category_name,$number_of_products);
		
		$slugShopCategories[] = $slugShopCategory;
	}

	
 
  return $slugShopCategories;
}


function get_sluk_posts($wpPosts,$categorySlug){
	$slugPosts = [];
	foreach ($wpPosts as $wpPost) {
		$slugPost = get_sluk_post($wpPost,$categorySlug);
		$slugPosts[] = $slugPost;
	}
	return $slugPosts;
}

function get_sluk_post($wpPost,$categorySlug){
	global $ThemifyBuilder;
	$categoryData = get_category_by_slug( $categorySlug );

	$id = $wpPost->ID;
	$image_url = get_the_post_thumbnail_url($wpPost->ID);
	$category = ($categoryData)?$categoryData->name:'';
	$title = $wpPost->post_title;
	$description = ($categorySlug === 'product')?get_the_excerpt($wpPost->ID):$ThemifyBuilder->get_first_text($wpPost->ID);
	$content = ($categorySlug === 'product')?$wpPost->post_content:get_sluk_post_content($wpPost->ID);
	$published_date = $wpPost->post_date;
	$slukPost = new SulkAppPost($id,$image_url,$category,$title,$description,$content,$published_date);
	return $slukPost;
}

function get_sluk_post_content($postId){
	global $ThemifyBuilder;
   $builder_data = $ThemifyBuilder->get_builder_data($postId);

   $contentText = '';
    if (is_array($builder_data)) {
        foreach ($builder_data as $row) {
            if (!empty($row['cols'])) {
                foreach ($row['cols'] as $col) {
                    if (!empty($col['modules'])) {
                        foreach ($col['modules'] as $mod) {
                            if (isset($mod['mod_name']) && $mod['mod_name'] === 'text' && !empty($mod['mod_settings']['content_text'])) {
                                $contentText.=$mod['mod_settings']['content_text'];
                            }else if (isset($mod['mod_name']) && $mod['mod_name'] === 'image' && !empty($mod['mod_settings']['url_image'])) {
                                $contentText.='<img src="'.$mod['mod_settings']['url_image'].'" />';
                            }
                            // Check for Sub-rows
                            if (!empty($mod['cols'])) {
                                foreach ($mod['cols'] as $sub_col) {
                                    if (!empty($sub_col['modules'])) {
                                        foreach ($sub_col['modules'] as $sub_module) {
                                            if (isset($sub_module['mod_name']) && $sub_module['mod_name'] === 'text' && !empty($sub_module['mod_settings']['content_text'])) {
                                                $contentText.=$sub_module['mod_settings']['content_text'];
                                            }else if (isset($sub_module['mod_name']) && $sub_module['mod_name'] === 'image' && !empty($sub_module['mod_settings']['url_image'])) {
                                                $contentText.='<img src="'.$sub_module['mod_settings']['url_image'].'" />';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $contentText;
}

function themify_builder_get_data( $post_id ) {
	if( metadata_exists( 'post', $post_id, '_themify_builder_settings_json' ) ) {
		$data = get_post_meta( $post_id, '_themify_builder_settings_json', true );
		$data = stripslashes_deep( json_decode( $data, true ) );

		return $data;
	}

	return false;
}


add_action( 'rest_api_init', function () {
  register_rest_route( 'sluksapp-api/v1', '/retro-home', array(
    'methods' => 'POST',
    'callback' => 'get_retro_home_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/features', array(
    'methods' => 'POST',
    'callback' => 'get_features_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/news', array(
    'methods' => 'POST',
    'callback' => 'get_news_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/reviews', array(
    'methods' => 'POST',
    'callback' => 'get_reviews_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/modern-home', array(
    'methods' => 'POST',
    'callback' => 'get_modern_home_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/shop-category', array(
    'methods' => 'POST',
    'callback' => 'get_shop_category',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/modern-features', array(
    'methods' => 'POST',
    'callback' => 'get_modern_features_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/modern-news', array(
    'methods' => 'POST',
    'callback' => 'get_modern_news_data',
  ) );

  register_rest_route( 'sluksapp-api/v1', '/modern-reviews', array(
    'methods' => 'POST',
    'callback' => 'get_modern_reviews_data',
  ) );

} );