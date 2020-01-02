<?php

$CFG = require_once __DIR__ . "/../common/include/incConfig.php";



require_once $CFG["CFG_LIBS_PATH_AWS"];

//echo "<br>CFG_LIBS_PATH_AWS : " . $CFG["CFG_LIBS_PATH_AWS"];
//echo "<br>CFG_AWS_AID : " . $CFG["CFG_AWS_AID"];
//echo "<br>CFG_AWS_KEY : " . $CFG["CFG_AWS_KEY"];
//exit;

use Aws\Ec2\Ec2Client;
use Aws\Ec2\Exception\Ec2Exception;
use Aws\Exception\AwsException;


/*88
$client = Aws\Ec2\Ec2Client::factory(
    array(
        'key' => $CFG["CFG_AWS_AID"], 
        'secret' => $CFG["CFG_AWS_KEY"],
        'region' => 'ap-northeast',
        'version' => '2016-11-15'
    )
);
       
*/
$ec2Client = new Aws\Ec2\Ec2Client([
    'credentials' => array('key' => $CFG["CFG_AWS_AID"],'secret' => $CFG["CFG_AWS_KEY"]),
    'region' => 'ap-northeast-2',
    'version' => '2016-11-15'
]);


echo "<br>" . 111;

try {
        
    $instanceIds = array('i-0db0abd9e1023680b'); //eduDocker

    $result = $ec2Client->stopInstances(array(
        'InstanceIds' => $instanceIds,
    ));

    $tarr = $result->toArray();

    echo "<br><br><pre>" . json_encode($tarr,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) ."</pre>";
    
    echo "<br><br>현재상태 : " . $tarr["StoppingInstances"]["CurrentState"]["Code"];

    echo "<br><br>이전상태 : " . $tarr["StoppingInstances"]["PreviousState"]["Code"];

    echo "<br><br>처리결과 : " . $tarr["@metadata"]["statusCode"];
    //echo "<br><br>" . $result->search(".Name");
}catch (Ec2Exception $e) {
    echo "<br>" . $e->getMessage() . "\n";
}catch (AwsException $e) {
    echo "<br>" . $e->getMessage() . "\n";
}

echo "<br>" . 333;
?>
