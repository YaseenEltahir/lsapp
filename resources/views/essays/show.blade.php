@extends('layouts.app')

@section('content')
    <a href="/essays" class="btn btn-default">Go Back</a>
    <h1>{{$essay->essay_title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$essay->cover_image}}">
    <br><br>
    <div>
        {{-- {!!$essay->body!!} --}}
    </div>
    <div>
            {!!$essay->subscription->subscription_title!!}
    </div>
    <hr>
    <small>Written on {{$essay->created_at}} by {{$essay->user->name}}</small>
    <hr>
    <h3>List of books:</h3>
    @foreach($books as $book)
        <h4>{{$book->book_title}}</h4>
    @endforeach
    @if(!Auth::guest())
        @if(Auth::user()->essay_id == $essay->user_id)
            <a href="/posts/{{$essay->essay_id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $essay->essay_id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection