<?php

namespace SynapsePay;

class BankEndpoint extends APIEndpoint {
  
  function add( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/bank/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Bank($json["bank"], $method, $client);
  }

  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/bank/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Bank", $json["banks"], $method, $client);
  }

  function link( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/bank/login", $params, $headers, $this );
    $json = $this->client->execute($method);
    if( $json["is_mfa"] && $json["response"]["type"] == "questions" ) {
      return new BankMfaQuestions($json["response"], $method, $client);
    } else if( $json["is_mfa"] && $json["response"]["type"] == "device" ) {
      return new BankMfaDevice($json["response"], $method, $client);
    } else {
      return new ApiList("Bank", $json["banks"], $method, $client);
    }
  }

  function refresh( $id, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "id" => $id,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/refresh", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Bank", $json["banks"], $method, $client);
  }

  function remove( $bankId, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "bank_id" => $bankId,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/delete", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $json;
  }

}
