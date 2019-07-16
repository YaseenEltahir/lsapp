@extends('layouts.app')

@section('content')
    <h1>Create Subscription</h1>

    {!! Form::open(['action' => 'SubscriptionsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('subscription_title', 'subscription Title')}}
            {{Form::text('subscription_title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        
        
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection