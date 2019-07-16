@extends('layouts.app')

@section('content')
    <h1>Edit Subscription</h1>
    {!! Form::open(['action' => ['SubscriptionsController@update', $subscription->subscription_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('subscription_title', 'Title')}}
            {{Form::text('subscription_title', $subscription->subscription_title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection