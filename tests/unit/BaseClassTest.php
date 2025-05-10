<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseClass;
use MessagePark\Exceptions\MethodMissingException;

class SubClassThatSilencesMethodMissing extends BaseClass {
  protected function methodMissing() {
    // NOOP
  }
}

class BaseClassTest extends TestCase {
  function testMessagePassing() {
    $obj = new SubClassThatSilencesMethodMissing('oui');
    try {
      $obj->thisMethodDoesntExist();
      $this->assertTrue($reaches_this = true);
    } catch (Exception $e) {
      $this->fail("An exception was thrown: {$e->getMessage()}");
    }
  }

  function testMessagePassingNotImplemented() {
    $obj = new BaseClass('oui');
    $this->expectException(MethodMissingException::class);
    $obj->thisMethodDoesntExist();
  }

}

