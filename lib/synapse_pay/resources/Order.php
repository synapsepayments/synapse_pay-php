<?php

namespace SynapsePay;

class Order extends ApiResource {

  public $status_url;
  public $tip;
  public $id;
  public $seller;
  public $fee;
  public $resource_uri;
  public $ticket_number;
  public $total;
  public $amount;
  public $date;
  public $supp_id;
  public $is_buyer;
  public $note;
  public $account_type;
  public $discount;
  public $status;
  public $date_settled;
  public $facilitator_fee;

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
