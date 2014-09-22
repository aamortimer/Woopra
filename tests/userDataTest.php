<?php
use aamortimer\Woopra\UserData;
date_default_timezone_set('Europe/London');

class UserDataTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->website = 'bookfhr.com';
    $this->userData = new userData(array(
      'app-id' => 'HWFHNCS42SROLUGUF2ZHOMMSSHQKME7W',
      'secret-key' => 'wAhTUqyC0yyzQEJhsG5LO9EwXEI9ZIR1BP6Npx1Rx42xMjHcIBPMCKRbshRgcWbH'
    ));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLabelShow()
  {
    $this->userData->show();
  }

  public function testLabelShowReponse()
  {
    $rsp = $this->userData->show(array(
      'website'=>$this->website
    ));

    $this->assertTrue(is_object($rsp));
  }
}
