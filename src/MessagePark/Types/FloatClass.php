<?php

namespace MessagePark\Types;

use MessagePark\BaseClass;
use MessagePark\Math;
use MessagePark\Arithmetic;
use function MessagePark\send;

class FloatClass extends BaseClass {
  // See https://www.php.net/manual/en/ref.math.php
  const METHODS = [
    'abs' => ['this'],
    'acos' => ['this'],
    'acosh' => ['this'],
    'asin' => ['this'],
    'asinh' => ['this'],
    'atan' => ['this'],
    'atan2' => ['this', 'y'],
    'atanh' => ['this'],
    'ceil' => ['this'],
    'cos' => ['this'],
    'deg2rad' => ['this'],
    'exp' => ['this'],
    'expm1' => ['this'],
    'fdiv' => ['this', 'num2'],
    'floor' => ['this'],
    'fmod' => ['this', 'num2'],
    'fpow' => ['this', 'exponent'],
    'hypot' => ['this', 'y'],
    'is_finite' => ['this'],
    'is_infinite' => ['this'],
    'is_nan' => ['this'],
    'log' => ['this', 'base'],
    'log10' => ['this'],
    'log1p' => ['this'],
    'max' => ['this', '...'],
    'min' => ['this', '...'],
    'pow' => ['this', 'exponent'],
    'rad2deg' => ['this'],
    'round' => ['this', 'precision', 'mode'],
    'sin' => ['this'],
    'sinh' => ['this'],
    'tan' => ['this'],
    'tanh' => ['this'],
  ];

  function send(string $message_name, ...$arguments) {
    $method_name = Arithmetic::operatorTokenToMethodName($message_name);
    if (method_exists(Arithmetic::class, $method_name)) {
      // NOOP
      return Arithmetic::$method_name($this->value, $arguments[0]);
    }
  }

  function methodMissing(string $message_name, array $arguments) {
    if (in_array($message_name, array_keys(self::METHODS))) {
      $math = new Math($this->value, self::METHODS);
      return $math->$message_name($arguments);
      //return $message_name($this->value);
    }
    // if nothing else could be found, call parent's:
    return parent::methodMissing($message_name, $this->value, ...$arguments);
  }
}

