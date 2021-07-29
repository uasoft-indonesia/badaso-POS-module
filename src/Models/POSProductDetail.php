<?php

namespace Uasoft\Badaso\Module\POS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POSProductDetail extends Model
{
    use SoftDeletes;

    protected $table = null;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'product_details';
        parent::__construct($attributes);
    }

    protected $guarded = [];

    /**
     * Get the discount that owns the ProductDetail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(POSDiscount::class);
    }

    /**
     * Get the product that owns the ProductDetail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(POSProduct::class, 'product_id');
    }
}
