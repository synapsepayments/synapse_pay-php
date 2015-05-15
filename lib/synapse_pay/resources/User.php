<?php

namespace SynapsePay;

class User extends ApiResource {

  public $accept_bank_payments;
  public $accept_gratuity;
  public $avatar;
  public $balance;
  public $email;
  public $fullname;
  public $has_avatar;
  public $is_trusted;
  public $phone_number;
  public $promo_text;
  public $referral_code;
  public $resource_uri;
  public $seller_details;
  public $user_id;
  public $username;
  public $visit_count;
  public $visit_message;

  public function create( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/user/create", $params, $headers, $this );
    $json = $method->execute();
    return (new Client())->refreshFrom($json);
  }

  public function login( $username, $password, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "username" => $username,
      "password" => $password,
    ], $params);
    $method = new ApiMethod( ":post", "/user/login", $params, $headers, $this );
    $json = $method->execute();
    return (new Client())->refreshFrom($json);
  }

  public function refreshAccess( $refreshToken, $params=[], $headers=[] ) {
    $params = ParamsBuilder::merge([
      "refresh_token" => $refreshToken,
    ], $params);
    $method = new ApiMethod( ":post", "/user/refresh", $params, $headers, $this );
    $json = $method->execute();
    return (new Client())->refreshFrom($json);
  }

  function refresh( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/user/show", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $this->refreshFrom($json["user"], method);
  }

  function update( $params=[], $headers=[] ) {
    $method = new ApiMethod( ":post", "/user/edit", $params, $headers, $this );
    $json = $this->client->execute($method);
    return $this->refreshFrom($json["user"], method);
  }

}
