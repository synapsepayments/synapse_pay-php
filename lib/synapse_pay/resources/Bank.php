<?php

namespace SynapsePay;

class Bank extends ApiResource {

  public $is_active;
  public $nickname;
  public $resource_uri;
  public $date;
  public $id;
  public $account_type;
  public $is_buyer_default;
  public $is_verified;
  public $name_on_account;
  public $routing_number_string;
  public $account_class;
  public $is_seller_default;
  public $account_number_string;
  public $bank_name;

  function remove( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "bank_id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/delete", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $json;
  }

}
