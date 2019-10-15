<?php

class multiSiteItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'multiSiteItem';
    public $classKey = 'multiSiteItem';
    public $languageTopics = ['multisite'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
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

return 'multiSiteItemCreateProcessor';