<?php
//echo "no access for now";
//die;
// Set Cache-Control header
header('Cache-Control: max-age=86400');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache");
//set_time_limit(0);
//ini_set('max_execution_time', 500); //500 seconds
//ini_set('memory_limit', '512M');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR);

define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require '../wp-load.php';
global $wpdb;


$u_id = $_GET['user_id'];
$parent_cat_name = $_GET['parent_cat_name'];
$data_last_product_id = $_GET['data_last_product_id'];

$sql_cat = "select * from product_data where User_id = '".$u_id."' and Parent_Catgeory = '".$parent_cat_name."' and id > '".$data_last_product_id."' order by id ASC LIMIT 4";
$result_cat = $wpdb->get_results($sql_cat);

?>

<?php
  $product_counter = 0;
?>
<?php foreach( $result_cat as $row_cat ) { ?>
  <div class="col-lg-3 col-md-6 listing-list-loop grid_view_inside_content" style="font-family: roboto;">
    <div class=" dealerlistingpage row">
      <div class="col-md-12 col-sm-12 col-xs-12 listing-image-sidebar p-1">
        <div class="quickview">
          <a target="_blank" class="a2a_dd1 addtoany_share_save1 addtoany_share1" href="https://www.hd-central.com/product-page-testv2/?ID=<?php echo $row_cat->id; ?>">
            <div class="eye-icon">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" style="font-size: 14px;">
                <path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
              </svg>
            </div>
          </a>
        </div>
        <img class="product_image" src="<?php echo $row_cat->Image_url_1; ?>">
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 p-1">
        <div class="">
          <div class="meta-middle contentblockpart">
            <div class="row">
              <div class="col-md-12">
                <div class="meta-middle titleblockpart p-1 ">
                  <div class="title heading-font titleblocktop  text-secondary d-flex align-items-center">
                    <div><a target="_blank" href="<?php echo $row_cat->Product_URL; ?>"><?php echo $row_cat->Product_Title; ?></a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="meta-middle descblockpart priceseller pricesellerfavblock">
              <div class="meta-middle-unit-top pricedisplay"><?php echo $row_cat->Product_Currency; ?> <?php echo $row_cat->Product_Price; ?></div>
              <div class="right_content"></div>
            </div>
            <div class="meta-middle descblockpart">
              <div class="meta-middle-unit-top">
                <div class=""><a class="linkseller" href="<?php echo $row_cat->Product_URL; ?>" target="_blank"><?php echo $row_cat->Seller; ?></a></div>
              </div>
            </div>
            <div class="contentblockpart-footer ">
              <div class="footer-col">
                <div class="new-contact-list">
                <div class=" meta-right-unit titleblocktop socialblock contact-tel">
                  <div class="meta-right-unit-inner share-in">
                    <div class="name">
                      <div class="addtoany_shortcode">
                      <div class=" addtoany_list" data-a2a-url="https://www.hd-central.com/service-list/" data-a2a-title="Service Providers">
                        <a class="re-add-fav-btn-product" data-id="<?php echo $row_cat->id; ?>" data-type="fav_provider" title="Add to my dashboard" rel="nofollow" style="cursor: pointer;">
                          <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" class="text-secondary" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" style="font-size: 14px;">
                            <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path>
                          </svg>
                        </a>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="meta-right-unit titleblocktop socialblock contact-tel">
                  <div class="meta-right-unit-inner share-in">
                    <div class="name">
                      <div class="addtoany_shortcode">
                        <div class="addtoany_list" data-a2a-url="https://www.hd-central.com/service-list/" data-a2a-title="Service Providers">
                          <a target="_blank" class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url=https%253A%252F%252Fwww.hd-central.com%252Fbikes-list%252F">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="text-secondary" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" style="font-size: 14px;">
                              <path d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="footer-col" class="last_product_id" data-last-product-id="<?php echo $row_cat->id; ?>">
                <a href="<?php echo $row_cat->Product_URL; ?>" target="_blank" style="text-decoration: none;">
                <div class="buy-now bg-light p-2 text-center border buy-now-buttom">
                  Buy Now
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" class="buy-now ms-3" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" style="color: black; font-size: 11px;">
                    <path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path>
                  </svg>
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    $product_counter++;
    $pat_cat_name = str_replace(" ", "", $row_cat->Parent_Catgeory);
    $pat_cat_name = str_replace("&", "", $pat_cat_name);
  ?>
  <?php if(count($result_cat) == $product_counter) { ?>
    <input type="hidden" class="last_product_id_<?php echo $u_id; ?>_<?php echo $pat_cat_name; ?>" value="<?php echo $row_cat->id; ?>" />
  <?php } ?>
<?php } ?>