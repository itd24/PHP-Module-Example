<?php

/**
 * A helper class for moving data between objects
 */
class ViewBag
{
    
    /**
     * the instance of the only ViewBag we will have in our application
     */
    private static $instance;
    
    /**
     * the 'bag' we will store our variables in
     */
    private $bag = array();
    
    protected function __construct() {
    }
    
    /**
     * the initialization function for our singelton class
     * @return ViewBag - our ViewBag instance
     */
    public static function init() {
        if (!isset(self::$instance)) self::$instance = new ViewBag();
        return self::$instance;
    }
    
    /**
     * saves a value with a specific key
     * @param string $key - the key
     * @param string $value - the value
     * @return void
     */
    public function set($key, $value) {
        $this->bag[$key] = $value;
    }
    
    /**
     * gets a value under a specific key
     * @param string $key - the key
     * @param string $default - the default value to return, if there is no value with the specified key
     * @return mixed - the value under this specific key
     */
    public function get($key, $default = null) {
        if (isset($this->bag[$key])) return $this->bag[$key];
        return $default;
    }
}
?>