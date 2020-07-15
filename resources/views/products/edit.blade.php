@extends('layouts.app')
@section('title', 'Edit Dry Good')

@section('content')
    <div class="container">
        <form action="/products/{{$product->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Dry Good</h1>
                    </div>
                    <div class="form-group row">

                        <label for="type" class="col-md-4 col-form-label ">Type: </label>
                        <input id="type" type="text"
                               class="form-control @error('type') is-invalid @enderror"
                               name="type" value="{{ old('type')??$product->type}}"
                               autocomplete="type" autofocus readonly>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
{{--                        <select id="type"--}}
{{--                                class="form-control"--}}
{{--                                name="type"--}}
{{--                        >--}}
{{--                            <option value="{{ old('type') ??$product->type }}">Old value: {{ old('type') ??$product->type }}</option>--}}
{{--                            <option value="bottle">Bottle</option>--}}
{{--                            <option value="cork">Cork</option>--}}
{{--                            <option value="capsule">Capsule</option>--}}
{{--                            <option value="screw cap">Screw Cap</option>--}}
{{--                            <option value="carton">Carton</option>--}}
{{--                            <option value="divider">Divider</option>--}}
{{--                            <option value="pallet">Pallet</option>--}}
{{--                        </select>--}}

                        <label for="code" class="col-md-4 col-form-label ">Code</label>
                        <input id="code" type="text"
                               class="form-control @error('code') is-invalid @enderror"
                               name="code" value="{{ old('code')??$product->code }}"
                               autocomplete="code" autofocus>

                        @error('code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="description" class="col-md-4 col-form-label ">Description</label>
                        <input id="description" type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description" value="{{ old('description')??$product->description }}"
                               autocomplete="description" autofocus>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="price" class="col-md-4 col-form-label ">Price</label>
                        <input id="price" type="number"
                               class="form-control @error('price') is-invalid @enderror"
                               name="price" value="{{ old('price') ??$product->price}}"
                               autocomplete="price" autofocus>

                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cost" class="col-md-4 col-form-label ">Cost</label>
                        <input id="cost" type="number" placeholder="Insert Cost..." step="0.01"
                               class="form-control @error('cost') is-invalid @enderror"
                               name="cost" value="{{ old('cost')??$product->cost }}"
                               autocomplete="cost" autofocus>

                        @error('cost')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="current_inventory" class="col-md-4 col-form-label ">Current Inventory</label>
                        <input id="current_inventory" type="number"
                               class="form-control @error('current_inventory') is-invalid @enderror"
                               name="current_inventory" value="{{ old('current_inventory') ??$product->current_inventory}}"
                               autocomplete="current_inventory" autofocus>

                        @error('current_inventory')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="order_quantity" class="col-md-4 col-form-label ">Order Quantity</label>
                        <input id="order_quantity" type="number"
                               class="form-control @error('order_quantity') is-invalid @enderror"
                               name="order_quantity" value="{{ old('order_quantity') ??$product->order_quantity}}"
                               autocomplete="order_quantity" autofocus>

                        @error('order_quantity')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="to_be_ordered" class="col-md-4 col-form-label ">To be ordered</label>
                        <input id="to_be_ordered" type="number"
                               class="form-control @error('to_be_ordered') is-invalid @enderror"
                               name="to_be_ordered" value="{{ old('to_be_ordered')??$product->to_be_ordered }}"
                               autocomplete="to_be_ordered" autofocus>

                        @error('to_be_ordered')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="current_inventory_value" class="col-md-4 col-form-label ">Current Inventory Value</label>
                        <input id="current_inventory_value" type="number"
                               class="form-control @error('current_inventory_value') is-invalid @enderror"
                               name="current_inventory_value" value="{{ old('current_inventory_value') ??$product->current_inventory_value}}"
                               autocomplete="current_inventory_value" autofocus>

                        @error('current_inventory_value')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="belong_to" class="col-md-4 col-form-label ">Belong to</label>
                        <input id="belong_to" type="text"
                               class="form-control @error('belong_to') is-invalid @enderror"
                               name="belong_to" value="{{ old('belong_to') ??$product->belong_to}}"
                               autocomplete="belong_to" autofocus>

                        @error('belong_to')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="size" class="col-md-4 col-form-label ">Size</label>
                        <input id="size" type="text"
                               class="form-control @error('size') is-invalid @enderror"
                               name="size" value="{{ old('size')??$product->size }}"
                               autocomplete="size" autofocus>

                        @error('size')
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
