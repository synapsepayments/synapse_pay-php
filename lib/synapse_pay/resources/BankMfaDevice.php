<?php

namespace SynapsePay;

class BankMfaDevice extends ApiResource {

  public $type;
  public $access_token;
  public $cookies;
  public $form_extra;
  public $mfa;

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
