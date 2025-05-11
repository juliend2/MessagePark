<?php

namespace MessagePark;

use MessagePark\Exceptions\MethodMissingException;

trait Messageable {
  protected $value;

  function __construct($value = null) {
    $this->value = $value;
  }

  /**
   * Don't specify any return type, because we want to stay flexible.
   */
  function __call(string $message_name, array $arguments) {
    // To override if needed
    /* echo $message_name; */
    /* echo implode(', ', $arguments); */
    return $this->methodMissing($message_name, $arguments);
  }

  protected function methodMissing(string $message_name, array $arguments) {
    // TODO: TURN IT BACK ON LATER:
    //throw new MethodMissingException();
    if (is_object($this->value) && method_exists($this->value, $message_name)) {
      // we're wrapping another object, therefore let's try proxying this
      // method to it:
      return $this->value->$message_name(...$arguments);
    }
  }
}
