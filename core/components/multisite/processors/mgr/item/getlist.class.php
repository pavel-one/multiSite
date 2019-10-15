<?php

class multiSiteItemGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'multiSiteItem';
    public $classKey = 'multiSiteItem';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        $res_id = (int)$this->getProperty('res_id');
        $where = [
            'res_id' => $res_id,
        ];
        if ($query) {
            $where = array_merge($where, [
                'name:LIKE' => "%{$query}%",
                'OR:description:LIKE' => "%{$query}%",
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

return 'multiSiteItemGetListProcessor';