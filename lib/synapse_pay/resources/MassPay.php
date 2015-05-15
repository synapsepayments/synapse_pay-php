<?php

namespace SynapsePay;

class MassPay extends ApiResource {

  public $date;
  public $id;
  public $name_on_account;
  public $routing_number_string;
  public $account_number_string;
  public $amount;
  public $fee;
  public $resource_uri;
  public $status;
  public $trans_type;

  function cancel( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/masspay/cancel", $params, $headers, $this );
    $json = $this->client->execute($method);
    return new ApiList("MassPay", $json["mass_pays"], $method, $client);
  }

}
