<?php namespace Depcore\Contact\Components;

use Cms\Classes\ComponentBase;
use Depcore\Contact\Models\Location;
use Request;

class DepartmentsList extends ComponentBase
{
    public $location;

    public function componentDetails()
    {
        return [
            'name'        => 'depcore.contact::lang.components.departmentslist.name',
            'description' => 'depcore.contact::lang.components.departmentslist.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'depcore.contact::lang.components.departments_list.title.title',
                'description'       => 'depcore.contact::lang.components.departments_list.title.description',
                'default'           => '',
                'type'              => 'string',
                'placeholder'       => 'depcore.contact::lang.components.departments_list.title.placeholder',
                'group'             => 'depcore.contact::lang.components.departments_list.groups.title',
            ],
            'title_html' => [
                'title'             => 'depcore.contact::lang.components.departments_list.title_html.title',
                'description'       => 'depcore.contact::lang.components.departments_list.title_html.description',
                'default'           => 'h2',
                'type'              => 'dropdown',
                'required' => 1,
                'options' => [
                    'h1'=>'h1',
                    'h2'=>'h2',
                    'h3'=>'h3',
                    'h4'=>'h4',
                    'h5'=>'h5',
                    'h6'=>'h6',
                    'p'=>'p',
                    'div'=>'div',
                ],
                'group' => 'depcore.contact::lang.components.departments_list.groups.title',
            ],
            'title_class' => [
                'title'             => 'depcore.contact::lang.components.departments_list.title_class.title',
                'description'       => 'depcore.contact::lang.components.departments_list.title_class.description',
                'default'           => 'title',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.departments_list.title_class.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.title',
            ],
            'subtitle' => [
                'title'             => 'depcore.contact::lang.components.departments_list.subtitle.title',
                'description'       => 'depcore.contact::lang.components.departments_list.subtitle.description',
                'default'           => 'title',
                'type'              => 'string',
                'group' => 'depcore.contact::lang.components.departments_list.groups.subtitle',
            ],
            'subtitle_html' => [
                'title'             => 'depcore.contact::lang.components.departments_list.subtitle_html.title',
                'description'       => 'depcore.contact::lang.components.departments_list.subtitle_html.description',
                'default'           => 'h3',
                'type'              => 'dropdown',
                'required' => 1,
                'options' => [
                    'h1'=>'h1',
                    'h2'=>'h2',
                    'h3'=>'h3',
                    'h4'=>'h4',
                    'h5'=>'h5',
                    'h6'=>'h6',
                    'p'=>'p',
                    'div'=>'div',
                ],
                'group' => 'depcore.contact::lang.components.departments_list.groups.subtitle',
            ],
            'subtitle_class' => [
                'title'             => 'depcore.contact::lang.components.departments_list.subtitle_class.title',
                'description'       => 'depcore.contact::lang.components.departments_list.subtitle_class.description',
                'default'           => 'title',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.departments_list.subtitle_class.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.subtitle',
            ],
            'location' => [
                'title'             => 'depcore.contact::lang.components.departments_list.location.title',
                'description'       => 'depcore.contact::lang.components.departments_list.location.description',
                'type'              => 'dropdown',
            ],
            'department' => [
                'title'             => 'depcore.contact::lang.components.departments_list.department.title',
                'description'       => 'depcore.contact::lang.components.departments_list.department.description',
                'type'              => 'dropdown',
                'depends'     => ['location'],
            ],
           'container_class' => [
                'title'             => 'depcore.contact::lang.components.departments_list.container_class.title',
                'description'       => 'depcore.contact::lang.components.departments_list.container_class.description',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.departments_list.container_class.validation_message',
                'placeholder' => 'depcore.contact::lang.components.departments_list.container_class.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.css',
            ],
            'box_class' => [
                'title'             => 'depcore.contact::lang.components.departments_list.box_class.title',
                'description'       => 'depcore.contact::lang.components.departments_list.box_class.description',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.departments_list.box_class.validation_message',
                'placeholder' => 'depcore.contact::lang.components.departments_list.box_class.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.css',
            ],
            'svg_email' => [
                'title'             => 'depcore.contact::lang.components.departments_list.svg_email.title',
                'description'       => 'depcore.contact::lang.components.departments_list.svg_email.description',
                'default'           => '',
                'type'              => 'string',
                'validationMessage' => 'depcore.contact::lang.components.departments_list.svg_email.validation_message',
                'placeholder' => 'depcore.contact::lang.components.departments_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.icons',
            ],
            'svg_phone' => [
                'title'             => 'depcore.contact::lang.components.departments_list.svg_phone.title',
                'description'       => 'depcore.contact::lang.components.departments_list.svg_phone.description',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.departments_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.icons',
            ],
            'svg_address' => [
                'title'             => 'depcore.contact::lang.components.departments_list.svg_address.title',
                'description'       => 'depcore.contact::lang.components.departments_list.svg_address.description',
                'type'              => 'string',
                'placeholder' => 'depcore.contact::lang.components.departments_list.icon.placeholder',
                'group' => 'depcore.contact::lang.components.departments_list.groups.icons',
            ],

        ];
    }

    /**
     * get selected location
     *
     * @return void
     * @author Adam
     **/
    public function onRun()
    {
        $this->location = Location::find( $this->property( 'location' ) );
    }

    public function getLocationOptions()
    {
        return  [''=>'----' ] + Location::published()->get()->pluck('name','id')->toArray(  );
    }

    public function getDepartmentOptions()
    {
        $locationId = Request::input('location');
        if ($locationId) {
            return ['depcore.contact::lang.components.departments_list.department.all'] + Location::find($locationId)->departments()->get()->pluck('name','id')->toArray(  );
        }

    }
}