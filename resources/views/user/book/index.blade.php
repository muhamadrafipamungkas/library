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
            <th>Title</th>
            <th>Author Name</th>
            <th>Published Year</th>
            <th>Publisher Name</th>
            <th>Categories</th>
            <th>Quantity</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->authors_name_list()}}</td>
                <td>{{ $book->published_year }}</td>
                <td>{{ $book->publisher ? (count($book->publisher) > 0 ?$book->publisher[0]['publisher_name']: '') : '' }}</td>
                <td>{{ $book->categories_name_list() }}</td>
                <td>{{ $book->quantity }}</td>
                <td>
                    <form action="{{ route('books.borrow',$book->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a>
                        @if(in_array($book->id, $borrow))
                            <button class="btn btn-info" disabled>Borrowed</button>
                        @else
                            @csrf
                            <button type="submit" class="btn btn-success">Borrow</button>
                        @endif
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
