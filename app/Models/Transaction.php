<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rCategory()
    {
        return $this->belongsTo(TransactionCategory::class, 'category_id', 'id');
    }

    public function rContact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
