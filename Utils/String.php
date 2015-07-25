<?php

namespace MyCore\Utils;

/**
 * Utilities - String
 * @author Hieu Le
 *
 */
class String {

    /**
     * Replace unicode characters
     * @param string $str
     * @author Hieu Le
     */
    public function replaceUnicodeCharacters($str) {
        $str = preg_replace( "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str );
        $str = preg_replace( "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str );
        $str = preg_replace( "/(ì|í|ị|ỉ|ĩ)/", 'i', $str );
        $str = preg_replace( "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str );
        $str = preg_replace( "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str );
        $str = preg_replace( "/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str );
        $str = preg_replace( "/(đ)/", 'd', $str );
        $str = preg_replace( "/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str );
        $str = preg_replace( "/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str );
        $str = preg_replace( "/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str );
        $str = preg_replace( "/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str );
        $str = preg_replace( "/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str );
        $str = preg_replace( "/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str );
        $str = preg_replace( "/(Đ)/", 'D', $str );
        return strtolower( $str );
    }

    public static function urlTitle($string) {
        if($string == '')
            return '';
        $string = html_entity_decode($string);
        $marked = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
                "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
                ,"ế","ệ","ể","ễ","ế",
                "ì","í","ị","ỉ","ĩ",
                "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
                ,"ờ","ớ","ợ","ở","ỡ",
                "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
                "ỳ","ý","ỵ","ỷ","ỹ",
                "đ",
                "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
                ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
                "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
                "Ì","Í","Ị","Ỉ","Ĩ",
                "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
                ,"Ờ","Ớ","Ợ","Ở","Ỡ",
                "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
                "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
                "Đ",
                " ","&","?","/",".",",","$",":","(",")","'",";","+","–","’");

        $unmarked = array("a","a","a","a","a","a","a","a","a","a","a"
                ,"a","a","a","a","a","a","e","e","e","e","e","e","e"
                ,"e","e","e","e","e",
                "i","i","i","i","i",
                "o","o","o","o","o","o","o","o","o","o","o","o"
                ,"o","o","o","o","o",
                "u","u","u","u","u","u","u","u","u","u","u",
                "y","y","y","y","y",
                "d",
                "A","A","A","A","A","A","A","A","A","A","A","A"
                ,"A","A","A","A","A",
                "E","E","E","E","E","E","E","E","E","E","E",
                "I","I","I","I","I",
                "O","O","O","O","O","O","O","O","O","O","O","O"
                ,"O","O","O","O","O",
                "U","U","U","U","U","U","U","U","U","U","U",
                "Y","Y","Y","Y","Y",
                "D",
                "-","-","-","-","-","-","-","-","-","-","-","-","-","-","-");

        $tmp = (str_replace($marked, $unmarked, $string));
        $tmp = trim($tmp, "-");
        //$tmp = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $tmp);
        $tmp = preg_replace('/-+/', '-', $tmp);
        $tmp = strtolower($tmp);
        $tmp = ltrim($tmp,'-');
        return $tmp;
    }
}