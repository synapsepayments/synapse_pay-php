<?php

namespace SynapsePay;

class SynapsePay
{

    // @var string The base URL for the SynapsePay API.
    public static $apiBase = "https://synapsepay.com/api/v2/";

    // @var string The staging URL for the SynapsePay API.
    public static $apiStaging = "https://sandbox.synapsepay.com/api/v2";

    // @var string|null The version of the SynapsePay API to use for requests.
    public static $apiVersion = "v2";

    // @var string The support email of the SynapsePay API to use for requests.
    public static $supportEmail = "hello@synapsepay.com";

    // @var string|null The version of the SynapsePay API to use for requests.
    public static $docsUrl = "http://synapsepay.readme.io/v1.0/docs";

    public static $apiSandbox = "https://sandbox.synapsepay.com/api/v2";


    public static $clientId = null;
    public static $clientSecret = null;


    const VERSION = '0.0.1';

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return string The API Base used for requests.
     */
    public static function getApiBase()
    {
        return self::$apiBase;
    }

    /**
     * @return string The Auth Header used for requests.
     */
    public static function getAuthHeader()
    {
        return self::$authHeader;
    }

}
