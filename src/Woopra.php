<?php namespace aamortimer\Woopra;

/**
 * Woopra Helper class
 *
 * PHP class to interact with the Woopra API
 * https://www.woopra.com/docs/developer/analytics-api/
 *
 * @package  woopra
 * @license  http://opensource.org/licenses/MIT
 * @version  1.0.0
 */
class Woopra extends Base {

  /**
   * getAllLabels Helper
   *
   * @param     array $data
   * @param     function $callback
   * @return    mixed
   */
  static function getAllLabels(Array $data, $callback = false) {
    // validate data parameters
    if (!isset($data['app-id'])) {
      throw new \InvalidArgumentException('app-id is required.');
    }

    if (!isset($data['secret-key'])) {
      throw new \InvalidArgumentException('secret-key is required.');
    }

    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('website is required.');
    }

    // setup the labels api
    $labels = new UserData(array(
      'app-id' => $data['app-id'],
      'secret-key' => $data['secret-key']
    ));

    // run the show call
    $rsp = $labels->show(array(
      'website'=>$data['website']
    ));

    // add all the data to the labels array
    $labels = array();
    foreach($rsp as $label) {
      foreach ($label as $l) {
        $labels[$l->uid] = $l->meta->name;
      }
    }

    // run callback or return the label data
    if (is_callable($callback)) {
      $callback($labels);
    } else {
      return $labels;
    }
  }
}
