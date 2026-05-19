<?php 
/* Template Name: Single OEM Parts Finder */ 

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

get_header();

$host = "127.0.0.1:3306"; 
$user = "bn_wordpress"; 
$password = "b25b32f45a01e26c1eec323bd2901db14fc568812339ea362ff1f830612a3b62"; 
$dbname = "bitnami_wordpress"; 

$con = mysqli_connect($host, $user, $password, $dbname);

//print_r($_POST);
if(!empty($_POST['savepart'])){
	$user_id = get_current_user_id();
	$existingparts = get_user_meta( $user_id, "my_parts",true );
	$newParts  = $_POST['parts'];
	
	if(!empty($existingparts)){
		$newtosave = array_merge($existingparts,$newParts);	
	} else {
		$newtosave =$newParts; 
	}

	update_user_meta($user_id, "my_parts",$newtosave);

	if(!empty($newParts)){
		foreach($newParts as $part_in){
			$sql = "insert into parts_wanted (part_id, user_id, created_date) values ($part_in, $user_id, '" . date('Y-m-d H:i:s') . "') ";
			mysqli_query($con, $sql);
		}
	}


}

$upload_dir  = wp_upload_dir();
global $wpdb;

//https://hd-central.com/wp-content/uploads/2020/07/watermark_1_Small.jpg

if( !isset($_REQUEST['id']) || empty($_REQUEST['id']) ){
	wp_redirect(get_permalink(26822));
	exit;
}

$id = "";
if( isset($_REQUEST['id']) ){
	$id = $_REQUEST['id'];
}
//echo "++++".$id;

$id_check = "SELECT * FROM ". $wpdb->prefix ."product_list where id = ".$id;
$id_result = $wpdb->get_results($id_check);
$part_src = $id_result[0]->part_src;
if( count($id_result) == 0 ){
	echo "No such product found";
	exit;
}

$part_qry = "SELECT * FROM product_detail where plist_id = ".$id;
$part_result = $wpdb->get_results($part_qry);
$part_count = count($part_result);
echo "+++".$part_count;

if($part_count == 0){

$id_check = "SELECT * FROM ". $wpdb->prefix ."product_list where part_src = '".$part_src."'";
$id_result = $wpdb->get_results($id_check);
$part_src = $id_result[0]->part_src;
if( count($id_result) == 0 ){
	echo "No such product found";
	exit;
}
$id = $id_result[0]->id;
$part_qry = "SELECT * FROM product_detail where plist_id = ".$id_result[0]->id;

$part_result = $wpdb->get_results($part_qry);
$part_count = count($part_result);

}


?>
	<style>
		/*.image_wrapper img{
			margin: 0 auto;
			width: 100%;
		}
		.image_wrapper img:hover{
			transform: scale(1.5); /* (150% zoom)*/
		}*/
		
		
		


/* Hotspot */

#hotspotImg {
  background-color: #ededed;
  background-size: cover;
  background-position: center center;
  position: relative;
}

#hotspotImg .img-responsive { max-width: 100%; }

#hotspotImg .hot-spot {
  position: absolute;
  width: 25px;
  height: 25px;
  top: 5px;
  left: 5px;
  text-align: center;
  /*background-color: rgba(214, 15, 24, 0.6);*/
  color: #fff;
  border-radius: 100%;
  cursor: pointer;
  transition: all .3s ease;
  margin-left: 5px;
}

#hotspotImg .hot-spot .circle {
  display: block;
  position: absolute;
  top: 45%;
  left: 45%;
  width: 2em;
  height: 2em;
  margin: -1em auto auto -1em;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  border-radius: 50%;
  border: 1px solid #E5008A;
  opacity: 0;
  
}

#hotspotImg .hot-spot .tooltip {
      background-color: #f1f1f1;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  color: #fff;
  display: none;
  font-size: 14px;
  opacity: 1.0;
  left: 0px;
  
  position: absolute;
  text-align: left;
  top: 30px;
  width: 280px;
  z-index: 999;
}

#hotspotImg .hot-spot .tooltip .img-row {
  padding: 10px;
  text-align: center;
}

#hotspotImg .hot-spot .tooltip .text-row { padding: 0px; }

#hotspotImg .hot-spot .tooltip h4 {
	display: none;
  margin-bottom: 10px;
  border-bottom: 1px solid #ffffff;
}

#hotspotImg .hot-spot .tooltip p {
  font-size: 14px;
  line-height: 1.4em;
  margin-bottom: 10px;
}

