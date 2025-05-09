<?php

require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseClass;
use MessagePark\Types\FloatClass;
use function MessagePark\o;

class OTest extends TestCase {

  function testO() {
    $obj = new BaseClass('');
    $this->assertInstanceOf(BaseClass::class, o($obj));
    $this->assertInstanceOf(FloatClass::class, o(1.2));
  }

}
