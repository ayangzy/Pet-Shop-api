<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'email';

    const UPDATED_AT = null;

    public function isExpired()
    {
        if (now()->diffInMinutes($this->created_at) > 10) {
            return false;
        }
        return true;
    }
}
