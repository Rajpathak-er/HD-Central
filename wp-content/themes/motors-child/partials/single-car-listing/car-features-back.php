<?php


    # code...

$features = get_post_meta( get_the_id(), 'additional_features', true );
$features = ( !empty( $features ) ) ? explode( ',', $features ) : '';

if ( !empty( $features ) ): ?>
    <div class="stm-single-listing-car-features">
        <?php 
        $fdata['Mechanical'] = array("Stage 1","Stage 2","Stage 3","Stage 4","Cams Upgrade","Big bore upgrade","Fuelpak","Dyna Jet");
$fdata['Suspension'] = array("Aftermarket shocks","Aftermarket forks","Springer Fork","Progressive springs");
$fdata['Other'] = array("Custom paint job","Aftermarket handlebars","Aftermarket seat","Belly Fairing","Windscreen","Tanklit","Speedo relocated","Saddle Bags","Numberplate relocated");
$fdata['Electrical'] = array("LED Headlight", "LED Indicator", "Aftermarket Indicator", "Aftermarket Headlight", "Aftermarket Tracker", "Aftermarket Immobiliser");
$fdata['Structural Changes'] = array("Frame shortened (rear)","Hardtail","Aftermarket Frame");

foreach ($fdata as $keyfdata => $featuresdata) {
    
    ?>
        <div class="lists-inline <?php echo "featurerow_".$keyfdata; ?>">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12 featuretitle">

                <?php 
                echo $keyfdata;
                ?>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="row"> 
                    
        				<?php 
                        $existcount = 0;
                        foreach ( $features as $key => $feature ): 
                        if(in_array($feature, $fdata[$keyfdata])) {
                            $existcount++;
                        ?>
        			
                    
                    
        			
                        <div class="col-md-6 col-sm-12 col-xs-12 featuresdatasingle"><?php echo stm_dynamic_string_translation('Car feature ' . $feature, $feature ); ?></div>
        				<?php
                        }
                       
                     endforeach;
                      if($existcount == 0){
                            echo "<style>";
                            echo ".featurerow_".$keyfdata. "{display:none;}";

                            echo "</style>";
                        }
                        
                      ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
<?php endif; 


?>