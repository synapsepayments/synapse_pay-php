<?php

require(dirname(__FILE__) . '/../../init.php');

\SynapsePay\SynapsePay::$apiBase = \SynapsePay\SynapsePay::$apiSandbox;
\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

$client = \SynapsePay\User::login( "3ac38d63db58466982fe6f871c48f1", "TestTest123$" );

$order = $client->orders->create([
  "amount" => "100",
  "bank_id" => "2174",
  "facilitator_fee" => "1",
  "seller_id" => "3425",
]);
var_dump($order);