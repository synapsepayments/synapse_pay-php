<?php

namespace SynapsePay;

class ApiError extends SynapsePayError {

    public static $apiMethod;

    public function __construct($message = null, $apiMethod = null, $code = 0, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
      $this->apiMethod = $apiMethod;
    }

    public function code() {
      return ( $this->apiMethod['responseCode'] ) ? $this->apiMethod['responseCode'] : null;
    }

    public function body() {
      return ( $this->apiMethod['responseBody'] ) ? $this->apiMethod['responseBody'] : null;
    }

    public function json() {
      try {
        return ( $this->apiMethod['responseJson'] ) ? $this->apiMethod['responseJson'] : null;
      }
      catch ( Exception $e ) {
        return null;
      }
    }

    public function __toString() {
      $prefix = ( ! empty ( $this->code ) ) ? "(Status {$this->code})" : "";
      return "{$prefix}{$this->message}\n";
    }

}
