<?php namespace aamortimer\Woopra;

/**
 * Woopra Search API
 *
 * PHP class to interact with the Woopra API
 * https://www.woopra.com/docs/developer/analytics-api/
 *
 * @package  woopra
 * @license  http://opensource.org/licenses/MIT
 * @version  1.0.0
 */
class Funnels extends Base {
  /**
   * Construct
   *
   * @param     array $config
   * @return    void
   */
  public function __construct(Array $config)
  {
    if (!isset($config['app-id'])) {
      throw new \InvalidArgumentException('App ID is required, you can find yours by going to \'https://www.woopra.com/members/settings/access-keys\'');
    }

    if (!isset($config['secret-key'])) {
      throw new \InvalidArgumentException('Secret key is required, you can find yours by going to \'https://www.woopra.com/members/settings/access-keys\'');
    }

    $this->app_id = $config['app-id'];
    $this->secret_key = $config['secret-key'];
  }

  /**
   * search function
   * TODO: work out how to make this function work
   * @param     array $data
   * @return    mixed
   */
  public function funnel(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    if (!isset($data['start_day'])) {
      throw new \InvalidArgumentException('You must supply the \'start_day\'.');
    }

    if (!isset($data['end_day'])) {
      throw new \InvalidArgumentException('You must supply the \'end_day\'.');
    }

    if (!isset($data['goals'])) {
      throw new \InvalidArgumentException('You must supply the \'goals\' JSON data.');
    }

    if (!isset($data['group_by'])) {
      throw new \InvalidArgumentException('You must supply the \'group_by\' JSON data.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }
}
