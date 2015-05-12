<?php

namespace SynapsePay;

class OrderEndpoint extends APIEndpoint {
  
  function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/order/add", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Order($json["order"], $method, $client);
  }

  function poll( $orderId, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "order_id" => $order_id,
    ], $params);
    $method = new ApiMethod( ":post", "/order/poll", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Order($json["order"], $method, $client);
  }

  function recent( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/order/recent", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("Order", $json["orders"], $method, $client);
  }

  function update( $orderId, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "order_id" => $order_id,
    ], $params);
    $method = new ApiMethod( ":post", "/order/update", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Order($json["order"], $method, $client);
  }

  function void( $orderId, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "order_id" => $order_id,
    ], $params);
    $method = new ApiMethod( ":post", "/order/void", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new Order($json["order"], $method, $client);
  }

}
