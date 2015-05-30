<?php

namespace SynapsePay;

class BankMfaDeviceEndpoint extends APIEndpoint {
  
  function answer( $accessToken, $bank, $mfa, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "access_token" => $accessToken,
      "bank" => $bank,
      "mfa" => $mfa,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/mfa", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Bank", $json["banks"], $method, $client);
  }

}
