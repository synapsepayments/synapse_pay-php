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
        // echo 'Error in execute';
        // $this->responseBody = e.http_body if e.respond_to?(:http_body)
        // $this->responseCode = e.http_code if e.respond_to?(:http_code)
        //@error = compose_error(e)
        //raise @error
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
        return new ApiError( "Invalid request. Please check the URL and parameters.", $this );
      } else if ( $this->responseCode == 401 ) {
        return new AuthenticationError( "Authentication failed.", $this );
      } else {
        return new ApiError( "An error occured while making the API call.", $this );
      }
    }


  // public static function composeArguments($method_opts, $arguments) {
  //     $ret = array();
  //     if(array_key_exists("arguments", $method_opts)) {
  //         $arg_names = $method_opts["arguments"];
  //         foreach($arg_names as $arg_name) {
  //             if(count($arguments) == 0) {
  //                 throw new \Exception('Too few arguments provided. ' . implode(", ", $arg_names) . ' are all required.');
  //             }
  //             $ret[$arg_name] = array_shift($arguments);
  //         }
  //     }
  //     if(count($arguments) > 0) {
  //         $ret["params"] = array_shift($arguments);
  //     } else {
  //       $ret["params"] = array();
  //     }
  //     if(count($arguments) > 0) {
  //       $ret["options"] = array_shift($arguments);
  //     } else {
  //       $ret["options"] = array();
  //     }
  //     if(count($arguments) > 0) {
  //         throw new \Exception('Too many arguments provided.');
  //     }

  //     $params = $ret["params"];
  //     $options = $ret["options"];
  //     unset($ret["params"]);
  //     unset($ret["options"]);

  //     return array($ret, $params, $options);
  // }

  // public static function getBasePath($options) {
  //   $path = "";
  //   if(array_key_exists("path", $options)) {
  //       $path = $options["path"] . "";
  //   } else {
  //       $path = ":path";
  //   }
  //   return $path . "";
  // }



  // public static function determineUnusedArgs($options, $arguments) {
  //   $path = self::getBasePath($options);
  //   $match = array();
  //   while(preg_match('/:([^\/]*)/', $path, $match) == 1) {
  //     if(array_key_exists($match[1], $arguments)) {
  //       unset($arguments[$match[1]]);
  //     }
  //     $count = 1;
  //     $empty = "";
  //     $path = str_replace($match[0], $empty, $path, $count);
  //   }
  //   return $arguments;
  // }

  // public static function composeParams($params, $arguments, $default_params, $klass, $this) {
  //   if(!is_array($default_params)) {
  //     if($this != null) {
  //       echo "default params started as...";
  //       var_dump($default_params);
  //       var_dump($klass);
  //       $default_params = self::tryInstanceThenClass($klass, $this, $default_params);
  //       echo "default paramsa re now...";
  //       var_dump($default_params);
  //     }
  //   }

  //   return $params + $arguments + $default_params;
  // }


}
