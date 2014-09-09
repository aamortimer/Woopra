<?php
use aamortimer\Woopra\Funnels;
date_default_timezone_set('Europe/London');

class FunnelsTest extends PHPUnit_Framework_TestCase {
  public function setUp()
  {
    $this->website = 'bookfhr.com';
    $this->funnels = new Funnels(array(
      'app-id' => '',
      'secret-key' => ''
    ));

    $this->goals = [
        array(
          'name' => 'Booking',
          'operator' => 'AND',
          'filters' => array(
            array('scope'=>'actions', 'key' => 'url', 'match' => 'contains', 'value' => 'booking3')
          )
        )
    ];

    $this->group_by = 'day';
  }

  /**
   * Test web site exception
   * @expectedException InvalidArgumentException
   */
  public function testFunnelsWebSite()
  {
    $data = array();

    $this->funnels->funnel();
  }

  /**
   * Test start day exception
   * @expectedException InvalidArgumentException
   */
  public function testFunnelsStartDay()
  {
    $data = array();

    $this->funnels->funnel(array(
      'website'=>$this->website
    ));
  }

  /**
   * Test start day exception
   * @expectedException InvalidArgumentException
   */
  public function testFunnelsEndDay()
  {
    $data = array();

    $this->funnels->funnel(array(
      'website'=>$this->website,
      'start_day'=>date('Y-m-d', strtotime('-1 Day'))
    ));
  }

  /**
   * Test goals exception
   * @expectedException InvalidArgumentException
   */
  public function testFunnelsGoals()
  {
    $data = array();

    $this->funnels->funnel(array(
      'website'=>$this->website,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
      'end_day'=>date('Y-m-d')
    ));
  }

  /**
   * Test goals exception
   * @expectedException InvalidArgumentException
   */
  public function testFunnelsGroupBy()
  {
    $data = array();
    $this->funnels->funnel(array(
      'website'=>$this->website,
      'start_day'=>date('Y-m-d', strtotime('-1 Day')),
      'end_day'=>date('Y-m-d'),
      'goals'=>$this->goals
    ));
  }


  public function testFunnelsResponse()
  {
    $data = array();
    $rsp = $this->funnels->funnel(array(
      'website'=>$this->website,
      'start_day'=>date('Y-m-d', strtotime('-2 Day')),
      'end_day'=>date('Y-m-d', strtotime('-1 Day')),
      'goals'=>$this->goals,
      'group_by'=>$this->group_by
    ));

    $this->assertTrue(is_object($rsp));
  }

}
