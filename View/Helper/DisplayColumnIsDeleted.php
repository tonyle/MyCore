<?php
namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayColumnIsDeleted extends AbstractHelper {
    public function __invoke($params, $columnName = 'IsDeleted_Filter') {
        $isDeleted = 'ALL';
        if ( isset ($params[$columnName]) )
            $isDeleted = $params[$columnName];
        $options = array(
            'ALL' => LAB_ALL,
            '1'   => LAB_YES,
            '0'   => LAB_NO,
        );

        $html = '<select class="span2" name="' . $columnName . '" id="' . $columnName . '" onchange="return filterOption($(this).val(), $(this).attr(\'name\'))">';
        foreach ($options as $optionKey => $optionValue) {
            $selected = '';
            if ($isDeleted == (string)$optionKey) {
                $selected = 'selected';
            }
            $html .= '<option value="' . $optionKey . '" ' . $selected . ' label="' . $optionValue . '">' . $optionValue . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}