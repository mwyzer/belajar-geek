<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDataAccessPermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['partnerTypeId', 'customerDataCategoryId', 'accessLevelId'];

    public function customerDataCategory()
    {
        return $this->belongsTo(CustomerDataCategory::class, 'customerDataCategoryId');
    }
}