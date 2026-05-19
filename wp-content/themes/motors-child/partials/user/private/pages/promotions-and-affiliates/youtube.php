<div class="panel panel-default pannel-outer-heading mainwelcomecontent">
	<div class="panel-body panel-content-padding">
		<div class="form-group d-flex align-items-center">
			<?php
				$my_postid = 33401;//This is page id or post id
				$content_post = get_post($my_postid);
				$content = $content_post->post_content;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				echo $content;
			?>
		</div>
	</div>
</div>



<?php /* ?><div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page_admin' => 'settings'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
            class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Earn Cash</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                           <?php echo do_shortcode('[gravityform id="12" title="false" description="false"]');?>
                        </div>                        
                    </div>   
                </div>

                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div><?php */ ?>