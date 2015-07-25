<?php
include('connect.php');
include('fetch.php');
//API login Credentials
$username="Bootcamp";
$password="Bootcamp2015";
$html=json_decode($county_json,true);
 //print_r($html);
//HTTP GET request -Using Curl -Response JSON
$array_length=count($html);
    for($i=0;$i<$array_length;$i++)
    { 
   // print_r($data);
$url="http://test.hiskenya.org/api/analytics?dimension=dx:BnGDrFwyQp9;c0MB4RmVjxk;qnZmg5tNSMy;gVp1KSFI69G;cPlWFYbBacW&dimension=pe:LAST_12_MONTHS&dimension=co&filter=ou:".$html[$i]."&displayProperty=NAME";
// $url_orgUnit="http://test.hiskenya.org/api/organisationUnits";

// $data = array("dataSet" => "$dataset", "period" => "$period", "orgUnit" => "$orgUnit");
// $data_string = http_build_query($data);
// $url.="$data_string";

// initailizing curl
$ch = curl_init();
//curl options
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
//execute
$result = curl_exec($ch);

//close connection
curl_close($ch);

if ($result){

	$result=json_decode($result,true);
	$json=$result['rows'];
	//print_r($json);

	 foreach($json as $row)
    { 
     if($row[2]=="rPAsF4cpNxm" || $row[2]=="w77uMi1KzOH")
     {
    $drugid = $row[0];
    $periodic = $row[1];
    $drugcategoryid = $row[2];
    $drugvalue = $row[3];

  $sql = "INSERT INTO county_level_drugs(drug_id,period,drug_category_id,drug_value,county_id)VALUES('$drugid','$periodic','$drugcategoryid','$drugvalue','$html[$i]')";
    if(mysql_query($sql,$con))
    {
    	echo ("inserted successfully <br>");
        
    }else
       die('Error : ' . mysql_error()); 
    }

}
}
else{

    echo -1;
}
}

?>

