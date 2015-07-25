<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 3/29/15
 * Time: 10:59 PM
 */

namespace MyCore;

use Zend\Session\Container as SessionContainer;

class Session
{
    /**
     * Default core session namespace
     */
    const NAMESPACE_DEFAULT = 'Default_Namespace';

    /**
     * Session container instance
     * @var SessionContainer
     */
    protected $session;

    /**
     * Self instance
     * @var $instance
     */
    private static $instance;

    /**
     * @param null $namespace
     */
    private function __construct($namespace)
    {
        if(empty($namespace)) {
            $namespace = self::NAMESPACE_DEFAULT;
        }

        $this->session = new SessionContainer($namespace);
    }

    /**
     * Get core session instance
     */
    public static function getInstance($namespace = null)
    {
        if(!isset(self::$instance)) {
            self::$instance = new self($namespace);
        }

        return self::$instance;
    }

    /**
     * Get session content by key
     * @param String $key
     * @return mixed
     */
    public function read($key)
    {
        return $this->session->{$key};
    }

    /**
     * Read token and delete after
     * @param String $key
     * @return mixed
     */
    public function readOnce($key)
    {
        $content = $this->read($key);

        $this->delete($key);

        return $content;
    }

    /**
     * Delete a token
     * @param $key
     */
    public function delete($key)
    {
        unset($this->session->{$key});
    }

    /**
     * Write session content
     * @param String $key
     * @param $content
     */
    public function write($key, $content)
    {
        $this->session->{$key} = $content;
    }

    /**
     * Return true if exist key is empty
     * @param String $key
     * @return bool
     */
    public function isEmpty($key)
    {
        return !isset($this->session->{$key});
    }
}