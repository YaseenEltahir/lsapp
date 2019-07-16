@extends('layouts.app')

@section('content')
    <h1>Subscriptions</h1>
    <a href="/subscriptions/create" class="btn btn-primary"> Create </a>
    @if(count($subscriptions) > 0)
    <table class="table">
            <tr>
                

                    <th>subscription_title</th> 
                    <th>created_at</th>

                  </tr>
        @foreach($subscriptions as $subscription)
        <tr>

                    
                    <td>
                        <h3><a href="/subscriptions/{{$subscription->subscription_id}}">{{$subscription->subscription_title}}</a></h3>
                    </td>&nbsp
                    <td>
                        <h4> {{$subscription->created_at}}</h4>
                    </td>
                   
        </tr>
        @endforeach
    </table>
        {{-- {{$subscriptions->links()}} --}}
    @else
        <p>No subscriptions found</p>
    @endif
@endsection