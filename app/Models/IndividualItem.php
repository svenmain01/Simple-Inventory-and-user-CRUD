<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'item', 'description', 'quantification','quantity', 'priceperquantification', 'totalprice', 'acquisitiondate', 'propertynumber',
    ];
}