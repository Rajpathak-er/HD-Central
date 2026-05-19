<?php
/* Template Name: Find Completed Item Template  */ 
get_header();

error_reporting(E_ALL);  // Turn on all errors, warnings, and notices for easier debugging

// API request variables
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$query = 'harry potter phoenix';
//$query = 'sportster 1200';



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
				<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to HD Central." href="https://hd-central.com" class="home"><span property="name">HD Central</span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="archive post-bike_guide-archive current-item">Test Page</span><meta property="url" content="https://hd-central.com/bike_guide/"><meta property="position" content="2"></span>					
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="sidebar-margin-top clearfix"></div>
				<table>
					<thead>
						<tr>
							<th>No</th>
							<th>Title</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>	
					<?php
						// Construct the findItemsByKeywords POST call
						// Load the call and capture the response returned by the eBay API
						// The constructCallAndGetResponse function is defined below
						$resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query));
						// echo "<pre>";
						// print_r($resp);
						// echo "</pre>";	
						//die();
						
						// Check to see if the call was successful, else print an error
						if ( !empty($resp) && $resp->ack == "Success") {
							$results = '';  // Initialize the $results variable
							
							$i=1;
							// Parse the desired information from the response
							foreach($resp->searchResult->item as $item){
								$title = $item->title;
								$price = $item->sellingStatus->currentPrice;
					?>			
								<tr><td><?php echo $i; ?></td><td><?php echo $title; ?></td><td><?php echo $price; ?></td></tr>
					<?php			
								$i++;
							}
						}else{
							echo "<tr><td><h3>Oops! The request was not successful. Make sure you are using a valid AppID for the Production environment.</h3></td></tr>";
						}
					?>
					</tbody>	
				</table>
			</div>
		</div>
	</div>
	
<?php
	function constructPostCallAndGetResponse($endpoint, $query) {
		global $xmlrequest;
		
		// Create the XML request to be POSTed
		$xmlrequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$xmlrequest .= "<findCompletedItemsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
		$xmlrequest .= "<keywords>";
		$xmlrequest .= $query;
		$xmlrequest .= "</keywords>\n";
		//$xmlrequest .= "<paginationInput>\n  <entriesPerPage>3</entriesPerPage>\n</paginationInput>\n";
		$xmlrequest .= "</findCompletedItemsRequest>";
		
		// Set up the HTTP headers
		$headers = array(
			'X-EBAY-SOA-OPERATION-NAME: findCompletedItems',
			'X-EBAY-SOA-SERVICE-VERSION: 1.0.0',
			'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
			'X-EBAY-SOA-GLOBAL-ID: EBAY-GB',
			'X-EBAY-SOA-SECURITY-APPNAME: JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5',
			'Content-Type: text/xml;charset=utf-8',
		);
		
		$session  = curl_init($endpoint);                       // create a curl session
		curl_setopt($session, CURLOPT_POST, true);              // POST request type
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers);    // set headers using $headers array
		curl_setopt($session, CURLOPT_POSTFIELDS, $xmlrequest); // set the body of the POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    // return values as a string, not to std out
		
		$responsexml = curl_exec($session);                     // send the request
		curl_close($session);                                   // close the session
		return $responsexml;                                    // returns a string
		
	}  // End of constructPostCallAndGetResponse function
?>
	
<?php	
	get_footer();