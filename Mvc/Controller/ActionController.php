<?php
namespace MyCore\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MyCore\Debug;

class ActionController extends AbstractActionController {

    public $config    = null;
    public $staff     = null;
    public $viewModel = null;
    public $title     = 'Admin';
    public $isAjax    = false;
    public function __construct() {
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $viewModel = new ViewModel();
        $route = $e->getRouteMatch();
        /**
         * define module name, controller name, action name
        */
        define('CONTROLLER_NAME', strtolower($route->getParam('__CONTROLLER__', 'index')));
        define('ACTION_NAME', $route->getParam('action', 'index'));

        if (MODULE_NAME == 'admin') {
            $this->layout('layout/admin');
        }

        $sm = $this->getServiceLocator();
        $authService = $sm->get('AuthenticationService');
        $staff = $authService->getStorage()->read();
//        if (ACTION_NAME != 'login') {
//            if (! $authService->hasIdentity()) {
//                header("Location: /admin/staffs/login");
//                exit();
//            } else {
//                if (MODULE_NAME === 'admin' && ACTION_NAME != 'logout') {
//                    if (!$staff->is_admin) {
//                        header("Location: /");
//                        exit();
//                    }
//                }
//            }
//        }
        $this->staff = $staff;
        $this->layout()->staff = $staff;
        $viewModel->__set('staff', $staff);

        $config = $sm->get('config');
        $this->config = $config;
        $this->layout()->config = $config;
        $viewModel->__set('config', $config);

        /**
         * define static
         */
        define('STATIC_URL', $config['static']['url']);
        define('OUTSIDE_URL', $config['outside']['url']);

        $this->viewModel = $viewModel;

        $viewModel->__set('title', $this->title);
        $this->layout()->title = $this->title;

        /**
         * save last url
         */
        $this->lastUrl()->setLastUrl();

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->isAjax = true;
        }
        return parent::onDispatch($e);
    }

    /**
     * [outputLog description]
     * @param  array $params [description]
     * @return bool         [description]
     * @throws Exception $ex
     */
    public function outputLog($params)
    {
        $sm = $this->getServiceLocator();
        $logger = $sm->get('Application\Logger');

        try {
            return $logger->log($params);
        } catch (Exception $ex) {
            throw $ex;
        }

        return false;
    }
}