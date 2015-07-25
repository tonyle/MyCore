<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/7/15
 * Time: 8:02 AM
 */

namespace MyCore\Utils;

class Validator
{
    /**
     * Validate empty input
     * @param mixed $input
     * @return bool
     */
    public static function isEmpty($input)
    {
        return empty($input) || trim($input) === '';
    }

    /**
     * Validate email input
     * @param mixed $input
     * @return bool
     */
    public static function isEmail($input)
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate URL input
     * @param mixed $input
     * @return bool
     */
    public static function isUrl($input)
    {
        return filter_var($input, FILTER_VALIDATE_URL);
    }

    /**
     * Validate DateTime input
     * @param mixed $input
     * @return bool
     */
    public static function isDateTime($input)
    {
        try {
            return !(new Date($input));
        } catch (\Exception $ex) {
            return false;
        }
    }
}