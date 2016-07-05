<?php

namespace App;

use App\Book;
use App\Borrow;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withPivot('due_date', 'active')
            ->withTimestamps();
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function exceedsMaxBorrows()
    {
        return $this->borrows()->active()->count() >= $this->max_borrows;
    }

    public function hasBorrowsDue()
    {
        return $this->borrows()->active()
            ->where('due_date', '<', Carbon::now())
            ->count() > 0;
    }
}
