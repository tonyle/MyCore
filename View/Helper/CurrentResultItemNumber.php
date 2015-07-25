<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CurrentResultItemNumber extends AbstractHelper {
    public function __invoke($paginator, $pageListCount = PAGE_LIST_COUNT) {
        $itemNumber = $paginator->getCurrentItemCount();
        $first = $pageListCount * ($paginator->getCurrentPageNumber() - 1);
        if($itemNumber != 0) {
            $first++;
        }
        $last = $first + $itemNumber - 1;
        $last = ($last <= 0) ? 0 : $last;
        $result = "{$first} / {$last} trên {$paginator->getTotalItemCount()}";
        return $result;
    }
}