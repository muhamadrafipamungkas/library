@extends('adminlte::page')

@section('title', 'Books')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Show Book</h2>
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


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $book->title }}
            </div>
            <div class="form-group">
                <strong>Published Year:</strong>
                {{ $book->published_year }}
            </div>
            <div class="form-group">
                <strong>Publisher Name:</strong>
                {{ $book->publisher_name }}
            </div>
            <div class="form-group">
                <strong>Categories:</strong>
                {{ $book->categories_name_list() }}
            </div>
            <div class="form-group">
                <strong>Quantity:</strong>
                {{ $book->quantity }}
            </div>
            <div class="form-group">
                <strong>Book Cover:</strong>
                <img src="{{ URL::asset('storage/public/attachments/cover/'.$book->thumbnail) }}" />
                {{ $book->thumbnail }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //
    </script>
@stop
