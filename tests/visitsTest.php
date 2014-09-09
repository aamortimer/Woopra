<?php
use aamortimer\Woopra\Search;
date_default_timezone_set('Europe/London');

class VisitsTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->website = 'bookfhr.com';
    $this->search = new Search(array(
      'app-id' => '',
      'secret-key' => ''
    ));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSearchvisits()
  {
     $this->search->searchVisits();
  }

  public function testSearchvisitsResults()
  {
    $timestamp = strtotime('-2 day');
    $ms = $timestamp * 1000;
    $time_in_milliseconds = number_format($ms, 0, '.', '');

    $rsp = $this->search->searchVisits(array(
      'website'=>'bookfhr.com',
      'before'=>$time_in_milliseconds
    ));

    $this->assertTrue(is_object($rsp));
  }
}
