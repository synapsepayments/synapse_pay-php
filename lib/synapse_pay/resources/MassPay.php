<?php

namespace SynapsePay;

class MassPay extends ApiResource {

  public $resource_uri;
  public $account_number_string;
  public $fee;
  public $name_on_account;
  public $routing_number_string;
  public $status;
  public $trans_type;
  public $amount;
  public $date;
  public $id;

  function cancel( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/masspay/cancel", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $client);
  }

}
