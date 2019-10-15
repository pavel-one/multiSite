<?php


class multiSiteCityCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'multiSiteCity';
    public $classKey = 'multiSiteCity';
    public $languageTopics = ['multisite'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
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

return 'multiSiteCityCreateProcessor';