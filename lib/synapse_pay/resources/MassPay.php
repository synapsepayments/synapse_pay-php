<?php

namespace SynapsePay;

class MassPay extends ApiResource {

  public $account_number_string;
  public $amount;
  public $date;
  public $fee;
  public $id;
  public $name_on_account;
  public $resource_uri;
  public $routing_number_string;
  public $status;
  public $trans_type;

  function cancel( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/masspay/cancel", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $this->client);
  }

}
