<?php

namespace App;

use App\Borrow;
use Illuminate\Database\Eloquent\Model;
use DB;

class Book extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function isAvailable()
    {
        return $this->available;
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    public function checkout()
    {
        $this->available = false;
        return $this;
    }

    public function checkin()
    {
        $this->available = true;
        return $this;
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public static function popular()
    {
        return self::select(DB::raw('books.*, count(*) as `aggregate`'))
                ->join('book_user', 'books.id', '=', 'book_user.book_id')
                ->groupBy('book_id')
                ->orderBy('aggregate', 'desc')
                ->paginate(10);
    }
}
