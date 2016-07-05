<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'book_user';

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deactivate()
    {
        $this->active = false;
        return $this;
    }
}
