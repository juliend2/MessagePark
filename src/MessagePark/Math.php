<?php

namespace MessagePark;
use MessagePark\Exceptions\MethodMissingException;

class Math {
  protected $value;
  protected $supported_methods;
  function __construct($value, $supported_methods) {
    $this->value = $value;
    $this->supported_methods = $supported_methods;
  }

  function __call($method_name, $arguments) {
    if (!in_array($method_name, array_keys($this->supported_methods))) {
      // NOOP
      throw new MethodMissingException($method_name);
    }
    if (isset($this->supported_methods[$method_name][0]) && $this->supported_methods[$method_name][0] === 'this') {
      $args = array_slice($this->supported_methods[$method_name], 1);
      return $method_name($this->value, ...$args);
    }
    // Maybe it's calling a function on $this->value?
    // if ($this->supported_methods[$method_name][0]) {
    //   // TODO
    // }
    throw new \Exception('You called a method for which $this->value is not the first param.');
  }
}
