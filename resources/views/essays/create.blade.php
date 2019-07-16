@extends('layouts.app')

@section('content')
<a href="/essays" class="btn btn-default">Go Back</a>

    <h1>Create Essay</h1>
    {{-- 01-12 17:54:30.112 4248-4248/? E/pin: [{"essay_id":2,"essay_title":"مقالة 1","essay_body":"<p>لب الموضوع<\/p>","file_name":"My CV_1547157677.pdf","is_active":1,"created_at":"2019-01-10 22:01:17","updated_at":"2019-01-10 22:01:17"}] --}}

    {!! Form::open(['action' => 'EssaysController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('essay_title', 'Essay Title')}}
            {{Form::text('essay_title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('essay_body', 'Essay Body')}}
            {{Form::textarea('essay_body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('', 'PDF File Upload')}}
            {{Form::file('file_name')}}
        </div>
        <div class="form-group">
            {{Form::label('', 'Cover Image Upload')}}
            {{Form::file('cover_image')}}
        </div>
        <div class="form-group">
                @foreach($books as $book)
                    <input type="checkbox" name="{{$book->book_title}}" > {{$book->book_title}}<br>
                @endforeach

        </div>
        <div class="form-group">

        <select name="subscription_selector">
            @foreach($subscriptions as $subscription)
                <option value="{{$subscription->subscription_id}}">{{$subscription->subscription_title}}</option>
            @endforeach
                
              </select>
            </div>
            <div class="form-group">
                    {{ Form::label('date', 'Date:') }}
                    <input type="date" name="essay_date" ><br>
                    </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection