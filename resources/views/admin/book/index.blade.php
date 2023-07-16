@extends('adminlte::page')

@section('title', 'Books')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left d-inline-block">
                <h2>Books</h2>
            </div>
            @if($user->role == "admin")
                <div class="float-right d-inline-block">
                    <a class="btn btn-success" href="{{ route('books.create') }}">Create Book</a>
                </div>
            @endif
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Published Year</th>
            <th>Quantity</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->published_year }}</td>
                <td>{{ $book->quantity }}</td>
                <td>
                    <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $books->links() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //
    </script>
@stop
