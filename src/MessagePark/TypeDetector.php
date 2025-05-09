<?php

namespace MessagePark;

class TypeDetector {
  public function detect($input): string {
    if (is_array($input)) {
      return 'ARRAY';
    }
    // not array, but iterable:
    if (is_iterable($input)) {
      return 'ITERABLE';
    }
    if (is_float($input)) {
      return 'FLOAT';
    }
    if (is_int($input)) {
      return 'INT';
    }
    if (is_string($input)) {
      return 'STRING';
    }
    if (is_bool($input)) {
      return 'BOOL';
    }
    if (is_null($input)) {
      return 'NULL';
    }
    // Object:
    if (is_object($input) && is_a($input, 'MessagePark\BaseClass')) {
      return strtoupper(explode('\\', get_class($input))[1]);
    }
    // Not BaseObject, but still stdClass:
    if (is_object($input)) {
      return 'OBJECT';
    }
    throw new \Exception("Unrecognized type for ". var_export($input, true). ".");
  }
}

