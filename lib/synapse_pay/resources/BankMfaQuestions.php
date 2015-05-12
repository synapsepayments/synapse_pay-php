<?php

namespace SynapsePay;

class BankMfaQuestions extends ApiResource {

  public $access_token;
  public $mfa;
  public $type;

  function answer( $bank, $mfa, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "bank" => $bank,
      "mfa" => $mfa,
    ], $params);
    $params = ParamsBuilde::merge([
      "access_token" => $this->access_token,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/mfa", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Bank", $json["banks"], $method, $client);
  }

}
