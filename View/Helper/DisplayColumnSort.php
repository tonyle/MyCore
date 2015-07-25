<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayColumnSort extends AbstractHelper {
    public function __invoke($columnName = '') {
        $columnName = $columnName. '_sort';
        /**
         * genearte from last params
         */
        $params = unserialize(URL_PARAM);

        $view = $this->getView();

        $styleSortUp   = 'position: absolute; cursor: pointer; height: 11px;';
        $styleSortDown = 'position: absolute; margin-top: 10px; height: 11px; cursor: pointer;';

        $urlSortUp   = '';
        $urlSortDown = '';

        $paramsSortUp   = array($columnName => 'ASC');
        $paramsSortDown = array($columnName => 'DESC');

        if (isset($params[$columnName])) {
            if ($params[$columnName] === 'ASC') {
                $styleSortUp   = 'position: absolute; cursor: pointer; height: 11px; color: #007AFF;';
                $paramsSortUp[$columnName] = null;
            } elseif ($params[$columnName] === 'DESC') {
                $styleSortDown = 'position: absolute; margin-top: 10px; height: 11px; cursor: pointer; color: #007AFF;';
                $paramsSortDown[$columnName] = null;
            }
        }

        $urlSortUp   = $view->generateUrl($paramsSortUp);
        $urlSortDown   = $view->generateUrl($paramsSortDown);

        echo "<div style='float: right; height: 18px; width: 12px; position: relative;'>";
        echo '<i onclick="window.location.href=\'' . $urlSortUp . '\'" class="clip-chevron-up" style="' . $styleSortUp . '"></i>';
        echo '<i onclick="window.location.href=\'' . $urlSortDown . '\'" class="clip-chevron-down" style="' . $styleSortDown . '"></i>';
        echo "</div>";
    }
}