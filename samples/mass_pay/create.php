<?php

require(dirname(__FILE__) . '/../../init.php');

\SynapsePay\SynapsePay::$apiBase = \SynapsePay\SynapsePay::$apiSandbox;
\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

$client = \SynapsePay\User::login( "3ac38d63db58466982fe6f871c48f1", "TestTest123$" );

// With bank info
$massPays = $client->massPays->create([
  "mass_pays" => [
      [
        "legal_name" => "Some Person 1",
        "account_number" => "888888888",
        "routing_number" => "222222222",
        "amount" => "10.33",
        "trans_type" => "0",
        "account_class" => "1",
        "account_type" => "2",
        "user_info" => [
          "email" => "some@email.com",
          "phone_number" => "9011234567",
          "ip_address" => "some.ip.address",
          "dob" => "18/11/1989",
          "risk_score" => 10
        ]
      ],
      [
        "legal_name" => "Some Person 2",
        "account_number" => "888888888",
        "routing_number" => "222222222",
        "amount" => "10.33",
        "trans_type" => "0",
        "account_class" => "1",
        "account_type" => "1"
      ]
    ],
]);

foreach( $massPays->data as $massPay ) {
  echo "Mass Pay:: ";
  var_dump( $massPay );
}


// With cards instead of bank info
$massPays = $client->massPays->create([
  "mass_pays" => [
      [
        "amount" => "20",
        "trans_type" => "0",
        "card_id" => "77"
      ],
      [
        "amount" => "20",
        "trans_type" => "0",
        "card_id" => "76"
      ]
    ],
]);

foreach( $massPays->data as $massPay ) {
  echo "Mass Pay:: ";
  var_dump( $massPay );
}
