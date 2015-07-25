<?php

namespace MyCore\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container;

class Functions extends AbstractPlugin {

    public function __invoke() {
        return $this;
    }

    /**
     * convert to alias
     *
     * @param unknown $string
     * @return string
     * @author Giau Le
     */
    public function changeNameImage($string) {
        if($string == '')
            return '';

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
                " ","&","?","/",",","$",":","(",")","'",";","+","–","’");

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
        $tmp = preg_replace(array('/\s+/','/[^A-Za-z0-9\-.]/'), array('-',''), $tmp);
        $tmp = preg_replace('/-+/', '-', $tmp);
        $tmp = strtolower($tmp);
        return $tmp;
    }
}