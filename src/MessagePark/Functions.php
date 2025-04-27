<?php

namespace MessagePark;

use MessagePark\Types\Integer;
use MessagePark\MethodMissingError;

function send($object, $message_name, ...$params) {
  if (is_object($object) && method_exists($object, $message_name)) {
    return $object->$message_name(...$params);
  }
  if (is_integer($object)) {
    return send_message_to_integer($object, $message_name, $params);
  }
  return new MethodMissingError();
}

function send_message_to_integer(int $object, $message_name, $params) {
  $_object = new Integer($object);
  return $_object->send($message_name, $params[0]);
}


