@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Books</div>
                <br><br>
                <ul class="media-list">
                @foreach ($books as $book)
                    <li class="media">
                        <div class="media-left">
                          {{-- <a href="#">
                            <img class="media-object" src="" alt="">
                          </a> --}}
                        </div>

                        <div class="media-body">
                          <h4 class="media-heading">{{$book->title}}
                          <small>
                              @if ($book->available)
                                  <span class="label label-success">available</span>
                              @else
                                  <span class="label label-warning">not available</span>
                              @endif
                              </small>
                          </h4>

                          <p>{{ $book->author }}, {{ $book->year }}</p>
                          <p>{{ $book->description }}</p>
                        </div>
                        <div class="media-left">
                            @if ($book->available)
                                <p>
                                    <a class="btn btn-xs btn-default" href="{{ url('/books/' . $book->id . '/checkout') }}">
                                        Check-out
                                    </a>
                                </p>
                            @endif
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
