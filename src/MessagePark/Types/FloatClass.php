<?php

namespace MessagePark\Types;

use MessagePark\BaseClass;
use function MessagePark\send;

class FloatClass extends BaseClass {
  function __call(string $message_name, array $arguments) {
    return parent::__call($message_name, $arguments);
  }
}


