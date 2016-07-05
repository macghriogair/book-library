@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My Book Borrows</div>
                <br><br>
                <ul class="media-list">

                @forelse ($borrows as $borrow)
                    <li class="media">
                      <div class="media-left">
                        {{-- <a href="#">
                          <img class="media-object" src="" alt="">
                        </a> --}}
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">{{$borrow->book->title}}</h4>

                        <p>{{ $borrow->book->author }}, {{ $borrow->book->year }}</p>
                        <p>{{ $borrow->book->description }}</p>

                        @if (strtotime($borrow->due_date) < time())
                            <p class="text-danger">
                        @else
                            <p class="text-primary">
                        @endif

                            due {{ date('d-M-Y', strtotime($borrow->due_date)) }}
                        </p>
                      </div>
                      <div class="media-left">

                        <p>
                            <a class="btn btn-xs btn-default" href="{{ url('/books/' . $borrow->book->id . '/checkin') }}">
                                Check-in
                            </a>
                        </p>
                      </div>
                    </li>
                @empty
                    No books borrowed.
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
