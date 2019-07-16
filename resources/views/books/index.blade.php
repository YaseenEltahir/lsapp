@extends('layouts.app')

@section('content')
    <h1>Books</h1>
    <a href="/books/create" class="btn btn-primary"> Create </a>
    @if(count($books) > 0)
    <table class="table">
            <tr>
                

                    <th>book_title</th> 
                    <th>created_at</th>

                  </tr>
        @foreach($books as $book)
        <tr>

                    
                    <td>
                        <h3><a href="/books/{{$book->book_id}}">{{$book->book_title}}</a></h3>
                    </td>&nbsp
                    <td>
                        <h4> {{$book->created_at}}</h4>
                    </td>
                   
        </tr>
        @endforeach
    </table>
        {{-- {{$books->links()}} --}}
    @else
        <p>No books found</p>
    @endif
@endsection