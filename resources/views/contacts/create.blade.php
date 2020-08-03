@extends('layouts.app')
{{--@extends('customers.create')--}}
@section('title', 'Create Contacts')

@section('content')
    <div class="container">
        <form action="/customers/{{$customer->id}}/contacts" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Contact</h1>
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

                        <label for="email" class="col-md-4 col-form-label ">Email</label>
                        <input id="email" type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="phone" class="col-md-4 col-form-label ">Phone Number</label>
                        <input id="phone" type="text"
                               class="form-control @error('phone') is-invalid @enderror"
                               name="phone" value="{{ old('phone') }}"
                               autocomplete="phone" autofocus>

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="fax" class="col-md-4 col-form-label ">Fax</label>
                        <input id="fax" type="text"
                               class="form-control @error('fax') is-invalid @enderror"
                               name="fax" value="{{ old('fax') }}"
                               autocomplete="fax" autofocus>

                        @error('fax')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
