<?php
include"connection.php";
 if($conn)
 {
  function secure($data)
  {
    include"connection.php";
    $data=mysqli_real_escape_string($conn,$data);
    $data=htmlentities($data);
    return $data;
  }
 }
 function encrypt($data,$key)
 {
  $cipher="AES-128-CBC";
  $ivlen = openssl_cipher_iv_length($cipher);
  $iv = '1234567891011121'; 
  $encrypt= openssl_encrypt($data, $cipher, $key, $options=0, $iv);
  return $encrypt;
 }

 function decrypt($data,$key)
 {
  $cipher="AES-128-CBC";
  $ivlen = openssl_cipher_iv_length($cipher);
  $iv = '1234567891011121'; 
  $decrypt= openssl_decrypt($data, $cipher, $key, $options=0, $iv);
  return $decrypt;
 }
 function setKey($key)
 {
   $key=secure($key);
   $key=md5($key);
   return $key;
 } 
 
 function keys()
{
  return md5("userkey");
}

?>