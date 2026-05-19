<?php

error_reporting(E_ERROR);
ini_set('display_errors', 1);

ini_set('max_execution_time', 0);
ini_set('default_socket_timeout', 90);
ini_set('memory_limit', '2048M');

$access_token = "";
$client_id = "JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5";
$client_secret = "PRD-c8eaa0dbc844-1de8-4109-84ca-a8b3";

global $total_page;

$servername = "localhost";
$username = "bn_wordpress";
$password = "b25b32f45a01e26c1eec323bd2901db14fc568812339ea362ff1f830612a3b62";
$dbname = "bitnami_wordpress";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

get_data(1, $conn);

function get_product_details($item_id) {
    global $access_token, $client_id, $client_secret;

    $access_token = get_access_token();
    $url = "https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID=" . $item_id;
    $headers = array(
        "X-EBAY-API-IAF-TOKEN:" . $access_token
    );
    $post_data = array();
    $product_details = get_html($url, "", $headers, $post_data);
    $response = json_decode($product_details, true);

    if (isset($response["Errors"]["ShortMessage"])) {
        if ($response["Errors"]["ShortMessage"] == "Invalid token.") {
            $access_token = get_access_token();
            $url = "https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID=" . $item_id;
            $headers = array(
                "X-EBAY-API-IAF-TOKEN:" . $access_token
            );
            $post_data = array();
            $product_details = get_html($url, "", $headers, $post_data);
        }
    }
    // $product_details = json_decode($product_details, true);
    // echo "<pre>";
    // print_r($product_details);
    // exit;

    return $product_details;
}

// Function to perform CURL Request on eBay API
function get_html($url, $cookiefile, $headers, $postarray) {

    $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:20.0.0) Gecko/20100101 Firefox/A20.0.0';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);

    if ($cookiefile != "") {
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/' . $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/' . $cookiefile);
    }

    if (empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: q=0.9,en-US;q=0.8,en;q=0.7',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
        ));
    } else {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    if (!empty($postarray)) {

        $post_array = array();
        foreach ($postarray as $key => $value) {
            $post_array[] = urlencode($key) . '=' . urlencode($value);
        }
        $post_string = implode('&', $post_array);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    $pageContent = curl_exec($ch);

    curl_close($ch);

    return $pageContent;
}

function get_access_token() {
    global $access_token, $client_id, $client_secret;
    $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
    );

    $post_data = array(
        "grant_type" => "client_credentials",
        "scope" => "https://api.ebay.com/oauth/api_scope"

    );

    $access_token_content = get_html("https://api.ebay.com/identity/v1/oauth2/token", "", $headers, $post_data);
    $access_token = json_decode($access_token_content, true)["access_token"];
    return $access_token;
}

function curl_get_contents($url) {
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 500000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $data = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "cURL Error properties #:" . $err;
    }
    return $data;
}

function outputCsv($fileName, $assocDataArray, $page) {
    ob_clean();
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName);
    if (isset($assocDataArray['0'])) {
        $fp = fopen('php://output', 'a');
        foreach ($assocDataArray as $values) {
            fputcsv($fp, $values);
        }
        fclose($fp);
    }
    ob_flush();
    $page = $page + 1;
    //get_data($page);
}

function removeElementsByTagName($tagName, $document) {
    $nodeList = $document->getElementsByTagName($tagName);
    for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0;) {
        $node = $nodeList->item($nodeIdx);
        $node->parentNode->removeChild($node);
    }
}

function removestypetag($htmlcontent) {

    // create a new DomDocument object
    $doc = new DOMDocument();

    // load the HTML into the DomDocument object (this would be your source HTML)
    $doc->loadHTML($htmlcontent);
    removeElementsByTagName('script', $doc);
    removeElementsByTagName('style', $doc);
    removeElementsByTagName('link', $doc);

    // output cleaned html
    return $doc->saveHtml();
}

