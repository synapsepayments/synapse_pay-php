<?php

namespace SynapsePay;

class DepositEndpoint extends APIEndpoint {
  
  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/deposit/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Deposit", $json["deposits"], $method, $client);
  }

  function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/deposit/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Deposit($json["deposit"], $method, $client);
  }

  function micro( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/deposit/micro", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Deposit", $json["deposits"], $method, $client);
  }

}
