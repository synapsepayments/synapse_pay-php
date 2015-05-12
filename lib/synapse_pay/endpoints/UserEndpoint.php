<?php

namespace SynapsePay;

class UserEndpoint extends APIEndpoint {
  
  function retrieve( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/user/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new User($json["user"], $method, $client);
  }

  function search( $query, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "query" => $query,
    ], $params);
    $method = new ApiMethod( ":post", "/user/customers", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("User", $json["customers"], $method, $client);
  }

  function update( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/user/edit", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new User($json["user"], $method, $client);
  }

}
