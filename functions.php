<?php

$Ip = $_SERVER['REMOTE_ADDR'];
$Url = $_SERVER['REQUEST_URI'];
$Browser = $_SERVER['HTTP_USER_AGENT'];

function expireDate(){ 
	$waktu = date('Y-m-d H:i:s');
	$expire = date('Y-m-d H:i:s',strtotime('+12 hour', strtotime($waktu)));
	$pisah = explode(" ", $expire);
	$pisah_1 = explode("-", $pisah[0]);
	$waktuJadi = $pisah_1[2].'/'.$pisah_1[1].'/'.$pisah_1[0].' '.$pisah[1];
	return $waktuJadi;
}

function expDate($lamaWaktu){ 
    $waktu = date('Y-m-d H:i:s');
    $expire = date('Y-m-d H:i:s',strtotime($lamaWaktu, strtotime($waktu)));
    $pisah = explode(" ", $expire);
    $pisah_1 = explode("-", $pisah[0]);
    $waktuJadi = $pisah_1[2].'/'.$pisah_1[1].'/'.$pisah_1[0].' '.$pisah[1];
    return $waktuJadi;
}

function code($length){
    $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return $string;
}

function encode($text){
    $a = substr($text, 0, 3);
    $b = substr($text, 3, strlen($text));
    $c = 'x$1'.str_rot13(base64_encode(str_rot13($b))).'$ix'.str_rot13(base64_encode(str_rot13($a))).'n$x';
    $d = substr($c, 0, 6);
    $e = substr($c, 6, strlen($c));
    $f = 'n$x'.str_rot13(base64_encode(str_rot13($e))).'t$x'.str_rot13(base64_encode(str_rot13($d)));
    return $f;
}

function decode($text){
    $a = substr($text, 3, strlen($text));
    $b = explode('t$x', $a);
    $c = substr(str_rot13(base64_decode(str_rot13($b[1]))).''.str_rot13(base64_decode(str_rot13($b[0]))), 3, strlen(str_rot13(base64_decode(str_rot13($b[1]))).''.str_rot13(base64_decode(str_rot13($b[0])))));
    $d = explode('$ix', $c);
    $e = str_rot13(base64_decode(str_rot13(substr($d[1], 0, -3))));
    $f = str_rot13(base64_decode(str_rot13($d[0])));
    return $e.''.$f;
}

function Message($angka, $pesan){
    if($angka == '1'){ // sukses
        $message = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    '.$pesan.'
                  </div>';
    } else if($angka == '2'){ // gagal
        $message = '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                    '.$pesan.'
                  </div>';
    } else if($angka == '3'){ // info
        $message = '<div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Info!</h4>
                    '.$pesan.'
                  </div>';
    }
    return $message;
}

function Callout($angka, $hpesan, $pesan){
    if($angka == '1'){
        $pesan = '
              <div class="callout callout-success">
                <h4><i class="icon fa fa-check"></i>&nbsp; '.$hpesan.'</h4>
                <p>'.$pesan.'</p>
              </div>';
    } else if($angka == '2'){
        $pesan = '
              <div class="callout callout-danger">
                <h4><i class="icon fa fa-remove"></i>&nbsp; '.$hpesan.'</h4>
                <p>'.$pesan.'</p>
              </div>';
    } else if($angka == '3'){
        $pesan = '
              <div class="callout callout-info">
                <h4><i class="icon fa fa-info-circle"></i>&nbsp; '.$hpesan.'</h4>
                <p>'.$pesan.'</p>
              </div>';
    } else if($angka == '4'){
        $pesan = '
              <div class="callout callout-warning">
                <h4><i class="icon fa fa-warning"></i>&nbsp; '.$hpesan.'</h4>
                <p>'.$pesan.'</p>
              </div>';
    }
    return $pesan;
}

function act($name){
    if($_GET['content'] == $name){
        echo 'active';
    }
}

function Sensor($email){
    $Expl = explode('@', $email);
    $aa = strlen($Expl[0]); // jumlah email
    $ab = substr($Expl[0], 0, 1); // ambil huruf depan
    $ac = substr($Expl[0], $aa-1, strlen($Expl[0])); // ambil huruf belakang 
    $ad = $aa - 2; // jumlah tengah
    // ab.''.$end.''.$ac.'@'.$Expl[1]
    echo $ab;
    $ii = 0;
    while($ii < $ad){
        echo '*';
        $ii++;
    }
    echo $ac.'@'.$Expl[1];
}

function Sapa($waktu){
    $pecah = explode(" ", $waktu);
    $pecahWaktu = explode(":", $pecah[1]); 
    $jam = $pecahWaktu[0];
    $pagi = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
    $siang = array('11', '12', '13', '14');
    $sore = array('15', '16', '17', '18');
    $malam = array('19', '20', '21', '22', '23', '24');
    if(in_array($jam, $pagi)){
        $sapa = 'Selamat Pagi';
    } else if(in_array($jam, $siang)){
        $sapa = 'Selamat Siang';
    } else if(in_array($jam, $malam)){
        $sapa = 'Selamat Malam';
    } else if(in_array($jam, $sore)){
        $sapa = 'Selamat Sore';
    } else {
        $sapa = 'Selamat Datang';
    }
    return $sapa;
}

function Bulan($bulans){
    switch ($bulans) {
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
        default:
            $bulan = 'Error';
            break;
    }
    return $bulan;
}

function bulanIndo($date){
    $pecah = explode("-", $date);
    $bulan = Bulan($pecah[1]);
    if($pecah[1] == '00'){
      $go = '-';
    } else {
      $go = $pecah[2].' '.$bulan.' '.$pecah[0];
    }
    return $go;
}

function penyebut($nilai) {
 $nilai = abs($nilai);
 $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 $temp = "";
 if ($nilai < 12) {
 $temp = " ". $huruf[$nilai];
 } else if ($nilai <20) {
 $temp = penyebut($nilai - 10). " belas";
 } else if ($nilai < 100) {
 $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
 } else if ($nilai < 200) {
 $temp = " seratus" . penyebut($nilai - 100);
 } else if ($nilai < 1000) {
 $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
 } else if ($nilai < 2000) {
 $temp = " seribu" . penyebut($nilai - 1000);
 } else if ($nilai < 1000000) {
 $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
 } else if ($nilai < 1000000000) {
 $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
 } else if ($nilai < 1000000000000) {
 $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
 } else if ($nilai < 1000000000000000) {
 $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
 }     
 return $temp;
 }
 
function bulanGaris($date){
    $bg = explode('-', $date);
    $bulan = $bg[2].'/'.$bg[1].'/'.$bg[0];
    return $bulan;
}
