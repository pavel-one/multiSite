<?php

class multiSiteCityUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'multiSiteCity';
    public $classKey = 'multiSiteCity';
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
        if (!$id) {
            $this->modx->error->addField('id', 'Не передан ID');
        }
        $key = trim($this->getProperty('city_key'));
        if (empty($key)) {
            $this->modx->error->addField('city_key', 'Вы должны указать ключ');
        }

        $name = trim($this->getProperty('city_name'));
        if (empty($name)) {
            $this->modx->error->addField('city_name', 'Вы должны указать название');
        }

        return parent::beforeSet();
    }
}

return 'multiSiteCityUpdateProcessor';
