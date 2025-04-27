<?php

namespace MessagePark;

class BaseObject {
  function methodMissing() {
    return new MethodMissingError();
  }

  function onError($callback) {
    if (is_subclass_of(static::class, BaseError::class)) {
      $callback($this);
    }
  }
}

