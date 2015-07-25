<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayDateTime extends AbstractHelper {
    public function __invoke($dateTime) {
        $time = strtotime($dateTime);
        return date('d-m-Y i:s A', $time);
    }
}