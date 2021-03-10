<?php namespace Depcore\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Depcore\Contact\Models\Department;

/**
 * Departments Back-end Controller
 */
class ContactInfos extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',

    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Depcore.Contact', 'contact', 'contactinfos');
    }

    /**
     * Deleted checked departments.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $departmentId) {
                if (!$department = Department::find($departmentId)) continue;
                $department->delete();
            }

            Flash::success(Lang::get('depcore.contact::lang.contactinfos.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.contact::lang.contactinfos.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
