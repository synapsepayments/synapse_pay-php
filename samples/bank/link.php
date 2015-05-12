<?php

require(dirname(__FILE__) . '/../../init.php');

\SynapsePay\SynapsePay::$apiBase = \SynapsePay\SynapsePay::$apiSandbox;
\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

$client = \SynapsePay\User::login( "3ac38d63db58466982fe6f871c48f1", "TestTest123$" );

// Link a bank account with an MFA Device

$mfaDevice = $client->banks->link([
  "bank" => "Bank of America",
  "password" => "test1234",
  "username" => "synapse_code",
]);
var_dump($mfaDevice);

// Link a bank account with MFA Questions

$mfaQuestions = $client->banks->link([
  "bank" => "Bank of America",
  "password" => "test1234",
  "username" => "synapse_good",
]);
var_dump($mfaQuestions);

// Link a bank account without any MFA

$mfaDevice = $client->banks->link([
  "bank" => "Bank of America",
  "password" => "test1234",
  "username" => "synapse_nomfa",
]);
var_dump($mfaDevice);
