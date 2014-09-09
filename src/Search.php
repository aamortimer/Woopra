<?php namespace aamortimer\Woopra;

/**
 * Woopra Search API
 *
 * PHP class to interact with the Woopra API
 * https://www.woopra.com/docs/developer/search-api/
 *
 * @package  woopra
 * @license  http://opensource.org/licenses/MIT
 * @version  1.0.0
 */
class Search extends Base {
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
   *
   * @param     array $data
   * @return    mixed
   */
  public function search(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * profile function
   *
   * @param     array $data
   * @return    mixed
   */
  public function profile(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    if (!isset($data['email'])) {
      throw new \InvalidArgumentException('You must supply the \'email\' address for the profile.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * profile function
   *
   * @param     array $data
   * @return    mixed
   */
  public function profileVisits(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    if (!isset($data['email'])) {
      throw new \InvalidArgumentException('You must supply the \'email\' address for the profile.');
    }

    if (!isset($data['to']) && !isset($data['start_day'])) {
      throw new \InvalidArgumentException('You must supply the \'start_day\' if \'to\' parameter is not set.');
    }

    if (!isset($data['to']) && !isset($data['end_day'])) {
      throw new \InvalidArgumentException('You must supply the \'end_day\' if \'to\' parameter is not set.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * profile edit function
   *
   * @param     array $data
   * @return    mixed
   */
  public function profileEdit(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    if (!isset($data['email'])) {
      throw new \InvalidArgumentException('You must supply the \'email\' address for the profile.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * profile edit function
   *
   * @param     array $data
   * @return    mixed
   */
  public function onlineCount(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * search visits function
   *
   * @param     array $data
   * @return    mixed
   */
  public function searchVisits(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    if (!isset($data['before'])) {
      throw new \InvalidArgumentException('You must supply the \'before\' timestamp.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }

  /**
   * search visits function
   *
   * @param     array $data
   * @return    mixed
   */
  public function onlineList(Array $data = [])
  {
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('You must supply the \'website\' address you are searching.');
    }

    $data = array_merge($data, $this->defaults);

    return $this->send($data, __METHOD__);
  }
}
