<?php
require 'vendor/autoload.php';
use Google\Cloud\Translate\V2\TranslateClient;

$currentLanguageIsoCode = "";
$currentLanguageDirection = "";

if (isset($_COOKIE["currentLanguageIsoCode"])) {
	$currentLanguageIsoCode = $_COOKIE["currentLanguageIsoCode"];
	$currentLanguageDirection = $_COOKIE["currentLanguageDirection"];
} else {
	$currentLanguageIsoCode = "en";
	$currentLanguageDirection = "ltr";
}

$translate = null;
try {
	$translate = new TranslateClient([
		'keyFilePath' => 'resources/includes/motarey-translation-5aac831307f6.json'
	]);
} catch(Exception $e) {
	echo $e->getMessage();
}
?>