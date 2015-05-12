<?php

namespace SynapsePay;

class CardEndpoint extends APIEndpoint {
  
  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/card/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Card", $json["cards"], $method, $client);
  }

  function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/card/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Card($json["card"], $method, $client);
  }

  function update( $id, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "id" => $id,
    ], $params);
    $method = new ApiMethod( ":post", "/card/edit", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Card($json["card"], $method, $client);
  }

}
