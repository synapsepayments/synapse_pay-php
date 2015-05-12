<?php

namespace SynapsePay;

class WithdrawalEndpoint extends APIEndpoint {
  
  function all( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/withdraw/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Withdrawal", $json["withdraws"], $method, $client);
  }

  function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/withdraw/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Withdrawal($json["withdrawal"], $method, $client);
  }

}
