<?php

include_once("db.php");

define('HMAC_SECRET', 'pedazodecachodeclavequenolavaaaveriguarniperrY');

function ser($username, $is_admin, $weather)
{
  $data = [
    'username' => $username,
    'is_admin' => $is_admin,
    'weather' => $weather
  ];

  $serializedData = base64_encode(serialize($data));
  $hmac = hash_hmac('sha256', $serializedData, HMAC_SECRET);
  return $serializedData . '|' . $hmac;
}

function deser($cookieString)
{
  $parts = explode('|', $cookieString, 2);

    if (count($parts) !== 2) return null;
    
    [$serialized, $hmac] = $parts;
    
    // Verificar integridad — si no cuadra, rechazar
    if (!hash_equals(hash_hmac('sha256', $serialized, HMAC_SECRET), $hmac)) {
        return null;  // Cookie manipulada
    }
    
    return unserialize(base64_decode($serialized));
}

function create_cookie($username)
{
  $conn = db_connect();
  $sql = "SELECT id, is_admin, weather FROM users WHERE username='$username'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $serinfo = ser($username, $row['is_admin'], $row['weather']);
  setcookie("user_info", $serinfo, time() + 36000, "/");
}
