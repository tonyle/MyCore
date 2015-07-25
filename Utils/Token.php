<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 3/29/15
 * Time: 3:33 PM
 */

namespace MyCore\Utils;

use MyCore\Session;

class Token
{
    // Token key
    const TOKEN_KEY = 'sgx_token';
    // Token salt key
    const TOKEN_SALT = '|r(b{Gss;(!HQgd1_FEzj5o)qcd_?_oTIEM.5z,5279<6MjY,Ik5*1Ap<0r3])FQ';

    /**
     * Generate one time token
     */
    public static function token()
    {
        // Get token hash key
        $token = md5(uniqid(rand(), true) . self::TOKEN_SALT);

        // Set token to session
        Session::getInstance()->write(self::TOKEN_KEY, $token);

        return $token;
    }

    /**
     * Valid a token value
     *
     * @param $token
     * @return bool
     */
    public static function isValidToken($token)
    {
        $_token = Session::getInstance()->readOnce(self::TOKEN_KEY);

        return $token === $_token;
    }
}