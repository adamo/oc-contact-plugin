<?php namespace Depcore\Contact;

use Backend;
use System\Classes\PluginBase;

/**
 * contact Plugin Information File
 */
class Plugin extends PluginBase
{

    public $requires =['Inetis.ListSwitch'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'depcore.contact::lang.plugin.name',
            'description' => 'depcore.contact::lang.plugin.description',
            'author'      => 'depcore',
            'icon'        => 'icon-building'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Depcore\Contact\Components\ContactList' => 'contactsList',
            'Depcore\Contact\Components\LocationsList' => 'locationsList',
            'Depcore\Contact\Components\DepartmentsList' => 'departmentsList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'depcore.contact.some_permission' => [
                'tab' => 'depcore.contact::lang.plugin.name',
                'label' => 'depcore.contact::lang.permissions.some_permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'contact' => [
                'label'       => 'depcore.contact::lang.plugin.name',
                'url'         => Backend::url('depcore/contact/departments/'),
                'icon'        => 'icon-building-o',
                'permissions' => ['depcore.contact.*'],
                'order'       => 500,
                'sideMenu' => [
                    'location' => [
                        'label'       => 'depcore.contact::lang.locations.menu_label',
                        'icon'        => 'icon-map-marker',
                        'url'         => Backend::url('depcore/contact/locations'),
                        'permissions' => ['depcore.contact.manage_contact'],
                    ],
                    'departments' => [
                        'label'       => 'depcore.contact::lang.departments.menu_label',
                        'icon'        => 'icon-th-list',
                        'url'         => Backend::url('depcore/contact/departments'),
                        'permissions' => ['depcore.contact.manage_contact'],
                    ],
                    'add_department' => [
                        'label'       => 'depcore.contact::lang.department.create_title',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('depcore/contact/departments/create'),
                        'permissions' => ['depcore.contact.manage_contact'],
                    ],
                    'people' => [
                        'label' => 'depcore.contact::lang.people.menu_label',
                        'icon' => 'icon-user-circle',
                        'url' => Backend::url('depcore/contact/people'),
                    ],
                    'contact_info' => [
                        'label' => 'depcore.contact::lang.contactinfos.menu_label',
                        'icon' => 'icon-address-card-o',
                        'url' => Backend::url('depcore/contact/contactinfos'),
                    ],
                ], // side menu ends
            ],
        ];
    }

}
