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


{{--                        <label for="wine_code" class="col-md-4 col-form-label ">Wine Code</label>--}}
{{--                        <input id="wine_code" type="text"--}}
{{--                               class="form-control @error('wine_code') is-invalid @enderror"--}}
{{--                               name="wine_code" value="{{ old('wine_code') }}"--}}
{{--                               autocomplete="wine_code" autofocus>--}}

{{--                        @error('wine_code')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}

                        <label for="run_number" class="col-md-4 col-form-label ">Run No.</label>
                        <input id="run_number" type="number"
                               class="form-control @error('run_number') is-invalid @enderror"
                               name="run_number" value="{{ old('run_number') }}"
                               autocomplete="run_number" autofocus
                               placeholder="0000" max="9999" min="1000">

                        @error('run_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                        <label for="COA" class="col-md-4 col-form-label ">COA</label>
                        <select id="COA"
                                class="form-control" name="COA">
                                <option value='1'>
                                    YES
                                </option>
                            <option value='0'>
                                NO
                            </option>
                        </select>

{{--                        <input id="COA" type="number"--}}
{{--                               class="form-control @error('COA') is-invalid @enderror"--}}
{{--                               name="COA" value="{{ old('COA') }}"--}}
{{--                               autocomplete="COA" autofocus--}}
{{--                               placeholder="0000" >--}}



                        <label for="LIP" class="col-md-4 col-form-label ">LIP</label>
                        <select id="LIP"
                                class="form-control" name="LIP">


                            <option value='1'>
                                YES
                            </option>
                            <option value='0'>
                                NO
                            </option>

                        </select>




                        <label for="wine" class="col-md-4 col-form-label ">Wine</label>
                        <select id="wine"
                                class="form-control" name="wine">

                            @foreach($wines as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_wine" class="col-md-4 col-form-label ">Wine: Quantity</label>
                        <input id="quantity_wine" type="number"
                               class="form-control @error('quantity_wine') is-invalid @enderror"
                               name="quantity_wine" value="{{ old('quantity_wine') }}"
                               autocomplete="quantity_wine" autofocus>

                        @error('quantity_wine')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                        <label for="bottle" class="col-md-4 col-form-label ">Bottle</label>
                        <select id="bottle"
                                class="form-control" name="bottle">

                            @foreach($bottles as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_bottle" class="col-md-4 col-form-label ">Bottle: Quantity</label>
                        <input id="quantity_bottle" type="number"
                               class="form-control @error('quantity_bottle') is-invalid @enderror"
                               name="quantity_bottle" value="{{ old('quantity_bottle') }}"
                               autocomplete="quantity_bottle" autofocus>

                        @error('quantity_bottle')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cork" class="col-md-4 col-form-label ">Cork</label>
                        <select id="cork"
                                class="form-control" name="cork">

                            @foreach($corks as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_cork" class="col-md-4 col-form-label ">Cork: Quantity</label><input
                            id="quantity_cork" type="number"
                            class="form-control @error('quantity_cork') is-invalid @enderror"
                            name="quantity_cork" value="{{ old('quantity_cork') }}"
                            autocomplete="quantity_cork" autofocus>

                        @error('quantity_cork')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="capsule" class="col-md-4 col-form-label ">Capsule</label>
                        <select id="capsule"
                                class="form-control" name="capsule">

                            @foreach($capsules as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_capsule" class="col-md-4 col-form-label ">Capsule: Quantity</label>
                        <input id="quantity_capsule" type="number"
                               class="form-control @error('quantity_capsule') is-invalid @enderror"
                               name="quantity_capsule" value="{{ old('quantity_capsule') }}"
                               autocomplete="quantity_capsule" autofocus>

                        @error('quantity_capsule')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="screw_cap" class="col-md-4 col-form-label ">Screw Cap</label>
                        <select id="screw_cap"
                                class="form-control" name="screw_cap">

                            @foreach($screwCaps as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_screw_cap" class="col-md-4 col-form-label ">Screw Cap:
                            Quantity</label><input id="quantity_screw_cap" type="number"
                                                   class="form-control @error('quantity_screw_cap') is-invalid @enderror"
                                                   name="quantity_screw_cap" value="{{ old('quantity_screw_cap') }}"
                                                   autocomplete="quantity_screw_cap" autofocus>

                        @error('quantity_screw_cap')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="carton" class="col-md-4 col-form-label ">Carton</label>
                        <select id="carton"
                                class="form-control" name="carton">

                            @foreach($cartons as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_carton" class="col-md-4 col-form-label ">Carton: Quantity</label><input
                            id="quantity_carton" type="number"
                            class="form-control @error('quantity_carton') is-invalid @enderror"
                            name="quantity_carton" value="{{ old('quantity_carton') }}"
                            autocomplete="quantity_carton" autofocus>

                        @error('quantity_carton')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="divider" class="col-md-4 col-form-label ">Divider</label>
                        <select id="divider"
                                class="form-control" name="divider">

                            @foreach($dividers as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_divider" class="col-md-4 col-form-label ">Divider: Quantity</label><input
                            id="quantity_divider" type="number"
                            class="form-control @error('quantity_divider') is-invalid @enderror"
                            name="quantity_divider" value="{{ old('quantity_divider') }}"
                            autocomplete="quantity_divider" autofocus>

                        @error('quantity_divider')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="pallet" class="col-md-4 col-form-label ">Pallet</label>
                        <select id="pallet"
                                class="form-control" name="pallet">

                            @foreach($pallets as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_pallet" class="col-md-4 col-form-label ">Pallet: Quantity</label><input
                            id="quantity_pallet" type="number"
                            class="form-control @error('quantity_pallet') is-invalid @enderror"
                            name="quantity_pallet" value="{{ old('quantity_pallet') }}"
                            autocomplete="quantity_pallet" autofocus>

                        @error('quantity_pallet')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
