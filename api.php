<?php 

error_reporting(0); // 0 kan error 

require_once('routeros_api.class.php');
require_once('functions.php');

$API = new RouterosAPI();
$API->debug = false;


$action = $_GET['action'];
$queri = $_GET['queri'];

$msg_err = array(
	'result' => 'false',
	'message' => 'value isnt valid'
);

if($action == 'connect' && $queri != null){
	$d_queri = explode('-', $queri); // Pecah isi dari queri

	if($API->connect($d_queri[0], $q_queri[1], $d_queri[2])){
		$status = '1';
		$msg = 'mikrotik connected';
	} else {
		$status = '0';
		$msg = 'mikrotik not connected';
	}
	$msg_succ = array(
		'result' => 'true',
		'status' => $status,
		'message' => $msg
	);
	echo json_encode($msg_succ);
} else {
	echo json_encode($msg_err);
}