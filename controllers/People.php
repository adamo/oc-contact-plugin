<?php namespace Depcore\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Depcore\Contact\Models\Person;

/**
 * People Back-end Controller
 */
class People extends Controller
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

        BackendMenu::setContext('Depcore.Contact', 'contact', 'people');
    }

    /**
     * Deleted checked people.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $personId) {
                if (!$person = Person::find($personId)) continue;
                $person->delete();
            }

            Flash::success(Lang::get('depcore.contact::lang.people.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.contact::lang.people.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
