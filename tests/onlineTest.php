<?php
use aamortimer\Woopra\Config;
use aamortimer\Woopra\Search;

date_default_timezone_set('Europe/London');

class OnlineTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    echo Config::app_id;die;
    $this->website = 'bookfhr.com';
    $this->search = new Search(array(
      'app-id' => '',
      'secret-key' => ''
    ));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testOnlineCount()
  {
     $this->search->onlineCount();
  }

  public function testOnlineCountResults()
  {
    $rsp = $this->search->onlineCount(array(
      'website'=>'bookfhr.com'
    ));
    $this->assertTrue(is_object($rsp));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testOnlineList()
  {
     $this->search->onlineList();
  }

  public function testOnlineListResults()
  {
    $rsp = $this->search->onlineList(array(
      'website'=>'bookfhr.com'
    ));

    $this->assertTrue(is_object($rsp));
  }
}
