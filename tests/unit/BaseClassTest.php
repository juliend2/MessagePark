<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseClass;
use MessagePark\Exceptions\MethodMissingException;

class BaseClassTest extends TestCase {
  function testMessagePassing() {
    $obj = new BaseClass('oui');
    $this->expectException(MethodMissingException::class);
    $obj->thisMethodDoesntExist();
  }
}

