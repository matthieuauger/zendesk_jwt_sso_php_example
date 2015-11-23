<?php

include_once __DIR__ . "/vendor/autoload.php";

use Firebase\JWT\JWT;

/**
 * This is the second part of the authentication.
 * When you activate the JWT authentication on zendesk, all authentications will be redirected to your site
 * Once the user is registered/logged in your site, you can send this token to authenticate him on Zendesk
 */

$key       = "//YOUR_KEY_HERE//";
$subdomain = "//YOUR_DOMAIN_HERE";
$now       = time();
$token = array(
  "jti"   => md5($now . rand()),
  "iat"   => $now,
  "name"  => "John Doe",
  "email" => "john.doe@yopmail.com"
);

$jwt = JWT::encode($token, $key);
$location = "https://" . $subdomain . ".zendesk.com/access/jwt?jwt=" . $jwt;

if(isset($_GET["return_to"])) {
  $location .= "&return_to=" . urlencode($_GET["return_to"]);
}

header("Location: " . $location);
