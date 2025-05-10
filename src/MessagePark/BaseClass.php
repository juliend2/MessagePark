<?php

namespace MessagePark;

use MessagePark\Messageable;
use Messageable\Exceptions\BaseException;

class BaseClass {
  use Messageable;

  function onError($callback) {
    if (is_subclass_of(static::class, BaseException::class)) {
      $callback($this);
    }
  }
}

