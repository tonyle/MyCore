<?php
/**
 * Project sgx.me.
 * User: Thanh Dang
 * Date: 4/16/15
 * Time: 9:52 PM
 */

namespace MyCore\Lib;

class File
{
    /**
     * Check filename is exist or not
     * @param $path
     * @return bool true exist
     *              false does not exist
     */
    public static function fileExist($path)
    {
        return is_file($path);
    }

    /**
     * Check directory is exist or not
     * @param $path
     * @return bool true exist
     *              false does not exist
     */
    public static function directoryExist($path)
    {
        return is_dir($path);
    }
}