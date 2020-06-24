@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/p" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Order</h1>
                    </div>
                    <div class="form-group row">
                        <label for="Order No." class="col-md-4 col-form-label ">Order No.</label>
                        <input id="Order No." type="text"
                               class="form-control @error('Order No.') is-invalid @enderror"
                               name="Order Number" value="{{ old('Order No.') }}"
                                autocomplete="Order No." autofocus>

                        @error('Order No.')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="Wine Code" class="col-md-4 col-form-label ">Wine Code</label>
                        <input id="Wine Code" type="text"
                               class="form-control @error('Wine Code') is-invalid @enderror"
                               name="Wine Code" value="{{ old('Wine Code') }}"
                                autocomplete="Wine Code" autofocus>

                        @error('Wine Code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="Run No." class="col-md-4 col-form-label ">Run No.</label>
                        <input id="Run No." type="number"
                               class="form-control @error('Run No.') is-invalid @enderror"
                               name="Run Number" value="{{ old('Run No.') }}"
                                autocomplete="Run No." autofocus
                               placeholder="0000" max="9999" min="1000">

                        @error('Run No.')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="row">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
