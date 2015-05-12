<?php

namespace SynapsePay;

class ApiList extends ApiResource {

  public $data;
  public $klass;
  public $client;


  public function __construct( $klass, $json=null, $apiMethod=null, $client=null ) {

    if ( is_object( $klass ) ) {
      $klass = get_class( $klass );
    } else {
      $klass = $klass;
    }

    if(isset($this)) {
      $this->klass = $klass;
      $this->refreshFrom($json, $apiMethod, $client);
      return $this;
    } else {
      $ret = new static();
      $ret->klass = $klass;
      $ret->refreshFrom($json, $apiMethod, $client);
      return $ret;
    }
  }

  public function refreshFrom( $json, $apiMethod=null, $client ) {
    $this->clearApiAttributes();
    $this->apiMethod = $apiMethod;
    $this->client = $client;
    $this->data = array();
    $this->json = $json;

    if( !is_array($json) ) {
      $json = array( "data" => $json );
    }

    // Use the Json to create object
    foreach ($json as $k => $v) {
      if ( $k == "data" ) {
        if ( is_array( $v ) ) {
          $d = array();
          foreach ($v as $nk => $nv ) {
            array_push( $d, new $this->$klass( $nv, $apiMethod, $client ) );
          }
          $this->data = $d;
        }
      }
      else if ( array_key_exists( $k, $this->apiAttributes() ) ) {
        $this->$k = $v;
      }
    }
    return $this;
  }
}
