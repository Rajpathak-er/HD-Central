<?php 
$user = stm_get_user_custom_fields('');

/* 
 
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
 */
 $join = get_user_meta($user['user_id'], 'user_join_list', true);

 $rcv = get_user_meta($user['user_id'], 'user_offers', true);
?>

 <!--Main information-->
<div class="stm-change-block">
	<div class="main-info-settings harley_ownership">
	
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Header Create a promotion for your business </h2>
<p>We can help your business grow by offering you the ability to directly reach your customers and the thousands of visitors on our site by choosing on of the promotion types below. 
</p>
<p>
Offer a discount on any of the services you provide : 
</p>
 

<p>
<?php 
echo do_shortcode('[gravityform id="13" title="false" description="false"]');

?>
	</p>

<p>*We receive hundreds of videos everyday so give us at least 5 days to respond and conform if your video has made it or not </p>
			</div>
		</div>
		
		
		
	</div>
</div>