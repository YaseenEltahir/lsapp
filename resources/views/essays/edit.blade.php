@extends('layouts.app')

@section('content')
<a href="/essays" class="btn btn-default">Go Back</a>
    <h1>Edit Essay</h1>
    {{-- {!! Form::open(['action' => ['EssaysController@update', $essay->essay_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('essay_title', 'Title')}}
            {{Form::text('essay_title', $essay->essay_title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $essay->body, ['essay_id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} --}}

    {!! Form::open(['action' => ['EssaysController@update', $essay->essay_id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="form-group">
            {{Form::label('essay_title', 'Essay Title')}}
            {{Form::text('essay_title', $essay->essay_title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('essay_body', 'Essay Body')}}
            {{Form::textarea('essay_body', $essay->essay_body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label($essay->file_name, 'PDF File Upload')}}
            {{Form::file('file_name')}}
        </div>
        <div class="form-group">
            {{Form::label($essay->cover_image, 'Cover Image Upload')}}
            {{Form::file('cover_image')}}
        </div>
        <div class="form-group">
                @foreach($books as $book)
                    <input type="checkbox" name="{{$book->book_title}}" {{$essay->hasBook($book)?"checked":""}} > {{$book->book_title}}<br>
                @endforeach
        </div>
        <div class="form-group">

            <select name="subscription_selector">
                @foreach($subscriptions as $subscription)
                    <option value="{{$subscription->subscription_id}}" {{($essay->subscription_id==$subscription->subscription_id)?"selected":""}}>{{$subscription->subscription_title}}</option>
                @endforeach        
            </select>
        </div>
        <div class="form-group">
                {{ Form::label('date', 'Date:') }}
                <input type="date" name="essay_date" value="{{date('Y-m-d', strtotime($essay->essay_date)) }}"  ><br>

                {{-- <input type="date" name="essay_date" value="1980-08-26" {{date('d-m-Y H:i:s', strtotime($essay->essay_date)) }} ><br> --}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection