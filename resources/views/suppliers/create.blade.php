@extends('layouts.app')
@section('title', 'Create Suppliers')

@section('content')
    <div class="container">
        <form action="/suppliers" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Supplier</h1>
                    </div>
                    <div class="form-group row">



                        <label for="name" class="col-md-4 col-form-label ">Name</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                                autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror



                    <div class="row">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
