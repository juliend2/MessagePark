<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MessagePark\TypeDetector;
use MessagePark\BaseClass;

class TypeDetectorTest extends TestCase {

  protected TypeDetector $detector;

  protected function setUp(): void {
    $this->detector = new TypeDetector();
  }

  public function testDetectScalars() {
    $this->assertEquals('INT', $this->detector->detect(1));
    $this->assertEquals('INT', $this->detector->detect(0));
    $this->assertEquals('FLOAT', $this->detector->detect(1.0));
    $this->assertEquals('FLOAT', $this->detector->detect(0.0));
    $this->assertEquals('STRING', $this->detector->detect('1'));
    $this->assertEquals('STRING', $this->detector->detect('0'));
    $this->assertEquals('BOOL', $this->detector->detect(true));
    $this->assertEquals('BOOL', $this->detector->detect(false));
  }

  public function testDetectSpecials() {
    $this->assertNotEquals('NULL', $this->detector->detect(0));
    $this->assertNotEquals('NULL', $this->detector->detect(false));
    $this->assertNotEquals('NULL', $this->detector->detect([]));
    $this->assertEquals('NULL', $this->detector->detect(null));
  }

  public function testDetectObjects() {
    $this->assertEquals('OBJECT', $this->detector->detect((object)[]));
    $this->assertEquals('OBJECT', $this->detector->detect(new stdClass()));
    $this->assertEquals('BASECLASS', $this->detector->detect(new BaseClass('')));
  }

  public function testDetectIterables() {
    $this->assertEquals('ARRAY', $this->detector->detect([]));
    $this->assertEquals('ARRAY', $this->detector->detect(array()));
    $this->assertEquals('ITERABLE', $this->detector->detect(new ArrayObject()));
  }

}



