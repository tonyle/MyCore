<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/30/15
 * Time: 8:02 AM
 */
namespace MyCore\Module;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Console\Request as ConsoleRequest;

/**
 * Class BaseModule
 * @package MyCore\Module
 */
class BaseModule
{
    public function onBootstrap(MvcEvent $e) {

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_ROUTE, function($e) {

            $request = $e->getRequest();

            if (!$request instanceof ConsoleRequest) {
                $requestUri = $request->getRequestUri();

                if (strpos($requestUri, '?') !== false) {
                    $explode = explode('?', $requestUri);
                    parse_str(end($explode), $params);

                    foreach ($params as $name => $value) {
                        if (!isset($_GET[$name])) {
                            $_GET[$name] = $value;
                        }

                        if (!isset($_REQUEST[$name])) {
                            $_REQUEST[$name] = $value;
                        }
                    }
                }
            }
        });
    }
}