<?php

namespace SynapsePay;

class Card extends ApiResource {

  public $account_class;
  public $account_number_string;
  public $account_type;
  public $id;
  public $name_on_account;
  public $resource_uri;
  public $routing_number_string;

  function update( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/card/edit", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $this->refreshFrom($json["card"], $method, $this->client);
  }

}
