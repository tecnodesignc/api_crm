<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Media\Entities\File;

class Account extends Model
{

    use MediaRelation;

    protected $table = 'crm__accounts';
    protected $fillable = ['account_name', 'parent_account', 'fax', 'phone', 'owner_id', 'industry', 'account_site', 'state', 'process_flow', 'billing_street', 'billing_code', 'billing_state', 'billing_country', 'shipping_city', 'shipping_street', 'shipping_state', 'shipping_country', 'shipping_code', 'approved ', 'twitter', 'facebook', 'instagram', 'linkedin', 'status', 'created_by', 'annual_revenue', 'ownership', 'description', 'rating', 'website', 'employees', 'modified_by', 'review', 'options'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'approved' => 'boolean'
    ];

    /**
     * |--------------------------------------------------------------------------
     * | RELATIONS
     * |--------------------------------------------------------------------------
     */

    public function owner()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", 'owner_id');
    }

    public function modified()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", 'modified_id');
    }

    public function created()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", 'created_id');
    }

    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_account');
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_account');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * |--------------------------------------------------------------------------
     * | MUTATORS
     * |--------------------------------------------------------------------------
     */

    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function getAccountImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'accountimage')->first();
        if (!$thumbnail) {
            $image = [
                'mimeType' => 'image/jpeg',
                'path' => null
            ];
        } else {
            $image = [
                'mimeType' => $thumbnail->mimetype,
                'path' => $thumbnail->path_string
            ];
        }
        return json_decode(json_encode($image));
    }

    /**
     * Magic Method modification to allow dynamic relations to other entities.
     * @return string
     * @var $destination_path
     * @var $value
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['ecore.crm.config.relations.account', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);
            $bound = $function->bindTo($this);

            return $bound();
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
