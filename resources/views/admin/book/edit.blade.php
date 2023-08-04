@extends('adminlte::page')

@section('title', 'Book')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Category</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update',$book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $book->title }}" class="form-control" placeholder="Name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Published Year:</strong>
                    <input type="text" name="published_year" value="{{ $book->published_year }}" class="form-control" placeholder="2002">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <strong>Publisher Name:</strong>
                {{ $book->publisher_name }}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <strong>Categories:</strong>
                {{ $book->categories_name_list() }}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <strong>Quantity:</strong>
                {{ $book->quantity }}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <strong>Book Cover:</strong>
                <img src="{{ URL::asset('storage/public/attachments/cover/'.$book->thumbnail) }}" />
                {{ $book->thumbnail }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //
    </script>
@stop
