<?php
    $list = 'active';
    $grid = '';

    if(!empty($_GET['view']) and $_GET['view'] == 'grid') {
        $list = '';
        $grid = 'active';
    }
    $get_current_user_id = get_current_user_id();
    $my_offer_id = get_user_meta($get_current_user_id,'my_offer_id',true);
    
    if(!empty($_REQUEST['delete'])){
        delete_user_meta($get_current_user_id,'my_offer_id');
        wp_delete_post($my_offer_id);
        wp_redirect(esc_url( add_query_arg( array( 'page' => 'add_promotions' ), stm_get_author_link( '' ) ) ));

    }

    $my_offer_id = get_user_meta($get_current_user_id,'my_offer_id',true);
?>
<div class="content-padding gray-bkg vendor-policies dd-promotions">
    <div class="notice-wrapper">
    </div>
    <div class="row">
        <div class="">
            
            <?php 
            if(!empty($_REQUEST['delete'])){
                echo "Offer deleted!";
            }
            ?>
            <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

            <div class="panel panel-default pannel-outer-heading">
                <div class="panel-heading d-flex">
                 <h2 style="text-decoration: underline;    width: 50%;">Create your special offer below:</h2>
                 <?php if(!empty($my_offer_id)){?> 
                  <a style="float: right;text-align: right;width: 50%;" href="?page=add_promotions&delete=1">Delete this offer</a>
              <?php } ?>
                </div>
                <div class="panel-body panel-content-padding add_bike_panel">
                    <div class="form-group d-flex align-items-center">
                        <?php acf_form_head(); ?>
                        <div id="primary">
        <div id="content" role="main">

            <?php /* The loop */ ?>
            
                
                <?php 
                    if(empty($my_offer_id)){
                            acf_form(array(
                            'post_id'       => 'new_post',
                            'post_title'    => true,
                            'post_content'  => false,
                            'new_post'      => array(
                                'post_type'     => 'offers',
                                'post_status'   => 'publish'
                            ),							
                        ));
                    }else {
                        acf_form(array(
							'post_id'       => $my_offer_id,
							'post_title'    => true,
							'post_content'  => false,
							'updated_message' => __("Offer updated", 'acf'),
							'new_post'      => array(
								'post_type'     => 'offers',
								'post_status'   => 'publish'
							),							
                        ));
                    }

                    
                ?>

            

        </div><!-- #content -->
    </div><!-- #primary -->

                        <?php 

                            //echo do_shortcode('[eventer_dashboard default="eventer_add_new"]');
                        ?>    
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

        height: 32px;
        margin-left: 12px;
        padding: 10px 28px !important;

    }

    .current-endpoint-title-wrapper+.content-padding{
            padding-top: 40px;
    }
</style>