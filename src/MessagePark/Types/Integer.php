<?php

namespace MessagePark\Types;

use function MessagePark\send;

class Integer {
  protected $integer;
  public function __construct($integer) {
    $this->integer = $integer;
  }

  public function send($message_name, int $param) {
    if (!is_integer($param)) {
      return new BaseError("Integer can only call '$message_name' on objects of the same type.");
    }
    if ($message_name === '+') {
      return $this->integer + $param;
    }
  }
}

