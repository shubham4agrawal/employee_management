<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'department_id', 'date_of_birth'];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function contactNumbers(): HasMany
    {
        return $this->hasMany(ContactNumber::class);
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }
}
