<?php 
$user = stm_get_user_custom_fields('');

 if(isset($_POST) && $_POST['save'] == 'Submit'){
	 //Print_r($_POST);
	 
	if( isset($_POST['user_harleys']) && $_POST['user_harleys'] == 'on'){
		update_user_meta($user['user_id'],'user_harleys','I own 1 or more Harleys');
	}else{
		update_user_meta($user['user_id'],'user_harleys','');
	}
	
	update_user_meta($user['user_id'],'user_model',$_POST['user_model']);
 }

 $harley = get_user_meta($user['user_id'], 'user_harleys', true);

 $model = get_user_meta($user['user_id'], 'user_model', true);
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
							   name="user_harleys" <?php echo(!empty($harley) ? 'checked' : ''); ?>/>
						<span><?php esc_html_e('I own more than 1 Harley-Davidson'); ?></span>
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<label>Model</label>
					
						<select name="user_model" class="form-control large gfield_select select2-hidden-accessible">
						<option>Select a model</option>
						<?php
						

						$make_terms = get_terms(array('taxonomy' => 'make', 'hide_empty' => false, ));								
				 
						foreach( $make_terms as $make ) {
							//$choices[] = array( 'text' => $make->name, 'value' => $make->term_id );
							echo '<option value="'.$make->term_id.'" '; if($model == $make->term_id){ echo " selected"; } echo '>'.$make->name.'</option>';
						} ?>
							
						</select>
					
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