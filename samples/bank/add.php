<?php

require(dirname(__FILE__) . '/../../init.php');

\SynapsePay\SynapsePay::$apiBase = \SynapsePay\SynapsePay::$apiSandbox;
\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

$client = \SynapsePay\User::login( "3ac38d63db58466982fe6f871c48f1", "TestTest123$" );

$bank = $client->banks->add([
  "account_class" => "1",
  "account_num" => "1111111111",
  "account_type" => "1",
  "fullname" => "Jon Smith",
  "nickname" => "Example bank account",
  "routing_num" => "121000358",
]);
var_dump($bank);
