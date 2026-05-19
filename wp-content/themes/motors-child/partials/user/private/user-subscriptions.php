<?php 
$user = stm_get_user_custom_fields('');

 
 
 if(isset($_POST) && $_POST['save'] == 'Submit'){
	 //Print_r($_POST);
	 
	if( isset($_POST['user_join_list']) && $_POST['user_join_list'] == 'on'){
		update_user_meta($user['user_id'],'user_join_list','Join our mailing list with news and other updates');
	}else{
		update_user_meta($user['user_id'],'user_join_list','');
	}
	
	if(isset($_POST['user_offers']) && $_POST['user_offers'] == 'on'){
		update_user_meta($user['user_id'],'user_offers','Receive offers and discounts from local suppliers and dealers ( and more)');
	}else{
		update_user_meta($user['user_id'],'user_offers','');
	}
 }
 
 $join = get_user_meta($user['user_id'], 'user_join_list', true);

 $rcv = get_user_meta($user['user_id'], 'user_offers', true);
?>

 <!--Main information-->
<div class="stm-change-block">
	<div class="main-info-settings harley_ownership">
	<form action="" method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
              class="stm_save_user_settings_ajax">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<label>
						<input type="checkbox"
							   name="user_join_list" <?php echo(!empty($join) ? 'checked' : ''); ?>/>
						<span><?php esc_html_e('Join our mailing list with news and other updates'); ?></span>
					</label>
					
					<label>
						<input type="checkbox"
							   name="user_offers" <?php echo(!empty($rcv) ? 'checked' : ''); ?>/>
						<span><?php esc_html_e('Receive offers and discounts from local suppliers and dealers ( and more)'); ?></span>
					</label>
					
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<input type="submit" id="submit_button" class="button submit_button" value="Submit" name="save">
			</div>
		</div>
		</form>
	</div>
</div>