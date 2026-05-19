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
				<h4>Become part of our Youtube Affiliate Scheme </h4>
<p>You can earn money but sharing your videos on our Youtube channel. We will share 50 % of all the advertising revenue with you and we may even ask you for more which we will pay you for. 
We may however not use your video but will let you know if this is the case</p>
<p>
Videos we are looking for on our channel include: 
</p>
<ul>
	<li>Fixing and servicing your ride </li>
	<li>Road trip Points of Interest </li>
	<li>Exceptional rides </li>
    <li>Hacks and tips</li>
<li>Bike Reviews</li>
<li>Showstopper videos of any kind that relate to Harley’s </li>
</ul>
 
<p>
The list is endless so if you think others will like it let us know. Visit the YouTube affiliate page on our main site to see the list of video content we are currently commissioning or may be looking for. 
</p>
<p>You can submit your video here 
</p>
<p>
<?php 
echo do_shortcode('[gravityform id="12" title="false" description="false"]');

?>
	</p>

<p>*We receive hundreds of videos everyday so give us at least 5 days to respond and conform if your video has made it or not </p>
			</div>
		</div>
		
		
		
	</div>
</div>