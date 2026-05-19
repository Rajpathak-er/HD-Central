<?php
	
	//$get_current_user_id = get_current_user_id();
	$my_event_id = "";
	$errMsg = "";
	$errStyle = "display: none;";
	
	$return_url = stm_get_author_link( '' )."?page=my_event";
		
	if( isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
		
		if( isset($_REQUEST['action']) && $_REQUEST['action'] == "delete" ){
			wp_trash_post($_REQUEST['id'], false);
			
			wp_redirect( $return_url );
			exit;
		}
		
		if( 'event' === get_post_type($_REQUEST['id']) && FALSE != get_post_status( $_REQUEST['id'] ) ) {
			//echo "tttt111";
			$my_event_id = $_REQUEST['id'];
		
		} else {
			//echo "tttt";
			// The post does not exist
			$errMsg = "No Such Event Exists";
			$errStyle = "display: block;";
		}		
	}	
		
	
	
?>

<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
	<div class="current-endpoint">
		<i class="wcmp-font ico-policies-icon"></i><span>Add Event</span>
	</div>
</div>
	
<div class="content-padding gray-bkg vendor-policies add_event_container">
    <div class="notice-wrapper" style="<?php echo $errStyle; ?>">
		<p><?php echo $errMsg; ?></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default pannel-outer-heading">
				<div class="panel-heading d-flex">
					
				</div>
				<div class="panel-body panel-content-padding add_bike_panel">
					<div class="form-group d-flex align-items-center">
						<?php acf_form_head(); ?>
						<div id="primary">
							<div id="content" role="main">
								<?php 
									if( empty($my_event_id) ){										
										acf_form(array(
											'post_id'		=> 'new_post',
											'post_title'	=> true,
											'post_content'	=> true,
											'new_post'		=> array(
												'post_type'		=> 'event',
												'post_status'	=> 'publish'
											),
											'return' => $return_url,
											'submit_value'  => 'Create Event'
										));
									}else {										
										acf_form(array(
											'post_id'		=> $my_event_id,
											'post_title'	=> true,
											'post_content'	=> true,
											'updated_message' => __("Event updated", 'acf'),											
											'submit_value'  => __('Update Event'),
											'return' => $return_url,
										));
									}
								?>
							</div><!-- #content -->
						</div><!-- #primary -->
						  
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
<style type="text/css">
	.acf-form{
		    width: 700px;
			max-width: 100%;
		}
	.acf-button{
		height: 44px;
 	}
 	/*.current-endpoint-title-wrapper+.content-padding{
 		    padding-top: 30px;
 	}*/
</style>