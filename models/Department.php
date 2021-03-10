<?php namespace Depcore\Contact\Models;

use Model;

/**
 * Department Model
 */
class Department extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'name',
        'description'
    ];

    public $rules = [
        'name' => 'required',
    ];

    public $customMessages = [
        'name.required' => 'depcore.contact::lang.department.name_required',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'depcore_contact_departments';

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $hasMany = [
        'people' => Person::class,
        'conditions' => 'is_published = 1',
    ];

    public $belongsTo = [
        'location' => Location::class,
    ];

    public $attachOne = [
        'cover' => '\System\Models\File',
    ];

    public $morphOne = [
        'contactinfo' => [ContactInfo::class, 'name' => 'contact']
    ];

}
