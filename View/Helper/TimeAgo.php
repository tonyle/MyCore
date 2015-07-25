<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Renderer\PhpRenderer;
use MyCore\Utils\Date;

class TimeAgo extends AbstractHelper {

    public function __invoke($dateFrom, $dateTo = false) {
        return Date::timeAgo($dateFrom, $dateTo);
    }

    /**
     * convert to vn
     *
     * @param unknown $time
     * @param string $format
     * @author Giau Le
     */
    public static function sortDateVN($time, $format="D-d.m.Y") {
        return Date::sortDateVN($time, $format);
    }
}