<?php namespace Depcore\Contact\Models;

use Model;

/**
 * ContactInfo Model
 */
class ContactInfo extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'depcore_contact_contact_infos';

    protected $jsonable = ['emails','phones'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $hasMany = [
        'people' => Person::class,
    ];

}
