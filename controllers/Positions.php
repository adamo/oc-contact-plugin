<?php namespace Depcore\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Depcore\Contact\Models\Position;

/**
 * Positions Back-end Controller
 */
class Positions extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Depcore.Contact', 'contact', 'positions');
    }

    /**
     * Deleted checked positions.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $positionId) {
                if (!$position = Position::find($positionId)) continue;
                $position->delete();
            }

            Flash::success(Lang::get('depcore.contact::lang.positions.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.contact::lang.positions.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
