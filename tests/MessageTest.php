<?php

require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\BaseClass;
use MessagePark\BaseError;
use MessagePark\MethodMissingError;
use function MessagePark\send;

class FakeClass extends BaseClass {
  protected $string;
  function __construct($string) {
    $this->string = $string;
  }
  function exclaim() {
    return "$this->string!";
  }
}

class MessageTest extends TestCase {

  protected function assertIsSubclassOf($base_class_name, $value) {
    $message = "Value ".var_export($value, true)." is not a subclass of '$base_class_name'.";
    $truthiness = is_subclass_of($value, $base_class_name);
    return $this->assertTrue($truthiness, $message);
  }

  public function testMessage() {
    $this->assertEquals(4, send(2, '+', 2));
    $this->assertIsSubclassOf(BaseError::class, send(2.1, '====', 2.1));
  }

  /*
  public function testNotImplementedMessage() {
    $this->assertEquals(null, send(2, '====', 2));
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
   */

  // public function testErrorHandling() {
  //   $obj = new FakeClass('du coup');
  //   send($obj, 'method_that_doesnt_exist')->onError(function($obj) {
  //     //echo 'prouette!';
  //   });
  // }

  // todo: method missing
  //       on error
  //       handling exceptions

}

