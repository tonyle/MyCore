<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/25/15
 * Time: 6:40 PM
 */
namespace MyCore\Utils;

class Number
{
    /**
     * Convert into currency format
     */
    public static function currency($input, $sign = "₫")
    {
        if(empty($input)) {
            return "0 " . $sign;
        }

        if(!is_numeric($input)) {
            return "0 " . $sign;
        }

        return number_format($input, 0, ',', '.') ." ". $sign;
    }
}