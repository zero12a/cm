<?php

$CFG = require_once "../common/include/incConfig.php";

require $CFG["CFG_LIBS_PATH_AWS"];

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\Model\MultipartUpload\UploadBuilder;
echo 111;

try {
        
    $client = S3Client::factory(
        array(
        'credentials' => array('key' => $CFG_AWS_AID,'secret' => $CFG_AWS_KEY),
        'region' => 'ap-northeast-2',
        'version' => 'latest'
        )
    );
    echo 222;
}catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}catch (AwsException $e) {
    echo $e->getMessage() . "\n";
}

try{
    $result = $client->putObject(array(
        'Bucket'     => "code-gen-mdm",
        'SourceFile' => "test.html",
        'Key'        => "test2.html"
    ));

    echo 333;
}catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}catch (AwsException $e) {
    echo $e->getMessage() . "\n";
}

//echo json_encode($result->toArray(), JSON_PRETTY_PRINT);
//echo "<br>";
$resultArray = $result->toArray();
echo $resultArray["@metadata"]["statusCode"];
echo $resultArray["ObjectURL"];
?>