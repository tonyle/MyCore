<?php

namespace MyCore\Utils;

/**
 * Class S_Date
 * @package MyCore
 * @author  thanhdc clgt@lgt.vn
 */
class Date
{
    private $_date;

    const FULL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const SHORT_DATETIME_FORMAT = 'Y-m-d H:i';
    const DATE_FORMAT = 'Y-m-d';
    const FULL_TIME_FORMAT = 'H:i:s';
    const SHORT_TIME_FORMAT = 'H:i';

    // Datetime format string
    protected $dateTimeFormat = 'Y-m-d H:i:s';

    /**
     * @param string $datetime
     * @throws \Exception $ex
     */
    public function __construct($datetime = 'now')
    {
        try {
            $this->_date = new \DateTime($datetime);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Get current SDate instance
     * @return Date
     */
    public static function getInstance()
    {
        return new self;
    }

    /**
     * Get full datetime format
     * @return string
     */
    public function getDateTime()
    {
        return $this->_date->format(self::FULL_DATETIME_FORMAT);
    }

    /**
     * Get date format
     * @return string
     */
    public function getDate()
    {
        return $this->_date->format(self::DATE_FORMAT);
    }

    /**
     * Get time format
     * @return string
     */
    public function getTime()
    {
        return $this->_date->format(self::FULL_TIME_FORMAT);
    }

    /**
     * Get timestamp
     */
    public function getTimestamp()
    {
        return $this->_date->getTimestamp();
    }

    /**
     * Instance format
     * @param $format
     * @return string
     */
    public function format($format)
    {
        return $this->_date->format($format);
    }

    /**
     * @param $dateFrom
     * @param bool $dateTo
     * @return string|void
     */
    public static function timeAgo($dateFrom, $dateTo = false)
    {
        if($dateFrom == 0)
            return "Một thời gian trước";

        if (!$dateTo) {
            $dateTo = time();
        } else {
            $dateTo = strtotime($dateTo);
        }
        $dateFrom = strtotime($dateFrom);

        $difference = $dateTo - $dateFrom;

        if($difference == 0 || $difference < 0) {
            $difference = 1;
        }

        switch(true) {
            case(strtotime('-1 min', $dateTo) < $dateFrom):
                $datediff = $difference;
                $text = ($datediff == 1) ? $datediff.' giây trước' : $datediff.' giây trước';
                break;
            case(strtotime('-1 hour', $dateTo) < $dateFrom):
                $datediff = floor($difference / 60);
                $text = ($datediff == 1) ? $datediff.' phút trước' : $datediff.' phút trước';
                break;
            case(strtotime('-1 day', $dateTo) < $dateFrom):
                $datediff = floor($difference / 60 / 60);
                $text = ($datediff==1) ? $datediff.' giờ trước' : $datediff.' giờ trước';
                break;
            default:
                $text = self::sortDateVN($dateFrom);
                break;
        }
        return $text;
    }

    /**
     * convert to vn
     *
     * @param unknown $time
     * @param string $format
     * @author Giau Le
     */
    public static function sortDateVN($time, $format="D-d.m.Y") {
        $stringSearch = array (
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
            "Sun",
            "am",
            "pm",
        );
        $stringReplace = array (
            "Thứ hai",
            "Thứ ba",
            "Thứ tư",
            "Thứ năm",
            "Thứ sáu",
            "Thứ bảy",
            "Chủ nhật",
            "sáng",
            "chiều"
        );
        $timeNow = date($format, $time);
        $timeNow = str_replace( $stringSearch, $stringReplace, $timeNow);

        return $timeNow;
    }
}