<?php

namespace MyCore\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class SearchRedirect extends AbstractPlugin {

    public function __invoke($isPost = false, $params) {
        if ($isPost) {
            if (!isset($params['module'])) {
                $params['module'] = MODULE_NAME;
            }

            if (!isset($params['controller'])) {
                $params['controller'] = CONTROLLER_NAME;
            }

            if (!isset($params['action'])) {
                $params['action'] = ACTION_NAME;
            }

            /**
             * url default
             */
            $url = '/' . $params['module'] . '/' . $params['controller'] . '/' . $params['action'];

            unset($params['module']);
            unset($params['controller']);
            unset($params['action']);

            /**
             * generate from params
            */
            if (count ($params)) {
                if (isset($params['TypeSearch']) && isset($params['KeywordSearch'])) {
                    $url .= '/' . $params['TypeSearch'] . '/' . $params['KeywordSearch'];
                }
            }

            $controller = $this->getController();
            $redirectPlugin = $controller->plugin('redirect');
            $redirectPlugin->toUrl($url);
        }
    }
}