function ebay_csv_header() {
    $fields = array("No" => "No", "ItemId" => "ItemId", "Title" => "Title", "Price" => "Price", "Currency Id" => "Currency Id", "URL" => "URL", "Gallery URL" => "Gallery URL", "Listing End Date" => "Listing End Date", "Listing Status" => "Listing Status", "Postal Code" => "Postal Code", "Location" => "Location", "Country" => "Country", "Colour" => "Colour", "Mileage" => "Mileage", "Power" => "Power", "Engine Size" => "Engine Size", "Year" => "Year", "Manufacturer" => "Manufacturer", "Model" => "Model", "Type" => "Type", "Gears" => "Gears", "Start Type" => "Start Type", "Drive Type" => "Drive Type", "Date of 1st Registration" => "Date of 1st Registration", "MOT Expiry Date" => "MOT Expiry Date", "MOT Expiration Date" => "MOT Expiration Date", "Capacity (cc)" => "Capacity (cc)", "Fuel" => "Fuel", "Transmission" => "Transmission", "Number of Manual Gears" => "Number of Manual Gears", "Extra Features" => "Extra Features", "V5 Registration Document" => "V5 Registration Document", "Previous owners (excl. current)" => "Previous owners (excl. current)", "Warranty" => "Warranty", "Modified Item" => "Modified Item", "Customised Features" => "Customised Features", "Road Tax Remaining" => "Road Tax Remaining", "Vehicle Type" => "Vehicle Type", "Additional Information" => "Additional Information", "Modification Description" => "Modification Description", "Performance Upgrades" => "Performance Upgrades", "Previous owners" => "Previous owners", "Country/Region of Manufacture" => "Country/Region of Manufacture", "Metallic Paint" => "Metallic Paint", "Street Name" => "Street Name", "Reg. Mark" => "Reg. Mark", "PictureURL" => "PictureURL", "Independent Vehicle Inspection" => "Independent Vehicle Inspection");
    // echo count($fields); exit;
    return $fields;
}

