<?php

namespace MessagePark;

class Arithmetic {
  public static function operatorTokenToMethodName(string $operator): string {
    return match ($operator) {
      '+' => 'add',
      '-' => 'subtract',
      '*' => 'multiply',
      '/' => 'divide',
      default => $operator,
    };
  }
  public static function add($a, $b) {
    return $a + $b;
  }
  public static function subtract($a, $b) {
    return $a - $b;
  }
  public static function multiply($a, $b) {
    return $a * $b;
  }
  public static function divide($a, $b) {
    return $a / $b;
  }
}

