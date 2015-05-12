<?php

namespace SynapsePay;

class APIEndpoint {
  public $client;

  public function __construct( $client ) {
    $this->client = $client;
  }
}
