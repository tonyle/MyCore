<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GenerateUrl extends AbstractHelper {

    public function __invoke($params = array()) {
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
         * genearte from last params
         */
        $lastParams = unserialize(URL_PARAM);
        $params = array_merge($lastParams, $params);

        /**
         * generate from params
         */
        if (count ($params)) {
            foreach ($params as $paramKey => $paramValue) {
                if (!is_null($paramValue) && $paramValue != '') {
                    $url .= '/' . $paramKey . '/' . $paramValue;
                }
            }
        }

        return $url;
    }
}