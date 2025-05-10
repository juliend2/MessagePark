<?php

require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseClass;
use MessagePark\Types\FloatClass;
use MessagePark\Types\IntegerClass;
use function MessagePark\o;

class OTest extends TestCase {

  function testO() {
    $obj = new BaseClass('');
    $this->assertInstanceOf(BaseClass::class, o($obj));
    $this->assertInstanceOf(IntegerClass::class, o(1));
    $this->assertInstanceOf(FloatClass::class, o(1.2));
  }

}
