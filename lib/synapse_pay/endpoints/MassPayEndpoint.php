<?php

namespace SynapsePay;

class MassPayEndpoint extends APIEndpoint {
  
  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/masspay/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $this->client);
  }

  function cancel( $id, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "id" => $id,
    ], $params);
    $method = new ApiMethod( ":post", "/masspay/cancel", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $this->client);
  }

  function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/masspay/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $this->client);
  }

}
