<?php
namespace MyCore\View\Helper;

use Zend\Form\View\Helper\FormElementErrors;
use Traversable;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class DisplayErrorMessage extends FormElementErrors {
    public function __invoke(ElementInterface $element = null, array $attributes = array()) {
        $this->setMessageOpenFormat('<span class="help-block">')
//            ->setMessageSeparatorString('</div><div class="help-inline">')
            ->setMessageCloseString('</span>');
        parent::__invoke($element, $attributes);
//         echo $this->getMessageCloseString();die;
    }
}