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
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('website is required.');
    }

    // setup the labels api
    $labels = new UserData($data);

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

  /**
   * getUserLabels Helper
   *
   * @param     array $data
   * @param     function $callback
   * @return    mixed
   */
  static function getUserLabels(Array $data, $callback = false) {
    // validate data parameters
    if (!isset($data['website'])) {
      throw new \InvalidArgumentException('website is required.');
    }

    // validate data parameters
    if (!isset($data['search'])) {
      throw new \InvalidArgumentException('search is required.');
    }

    $woopra_labels = Woopra::getAllLabels($data);
    $search = new Search($data);

    $rsp = $search->search(array(
      'website'=>$data['website'],
      'search'=>$data['search']
    ));

    $labels = array();
    foreach($rsp->visitors as $visitor) {
      foreach($visitor->labels as $label) {
        if (array_key_exists($label, $woopra_labels)) {
          $labels[$label] = $woopra_labels[$label];
        }
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
