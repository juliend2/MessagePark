<?php

namespace MessagePark;

class BaseClass {
  protected $value;

  function __construct($value = null) {
    $this->value = $value;
  }

  /**
   * Don't specify any return type, because we want to stay flexible.
   */
  function __call(string $message_name, array $arguments) {
    // To override if needed
    echo $message_name;
    echo implode(', ', $arguments);
    return null;
  }

  function methodMissing() {
    return new MethodMissingError();
  }

  function onError($callback) {
    if (is_subclass_of(static::class, BaseError::class)) {
      $callback($this);
    }
  }
}

