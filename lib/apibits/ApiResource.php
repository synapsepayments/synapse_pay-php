<?php

namespace SynapsePay;

class ApiResource {

  public $json;
  public $apiMethod;
  public $client;

  // public function __toString() {
  //   $ret = "";
  //   foreach(static::$attributes as $key => $v) {
  //     // echo "key=" . $key . " and value is " . $this->$key . " \n";
  //     $ret .= $key . " => " . $this->$key . "\n";
  //   }
  //   return $ret;
  // }

  public function __construct( $json=null, $apiMethod=null, $client=null ) {

    if(isset($this)) {
      $this->refreshFrom($json, $apiMethod, $client);
      return $this;
    } else {
      $ret = new static();
      $ret->refreshFrom($json, $apiMethod, $client);
      return $ret;
    }

  }

  public function refreshFrom( $json, $apiMethod=null, $client=null ) {
      $this->json = $json;
      $this->apiMethod = $apiMethod;
      $this->client = $client;

      // Use the Json to create object
      if( !is_array( $json ) ) {
        $json = array( "id" => $json );
      }

      foreach ($json as $k => $v) {
        if ( array_key_exists( $k, $this->apiAttributes() ) ) {
          $this->$k = $v;
        }
      }

      return $this;
  }

  public function apiAttributes() {
    return get_object_vars( $this );
  }

  public function clearApiAttributes() {
    foreach ( $this->apiAttributes() as $k => $v ) {
      $this->$k = null;
    }
  }

  public function changedAttributes() {
    $ret = array();

    foreach($this->apiAttributes() as $k => $v) {
      if($this->$k != $this->json[$k]) {
        $ret[$k] = $this->$k;
      }
    }
    return $ret;
  }


}
