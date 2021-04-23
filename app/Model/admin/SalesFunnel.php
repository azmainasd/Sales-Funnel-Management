<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesFunnel extends Model
{
    use SoftDeletes;

    /**
     * Get the solution that owns the SalesFunnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solution()
    {
        return $this->belongsTo(Solution::class, 'solution_id');
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
