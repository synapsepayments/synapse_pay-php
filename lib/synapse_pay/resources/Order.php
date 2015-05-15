<?php

namespace SynapsePay;

class Order extends ApiResource {

  public $account_type;
  public $amount;
  public $date;
  public $date_settled;
  public $discount;
  public $facilitator_fee;
  public $fee;
  public $id;
  public $is_buyer;
  public $note;
  public $resource_uri;
  public $seller;
  public $status;
  public $status_url;
  public $supp_id;
  public $ticket_number;
  public $tip;
  public $total;

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
