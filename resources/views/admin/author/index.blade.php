@extends('adminlte::page')

@section('title', 'Authors')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left d-inline-block">
                <h2>Authors</h2>
            </div>
            <div class="float-right d-inline-block">
                <a class="btn btn-success" href="{{ route('authors.create') }}">Create Author</a>
            </div>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($authors as $author)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $author->author_name }}</td>
                <td>
                    <form action="{{ route('authors.destroy',$author->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('authors.show',$author->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('authors.edit',$author->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $authors->links() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    //
    </script>
@stop
