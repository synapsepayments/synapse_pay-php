<?php

namespace SynapsePay;

class Request
{

  public function request($method, $url, $params, $headers) {

    $method = str_replace( ":", "", $method );

    list($rbody, $rcode) = self::executeRequest($method, $url, $params, $headers);

    return array(
      'body' => $rbody,
      'code' => $rcode
      );

  }

  public function executeRequest($method, $path, $params, $headers) {

      $curl = curl_init();
      $method = strtolower($method);
      $opts = array();

      if ($method == 'get') {
          $opts[CURLOPT_HTTPGET] = 1;
          if (count($params) > 0) {
              $encoded = self::encodeForm($params);
              if(strpos($path, "?") !== false) {
                  $path = "$path&$encoded";
              } else {
                  $path = "$path?$encoded";
              }
          }
      } elseif ($method == 'post') {
          $opts[CURLOPT_POST] = 1;
          $opts[CURLOPT_POSTFIELDS] = self::encode($params, $headers);

      } elseif ($method == 'put') {
          $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
          if (count($params) > 0) {
              $opts[CURLOPT_POSTFIELDS] = self::encode($params, $headers);
          }
      } elseif ($method == 'delete') {
          $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
          if (count($params) > 0) {
              $encoded = self::encodeForm($params);
              $path = "$path?$encoded";
          }
      } else {
          throw new ApiError("Unrecognized Curl Method: '{$method}'");
      }

      foreach ($headers as $header => $value) {
        $rawHeaders[] = $header . ': ' . $value;
      }

      $opts[CURLOPT_URL] = $path;
      $opts[CURLOPT_RETURNTRANSFER] = true;
      $opts[CURLOPT_CONNECTTIMEOUT] = 30;
      $opts[CURLOPT_TIMEOUT] = 60;
      $opts[CURLOPT_RETURNTRANSFER] = true;
      $opts[CURLOPT_HTTPHEADER] = $rawHeaders;
      $opts[CURLOPT_SSL_VERIFYPEER] = false;

      curl_setopt_array($curl, $opts);
      $rbody = curl_exec($curl);

      $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      return array($rbody, $rcode);
  }

  public static function encode($arr, $headers) {
    if( $headers["Content-Type"] == "application/json" ) {
      return json_encode($arr);
    } else {
      return self::encodeForm($arr);
    }
  }

  /**
   * @param array $arr A map of param keys to values.
   * @param string|null $prefix (It doesn't look like we ever use $prefix...)
   *
   * @return string A querystring, essentially.
   */
  public static function encodeForm($arr, $prefix = null)
  {
      if (!is_array($arr)) {
          return $arr;
      }

      $r = array();
      foreach ($arr as $k => $v) {
          if (is_null($v)) {
              continue;
          }

          if ($prefix && $k && !is_int($k)) {
              $k = $prefix."[".$k."]";
          } elseif ($prefix) {
              $k = $prefix."[]";
          }

          if (is_array($v)) {
              $r[] = self::encode($v, $k, true);
          } else {
              $r[] = urlencode($k)."=".urlencode($v);
          }
      }

      return implode("&", $r);
  }

}
