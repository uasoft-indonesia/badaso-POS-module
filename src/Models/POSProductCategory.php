<?php

namespace Uasoft\Badaso\Module\POS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POSProductCategory extends Model
{
    use SoftDeletes;

    protected $table = null;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'product_categories';
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'slug',
        'desc',
        'SKU',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function children()
    {
        return $this->hasMany(POSProductCategory::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(POSProductCategory::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(POSProduct::class, 'product_category_id', 'id');
    }
}
