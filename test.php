<?php

  require(dirname(__FILE__) . '/init.php');


\SynapsePay\SynapsePay::$clientId = "4528d2e0a2988064d8ac";
\SynapsePay\SynapsePay::$clientSecret = "dcbf52b16040c94a35f345b7e2c285f936d673c9";

# This creates an oauth client for the newly created user.
$client = \SynapsePay\User::create([
  "email" => "test-user-jon@synapsepay.com",
  "fullname" => "Test Account",
  "ip_address" => "11.111.11.11",
  "phonenumber" => "123456789"
]);

var_dump( $client );


try {
  $client->user->retrieve();
} catch(Exception $e) {
  var_dump($e);
}


  //echo "Business Name: " . $account->business_name;
  //var_dump( $account );



  // $req = new \SynapsePay\ApiRequestor(\SynapsePay\SynapsePay::getApiKey());

  // GET
  //var_dump($req->curlRequest('get', "https://api.paidapi.com/v0/account", null, null));

  // // POST
  // $method = "post";
  // $url = "https://api.paidapi.com/v0/transactions";
  // $params = array(
  //   "external_id" => 483,
  //   "amount" => 1234,
  //   "description" => "designing awesome holiday cards"
  // );

  // // PUT
  // $method = "put";
  // $url = "https://api.paidapi.com/v0/transactions/tr_UC2XHkrNISqNxZMj4Mag";
  // $params = array(
  //   "description" => "Updated"
  // );


  // // GET
  // $method = "get";
  // $url = "https://api.paidapi.com/v0/transactions/tr_UC2XHkrNISqNxZMj4Mag?jon=test";
  // $params = array(
  //   "test" => "123"
  // );

  // $c = \SynapsePay\Customer::retrieve("cus_fxpRoA9eIwureqSgtX1jww");

  //echo \SynapsePay\Account::retrieve();

  // $c2 = \SynapsePay\Customer::test();
  // var_dump($c);
  // echo "Json for customer is: \n";
  // var_dump($c->json);

  // echo $c;

  // var_dump($req->request($method, $url, $params, null));

// $klass = 'SynapsePay\Customer';
// $c = $klass->construct(array("name" => "jon"));
// echo $c;


  //var_dump($c->changedAttributeNames);

  // echo \SynapsePay\Customer::classString();
  // echo get_class(\SynapsePay\Customer();
