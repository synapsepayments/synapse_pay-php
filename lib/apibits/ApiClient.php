<?php

namespace SynapsePay;

class ApiClient {

  public $headers;
  public $params;

  public function __construct( $headers, $params ) {
    $this->refreshFrom( $headers, $params );
  }

  public function refreshFrom( $headers, $params ) {
    $this->headers = $headers;
    $this->params = $params;
    return $this;
  }

  public function execute( $apiMethod ) {
    $apiMethod->headers = ParamsBuilder::merge( $apiMethod->headers, $this->headers );
    $apiMethod->params = ParamsBuilder::merge( $apiMethod->params, $this->params );
    return $apiMethod->execute();
  }

}
