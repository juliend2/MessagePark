<?php

namespace MessagePark\Exceptions;

use MessagePark\BaseClass;
use MessagePark\Messageable;

class BaseException extends \Exception {
  use Messageable;
}

