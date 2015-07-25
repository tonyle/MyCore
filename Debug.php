<?php

namespace MyCore;

/**
 * Debug Class
 * @author Hieu Le
 *
 */
class Debug {
    /**
     * Die
     *
     * @author Hieu Le
     */
    static function d() {
        die( "Die on Debug Class" );
    }

    /**
     * print_r
     *
     * @param object $var
     * @author Hieu Le
     */
    static function p($var) {
        $arrTrace = debug_backtrace();
        echo ('<pre>');
        print_r( $var );
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
        echo ('</pre>');
    }

    /**
     * print_r and die
     *
     * @param object $var
     * @author Hieu Le
     */
    static function pd($var) {
        $arrTrace = debug_backtrace();
        echo ('<pre>');
        print_r( $var );
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
        echo ('</pre>');
        static::d();
    }

    /**
     * echo
     *
     * @param string $var
     * @author Hieu Le
     */
    static function e($var) {
        $arrTrace = debug_backtrace();
        echo $var . '<br>';
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
    }

    /**
     * Build json
     *
     * @param array $data
     * @return string
     * @author Hieu Le
     */
    static function buildJson($arr) {
        if(is_array( $arr )) {
            return json_encode( $arr, JSON_HEX_APOS );
        }
        return '[]';
    }

    /**
     * var_dump
     *
     * @param object $var
     * @author Hieu Le
     */
    static function v($var) {
        $arrTrace = debug_backtrace();
        echo ('<br /><pre>');
        var_dump( $var );
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
        echo ('</pre><br />');
    }

    /**
     * var_dump and die
     *
     * @param object $var
     * @author Hieu Le
     */
    static function vd($var) {
        $arrTrace = debug_backtrace();
        echo ('<pre>');
        var_dump( $var );
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
        echo ('</pre>');
        static::d();
    }

    /**
     * print_r (json_encode) and die
     *
     * @param array $v
     * @author Hieu Le
     */
    static function jd($var) {
        $arrTrace = debug_backtrace();
        print_r( json_encode( $var ) );
        print_r( sprintf( "Break at: FILE: %s, LINE: %s", $arrTrace[0]['file'], $arrTrace[0]['line'] ) );
        static::d();
    }
}

?>