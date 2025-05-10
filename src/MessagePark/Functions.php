<?php

namespace MessagePark;

use MessagePark\TypeDetector;
use MessagePark\MethodMissingError;
use MessagePark\BaseClass;
use MessagePark\Types\IntegerClass;
use MessagePark\Types\FloatClass;

function send($object, $message_name, ...$params) {
  if (is_object($object) && method_exists($object, $message_name)) {
    return $object->$message_name(...$params);
  }
  if (is_integer($object)) {
    return send_message_to_integer($object, $message_name, $params);
  }
  return new MethodMissingError("Unsupported type for '$object'.");
}

function send_message_to_integer(int $object, $message_name, $params) {
  $_object = new IntegerClass($object);
  return $_object->send($message_name, $params[0]);
}

function o($primitive) {
  $detector = new TypeDetector();
  return match ($detector->detect($primitive)) {
    'INT' => new IntegerClass($primitive),
    'FLOAT' => new FloatClass($primitive),
    'BASECLASS' => $primitive, // NOOP
    default => null,
  };
  return new BaseObject($primitive);
}

