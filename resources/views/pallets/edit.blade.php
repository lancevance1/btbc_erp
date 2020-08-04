@extends('layouts.app')
@section('title', 'Edit Pallets Specs')

@section('content')
    <div class="container">
        <form action="/orders/{{$order->id}}/pallets/{{$pallet->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Pallet</h1>
                    </div>
                    <div class="form-group row">



                        <label for="cartons_per_layer" class="col-md-4 col-form-label ">Cartons per Layer</label>
                        <input id="cartons_per_layer" type="number"
                               class="form-control @error('cartons_per_layer') is-invalid @enderror"
                               name="cartons_per_layer" value="{{ old('cartons_per_layer')?? $pallet->cartons_per_layer }}"
                               autocomplete="cartons_per_layer" autofocus>

                        @error('cartons_per_layer')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="layers_per_pallet" class="col-md-4 col-form-label ">Layers per Pallet</label>
                        <input id="layers_per_pallet" type="number"
                               class="form-control @error('layers_per_pallet') is-invalid @enderror"
                               name="layers_per_pallet" value="{{ old('layers_per_pallet') ?? $pallet->layers_per_pallet}}"
                               autocomplete="layers_per_pallet" autofocus>

                        @error('layers_per_pallet')
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
