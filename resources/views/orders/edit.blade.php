@extends('layouts.app')
@section('title', 'Edit Order')

@section('content')
    <div class="container">
        <form action="/orders/{{$order->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Order</h1>
                    </div>
                    <div class="form-group row">
                        <label for="order_number" class="col-md-4 col-form-label ">Order No.</label>
                        <input id="order_number" type="text"
                               class="form-control @error('order_number') is-invalid @enderror"
                               name="order_number" value="{{ old('order_number')??$order->order_number }}"
                                autocomplete="order_number" autofocus>

                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="wine_code" class="col-md-4 col-form-label ">Wine Code</label>
                        <input id="wine_code" type="text"
                               class="form-control @error('wine_code') is-invalid @enderror"
                               name="wine_code" value="{{ old('wine_code') ??$order->wine_code }}"
                                autocomplete="wine code" autofocus>

                        @error('wine_code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="run_number" class="col-md-4 col-form-label ">Run No.</label>
                        <input id="run_number" type="number"
                               class="form-control @error('run_number') is-invalid @enderror"
                               name="run_number" value="{{ old('run_number') ??$order->run_number }}"
                                autocomplete="run number" autofocus
                               placeholder="0000" max="9999" min="1000">

                        @error('run_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                        <label for="bottle" class="col-md-4 col-form-label ">Bottle</label>
                        <select id="bottle"
                                class="form-control" name="bottle">
                            <option value="{{ $current_bottle->id }}">
                                Old value: {{ $current_bottle->code }}
                            </option>
                            @foreach($bottles as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_bottle" class="col-md-4 col-form-label ">Bottle: Quantity</label>
                        <input id="quantity_bottle" type="number"
                               class="form-control @error('quantity_bottle') is-invalid @enderror"
                               name="quantity_bottle" value="{{ old('quantity_bottle') ??$current_bottle->pivot->quantity}}"
                               autocomplete="quantity_bottle" autofocus>

                        @error('quantity_bottle')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cork" class="col-md-4 col-form-label ">Cork</label>
                        <select id="cork"
                                class="form-control" name="cork">
                            <option value="{{ $current_cork->id }}">
                                Old value: {{ $current_cork->code }}
                            </option>
                            @foreach($corks as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_cork" class="col-md-4 col-form-label ">Cork: Quantity</label><input
                            id="quantity_cork" type="number"
                            class="form-control @error('quantity_cork') is-invalid @enderror"
                            name="quantity_cork" value="{{ old('quantity_cork')??$current_cork->pivot->quantity }}"
                            autocomplete="quantity_cork" autofocus>

                        @error('quantity_cork')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="capsule" class="col-md-4 col-form-label ">Capsule</label>
                        <select id="capsule"
                                class="form-control" name="capsule">
                            <option value="{{ $current_capsule->id }}">
                                Old value: {{ $current_capsule->code }}
                            </option>
                            @foreach($capsules as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_capsule" class="col-md-4 col-form-label ">Capsule: Quantity</label>
                        <input id="quantity_capsule" type="number"
                               class="form-control @error('quantity_capsule') is-invalid @enderror"
                               name="quantity_capsule" value="{{ old('quantity_capsule') ??$current_capsule->pivot->quantity}}"
                               autocomplete="quantity_capsule" autofocus>

                        @error('quantity_capsule')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="screw_cap" class="col-md-4 col-form-label ">Screw Cap</label>
                        <select id="screw_cap"
                                class="form-control" name="screw_cap">
                            <option value="{{ $current_screw_cap->id }}">
                                Old value: {{ $current_screw_cap->code }}
                            </option>
                            @foreach($screwCaps as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_screw_cap" class="col-md-4 col-form-label ">Screw Cap:
                            Quantity</label><input id="quantity_screw_cap" type="number"
                                                   class="form-control @error('quantity_screw_cap') is-invalid @enderror"
                                                   name="quantity_screw_cap" value="{{ old('quantity_screw_cap') ??$current_screw_cap->pivot->quantity}}"
                                                   autocomplete="quantity_screw_cap" autofocus>

                        @error('quantity_screw_cap')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="carton" class="col-md-4 col-form-label ">Carton</label>
                        <select id="carton"
                                class="form-control" name="carton">
                            <option value="{{ $current_carton->id }}">
                                Old value: {{ $current_carton->code }}
                            </option>
                            @foreach($cartons as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_carton" class="col-md-4 col-form-label ">Carton: Quantity</label><input
                            id="quantity_carton" type="number"
                            class="form-control @error('quantity_carton') is-invalid @enderror"
                            name="quantity_carton" value="{{ old('quantity_carton') ??$current_carton->pivot->quantity}}"
                            autocomplete="quantity_carton" autofocus>

                        @error('quantity_carton')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="divider" class="col-md-4 col-form-label ">Divider</label>
                        <select id="divider"
                                class="form-control" name="divider">
                            <option value="{{ $current_divider->id }}">
                                Old value: {{ $current_divider->code }}
                            </option>
                            @foreach($dividers as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_divider" class="col-md-4 col-form-label ">Divider: Quantity</label><input
                            id="quantity_divider" type="number"
                            class="form-control @error('quantity_divider') is-invalid @enderror"
                            name="quantity_divider" value="{{ old('quantity_divider') ??$current_divider->pivot->quantity}}"
                            autocomplete="quantity_divider" autofocus>

                        @error('quantity_divider')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="pallet" class="col-md-4 col-form-label ">Pallet</label>
                        <select id="pallet"
                                class="form-control" name="pallet">
                            <option value="{{ $current_pallet->id }}">
                                Old value: {{ $current_pallet->code }}
                            </option>
                            @foreach($pallets as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_pallet" class="col-md-4 col-form-label ">Pallet: Quantity</label><input
                            id="quantity_pallet" type="number"
                            class="form-control @error('quantity_pallet') is-invalid @enderror"
                            name="quantity_pallet" value="{{ old('quantity_pallet') ??$current_pallet->pivot->quantity}}"
                            autocomplete="quantity_pallet"  autofocus>

                        @error('quantity_pallet')
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
