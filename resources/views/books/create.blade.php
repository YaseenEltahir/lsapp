@extends('layouts.app')

@section('content')
    <h1>Create Book</h1>

    {!! Form::open(['action' => 'BooksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('book_title', 'Book Title')}}
            {{Form::text('book_title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        
        
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection