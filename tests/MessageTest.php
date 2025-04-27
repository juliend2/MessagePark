<?php

require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseObject;
use MessagePark\BaseError;
use MessagePark\MethodMissingError;
use function MessagePark\send;

class FakeClass extends BaseObject {
  protected $string;
  function __construct($string) {
    $this->string = $string;
  }
  function exclaim() {
    return "$this->string!";
  }
}

class MessageTest extends TestCase {

  public function testMessage() {
    $this->assertEquals(4, send(2, '+', 2));
  }

  public function testMessagePassingToObject() {
    $obj = new FakeClass('du coup');
    $this->assertEquals('du coup!', send($obj, 'exclaim'));
  }

  public function testMethodMissing() {
    $obj = new FakeClass('du coup');
    //$this->assertInstanceOf('BaseError', send($obj, 'chose_bine'));
    $this->assertInstanceOf(MethodMissingError::class, send($obj, 'chose_bine'));
  }

  public function testErrorHandling() {
    $obj = new FakeClass('du coup');
    send($obj, 'method_that_doesnt_exist')->onError(function($obj) {
      echo 'prouette!';
    });
  }

  // todo: method missing
  //       on error
  //       handling exceptions

}

