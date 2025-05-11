<?php

namespace MessagePark\Types;

use MessagePark\BaseClass;
use MessagePark\Arithmetic;
use MessagePark\Exceptions\MethodMissingException;
use function MessagePark\send;

class IntegerClass extends BaseClass {
  // See https://www.php.net/manual/en/ref.math.php
  const METHODS = [
    'abs' => ['this'],
    'base_convert' => ['strval(this)', 'from_base', 'to_base'],
    'bindec' => ['strval(this)'],
    'ceil' => ['this'],
    'decbin' => ['this'],
    'dechex' => ['this'],
    'decoct' => ['this'],
    'floor' => ['this'],
    // 'hexdec' => ['strval(this)'], // possibly impossible to implement
    //              because the hex string is a string, but we can't try to see
    //              whether that's a valid hex value, because that would be
    //              ambiguous.
    'intdiv' => ['this', 'num2'],
    'octdec' => ['this'],
    'pow' => ['this', 'exponent'],
    'round' => ['this', 'precision', 'mode'],
  ];
  function send(string $message_name, ...$arguments) {
    $method_name = Arithmetic::operatorTokenToMethodName($message_name);
    if (method_exists(Arithmetic::class, $method_name)) {
      return Arithmetic::$method_name($this->value, $arguments[0]);
    }
  }
}

