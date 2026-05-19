<?php
/* Template Name: Value My Bike Template  */ 
get_header();

?>
<div id="main">
	<div class="entry-header left small_title_box" style="">
		<div class="container">
			<div class="entry-title">
				<h2 class="h1" style="">
					Model Guide             
				</h2>
			</div>
		</div>
	</div>

	<!-- Breads -->	
	<div class="stm_breadcrumbs_unit heading-font ">
		<div class="container">
			<div class="navxtBreads">
				<!-- Breadcrumb NavXT 6.5.0 -->
				<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to HD Central." href="https://hd-central.com" class="home"><span property="name">HD Central</span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="archive post-bike_guide-archive current-item">Value My Bike</span><meta property="url" content="https://hd-central.com/bike_guide/"><meta property="position" content="2"></span>					</div>
			</div>
		</div>
		<div class="container">
	<div class="row">
		<div class="col-md-9 col-md-push-3 col-sm-12"><div class="sidebar-margin-top clearfix"></div>
			<div class="classic-filter-row" style="margin-top: 0px;">
				<form action="<?php echo($_SERVER["REQUEST_URI"]); ?>" method="get" class="filter_guide">
					<div class="filter filter-sidebar">
						<div class="row row-pad-top-24">
							<!--<div class="col-md-12 col-sm-12">
								<div class="clearfix">
									<h4 class="pull-left " style="text-transform: uppercase;">Filter</h4>
								</div>
							</div>-->						
							
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Year:</h5>
								<select name="years" class="form-control">
									<option value=""><?php _e('Years', ''); ?></option>
									<?php
										$years_terms = get_terms(array('taxonomy' => 'ca-year', 'hide_empty' => false, ));
										foreach( $years_terms as $year ) {											
									?>
											<option value="<?php echo esc_attr( $year->term_id ); ?>" <?php if($_REQUEST['years'] == $year->term_id){ echo "selected";} ?>><?php echo esc_html( $year->name ); ?></option>
									<?php								
										}
									?>
								</select>
							</div>
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Model:</h5>
								<select name="make" class="form-control">
									<option value=""><?php _e('Models', ''); ?></option>
									<?php
										$make_terms = get_terms(array('taxonomy' => 'make', 'hide_empty' => false, ));
										foreach( $make_terms as $make ) {
									?>	
											<option value="<?php echo esc_attr( $make->term_id ); ?>" <?php if($_REQUEST['make'] == $make->term_id){ echo "selected";} ?>><?php echo esc_html( $make->name ); ?></option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Model Range:</h5>
								<select name="serie" class="form-control">
									<option value=""><?php _e('Model Range', ''); ?></option>
									<?php
										$serie_terms = get_terms(array('taxonomy' => 'serie','hide_empty' => false, ));
										foreach( $serie_terms as $serie ) {
									?>	
											<option value="<?php echo esc_attr( $serie->term_id ); ?>" <?php if($_REQUEST['serie'] == $serie->term_id){ echo "selected";} ?>><?php echo esc_html( $serie->name ); ?></option>
									<?php		
										}
									?>
								</select>
							</div>													
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Mileage</h5>
								<div class="form-group">
									<div class="mileage_container">
										<input type="text" id="mileage" class="" placeholder="Enter mileage" name="mileage" value="<?php if(isset($_GET['mileage'])){echo $_GET['mileage'];} ?>">	
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">No Of Previous Previous:</h5>
								<select name="previous_keepers" class="form-control">
									<option value=""><?php _e('Previous Previous', ''); ?></option>
									<?php for($i=1; $i<=10; $i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>	
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Bike Category:</h5>
								<select name="bike_category" class="form-control">
									<option value=""><?php _e('Select Bike Category', ''); ?></option>
									<option value="a">A</option>
									<option value="b">B</option>
									<option value="c">C</option>
									<option value="d">D</option>									
								</select>
							</div>
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">MOT Status:</h5>
								<select name="mot_status" class="form-control">
									<option value=""><?php _e('Select MOT Status', ''); ?></option>
									<option value="valid ">Valid</option>
									<option value="not_valid">Not Valid</option>
								</select>
							</div>
														
							<div class="col-md-12 col-sm-12" style="margin-top: 10px;">
								<div class="clearfix">
									<button type="submit" name="filter_btn" class="button">Save</button>
								</div>
							</div>


							
						</div>				
					</div>
				</form>	
			</div>				
		</div>
		<div class="col-md-3 col-md-pull-9 hidden-sm hidden-xs">
			<aside id="archives-3" class="widget widget-default widget_archive">
				<div class="widget-title">
					<h4>Sidebar</h4>
				</div>		
			</aside>		
		</div>
	</div>
</div>
	<?php
	
	get_footer();