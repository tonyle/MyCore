<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class LastUrl extends AbstractHelper {

    public function __invoke($url = '/') {
        $lastUrl = new Container('LastUrl');
        if (isset ($lastUrl->{CONTROLLER_NAME})) {
            return $lastUrl->{CONTROLLER_NAME};
        }
        return $url;
    }
}