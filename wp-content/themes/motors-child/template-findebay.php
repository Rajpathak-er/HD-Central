<?php
/* Template Name: Find on ebay  */ 
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
							<form method="get">
								<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Keyword</h5>
								<div class="form-group">
									<div class="mileage_container">
										<input type="text" id="keywords" class="" placeholder="Enter bike name" name="keywords" value="<?php echo $_GET['keywords']; ?>">	
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12" style="margin-top: 10px;">
								<div class="clearfix">
									<button type="submit" name="filter_btn" class="button">Search</button>
								</div>
							</div>
							</form> 
							<!--<div class="col-md-12 col-sm-12">
								<div class="clearfix">
									<h4 class="pull-left " style="text-transform: uppercase;">Filter</h4>
								</div>
							</div>-->						
							
							<table><tr>
								<td>Title</td>
							</tr>


							<?php

								$keywords = urlencode($_GET['keywords']); 
								// $json = file_get_contents('https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805');
								
								$json = file_get_contents('https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805&paginationInput.entriesPerPage=10');

								$obj = json_decode($json);
								
								foreach ($obj->findCompletedItemsResponse[0]->searchResult[0]->item as $key => $bikedata) {
									
									$detail_json = file_get_contents('https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=Description,ItemSpecifics&ItemID='.$bikedata->itemId[0]);
									
									$obj_detail = json_decode($detail_json);
									//echo "+++".$obj_detail->Item->ItemSpecifics->NameValueList;

									echo "<tr><td><a href='".$bikedata->viewItemURL[0]."'>".$bikedata->title[0]."</a></td>";
									echo "<td>".$bikedata->sellingStatus[0]->currentPrice[0]->__value__." GBP </td>";
									
									echo "<td style='width: 180px;'>";
									//echo "<div>Condition: ".$obj_detail->Item->ConditionDisplayName."</div><div>Seller notes: ".$obj_detail->Item->ConditionDescription."</div>";
										foreach ($obj_detail->Item->ItemSpecifics->NameValueList as $key => $itemdata) {
											echo "<div>".$itemdata->Name.": ".$itemdata->Value[0]."</div>";
										}
									echo "</td>";
									
									echo "</tr>";									
								}

								
							?>
							</table>
							
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