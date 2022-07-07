<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');

// Set default timezone as some servers do not have this set.
if(isset($timeZone) && $timeZone != ""){
  date_default_timezone_set($timeZone);
}
else{
  date_default_timezone_set("UTC");
}

// Require the Swift Mailer library
require_once 'swift_required.php';

$messageText = "";

if($emailMethod == 'phpmail'){ 
  $transport = Swift_MailTransport::newInstance(); 
}elseif($emailMethod == 'smtp'){
    $transport = Swift_SmtpTransport::newInstance( $outgoingServerAddress, $outgoingServerPort, $outgoingServerSecurity )
    ->setUsername( $sendingAccountUsername )     
    ->setPassword( $sendingAccountPassword );
}

// For Capturing Additional Get Params Such as refsite, adunit, campaign
$query = parse_url($_POST['page_url'], PHP_URL_QUERY);
parse_str($query);
parse_str($query, $arr);

$mailer = Swift_Mailer::newInstance($transport);

/**
 * Sending Data to Leads API 
 */
$data = array(
    "name"=> $_POST['name'],
    "email"=> $_POST['email'],
    "mobile_no"=> $_POST['phone_number'],
    "company_name"=> "",
    "lead_status"=>'unattended',
    "lead_source"=>'Campaigns Enquiry Form',
    "trip_name"=>'Chadar Trek',
    'city'=>(isset($_REQUEST['city'])) ? $_REQUEST['city'] : '',
    'total_pax'=>(isset($_REQUEST['total_pax'])) ? $_REQUEST['total_pax'] : '',
    'travel_date'=>(isset($_REQUEST['travel_date'])) ? $_REQUEST['travel_date'] : '',
    'isPreviousTrekkingExperience'=>(isset($_REQUEST['isPreviousTrekkingExperience'])) ? $_REQUEST['isPreviousTrekkingExperience'] : '',
    "lp_slug"=>"",
    "lp_url"=> $_POST['page_url'],
    "ref_site"=> (isset($arr['refsite']) && !empty($arr['refsite'])) ? $arr['refsite'] : '',
    "ad_unit"=> (isset($arr['adunit']) && !empty($arr['adunit'])) ? $arr['adunit'] : '',
    "campaign"=> (isset($arr['campaign']) && !empty($arr['campaign'])) ? $arr['campaign'] : '',
    "company_name"=> (isset($_POST['company']) && !empty($_POST['company'])) ? $_POST['company'] : '',
    "total_pax"=> (isset($_POST['pax']) && !empty($_POST['pax'])) ? $_POST['pax'] : '',
    "comments"=> (isset($_POST['message']) && !empty($_POST['message'])) ? $_POST['message'] : '',
    "ip_add"=>$_SERVER['SERVER_ADDR'],
    "action"=> "adddleads",
    "token"=> "asdfSrE53ft5Rf6ge"
); 

//echo "<pre>";print_r($data);exit; 
$query = http_build_query($data);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.thegreatnext.com/leadsApi/api/", // URL Needs to be Updated as Per Actual Site URL
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $query,
    CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: af59579e-a595-4de7-8594-b70ed1be6ef4"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

echo $response;
echo $err;

curl_close($curl);

// Creating the message text using fields sent through POST
foreach ($_POST as $key => $value)
{
  // Sets of checkboxes will be shown as comma-separated values as they are passed in as an array.
  if(is_array($value)){
    $value = implode(', ' , $value);
  }
  $messageText .= ucfirst($key).": ".$value."\n\n";
}

if(isset($_POST['email']) && isset($_POST['name']) ){
  $fromArray = "letsdothis@thegreatnext.com";
}else{ $fromArray = array($sendingAccountUsername => $websiteName); }

$message = Swift_Message::newInstance($emailSubject)
  ->setFrom($fromArray)
  ->setTo(array($recipientEmail => $recipientName))->setBody($messageText);



// Send the message or catch an error if it occurs.
try{
  echo($mailer->send($message));
}
catch(Exception $e){
  echo($e->getMessage());
}
exit;
?>