<?php


class multiSiteCityRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'multiSiteCity';
    public $classKey = 'multiSiteCity';
    public $languageTopics = ['multisite'];
    //public $permission = 'remove';


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

            $object->remove();
        }

        return $this->success();
    }

}

return 'multiSiteCityRemoveProcessor';