<?php

class multiSiteItemDisableProcessor extends modObjectProcessor
{
    public $objectType = 'multiSiteItem';
    public $classKey = 'multiSiteItem';
    public $languageTopics = ['multisite'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('multisite_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var multiSiteItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('multisite_item_err_nf'));
            }

            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }

}

return 'multiSiteItemDisableProcessor';
