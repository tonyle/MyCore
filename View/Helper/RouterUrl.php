<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 3/2/15
 * Time: 9:15 PM
 */

namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RouterUrl extends AbstractHelper
{
    public function __invoke($routeName, $params = array(), $query = array())
    {
        // Get the view instance
        $view = $this->getView();
        // Get router url
        $url = $view->url($routeName, $params, array('force_canonical' => true));
        // Append query parameter
        if(!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }
}