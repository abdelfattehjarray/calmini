<?php
require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "837099730398-uai2b6ude1b0hh3nc0a3ud8ua14lqmmb.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'http://localhost/Website%202A35%20Golden%20Dawn/view/addUser.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
