<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Rome');

// variabili usate da jwt
$key = "example_key";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valido per 1 ora
$issuer = "http://localhost/CodeOfaNinja/RestApiAuthLevel1/";
?>