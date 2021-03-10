<?php namespace Depcore\Contact\Components;

use Cms\Classes\ComponentBase;
use Depcore\Contact\Models\Location;


class LocationsList extends ComponentBase
{

    public $locations;

    public function componentDetails()
    {
        return [
            'name'        => 'depcore.contact::lang.components.locationslist.name',
            'description' => 'depcore.contact::lang.components.locationslist.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'container_class' => [
                'title'             => 'depcore.contact::lang.components.locations_list.container_class.title',
                'description'       => 'depcore.contact::lang.components.locations_list.container_class.description',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.locations_list.container_class.validation_message',
                'placeholder' => 'depcore.contact::lang.components.locations_list.container_class.placeholder',
                'group' => 'depcore.contact::lang.components.locations_list.groups.css',
            ],
            'box_class' => [
                'title'             => 'depcore.contact::lang.components.locations_list.box_class.title',
                'description'       => 'depcore.contact::lang.components.locations_list.box_class.description',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.locations_list.box_class.validation_message',
                'placeholder' => 'depcore.contact::lang.components.locations_list.box_class.placeholder',
                'group' => 'depcore.contact::lang.components.locations_list.groups.css',
            ],
            'svg_email' => [
                'title'             => 'depcore.contact::lang.components.locations_list.svg_email.title',
                'description'       => 'depcore.contact::lang.components.locations_list.svg_email.description',
                'default'           => '',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.locations_list.svg_email.validation_message',
                'placeholder' => 'depcore.contact::lang.components.locations_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.locations_list.groups.icons',
            ],
            'svg_phone' => [
                'title'             => 'depcore.contact::lang.components.locations_list.svg_phone.title',
                'description'       => 'depcore.contact::lang.components.locations_list.svg_phone.description',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.locations_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.locations_list.groups.icons',
            ],
            'svg_address' => [
                'title'             => 'depcore.contact::lang.components.locations_list.svg_address.title',
                'description'       => 'depcore.contact::lang.components.locations_list.svg_address.description',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.locations_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.locations_list.groups.icons',
            ],
            'locations' => [
                'title'             => 'depcore.contact::lang.components.locations_list.selected_locations.title',
                'description'       => 'depcore.contact::lang.components.locations_list.selected_locations.description',
                'type'              => 'dropdown',
                'group' => 'depcore.contact::lang.components.locations_list.groups.limits',
            ],
        ];
    }

    public function onRun()
    {
        if ($this->property( 'locations' ))
              $this->locations = [ Location::find( $this->property( 'locations' ) )];
        else
            $this->locations = Location::published()->get();
    }


    public function getLocationsOptions()
    {
        return  [''=>'----' ] + Location::published()->get()->pluck('name','id')->toArray(  );
    }
}