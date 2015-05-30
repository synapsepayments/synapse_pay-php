<?php

namespace SynapsePay;

class ApiMethod {

    public $path;
    public $method;
    public $params;
    public $headers;

    public $responseBody;
    public $responseCode;
    public $error;

    public $apiKey;
    public $apiBase;


  public function __construct( $method, $path, $params, $headers, $object) {
    $this->apiBase = $apiBase ? $apiBase : SynapsePay::getApiBase();

    $this->method = $method;
    $this->path = PathBuilder::build( $path, $object, $params );
    $this->params = ParamsBuilder::build( $params );
    $this->headers = HeadersBuilder::build( $headers );
  }

  public function execute() {

     try {
        $response = Request::request( $this->method, $this->url(), $this->params, $this->headers );
        $this->responseBody = $response['body'];
        $this->responseCode = $response['code'];

      } catch ( Exception $e ) {
        $this->responseBody = $e->getMessage();
        $this->responseCode = $e->getCode();
        throw new ApiError( $this->responseBody, $this->method, $this->responseCode );
      }

      if ($this->responseCode < 200 || $this->responseCode >= 300) {
        throw $this->composeError();
      }

      return $this->responseJson();

  }


  public function url() {
    return "{$this->apiBase}{$this->path}";
  }

  public function responseJson()
  {
    try {
        $json = json_decode($this->responseBody, true);
    } catch (\Exception $e) {
        $msg = "Invalid response body from API: $this->responseBody "
          . "(HTTP response code was $this->responseCode)";
        //throw new Error\Api($msg, $rcode, $rbody);
        throw new \Exception($msg);
    }
    if( !$json["success"] ) {
      $this->error = new ApiError( $json, $this );
      throw $this->error;
    }
    return $json;
  }

  public function composeError() {
    return $this->errorWithResponse();
  }

  # Handle a few common cases.
  public function errorWithResponse() {
    if ( $this->responseCode == 400 || $this->responseCode == 404 ) {
      return new ApiError( $this->errorMessage("Invalid request. Please check the URL and parameters."), $this );
    } else if ( $this->responseCode == 401 ) {
      return new AuthenticationError( $this->errorMessage("Authentication failed."), $this );
    } else {
      return new ApiError( $this->errorMessage("An error occured while making the API call."), $this );
    }
  }

  public function errorMessage( $msg ) {
    if ( $this->responseBody == null ) {
      return $msg;
    } else {
      return $this->responseBody;
    }
  }

}
