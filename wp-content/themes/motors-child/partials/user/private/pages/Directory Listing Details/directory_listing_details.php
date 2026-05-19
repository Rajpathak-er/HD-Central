
<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">
        
    <form action="<?php echo esc_url(add_query_arg(array('page_admin' => 'settings'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form col-md-12">
        <div class="col-md-12">
            <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Business Description</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Business Description </label>
                            <div class="col-md-6 col-sm-9">

                            <textarea class="form-control" name="stm_business_description"
                                    
                                    placeholder="<?php esc_attr_e('Please provide a description of your business ', 'motors') ?>" />
                            </div>
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
</div>



