<?php

class multiSiteCityGetListProcessor extends modObjectGetListProcessor {
    public $objectType = 'multiSiteCity';
    public $classKey = 'multiSiteCity';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        $where = [];
        if ($query) {
            $where = array_merge($where, [
                'city_name:LIKE' => "%{$query}%",
                'OR:city_key:LIKE' => "%{$query}%",
            ]);
        }

        $c->where($where);

        return $c;
    }

    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('multisite_item_update'),
            //'multiple' => $this->modx->lexicon('multisite_items_update'),
            'action' => 'updateItem',
            'button' => true,
            'menu' => true,
        ];

        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('multisite_item_remove'),
            'multiple' => $this->modx->lexicon('multisite_items_remove'),
            'action' => 'removeItem',
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }
}

return 'multiSiteCityGetListProcessor';