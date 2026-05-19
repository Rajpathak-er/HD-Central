<?php
$user_id = get_current_user_id();
$parts = get_user_meta( $user_id, "my_parts",true );

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(!empty($_REQUEST['id'])){
	
	$key = array_search($_REQUEST['id'], $parts);
	if (false !== $key) {
		unset($parts[$key]);
	}
	update_user_meta($user_id, "my_parts",$parts);
}

?>


<!--Main information-->
<div class="stm-change-block">
	<div class="main-info-settings harley_ownership">
	
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php
				//print_r($parts);
					global $wpdb;  
					$partid	= '';
					
					foreach(array_unique($parts) as $part_result){
						$partid .= $part_result.',';
					}
						
					$partid = rtrim($partid,',');
					$query = "SELECT DISTINCT * FROM ". $wpdb->prefix ."product_list where id IN(select plist_id from product_detail where id IN(". $partid. "))";
					$query_res = $wpdb->get_results($query);
							
					foreach($query_res as $results){
						
						//print_r($results);
			 
						$part_qry = "SELECT DISTINCT * FROM product_detail p  where id IN(".$partid.") and plist_id =".$results->id;
						$partres = $wpdb->get_results($part_qry);   ?>
								
								
					<h2 class="parts-title">
						<strong><?php echo $results->product_year .'&nbsp;&nbsp;'. $results->product_model; ?></strong>&nbsp;&nbsp;
						<?php echo $results->product_range . '&nbsp;&nbsp;'. $results->part_name; ?>
					</h2>
					
					
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
									Action
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach($partres as $part){		
						?>					
							<tr id="pl_row_<?php echo $part->ref_no ."_". $part->id; ?>" data-tag="<?php echo $part->ref_no; ?>" data-partid="<?php echo $part->id; ?>" class="ari_part_info">
								
								<td class="ari_PLTag" style="width:10%">
									<?php echo $part->ref_no; ?>
								</td>
								<td class="ari_PLSku" style="width:15%">
									<?php echo $part->part_number; ?>
									
								</td>
								<td class="ari_desc" style="width:60%">
									<a href="<?php echo site_url();?>/single-parts/?id=<?php echo $results->id; ?>"><?php echo $part->part_desc; ?></a>  
								</td>
								<td style="width:15%">
									<a href="<?php echo site_url(); ?>/author/hd_admin/?page=my-parts-list&id=<?php echo $part->id; ?>" name="delete" class="button deletebtn" style="">Delete <i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php 
								}
								
						?>
						</tbody>
					</table>
					<?php } ?>
			</div>
		</div>
		
		
		
	</div>
</div>