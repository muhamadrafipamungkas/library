@extends('adminlte::page')

@section('title', 'Book')

@section('content')
    <div class="row pt-4">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add Books</h2>
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

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name (Title):</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Publisher Year:</strong>
                    <input type="number" name="publisher_year" class="form-control" placeholder="Publisher Year">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Book Quantity:</strong>
                    <input type="number" name="quantity" class="form-control" placeholder="Book Quantity">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Select Author Name:</label>
                    <select class="form-control select2" name="author">
                        <option selected disabled>Choose author name</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author["id"] }}">{{ $author["author_name"] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Select Publisher Name:</label>
                    <select class="form-control select2" name="publisher">
                        <option selected disabled>Choose publisher name</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher["id"] }}">{{ $publisher["publisher_name"] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <label>Book Cover:</label><br />
                    <form>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="attachment" name="attachment">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Select Categories:</label><br />
                    <select class="form-control select2 multiselect" name="categories[]" id="categories" multiple>

                        @foreach ($categories as $category)
                            <option value="{{ $category["id"] }}">{{ $category["name"] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link
        href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"
        rel="stylesheet" >
@stop

@section('js')
    <script type="text/javascript" src="//jquery-2.1.0.min.js"></script>
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#categories').multiselect({
                includeSelectAllOption: true,
            });

            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@stop
