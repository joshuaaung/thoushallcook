<?php

//use Aws\S3\S3Client; //So that we can use the S3Client:: ... 
use Aws\S3\Exception\S3Exception;

require 'vendor/autoload.php';

$s3_config = require ('s3_config.php');

//Declaring s3 variable
//NOTE: the array format is different for different aws/aws-sdk-php versions
//http://stackoverflow.com/questions/27400563/aws-sdk-for-php-error-retrieving-credentials-from-the-instance-profile-metadata
$s3 = new Aws\S3\S3Client([
		'version' => 'latest',
	    'region'  => 'ap-southeast-1', //For Singapore. This is important for redirection to your website after uploading of file to the s3 is completed. 
	    'credentials' => array(
		    'key' => $s3_config['s3']['key'],
		    'secret'  => $s3_config['s3']['secret'],
		),
	]);
/*
$s3 = S3Client::factory([
		'key' => $s3_config['s3']['key'],
		'secret' => $s3_config['s3']['secret']
	]);
	*/