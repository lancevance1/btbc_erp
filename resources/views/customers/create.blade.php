@extends('layouts.app')
@section('title', 'Create Customers')

@section('content')
    <div class="container">
        <form action="/customers" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Customer</h1>
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

                        <label for="address" class="col-md-4 col-form-label ">Address</label>
                        <input id="address" type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               name="address" value="{{ old('address') }}"
                                autocomplete="address" autofocus>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <a href="/contacts/create">create contact</a>

                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
