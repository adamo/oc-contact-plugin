<?php namespace Depcore\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Request;
use Lang;
use Depcore\Contact\Models\Department;
use Depcore\Contact\Models\Person;

/**
 * Departments Back-end Controller
 */
class Departments extends Controller
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
        $this->addJs("/plugins/depcore/contact/assets/sortable.min.js");
        $this->addJs("/plugins/depcore/contact/assets/reorderinit.js");

        BackendMenu::setContext('Depcore.Contact', 'contact', 'departments');
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

            Flash::success(Lang::get('depcore.contact::lang.departments.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.contact::lang.departments.delete_selected_empty'));
        }

        return $this->listRefresh();
    }

    public function onReorderRelation() {
        $records = Request::input('rcd');
        $model = new Person;
        $model->setSortableOrder($records, range(1, count($records)));
        Flash::success( \Lang::get( 'depcore.contact::lang.department.sort_finished' ) );
    }
}
