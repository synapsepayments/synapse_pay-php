<?php

namespace SynapsePay;

class HeadersBuilder {

  public static function build( $headers, $apiKey=null, $authKey=null ) {
    $headers = is_array( $headers ) ? $headers : [];

    $headers = array_merge( self::defaultHeaders(), $headers );
    return $headers;
  }

  public static function defaultHeaders() {
    $headers = array_merge([
      "user_agent" => "SynapsePay/{SynapsePay::getApiVersion()} SynapsePay/{SynapsePay::VERSION}"
    ], [
      "Content-Type" => "application/json",
    ]);

    try {
      $headers["x_paid_client_user_agent"] = json_encode( self::userAgent() );
    } catch ( Exception $e ) {
      $headers["x_paid_client_raw_user_agent"] = var_dump( self::userAgent() );
      $headers["error"] = "{$e}";
    }

    return $headers;
  }



  public static function userAgent() {

    return array(
        "bindings_version" => SynapsePay::VERSION,
        "lang" => 'php',
        "lang_version" => phpversion(),
        "platform" => self::osInfo(),
        "publisher" => 'paid',
        "uname" => self::getUname()
      );

  }

  public static function getUname() {
    return "no uname"; // TODO(shane): Add uname
  }

  public static function osInfo() {
    // the order of this array is important

    $oses = array(
      'Win311' => 'Win16',
      'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
      'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
      'Win98' => '(Windows 98)|(Win98)',
      'Win2000' => '(Windows NT 5.0)|(Windows 2000)',
      'WinXP' => '(Windows NT 5.1)|(Windows XP)',
      'WinServer2003' => '(Windows NT 5.2)',
      'WinVista' => '(Windows NT 6.0)',
      'Windows 7' => '(Windows NT 6.1)',
      'Windows 8' => '(Windows NT 6.2)',
      'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
      'OpenBSD' => 'OpenBSD',
      'SunOS' => 'SunOS',
      'Ubuntu' => 'Ubuntu',
      'Android' => 'Android',
      'Linux' => '(Linux)|(X11)',
      'iPhone' => 'iPhone',
      'iPad' => 'iPad',
      'MacOS' => '(Mac_PowerPC)|(Macintosh)',
      'QNX' => 'QNX',
      'BeOS' => 'BeOS',
      'OS2' => 'OS/2',
      'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
    );


    $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] );

    if ( ! empty( $userAgent ) ) {
      foreach ($oses as $os => $pattern) {
        if ( preg_match('/' . $pattern . '/i', $userAgent) ) {
          return $os;
        }
      }
    }

    return 'Unknown';
  }

}
