<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/22/15
 * Time: 4:10 PM
 */

namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Gravatar extends AbstractHelper
{
    public function __invoke($email, $s = 30)
    {
        $emailHash = md5(strtolower(trim($email)));

        return 'http://www.gravatar.com/avatar/' . $emailHash . '?s=' . $s;
    }
}