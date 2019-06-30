<?php

/**
 * Created by PhpStorm.
 * User: alexradyuk
 * Date: 6/17/18
 * Time: 01:32
 */
class FloorFormRestaurant extends FloorForm
{

    public function configure()
    {
        parent::configure(); // TODO: Change the autogenerated stub

        unset($this['restaurant_id']);
    }


    public function updateObject($values = null)
    {
        $this->getObject()->restaurant_id = sfContext::getInstance()->getUser()->getGuardUser()->getRestaurant()->getId();
        return parent::updateObject($values); // TODO: Change the autogenerated stub
    }

    public function updateDefaultsFromObject()
    {
        parent::updateDefaultsFromObject(); // TODO: Change the autogenerated stub

        if($this->isNew()){
            $this->setDefault('width', 50);
            $this->setDefault('height', 50);
        }
    }
}