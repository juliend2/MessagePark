<?php

namespace MessagePark\Types;

use MessagePark\BaseClass;
use MessagePark\Arithmetic;
use function MessagePark\send;

class IntegerClass extends BaseClass {
  function send(string $message_name, ...$arguments) {
    $method_name = Arithmetic::operatorTokenToMethodName($message_name);
    return Arithmetic::$method_name($this->value, $arguments[0]);
  }
}

