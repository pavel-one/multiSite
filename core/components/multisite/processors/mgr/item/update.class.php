<?php

class multiSiteItemUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'multiSiteItem';
    public $classKey = 'multiSiteItem';
    public $languageTopics = ['multisite'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $name = trim($this->getProperty('content_key'));
        if (empty($name)) {
            $this->modx->error->addField('content_key', $this->modx->lexicon('Вы должны указать ключ в контенте'));
        }

        $name = trim($this->getProperty('key_text'));
        if (empty($name)) {
            $this->modx->error->addField('key_text', $this->modx->lexicon('Вы должны заполнить содержимое'));
        }

        return parent::beforeSet();
    }
}

return 'multiSiteItemUpdateProcessor';
