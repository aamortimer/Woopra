<?php
use aamortimer\Woopra\Analytics;
date_default_timezone_set('Europe/London');

class AnalyticsTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->website = 'bookfhr.com';
    $this->analytics = new Analytics(array(
      'app-id' => '',
      'secret-key' => ''
    ));

    $this->report = [
      'group_by'=>array(
        array('key'=>'time', 'scope'=>'visits')
      ),
      'columns'=>array(
        array('name'=>'People', 'method'=>'count', 'scope'=>'visitors'),
        array('name'=>'Actions', 'method'=>'count', 'scope'=>'actions')
      )
    ];
  }

  /**
   * Test web site exception
   * @expectedException InvalidArgumentException
   */
  public function testAnalyticsReportWebSite()
  {
    $data = array(
      'report'=>$this->report,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
      'end_day'=>date('Y-m-d')
    );

    $this->analytics->report();
  }

  /**
   * Test report exception
   * @expectedException InvalidArgumentException
   */
  public function testAnalyticsReportReport()
  {
    $data = array(
      'website'=>$this->website,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
      'end_day'=>date('Y-m-d')
    );

    $this->analytics->report();
  }

  /**
   * Test start day exception
   * @expectedException InvalidArgumentException
   */
  public function testAnalyticsReportStartDay()
  {
    $data = array(
      'website'=>$this->website,
      'report'=>$this->report,
      'end_day'=>date('Y-m-d')
    );

    $this->analytics->report();
  }

  /**
   * Test start day exception
   * @expectedException InvalidArgumentException
   */
  public function testAnalyticsReportEndDay()
  {
    $data = array(
      'website'=>$this->website,
      'report'=>$this->report,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
    );

    $this->analytics->report();
  }

  public function testAnalyticsReportObject()
  {
    $data = array(
      'website'=>$this->website,
      'report'=>$this->report,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
      'end_day'=>date('Y-m-d')
    );

    $rsp = $this->analytics->report($data);

    $this->assertTrue(is_object($rsp));
  }
}
