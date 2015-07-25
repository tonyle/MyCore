<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/19/15
 * Time: 7:53 AM
 */

namespace MyCore\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use MyCore\Mvc\Model\User;
use MyCore\Utils\Date;

class BaseApplicationController extends AbstractActionController
{
    private $_credential;
    public $config    = null;
    public $viewModel = null;
    public $staff     = null;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        // Initial
        $this->_initAuthentication();
        $this->_initLayout();

        // Create View Model
        $this->viewModel = new ViewModel();
        $this->viewModel->__set('config', $this->config);

        // Define CONTROLLER_NAME & ACTION_NAME
        $route = $e->getRouteMatch();
        define('CONTROLLER_NAME', strtolower($route->getParam('__CONTROLLER__', 'index')));
        define('ACTION_NAME', $route->getParam('action', 'index'));

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
        } catch (\Exception $ex) {
            throw $ex;
        }

        return false;
    }

    public function sendActivity($verb, $actor, $object = array(), $target = array(), $company_id = null, $project_id = null, $contact_id = null)
    {
        $sm = $this->getServiceLocator();
        $activityInstance = $sm->get('Application\Activity');

        try {
            $activityInstance->setVerb($verb);
            $activityInstance->setActor($actor);
            $activityInstance->setObject($object);
            $activityInstance->setTarget($target);

            $activityInstance->send(array(
                'company_id' => $company_id,
                'project_id' => $project_id,
                'contact_id' => $contact_id,
                'date_created' => Date::getInstance()->getDateTime(),
                'created_by'=> $this->getCredential()->staff_id
            ));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function sendNotification($verb, $actor, $object = array(), $target = array(), $owners)
    {
        $sm = $this->getServiceLocator();

        $notificationInstance = $sm->get('Application\Notification');

        try {

            $notificationInstance->setVerb($verb);
            $notificationInstance->setActor($actor);
            $notificationInstance->setObject($object);
            $notificationInstance->setTarget($target);
            $notificationInstance->setTo($owners);

            $notificationInstance->send(array(
                'created_by' => $this->getCredential()->staff_id,
                'date_created' => Date::getInstance()->getDateTime()
            ));

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Get login credential
     * @return mixed
     */
    public function getCredential()
    {
        return $this->_credential;
    }

    /**
     * Init application layout
     */
    private function _initLayout()
    {
        // Get the module name
        $moduleName = substr(get_class($this), 0, strpos(get_class($this), '\\'));

        // Nested header view
        $header = new ViewModel(array(
            'staff' => $this->getCredential(),
            'moduleName' => $moduleName
        ));
        // Set header template
        $header->setTemplate('Application/header');
        // Set main layout
        $this->layout('Application/layout');
        // Set nested view
        $this->layout()->addChild($header, 'header');
        // Set layout view variable
        $this->layout()->setVariable('moduleName', $moduleName);
        $this->layout()->setVariable('title', $moduleName . ' - ' . 'SGX CMS');
    }

    /**
     * Check application authenticate
     */
    private function _initAuthentication()
    {
        $sm = $this->getServiceLocator();
        $authService = $sm->get('AuthenticationService');
        $route = $this->getEvent()->getRouteMatch();
        $actionName = $route->getParam('action', null);
        $this->config = $sm->get('config');

        if ($actionName != 'login' && !$authService->hasIdentity()) {
            // $this->redirect();
            header("Location: /admin/staffs/login");
            exit();
        }

        // Gets staff information
        $staff = $authService->getStorage()->read();
        $credential = new User($staff);
        $this->_credential = $credential;
        $this->staff = $staff;
    }
}