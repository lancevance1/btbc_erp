@extends('layouts.app')
@section('title', 'Create Order')

@section('content')
    <div class="container">
        <form action="/orders" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Order</h1>
                    </div>
                    <div class="form-group row">
                        <label for="order_number" class="col-md-4 col-form-label ">Order No.</label>
                        <input id="order_number" type="text"
                               class="form-control @error('order_number') is-invalid @enderror"
                               name="order_number" value="{{ old('order_number') }}"
                                autocomplete="order_number" autofocus>

                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="wine_code" class="col-md-4 col-form-label ">Wine Code</label>
                        <input id="wine_code" type="text"
                               class="form-control @error('wine_code') is-invalid @enderror"
                               name="wine_code" value="{{ old('wine_code') }}"
                                autocomplete="wine code" autofocus>

                        @error('wine_code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="run_number" class="col-md-4 col-form-label ">Run No.</label>
                        <input id="run_number" type="number"
                               class="form-control @error('run_number') is-invalid @enderror"
                               name="run_number" value="{{ old('run_number') }}"
                                autocomplete="run number" autofocus
                               placeholder="0000" max="9999" min="1000">

                        @error('run_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="row">
                        <button class="btn btn-primary" >Submit</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
