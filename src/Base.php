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
class Base {
  private $url;
  private $base_url = 'https://www.woopra.com/rest/[version]/[type]';
  private $version = 2.2;
  protected $app_id = '';
  protected $secret_key = '';
  private $response;
  private $response_info;
  private $request_data;

  /**
   * Default search params
   */
  protected $defaults = array('limit'=>50, 'offset'=>0, 'date_format'=>'yyyy-MM-dd');

  protected function getUrl($method)
  {
    $this->url = str_replace(
      array('[version]', '[type]'),
      array($this->version, $this->formatFunction($method)),
      $this->base_url
    );

    return $this->url;
  }


  private function formatFunction($method) {
    $function = end(explode('::', $method));

    $pieces = preg_split('/(?=[A-Z])/', $function);

    return strtolower(implode('/', $pieces));
  }

  public function lastResponse()
  {
    return $this->response;
  }

  public function lastResponseInfo()
  {
    return $this->response_info;
  }

  public function lastRequest()
  {
    return $this->request_data;
  }

  protected function send(Array $data = [], $method)
  {
    $ch = curl_init();

    $this->request_data = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, $this->getUrl($method));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array(
      "Content-Type: application/json",
      "X-Api-Version: {$this->version}",
      "X-Access-Id: {$this->app_id}",
      "X-Access-Secret: {$this->secret_key}"
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "request={$this->request_data}");

    $this->response = curl_exec($ch);

    $this->response_info = curl_getinfo($ch);

    curl_close($ch);

    return json_decode($this->response);
  }
}
