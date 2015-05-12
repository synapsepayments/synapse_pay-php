<?php

namespace SynapsePay;

class WireEndpoint extends APIEndpoint {
  
  function allIncoming( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/wirein/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Wire", $json["wires"], $method, $client);
  }

  function allOutgoing( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/wireout/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Wire", $json["wires"], $method, $client);
  }

  function createIncoming( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/wirein/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Wire($json["wire"], $method, $client);
  }

  function createOutgoing( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/wireout/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Wire($json["wire"], $method, $client);
  }

}
