<?php

namespace SynapsePay;

class Order extends ApiResource {

  public $facilitator_fee;
  public $is_buyer;
  public $note;
  public $resource_uri;
  public $date;
  public $date_settled;
  public $status_url;
  public $tip;
  public $discount;
  public $supp_id;
  public $seller;
  public $status;
  public $ticket_number;
  public $total;
  public $account_type;
  public $amount;
  public $fee;
  public $id;

  function update( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "order_id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/order/update", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $this->refreshFrom($json["order"], method);
  }

  function void( $params=[], $headers=[] ) {
    $params = ParamsBuilde::merge([
      "order_id" => $this->id,
    ], $params);
    $method = new ApiMethod( ":post", "/order/void", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $this->refreshFrom($json["order"], method);
  }

}
