<?php namespace Depcore\Contact\Components;

use Cms\Classes\ComponentBase;

class ContactList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'depcore.contact::lang.components.contactlist.name',
            'description' => 'depcore.contact::lang.components.contactlist.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}