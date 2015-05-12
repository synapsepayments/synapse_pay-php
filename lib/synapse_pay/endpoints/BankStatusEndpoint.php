<?php

namespace SynapsePay;

class BankStatusEndpoint extends APIEndpoint {
  
  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/bankstatus/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("BankStatus", $json["banks"], $method, $client);
  }

}
