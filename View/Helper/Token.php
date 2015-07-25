<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 3/29/15
 * Time: 3:31 PM
 */

namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MyCore\Utils\Token as CsrfToken;

/**
 * Class Token
 * The token helper for csrf prevention
 * @package MyCore\View\Helper
 */
class Token extends AbstractHelper
{
    /**
     * Main helper execution
     * @return string
     */
    public function __invoke()
    {
        // Gen onetime token
        $token = CsrfToken::token();
        // Return input helper
        return '<input type="hidden" name="csrf_token" value="' .$token. '" />';
    }
}