<?php

namespace App\Policies;

use App\Book;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BorrowBookPolicy
{
    use HandlesAuthorization;

    public function checkout(User $user, Book $book)
    {
        if (! $book->isAvailable()) {
            throw new \Exception("Book is not available");
        }
        if ($user->exceedsMaxBorrows()) {
            throw new \Exception("Nope, you got too many books borrowed!");
        }
        if ($user->hasBorrowsDue()) {
            throw new \Exception("Nope, you got books due to be returned first!");
        }
        return true;
    }
}
