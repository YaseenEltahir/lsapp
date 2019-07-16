@extends('layouts.app')

@section('content')
<a href="/essays/create" class="btn btn-primary"> Create </a>

<h1>Essays</h1>

    @if(count($essays) > 0)
    <table class="table" style="width:100%">
            <tr>
                    {{-- <th>image</th> --}}
                    <th>title</th> 
                    <th>date</th>
                    <th>file</th>
                    <th></th>
                     <th></th>
                     <th></th>

                  </tr>
        @foreach($essays as $essay)
        <tr>

                    {{-- <td>
                        <img style="width:50px height:50px" src="/storage/cover_images/{{$essay->cover_image}}">
                    </td> &nbsp &nbsp &nbsp --}}
                    <td>
                        <h3><a href="/essays/{{$essay->essay_id}}">{{$essay->essay_title}}</a></h3>
                    </td>&nbsp
                    <td>
                        <h4> {{date('Y-m-d', strtotime($essay->created_at)) }}  by {{$essay->user->name}} &nbsp &nbsp &nbsp</h4>
                    </td>&nbsp
                    <td>
                        <h3><a href="/download/{{$essay->file_name}}">{{$essay->file_name}}</a></h3>
                    </td>
                    <td>
                            <label class="switch" >
                            <input class ="cc" type="checkbox" id="{{$essay->essay_id}}" {{$essay->is_active=='1'?"checked":""}}>
                                    <span class="slider round" ></span>
                                  </label>    
                    </td>
                    <td>
                            <a href="/essays/{{$essay->essay_id}}/edit" class="btn btn-default">Edit</a>
                    </td>
                    <td>
                        {!!Form::open(['action' => ['EssaysController@destroy', $essay->essay_id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </td>
        </tr>
        @endforeach
    </table>
        {{$essays->links()}}
    @else
        <p>No essays found</p>
    @endif
    
@endsection