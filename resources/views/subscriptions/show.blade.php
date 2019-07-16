@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$subscription->subscription_title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$subscription->cover_image}}">
    <br><br>
    
    

    
@endsection