<?php
$url = "http://www.plm.automation.siemens.com/app/lv/remote/lightview.cfc?method=show&uri=tcm:1023-";
$startingId = 0;
$endingId = 50000;

$outputFile = "flvUrls.txt";

$fh = fopen($outputFile, "w+");
// Get them
for($i = $startingId; $i <= $endingId; $i++){
	$json = file_get_contents($url . $i);
	$jsonObj = json_decode($json, true);
	$flvUrl = getFlvUrl($jsonObj);
	if(!empty($flvUrl)){
		fwrite($fh, $flvUrl . "\r\n");
		echo "Found at $i\r\n";
	} else {
		echo "{$i}\r\n";
	}

}
fclose($fh);

function getFlvUrl($json){
	if(stristr(urldecode($json['DATA']['href']), '.flv') !== FALSE){	
		$query = array();
		parse_str(urldecode($json['DATA']['href']), $query);
		return $query['assetURL'];
	} else {
		return FALSE;
	}
}
