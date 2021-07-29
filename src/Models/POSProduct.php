<?php

namespace Uasoft\Badaso\Module\POS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POSProduct extends Model
{
    use SoftDeletes;

    protected $table = null;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'products';
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'product_category_id',
        'name',
        'slug',
        'desc',
        'product_image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the productCategory that owns the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo(POSProductCategory::class, 'product_category_id');
    }

    /**
     * Get all of the productDetails for the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDetails()
    {
        return $this->hasMany(POSProductDetail::class, 'product_id');
    }
}
