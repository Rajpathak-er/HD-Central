<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

		<div class="col-md-12">
		
			<div class="invoice_container">
				<div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Invoices and Payments</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center">
							<div class="col-md-12 col-sm-12">
								<?php echo do_shortcode('[pmpro_account]'); ?>
							</div>
						</div>
					</div>
				</div>	
			</div>
			
            <?php /* ?><!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
            <form action="<?php echo esc_url(add_query_arg(array('page_admin' => 'settings'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form">
                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Payment Provider</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Name</label>
                            <div class="col-md-6 col-sm-9">

                                <select class="form-control" name="vendor_payment_mode" id="vendor_payment_mode">
                                    <option value="">Payment Mode</option>
                                    <option value="paypal_masspay">PayPal</option>
                                    <option value="stripe_masspay">Stripe</option>
                                </select>
                            </div>


                        </div>
                    </div>
                    <div class="wcmp-action-container">
                        <button class="btn btn-default" type="submit">Save Changes</button>
                        <div class="clear"></div>
                    </div>
            </form><?php */ ?>
			
			
        </div>
    </div>
</div>