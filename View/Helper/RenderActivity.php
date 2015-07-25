<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 4/7/15
 * Time: 8:33 PM
 */

namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

abstract class RenderActivity extends AbstractHelper
{
    /**
     * @param array $activity Activity information
     * @param string $template activity template string
     * @return string
     */
    public function render($activity)
    {
        // Get view template
        $viewTemplate = $this->getTemplate($activity['verb']);

        if(empty($viewTemplate)) {
            return '';
        }

        // New view model instance
        $viewModel = new ViewModel(array(
            'activity' => $activity
        ));

        // Set view terminal
        $viewModel->setTerminal(true);

        // Set view template
        $viewModel->setTemplate($viewTemplate);

        // Return view rendered
        return $this->getView()->render($viewModel);
    }

    /**
     * The abstract function
     * @param $verb
     * @return mixed
     */
    public abstract function getTemplate($verb);
}