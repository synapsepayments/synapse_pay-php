<?php

namespace SynapsePay;

class PathBuilder {

    // Take a path like:
    //   ":path/:id/dogs/:dog_id"
    // and convert it to:
    //   "#{object.path}/#{object.id}/dogs/#{params[:id]}" => "/objects/1/dogs/2"
    //
    // Path priority is:
    //   1. Object - this will be a class or an instance of a class.
    //   2. Params - this is a hash of key values. All keys *must* be symbolized.
    //
    public static function build( $path, $object, $params ) {

      $ret = $path;

      $match = array();

      while(preg_match('/:([^\/]*)/', $ret, $match) == 1) {
        $value = self::determineValue($match[1], $object, $params);
        if($value == null) {
          throw new \Exception("Could not determine the full URL. The argument " . $match[0] . " is missing. Try setting them in your params.");
        }

        $count = 1; // keep str_replace from partial matching
        $ret = str_replace($match[0], $value, $ret, $count);
      }
      return $ret;
    }

    public static function determineValue( $match, $object, $params ) {

      $value = null;

      if( $object && property_exists($object, $match)) {
        $value = $object->$match;
      } else if(array_key_exists($match, $params)) {
        $value = $params[$match];
      }

      return $value;
    }

}
