<?php namespace Depcore\Contact\Models;

use Model;

/**
 * Person Model
 */
class Person extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    public $rules = [
        'name' => 'required|max:50',
        'surname' => 'required|max:60',
    ];

    public $customMessages = [
        'name.required' => 'depcore.contact::lang.person.name_required',
        'surname.required' => 'depcore.contact::lang.person.name_required',
        'name.max' => 'depcore.contact::lang.person.name_max',
        'surname.max' => 'depcore.contact::lang.person.name_max',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'depcore_contact_people';

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $belongsTo = [
        'department' => Department::class,
    ];

    public $morphOne = [
        'contactinfo' => [ContactInfo::class, 'name' => 'contact']
    ];

    public $attachOne = [
        'image' => '\System\Models\File',
    ];

}
