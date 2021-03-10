<?php namespace Depcore\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Request;
use Lang;
use Depcore\Contact\Models\Location;

/**
 * Locations Back-end Controller
 */
class Locations extends Controller
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
        BackendMenu::setContext('Depcore.Contact', 'contact', 'locations');
    }

    /**
     * Deleted checked locations.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $locationId) {
                if (!$location = Location::find($locationId)) continue;
                $location->delete();
            }

            Flash::success(Lang::get('depcore.contact::lang.locations.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.contact::lang.locations.delete_selected_empty'));
        }

        return $this->listRefresh();
    }


    public function onReorderRelation() {
        $records = Request::input('rcd');
        $model = new Location;
        $model->setSortableOrder($records, range(1, count($records)));
        Flash::success( \Lang::get( 'depcore.contact::lang.department.sort_finished' ) );
    }
}
