<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/15/15
 * Time: 10:40 PM
 */
namespace MyCore\Test;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

abstract class AbstractActionControllerTestCase extends AbstractControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $applicationConfig = include __DIR__ . '/../../../test/config.php';

        $this->setApplicationConfig($applicationConfig);

        $this->clean();
    }

    public function tearDown()
    {
        // TODO Clear test session
        $this->clean();
    }

    protected function clean(){}

    /**
     * @param $fixture
     */
    protected function loadFixture($fixture)
    {

    }

    protected function truncateTable($table)
    {
        $sm = $this->getApplicationServiceLocator();

        $adapter = $sm->get('Zend\Db\Adapter\Adapter');

        $adapter->query('truncate ' . $table, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
    }
}