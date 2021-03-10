<?php namespace Depcore\Contact\Models;

use Model;

/**
 * Location Model
 */
class Location extends Model
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
        'name.required' => 'depcore.contact::lang.location.name_required',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'depcore_contact_locations';

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $hasMany = [
        'departments' => Department::class,
        'conditions' => 'is_published = 1',
    ];

    public $attachOne =[
        'cover' => '\System\Models\file',
    ];

    public $morphOne = [
        'contactinfo' => [ContactInfo::class, 'name' => 'contact']
    ];

    /**
     * Get only published elements from database
     *
     * @return Object
     * @author Adam
     **/
    public function scopePublished($query)
    {
        return $query->whereNotNull('is_published')->where ( 'is_published',true )->orderBy( 'sort_order' );
    }
}