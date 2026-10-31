<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['username', 'full_name'])]
class User extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    public const UPDATED_AT = null;
}
