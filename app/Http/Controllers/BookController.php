<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrow;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('year', 'DESC')->get();
        return view('books.index', compact('books'));
    }

    public function myBooks()
    {
        $borrows = Auth::user()->borrows()->active()->orderBy('created_at')->get();
        return view('books.my', compact('borrows'));
    }

    public function checkOut(Book $book)
    {
        try {
            $this->authorize($book);
        } catch (\Exception $e) {
            return redirect('/books')->with('error', $e->getMessage());
        }

        Auth::user()->books()->attach(
            $book,
            ['due_date' => Carbon::now()->addWeeks(4) ]
        );
        $book->checkout()->save();

        return redirect('/books')->with('status', 'Book checked out!');
    }

    public function checkIn(Book $book)
    {
        $user = Auth::user();

        $borrow = Borrow::where([
            'book_id' => $book->id,
            'active' => true
        ])->firstOrFail()->deactivate()->save();

        $book->checkin()->save();

        return redirect('/books/my')->with('status', 'Book checked in successfully!');
    }

    // TODO
    public function popular()
    {
        return response()->json(Book::popular()->take(5));
    }
}
