<?php
namespace MyCore;

use Zend\Db\Sql\Predicate;

class GenerateSelect {
    public $select = null;
    public function __construct($select, $searchs = array(), $sorts = array(), $filters = array(), $params=array()) {
        $params = $params ? $params : unserialize(URL_PARAM);
        if (count ($params)) {
            foreach ($params as $paramKey => $paramValue) {
                if (in_array($paramKey, array_keys($searchs))) {
                    /**
                     * search
                     */
                    $select->where->like($searchs[$paramKey], "%{$paramValue}%");
                } elseif (in_array($paramKey, array_keys($sorts))) {
                    /**
                     * sort
                     */
                    if ($paramValue === 'ASC') {
                        $select->order("{$sorts[$paramKey]} ASC");
                    } else {
                        $select->order("{$sorts[$paramKey]} DESC");
                    }
                } elseif (in_array($paramKey, array_keys($filters))) {
                    /**
                     * filter
                     */
                    $select->where(array($filters[$paramKey] => $paramValue));
                } elseif ($paramKey === 'ALL') {
                    /**
                     * search all
                     */
                    if (count ($searchs)) {
                        $conditions = array();
                        foreach ($searchs as $search) {
                            $conditions[] = new Predicate\Like($search, "%{$paramValue}%");
                        }
                        $select->where(array(
                            new Predicate\PredicateSet(
                                $conditions,
                                Predicate\PredicateSet::COMBINED_BY_OR
                            ),
                        ));
                    }
                }
            }
        }
        $this->select = $select;
    }
}