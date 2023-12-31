@extends('adminlte::page')

@section('title', 'Borrow')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left d-inline-block">
                <h2>Borrow</h2>
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
            <th>Title</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>User</th>


            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($borrows as $borrow)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $borrow->book ? $borrow->book->title : ''}}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->return_date }}</td>
                <td>{{ $borrow->status }}</td>
                <td>{{ $borrow->user ? $borrow->user->name : '' }}</td>
                <td>
                    @if($borrow->book)
                        <form action="{{ route('books.return',$borrow->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('books.show',$borrow->book->id) }}">Show</a>
                        @if($borrow->status == 'RETURN')
                            <button class="btn btn-danger" disabled>Returned</button>
                        @else
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Return</button>
                        @endif
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {!! $borrows->links() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //
    </script>
@stop
