<?php

namespace MyCore\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container;

class LastUrl extends AbstractPlugin {

    private $_prefixActionAccess;
    private $_lastUrl;

    public function __invoke() {
        $this->_prefixActionAccess = array(
            'detail',
            'show-all'
        );

        $this->_lastUrl = new Container('LastUrl');
        return $this;
    }

    /**
     * set last url
     */
    public function setLastUrl() {
        if ($this->_isAllowSaveLastUrl()) {
            if (isset($_SERVER['SCRIPT_URI'])) {
                $url = $_SERVER['SCRIPT_URI'];
                $this->_lastUrl->{CONTROLLER_NAME} = $url;
            }
        }
    }

    /**
     * get last url
     */
    public function getLastUrl($url = '/') {
        if (isset ($this->_lastUrl->{CONTROLLER_NAME})) {
            return $this->_lastUrl->{CONTROLLER_NAME};
        }
        return $url;
    }

    /**
     * is allow save last url
     *
     * @return boolean
     * @author Giau Le
     */
    private function _isAllowSaveLastUrl() {
        foreach ($this->_prefixActionAccess as $action) {
            if (strpos(ACTION_NAME, $action) === 0) {
                return true;
            }
        }
        return false;
    }
}