<?php

namespace SynapsePay;

class Bank extends ApiResource {

  public $account_class;
  public $account_number_string;
  public $account_type;
  public $bank_name;
  public $date;
  public $id;
  public $is_active;
  public $is_buyer_default;
  public $is_seller_default;
  public $is_verified;
  public $name_on_account;
  public $nickname;
  public $resource_uri;
  public $routing_number_string;

  function remove( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "bank_id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/bank/delete", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $json;
  }

}
