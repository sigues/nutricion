<?php

abstract class Conekta_ApiResource extends Conekta_Object
{
  protected static function _scopedRetrieve($class, $id, $apiKey=null)
  {
    $instance = new $class($id, $apiKey);
    $instance->refresh();
    return $instance;
  }

  public function refresh()
  {
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl();

    list($response, $apiKey) = $requestor->request('get', $url, $this->_retrieveOptions);
    $this->refreshFrom($response, $apiKey);
    return $this;
   }

  public static function className($class)
  {
    // Useful for namespaces: Foo\Conekta_Charge
    if ($postfix = strrchr($class, '\\'))
      $class = substr($postfix, 1);
    if (substr($class, 0, strlen('Conekta')) == 'Conekta')
      $class = substr($class, strlen('Conekta'));
    $class = str_replace('_', '', $class);
    $name = urlencode($class);
    $name = strtolower($name);
    return $name;
  }

  public static function classUrl($class)
  {
    $base = self::_scopedLsb($class, 'className', $class);
    return "/${base}s";
  }

  public function instanceUrl()
  {
    $id = $this['id'];
    $class = get_class($this);
    if (!$id) {
      throw new Conekta_InvalidRequestError("Could not determine which URL to request: $class instance has invalid ID: $id", null);
    }
    $id = Conekta_ApiRequestor::utf8($id);
    $base = $this->_lsb('classUrl', $class);
    $extn = urlencode($id);
    return "$base/$extn";
  }

  private static function _validateCall($method, $params=null, $apiKey=null)
  {
    if ($params && !is_array($params))
      throw new Conekta_Error("You must pass an array as the first argument to Conekta API method calls.  (HINT: an example call to create a charge would be: \"ConektaCharge::create(array('amount' => 100, 'currency' => 'usd', 'card' => array('number' => 4242424242424242, 'exp_month' => 5, 'exp_year' => 2015)))\")");
    if ($apiKey && !is_string($apiKey))
      throw new Conekta_Error('The second argument to Conekta API method calls is an optional per-request apiKey, which must be a string.  (HINT: you can set a global apiKey by "Conekta::setApiKey(<apiKey>)")');
  }

  protected static function _scopedAll($class, $params=null, $apiKey=null)
  {
    self::_validateCall('all', $params, $apiKey);
    $requestor = new Conekta_ApiRequestor($apiKey);
    $url = self::_scopedLsb($class, 'classUrl', $class);
    list($response, $apiKey) = $requestor->request('get', $url, $params);
    return Conekta_Util::convertToConektaObject($response, $apiKey);
  }

  protected static function _scopedCreate($class, $params=null, $apiKey=null)
  {
    self::_validateCall('create', $params, $apiKey);
    $requestor = new Conekta_ApiRequestor($apiKey);
    $url = self::_scopedLsb($class, 'classUrl', $class);
    list($response, $apiKey) = $requestor->request('post', $url, $params);
    return Conekta_Util::convertToConektaObject($response, $apiKey);
  }

  protected function _scopedSave($class)
  {
    self::_validateCall('save');
    if ($this->_unsavedValues) {
      $requestor = new Conekta_ApiRequestor($this->_apiKey);
      $params = array();
      foreach ($this->_unsavedValues->toArray() as $k){
        $v = $this->$k;
        if ($v === NULL){
          $v = '';
        }
        $params[$k] = $v;
      }
      $url = $this->instanceUrl();
      list($response, $apiKey) = $requestor->request('post', $url, $params);
      $this->refreshFrom($response, $apiKey);
    }
    return $this;
  }

  protected function _scopedDelete($class, $params=null)
  {
    self::_validateCall('delete');
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl();
    list($response, $apiKey) = $requestor->request('delete', $url, $params);
    $this->refreshFrom($response, $apiKey);
    return $this;
  }
}
