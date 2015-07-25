<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/25/15
 * Time: 6:48 PM
 */
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MyCore\Utils\Number;
use MyCore\Utils\Date;

/**
 * Class Format
 * @package MyCore\View\Helper
 */
class Format extends AbstractHelper
{
    /**
     * Main helper execution
     * @return $this
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * Currency format helper
     * @param $input
     * @param string $sign
     * @return string
     */
    public function currency($input, $sign = '₫')
    {
        return Number::currency($input, $sign);
    }

    /**
     * return full datetime format
     * Format Y-m-d H:i:s
     * @param $input
     * @return string
     */
    public function dateTime($input)
    {
        $dateInstance = new Date($input);

        return $dateInstance->getDateTime();
    }

    /**
     * Return time format
     * Format H:i:s
     * @param $input
     * @return string
     */
    public function time($input)
    {
        $dateInstance = new Date($input);

        return $dateInstance->getTime();
    }

    /**
     * Return short datetime format
     * Format Y-m-d H:i
     * @param string $input
     * @return string
     */
    public function shortDateTime($input)
    {
        $dateInstance = new Date($input);

        return $dateInstance->format(Date::SHORT_DATETIME_FORMAT);
    }
}