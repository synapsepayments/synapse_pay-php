<?php

require(dirname(__FILE__) . '/../../init.php');

\SynapsePay\SynapsePay::$apiBase = \SynapsePay\SynapsePay::$apiSandbox;
\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

// Create a SynapsePay user account

$client = \SynapsePay\User::create([
  "email" => "test-user-321@synapsepay.com",
  "fullname" => "Test Account",
  "ip_address" => "11.111.11.11",
  "phonenumber" => "123456799",
]);
var_dump($client);

// Use force_create=no if you lose the access_token and refresh_token for an account.

$client = \SynapsePay\User::create([
  "email" => "test-user-321@synapsepay.com",
  "force_create" => "no",
  "fullname" => "Test Account",
  "ip_address" => "11.111.11.11",
  "phonenumber" => "123456799",
]);
var_dump($client);
