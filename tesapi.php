<?php 

require_once('routeros_api.class.php');

$API = new RouterosAPI();
$API->debug = false;

if($API->connect('103.152.45.10:1991', 'Kendri', 'motormio')){
  echo 'Connected <br /><br />';
} else {
  echo 'Disconnected <br /><br />';
}

echo $API->connect('103.152.45.10:1991', 'Kendri', 'motormio');
