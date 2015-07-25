<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayIsDeleted extends AbstractHelper {
    public function __invoke($isDeleted = 0) {
        if (!$isDeleted) {
            return '<span class="label label-success">Active</span>';
        }
        return '<span class="label label-important">Disable</span>';
    }
}