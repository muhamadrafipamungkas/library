@extends('adminlte::page')

@section('title', 'Publisher')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left d-inline-block">
                <h2>Publisher</h2>
            </div>
            <div class="float-right d-inline-block">
                <a class="btn btn-success" href="{{ route('publishers.create') }}">Create Publisher</a>
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
        @foreach ($publishers as $publisher)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $publisher->publisher_name }}</td>
                <td>
                    <form action="{{ route('publishers.destroy',$publisher->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('publishers.show',$publisher->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('publishers.edit',$publisher->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $publishers->links() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    //
    </script>
@stop
