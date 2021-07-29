<?php

namespace Uasoft\Badaso\Module\POS\Models;

use Illuminate\Database\Eloquent\Model;
use Uasoft\Badaso\Models\User;

class POSPaymentProvider extends Model
{
    protected $table = null;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'payment_providers';
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the UserAddress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
