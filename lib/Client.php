<?php

namespace SynapsePay;

class Client extends ApiClient {

  public $oauthConsumerKey;
  public $refreshToken;
  public $expiresIn;
  public $username;
  public $userID;
  public $json;

  public $user;
  public $banks;
  public $orders;
  public $deposits;
  public $withdrawals;
  public $cards;
  public $massPays;
  public $bankStatuses;
  public $wires;

  public function __construct( $oauthConsumerKey=null, $refreshToken=null ) {
    $this->refreshFrom( [
        "oauth_consumer_key" => $oauthConsumerKey,
        "refresh_token" => $refreshToken
    ] );
  }

  public function refreshFrom( $json ) {
    $this->json = $json;
    $this->oauthConsumerKey = $json["oauth_consumer_key"];
    $this->refreshToken = $json["refresh_token"];
    $this->expiresIn = $json["expires_in"];
    $this->username = $json["username"];
    $this->userID = $json["user_id"];

    $this->user = new UserEndpoint($this);
    $this->banks = new BankEndpoint($this);
    $this->orders = new OrderEndpoint($this);
    $this->deposits = new DepositEndpoint($this);
    $this->withdrawals = new WithdrawalEndpoint($this);
    $this->cards = new CardEndpoint($this);
    $this->massPays = new MassPayEndpoint($this);
    $this->bankStatuses = new BankStatusEndpoint($this);
    $this->wires = new WireEndpoint($this);

    return parent::refreshFrom( [], [
        "oauth_consumer_key" => $this->oauthConsumerKey
     ] );
  }

}
