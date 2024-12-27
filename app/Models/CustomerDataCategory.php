<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDataCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function customerDataAccessPermissions()
    {
        return $this->hasMany(CustomerDataAccessPermission::class, 'customerDataCategoryId');
    }
}