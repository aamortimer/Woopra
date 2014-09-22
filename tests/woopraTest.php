<?php
use aamortimer\Woopra\Woopra;
date_default_timezone_set('Europe/London');

class WoopraTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->data = [
      'app-id' => '',
      'secret-key' => '',
      'website' => 'example.com',
      'search' => 'example@example.com'
    ];
  }

  public function testGetLabels()
  {
    Woopra::getAllLabels($this->data, function($labels){
      $this->assertTrue(is_array($labels));
    });
  }

  public function testUserLabels()
  {
    Woopra::getUserLabels($this->data, function($labels){
      $this->assertTrue(is_array($labels));
    });
  }
}
