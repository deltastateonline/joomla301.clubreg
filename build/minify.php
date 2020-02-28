<?php

$prefix = null;

if(count($argv) > 1 ){
	$prefix = $argv[1];
}else
	exit(1);

$storeDir =  getcwd();

echo sprintf("Current dir %s \n" ,$storeDir);

if(!@chdir($prefix)){
	echo "Unable to change directory to {$prefix}\n"; // change to the required dir
	return;
}

$currentDir =  getcwd(); // where am i , logos, validate or test

$folder = $currentDir.DIRECTORY_SEPARATOR."min".DIRECTORY_SEPARATOR;

mkdir($folder);

echo sprintf("Changed Directory to %s \n",$currentDir);
$allFiles = glob("*.js", GLOB_NOSORT); // find all images

foreach( $allFiles as $afile){  
	echo sprintf("Processing %s\n",$afile);	
	
	$jsString = minify($afile);	
	$filename = sprintf("%s%s",$folder, $afile );	
	echo sprintf("Save to %s\n",$filename);
	file_put_contents ($filename , $jsString);
	
	sleep(1);
}

function minify($jsFile){
	
	$url = 'https://javascript-minifier.com/raw';
    $js = file_get_contents($jsFile);

    // init the request, set various options, and send it
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
        CURLOPT_POSTFIELDS => http_build_query([ "input" => $js ])
    ]);

    $minified = curl_exec($ch);

    // finally, close the request
    curl_close($ch);

    // output the $minified JavaScript
    return $minified;
	
}