function get_data($page = 1, $conn) {
    global $total_page;

    $curDate = date('Y-m-d H:i:s');
    $filename = $curDate . "-ebay.csv";
    $fields = ebay_csv_header();
    $keywords = "harley davidson parts accessories";
    $perpage = '&paginationInput.entriesPerPage=100';
    $pageno = '&paginationInput.pageNumber=' . $page;
    $sort_order = '&sortOrder=SortOrderType.Ascending';
    $sort_on = '&sortOn=SortOnType.EndTimeSoonest';
    $product_Category = array(
        "180028",
        "35559",
        "49790",
        "180029",
        "179853",
        "171107",
        "180027",
        "179752",
        "178998",
        "180033",
        "180034",
        "178030",
        "178996",
        "183504",
        "177075",
        "261272",
        "179469",
        "43990",
        "179421",
        "179463",
        "179443",
        "183745",
        "62250",
        "179735",
        "180513",
        "179731",
        "179715",
        "183530",
        "179723",
        "177962"
    );

    // echo count($product_Category); exit;
    $ra_random_index = array_rand($product_Category);
    $ebay_category = $product_Category[$ra_random_index];
    #$ebay_category = "261272";
    #echo $ebay_category; exit;

    $country_code_arr = [
        "1" => "EBAY-US", // USA
        "2" => "EBAY-GB", // UK
        "3" => "EBAY-DE", // Germany
        "4" => "EBAY-NL", // Netherlands
        "5" => "EBAY-AU", // Australia
        "6" => "EBAY-ENCA", // Canada
        "7" => "EBAY-CH"  // Switzerland
    ];

    $day = date("N");
    $country_code = $country_code_arr[$day];


    $url = 'https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&outputSelector(0)=PictureURLLarge&outputSelector(1)=PictureURLSuperSize&outputSelector(2)=GalleryInfo&REST-PAYLOAD&keywords=' . rawurlencode($keywords) . '&GLOBAL-ID=' . $country_code . '&categoryId=' . $ebay_category . $perpage . $pageno . $sort_order . $sort_on;
    $json = curl_get_contents($url);
    #$json = file_get_contents('/var/www/html/products.json');

    $obj = json_decode($json);
    // echo "<pre>";
    // print_r($obj);
    // exit;
    $singleData = array();
    $i = 0;

    if ($page == 1) {
        $total_page = $obj->findItemsAdvancedResponse[0]->paginationOutput[0]->totalPages[0];
        // $total_page = 1;
    }

    // if (($total_page < $page) || $page > 100) {
    //     # Script completed";
    //     exit;
    // }

    foreach ($obj->findItemsAdvancedResponse[0]->searchResult[0]->item as $key => $bikedata) {
        $i++;

        $sql_check = "SELECT id FROM `product_data` where Product_ID = '" . $bikedata->itemId[0] . "' ";
        $result_check = $conn->query($sql_check);
        if ($result_check->num_rows > 0) {
            continue;
        }

        $detail_json = get_product_details($bikedata->itemId[0]);
        #$detail_json = file_get_contents('/var/www/html/product_detail.json');

        $obj_detail = json_decode($detail_json);
        // echo "<pre>";
        // print_r($obj_detail);
        // exit;
        $attrArr = array();

        $attrArr["id"] = $i;
        $attrArr["item_id"] = $bikedata->itemId[0];
        $attrArr["title"] = $bikedata->title[0];
        $attrArr['primary_category_name'] = $bikedata->primaryCategory[0]->categoryName[0];
        $attrArr['secondary_category_name'] = $bikedata->secondaryCategory[0]->categoryName[0];
        //$attrArr['gallery_url'] = $bikedata->galleryURL;
        $attrArr["url"] = $bikedata->viewItemURL[0];
        $attrArr["location"] = $bikedata->location[0];
        $attrArr["country"] = $bikedata->country[0];
        $attrArr["currency_id"] = $bikedata->sellingStatus[0]->currentPrice[0]->{'@currencyId'};
        $attrArr["price"] = $bikedata->sellingStatus[0]->currentPrice[0]->__value__;
        $attrArr["listing_start_date"] = date('Y-m-d H:i:s', strtotime($bikedata->listingInfo[0]->startTime[0]));
        $attrArr["listing_type"] = $bikedata->listingInfo[0]->listingType[0];
        $attrArr["condition_display_name"] = $bikedata->condition[0]->conditionDisplayName[0];
        $attrArr["picture_url"] = $bikedata->pictureURLSuperSize[0];
        $attrArr["postal_code"] = $bikedata->postalCode[0];
        $attrArr["product_availability"] = $bikedata->shippingInfo[0]->shipToLocations[0];

        $attrArr["description"] = removestypetag($obj_detail->Item->Description);

        $attrArr["picture_1"] = @$obj_detail->Item->PictureURL[0];
        $attrArr["picture_2"] = @$obj_detail->Item->PictureURL[1];
        $attrArr["picture_3"] = @$obj_detail->Item->PictureURL[2];
        $attrArr["picture_4"] = @$obj_detail->Item->PictureURL[3];
        $attrArr["picture_5"] = @$obj_detail->Item->PictureURL[4];

        $attrArr["seller"] = "ebay.com";

        // echo "<pre>";
        // print_r($attrArr);
        // exit;

        $singleData['item_specifics'] = array();
        foreach ($obj_detail->Item->ItemSpecifics->NameValueList as $key => $itemdata) {
            // echo "<pre>";
            // print_r($itemdata);
            // exit;
            $singleData['item_specifics'][$itemdata->Name] = $itemdata->Value[0];
        }
        $item_specifics = json_encode($singleData['item_specifics']);
        // echo "<pre>";
        // print_r($singleData);
        // exit;

        if (@$obj_detail->Item->PictureURL[0] != "") {
            $sql = "INSERT INTO product_data (`Product_ID`, `Product_Title`, `Product_Price`, `Product_Currency`, `Product_URL`, `Product_Condition`, `Parent_Catgeory`, `Child_Category`, `Product_Region`, `Product_Description`, `Image_url_1`, `Image_url_2`, `Image_url_3`, `Image_url_4`, `Image_url_5`, `Seller`, `Product_Avalability`, `Product_Specifics`) 
            VALUES (
                '" . addslashes($attrArr["item_id"]) . "',
                '" . addslashes($attrArr["title"]) . "',
                '" . addslashes($attrArr["price"]) . "',
                '" . addslashes($attrArr["currency_id"]) . "',
                '" . addslashes($attrArr["url"]) . "',
                '" . addslashes($attrArr["condition_display_name"]) . "',
                '" . addslashes($attrArr["primary_category_name"]) . "',
                '" . addslashes($attrArr["secondary_category_name"]) . "',
                '" . addslashes($attrArr["country"]) . "',
                '" . addslashes($attrArr["description"]) . "',
                '" . addslashes($attrArr["picture_1"]) . "',
                '" . addslashes($attrArr["picture_2"]) . "',
                '" . addslashes($attrArr["picture_3"]) . "',
                '" . addslashes($attrArr["picture_4"]) . "',
                '" . addslashes($attrArr["picture_5"]) . "',
                '" . addslashes($attrArr["seller"]) . "',
                '" . addslashes($attrArr["product_availability"]) . "',
                '" . addslashes($item_specifics) . "'
            )";
            if ($conn->query($sql) === TRUE) {
                echo $page . "<><><>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // echo 111;
        // exit;
    }
    // $conn->close();

    $page = $page + 1;
    get_data($page, $conn);
}
