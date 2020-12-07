@extends('layouts.app')
@section('title', 'Show Suppliers')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Suppliers</h1>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
{{--                    <a href="/products/create">Create</a>--}}






                    <div class="col-sm-3">
                        <form action="/products/create" >
                            @csrf

                            <button type="submit" class="btn btn-secondary w-100">Create</button>
                        </form>

                    </div>

                    <div class="col-sm-3">
                        <form action="/suppliers/{{$supplier->id}}/edit" >
                            @csrf

                            <button type="submit" class="btn btn-secondary w-100">Edit</button>
                        </form>
                    </div>



                    <div class="col-sm-3">
                    <form action="/suppliers/{{ $supplier->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary w-100">Delete</button>
                    </form>
                    </div>



{{--                    <a href="/products/{{$product->id}}/edit">--}}
{{--                        Edit--}}
{{--                    </a>--}}

                </div>




                <div class="form-group row">

                    <label for="type" class="col-md-4 col-form-label ">Name</label>

                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name')??$supplier->name}}"
                           autocomplete="name" autofocus readonly>

                    @error('type')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror









                </div>


            </div>
        </div>


    </div>
@endsection
