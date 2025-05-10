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
    $this->methodMissing();
  }

  function methodMissing() {
    throw new MethodMissingException();
  }
}
