<?php
use aamortimer\Woopra\Search;
date_default_timezone_set('Europe/London');

class SearchTest extends PHPUnit_Framework_TestCase {
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
  public function testSearch()
  {
     $this->search->search();
  }

  public function testSearchResults()
  {
    $rsp = $this->search->search(array(
      'website'=>'bookfhr.com'
    ));
    $this->assertTrue(is_object($rsp));
  }

  public function testSearchResultsData()
  {
    $rsp = $this->search->search(array(
      'website'=>'bookfhr.com'
    ));
    $this->assertTrue(is_numeric($rsp->visitors[0]->lastSeen));
  }
}
