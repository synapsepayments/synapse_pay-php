<?php

namespace SynapsePay;

class Bank extends ApiResource {

  public $name_on_account;
  public $resource_uri;
  public $id;
  public $is_active;
  public $is_seller_default;
  public $nickname;
  public $account_class;
  public $account_number_string;
  public $is_buyer_default;
  public $account_type;
  public $routing_number_string;
  public $bank_name;
  public $date;
  public $is_verified;

  function remove( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "bank_id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/delete", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $json;
  }

}
