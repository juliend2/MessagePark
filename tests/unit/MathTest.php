<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use function MessagePark\o;

class MathTest extends TestCase {

  function testFloatFunctions() {
    $this->assertEquals(1, o(1.1)->floor());
    $this->assertEquals(2, o(1.1)->ceil());
  }
}