#hotspotImg .hot-spot .tooltip p:last-child { margin-bottom: 0; }

	</style>

	<div class="entry-header left small_title_box" style="">
		<div class="container">
			<div class="entry-title vc_row">
				<!--<div class="sub-title h5 vc_col-sm-3" style="<?php //echo implode( ' ', $title_style_subtitle ); ?>">
					<?php //echo do_shortcode('[widget id="search-3"]'); ?>
                    <h2><?php //echo apply_filters( 'stm_balance_tags', $sub_title ); ?></h2>
				</div>-->
			</div>
				<div class="vc_col-sm-12 post_title_main_heading">
					<h2 class="h1" style="">
						HDC OEM Parts finder       
					</h2>
				</div>
							
		</div>
	</div>
	
	<div class="container">
		<div class="row" style="margin-top: 10px;">
		
		<?php if( $part_count > 0  ){ ?>
		
			<div class="col-md-7 col-sm-6 col-xs-12">
				<div class="ari_part_image img_container" id="ari_part_image" >
					<div class="image_wrapper">
						<!--<img src="<?php echo $upload_dir['baseurl']; ?>/2020/07/watermark_1_Small.jpg" class="img-responsive part_image" usemap="#map1">						
						<map name="map1">
							<area href="https://hd-central.com/harley-davidson-manuals/" shape="rect" coords="1885,1528,1911,1587" title="Gwynneth Paltrow" alt="Gwynneth Paltrow 1" />
							<area href="#" shape="rect" coords="345,1794,371,1853" title="Naomi Watts" alt="Naomi Watts 1" />
						</map>-->
						
						<?php
							//1885;1528;1911;1587
							//345;1794;371;1853
							//492;2428;518;2487
							// $xCenter = (1885 + 1911) / 2;
							// $yCenter = (1528 + 1587) / 2;
						//$part_src = $row->part_src;
						// remove '/Small' from url 
						$url = explode('/', $part_src);
						array_pop($url);
						$part_src = implode('/', $url);
			
						//echo "part_src: ".$part_src."<br>";			
						
						$image_name = basename($part_src);
						$image_name = $image_name.".jpg";
						?>
						
						<div id="hotspotImg" class="responsive-hotspot-wrap">
							<img src="https://d3w1ljn98p0vd6.cloudfront.net/parts/<?php echo $image_name; ?>" class="img-responsive part_image">				
							<?php 

							foreach($part_result as $part){
								$img_coords = $part->img_coords;
								$coords  = explode(";", $img_coords);
							?>
							<div class="hot-spot" x="<?php echo $coords[0];?>" y="<?php echo $coords[1];?>">
								<div class="circle"></div>
								<div class="tooltip">
									<div class="text-row">
										<h4>PART Details</h4>

										<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg" style="margin-bottom: 0px;">
										
											<tr>
												<td>
													HD- OEM Part number
												</td>
												<td>
													<?php echo $part->part_number; ?>
												</td>
											</tr>
											<tr>
												<td>
													Part Description
												</td>
												<td>
													<?php echo $part->part_desc; ?>
												</td>
											</tr>
										</table>
										
										
										
									</div>
								</div>
							</div>
							<?php 
							}
							?>		
							

						
							
							
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="col-md-5 col-sm-6 col-xs-12">
				<div class="ari_part_list list_container" id="ari_part_list">
					<?php 
					if(!empty($_POST['savepart'])){
						echo "<h3>Your parts saved to your account!</h3>";
					}
					?>
					<h2>Create Your Parts List Below :</h2>
					<form method="post">
					<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
					<thead>
						<tr>
							<th>
								Ref:
							</th>
							<th>
								OEM REF:
							</th>
							<th>
								Part Description
							</th>
							<th>
								Select
							</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i = 0;
						foreach($part_result as $part){					
					?>					
						<tr id="pl_row_<?php echo $part->ref_no ."_". $part->id; ?>" data-tag="<?php echo $part->ref_no; ?>" data-partid="<?php echo $part->id; ?>" class="ari_part_info">
							<td class="ari_PLTag">
								<?php echo $part->ref_no; ?>
							</td>
							<td class="ari_PLSku">
								<?php echo $part->part_number; ?></div>
								
							</td>
							<td class="ari_desc">
								<?php echo $part->part_desc; ?></div>
							</td>
							<td style="text-align: center;">
								
								<input type="checkbox" name="parts[]" value="<?php echo $part->id; ?>">
							</td>
							<!--<div class="ariPriceColumn">
								<div class="ari_PLPrice" data-price="<?php echo $part->price; ?>">
									<span class="price_label">Hinta:</span> <?php echo $part->price; ?>
								</div>
                                <div class="ari_PLQty ari_PLQtyInput">
									<input id="ariparts_qty<?php echo $i; ?>" type="number" pattern="\d*" value="<?php echo $part->quantity; ?>" min="1">
								</div>
                                <div class="ari_PLCart">
									<span style="">
										<input type="button" class="ariPartListAddToCart ariImageOverride" id="ariparts_btnCart<?php echo $i; ?>" value="Lisää ostoskoriin">
									</span>
								</div>
							</div>
							--->
						</tr>
						
					<?php 
							$i++;
						} 
					?>
					</tbody>
					</table>
					<?php  if(is_user_logged_in()){

						?>
					<div class="savepartbutton" style="text-align: right;">
					<input type="submit" name="savepart"  value="Save Parts" class="button"  style="float: right;" />
				</div> <?php 
				}else{
					echo "<h3>Please login to save parts</h3>";
				}
				?>
			</form>
				</div>
			</div>	
			
		<?php } ?>	
		
		</div>
	</div>
	
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	
	<script type='text/javascript' src='<?php //echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.hotspot.js'></script>
	<script>
		jQuery(document).ready(function(){
			 if (jQuery('#hotspotImg').length > 0) {
				 jQuery('#hotspotImg').hotSpot({
					 bindselector: 'click'
				 });
			 }
			
			// jQuery('#hotspotImg').hotSpot({
				// // default selectors
				// mainselector: '#hotspotImg',
				// selector: '.hot-spot',
				// imageselector: '.img-responsive',
				// tooltipselector: '.tooltip',
				// // or 'click'
				// bindselector: 'hover'			  
			// });
		});
	</script>
	
<?php
	get_footer();
?>	
