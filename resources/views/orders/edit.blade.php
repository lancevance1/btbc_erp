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
                        <label for="customer_id" class="col-md-4 col-form-label ">Customer</label>
                        <select id="customer_id"
                                class="form-control" name="customer_id">
                            <option value="{{ $current_customer->id ?? null }}">
                                Old value: {{ $current_customer->name ?? null}}
                            </option>
                            @foreach($customers as $tmp)
                                <option value='{{$tmp->id}}'>
                                    {{$tmp->name}}
                                </option>
                            @endforeach
                        </select>

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


{{--                        <label for="wine_code" class="col-md-4 col-form-label ">Wine Code</label>--}}
{{--                        <input id="wine_code" type="text"--}}
{{--                               class="form-control @error('wine_code') is-invalid @enderror"--}}
{{--                               name="wine_code" value="{{ old('wine_code') ??$order->wine_code }}"--}}
{{--                                autocomplete="wine code" autofocus>--}}

{{--                        @error('wine_code')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}

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

                        <label for="baf_number" class="col-md-4 col-form-label ">BAF Number</label>
                        <input id="baf_number" type="text"
                               class="form-control @error('baf_number') is-invalid @enderror"
                               name="baf_number" value="{{ old('baf_number') ??$order->baf_number}}"
                               autocomplete="baf_number" autofocus placeholder="BA123">

                        @error('baf_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cases_required" class="col-md-4 col-form-label ">Cases Required</label>
                        <input id="cases_required" type="number"
                               class="form-control @error('cases_required') is-invalid @enderror"
                               name="cases_required" value="{{ old('cases_required') ??$order->cases_required}}"
                               autocomplete="cases_required" autofocus>

                        @error('cases_required')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="samples_required" class="col-md-4 col-form-label ">Samples Required</label>
                        <input id="samples_required" type="number"
                               class="form-control @error('samples_required') is-invalid @enderror"
                               name="samples_required" value="{{ old('samples_required') ??$order->samples_required}}"
                               autocomplete="samples_required" autofocus>

                        @error('samples_required')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror



                        <label for="pack_size" class="col-md-4 col-form-label ">Pack Size</label>
                        <input id="pack_size" type="number"
                               class="form-control @error('pack_size') is-invalid @enderror"
                               name="pack_size" value="{{ old('pack_size') ??$order->pack_size}}"
                               autocomplete="pack_size" autofocus>

                        @error('pack_size')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="do2" class="col-md-4 col-form-label ">DO2 %</label>
                        <input id="do2" type="number" placeholder="Insert..." step="0.1"
                               class="form-control @error('do2') is-invalid @enderror"
                               name="do2" value="{{ old('do2')??$order->do2 }}"
                               autocomplete="do2" autofocus>

                        @error('do2')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="additives" class="col-md-4 col-form-label ">Additives</label>
                        <input id="additives" type="text"
                               class="form-control @error('additives') is-invalid @enderror"
                               name="additives" value="{{ old('additives')??$order->additives }}"
                               autocomplete="additives" autofocus>

                        @error('additives')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="alc_on_label" class="col-md-4 col-form-label ">Alc% on Label</label>
                        <input id="alc_on_label" type="number" placeholder="Insert..." step="0.1"
                               class="form-control @error('alc_on_label') is-invalid @enderror"
                               name="alc_on_label" value="{{ old('alc_on_label') ??$order->alc_on_label}}"
                               autocomplete="alc_on_label" autofocus>

                        @error('alc_on_label')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="alc_in_tank" class="col-md-4 col-form-label ">Alc% in Tank</label>
                        <input id="alc_in_tank" type="number" placeholder="Insert..." step="0.1"
                               class="form-control @error('alc_in_tank') is-invalid @enderror"
                               name="alc_in_tank" value="{{ old('alc_in_tank') ??$order->alc_in_tank}}"
                               autocomplete="alc_in_tank" autofocus>

                        @error('alc_in_tank')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="turbidity" class="col-md-4 col-form-label ">Turbudity</label>
                        <input id="turbidity" type="number" placeholder="Insert..." step="0.1"
                               class="form-control @error('turbidity') is-invalid @enderror"
                               name="turbidity" value="{{ old('turbidity') ??$order->turbidity}}"
                               autocomplete="turbidity" autofocus>

                        @error('turbidity')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="required_by" class="col-md-4 col-form-label ">Required By</label>
                        <input id="required_by" type="date"
                               class="form-control @error('required_by') is-invalid @enderror"
                               name="required_by" value="{{ old('required_by') ??$order->required_by}}"
                               autocomplete="required_by" autofocus>

                        @error('required_by')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="delivered_by" class="col-md-4 col-form-label ">Delivered By</label>
                        <input id="delivered_by" type="date"
                               class="form-control @error('delivered_by') is-invalid @enderror"
                               name="delivered_by" value="{{ old('delivered_by') ??$order->delivered_by}}"
                               autocomplete="delivered_by" autofocus>

                        @error('delivered_by')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="carton_labels" class="col-md-4 col-form-label ">Carton Labels</label>
                        <select id="carton_labels"
                                class="form-control" name="carton_labels">

                            @if($order->carton_labels === 1)
                                <option value='1'>
                                    Old value: YES
                                </option>
                            @else
                                <option value='0'>
                                    Old value: NO
                                </option>
                            @endif
                            <option value='0'>
                                NO
                            </option>
                            <option value='1'>
                                YES
                            </option>
                        </select>

                        <label for="bottle_print" class="col-md-4 col-form-label ">Bottle Print</label>
                        <input id="bottle_print" type="text"
                               class="form-control @error('bottle_print') is-invalid @enderror"
                               name="bottle_print" value="{{ old('bottle_print') ??$order->bottle_print}}"
                               autocomplete="bottle_print" autofocus>

                        @error('bottle_print')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="neck" class="col-md-4 col-form-label ">Neck</label>
                        <input id="neck" type="text"
                               class="form-control @error('neck') is-invalid @enderror"
                               name="neck" value="{{ old('neck') ??$order->neck}}"
                               autocomplete="neck" autofocus>

                        @error('neck')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="front" class="col-md-4 col-form-label ">Front</label>
                        <input id="front" type="text"
                               class="form-control @error('front') is-invalid @enderror"
                               name="front" value="{{ old('front') ??$order->front}}"
                               autocomplete="front" autofocus>

                        @error('front')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="back" class="col-md-4 col-form-label ">Back</label>
                        <input id="back" type="text"
                               class="form-control @error('back') is-invalid @enderror"
                               name="back" value="{{ old('back') ??$order->back}}"
                               autocomplete="back" autofocus>

                        @error('back')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="bottles_direction" class="col-md-4 col-form-label ">Bottles Direction</label>
                        <select id="bottles_direction"
                                class="form-control" name="bottles_direction">

                            <option value='{{$order->bottles_direction}}'>
                                Old value: {{ucfirst($order->bottles_direction)}}
                            </option>
                            <option value='upright'>
                                Upright
                            </option>
                            <option value='inverted'>
                                Inverted
                            </option>
                            <option value='laydown'>
                                Laydown
                            </option>

                        </select>

                        <label for="cartons_direction" class="col-md-4 col-form-label ">Carton Direction</label>
                        <select id="cartons_direction"
                                class="form-control" name="cartons_direction">


                            <option value='{{$order->cartons_direction}}'>
                                Old value: {{ucfirst($order->cartons_direction)}}
                            </option>
                            <option value='upright'>
                                Upright
                            </option>
                            <option value='inverted'>
                                Inverted
                            </option>
                            o

                        </select>







                        <label for="COA" class="col-md-4 col-form-label ">COA</label>
                        <select id="COA"
                                class="form-control" name="COA">
                            @if($order->COA === 1)
                                <option value='1'>
                                    Old value: YES
                                </option>
                            @else
                                <option value='0'>
                                    Old value: NO
                                </option>
                            @endif
                            <option value='1'>
                                YES
                            </option>
                            <option value='0'>
                                NO
                            </option>
                        </select>

                        <label for="LIP" class="col-md-4 col-form-label ">LIP</label>
                        <select id="LIP"
                                class="form-control" name="LIP">
                            @if($order->LIP === 1)
                                <option value='1'>
                                    Old value: YES
                                </option>
                            @else
                                <option value='0'>
                                    Old value: NO
                                </option>
                            @endif
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
                            <option value="{{ $current_wine->id ?? null }}">
                                Old value: {{ $current_wine->code ?? null}}
                            </option>
                            @foreach($wines as $product)
                                <option value='{{$product->id}}'>
                                    {{$product->code}}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity_wine" class="col-md-4 col-form-label ">Wine: Quantity</label>
                        <input id="quantity_wine" type="number"
                               class="form-control @error('quantity_wine') is-invalid @enderror"
                               name="quantity_wine" value="{{ old('quantity_wine') ??$current_wine->pivot->quantity ?? null}}"
                               autocomplete="quantity_wine" autofocus>

                        @error('quantity_wine')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror



                        <label for="bottle" class="col-md-4 col-form-label ">Bottle</label>
                        <select id="bottle"
                                class="form-control" name="bottle">
                            <option value="{{ $current_bottle->id ?? null}}">
                                Old value: {{ $current_bottle->code ?? null}}
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
                               name="quantity_bottle"
                               value="{{ old('quantity_bottle') ??$current_bottle->pivot->quantity ?? null}}"
                               autocomplete="quantity_bottle" autofocus>

                        @error('quantity_bottle')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cork" class="col-md-4 col-form-label ">Cork</label>
                        <select id="cork"
                                class="form-control" name="cork">
                            <option value="{{ $current_cork->id ?? null}}">
                                Old value: {{ $current_cork->code ?? null}}
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
                            name="quantity_cork" value="{{ old('quantity_cork')??$current_cork->pivot->quantity ?? null}}"
                            autocomplete="quantity_cork" autofocus>

                        @error('quantity_cork')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="capsule" class="col-md-4 col-form-label ">Capsule</label>
                        <select id="capsule"
                                class="form-control" name="capsule">
                            <option value="{{ $current_capsule->id ?? null}}">
                                Old value: {{ $current_capsule->code ?? null}}
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
                               name="quantity_capsule" value="{{ old('quantity_capsule') ??$current_capsule->pivot->quantity?? null}}"
                               autocomplete="quantity_capsule" autofocus>

                        @error('quantity_capsule')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="screw_cap" class="col-md-4 col-form-label ">Screw Cap</label>
                        <select id="screw_cap"
                                class="form-control" name="screw_cap">
                            <option value="{{ $current_screw_cap->id ?? null}}">
                                Old value: {{ $current_screw_cap->code ?? null}}
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
                                                   name="quantity_screw_cap" value="{{ old('quantity_screw_cap') ??$current_screw_cap->pivot->quantity?? null}}"
                                                   autocomplete="quantity_screw_cap" autofocus>

                        @error('quantity_screw_cap')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="carton" class="col-md-4 col-form-label ">Carton</label>
                        <select id="carton"
                                class="form-control" name="carton">
                            <option value="{{ $current_carton->id ?? null}}">
                                Old value: {{ $current_carton->code ?? null}}
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
                            name="quantity_carton" value="{{ old('quantity_carton') ??$current_carton->pivot->quantity?? null}}"
                            autocomplete="quantity_carton" autofocus>

                        @error('quantity_carton')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="divider" class="col-md-4 col-form-label ">Divider</label>
                        <select id="divider"
                                class="form-control" name="divider">
                            <option value="{{ $current_divider->id ?? null}}">
                                Old value: {{ $current_divider->code ?? null}}
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
                            name="quantity_divider" value="{{ old('quantity_divider') ??$current_divider->pivot->quantity?? null}}"
                            autocomplete="quantity_divider" autofocus>

                        @error('quantity_divider')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="pallet" class="col-md-4 col-form-label ">Pallet</label>
                        <select id="pallet"
                                class="form-control" name="pallet">
                            <option value="{{ $current_pallet->id ?? null}}">
                                Old value: {{ $current_pallet->code ?? null}}
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
                            name="quantity_pallet" value="{{ old('quantity_pallet') ??$current_pallet->pivot->quantity?? null}}"
                            autocomplete="quantity_pallet"  autofocus>

                        @error('quantity_pallet')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="run_length" class="col-md-4 col-form-label ">Run Length</label>
                        <select id="run_length"
                                class="form-control" name="run_length">
                            <option value='{{$order->run_length}}'>
                                Old value: {{ucfirst($order->run_length)}}
                            </option>

                            <option value='exact cases'>
                                Exact Cases
                            </option>
                            <option value='run out labels'>
                                Run Out Labels
                            </option>
                            <option value='run out glass'>
                                Run Out Glass
                            </option>
                            <option value='run out cartons'>
                                Run Out Cartons
                            </option>
                            <option value='run out caps'>
                                Run Out Caps
                            </option>
                            <option value='run out corks'>
                                Run Out Corks
                            </option>


                        </select>

                        <label for="slip_sheets" class="col-md-4 col-form-label ">Slip Sheets</label>
                        <select id="slip_sheets"
                                class="form-control" name="slip_sheets">
                            @if($order->slip_sheets === 1)
                                <option value='1'>
                                    Old value: YES
                                </option>
                            @else
                                <option value='0'>
                                    Old value: NO
                                </option>
                            @endif
                            <option value='0'>
                                NO
                            </option>
                            <option value='1'>
                                YES
                            </option>
                        </select>

                        <label for="card_board" class="col-md-4 col-form-label ">Card Board</label>
                        <select id="card_board"
                                class="form-control" name="card_board">

                            @if($order->card_board === 1)
                                <option value='1'>
                                    Old value: YES
                                </option>
                            @else
                                <option value='0'>
                                    Old value: NO
                                </option>
                            @endif
                            <option value='0'>
                                NO
                            </option>
                            <option value='1'>
                                YES
                            </option>
                        </select>

                        <label for="stretch_wrap" class="col-md-4 col-form-label ">Stretch Wrap</label>
                        <input id="stretch_wrap" type="text"
                               class="form-control @error('stretch_wrap') is-invalid @enderror"
                               name="stretch_wrap" value="{{ old('stretch_wrap')??$order->stretch_wrap }}"
                               autocomplete="stretch_wrap" autofocus>

                        @error('stretch_wrap')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="cont_size" class="col-md-4 col-form-label ">Cont.Size</label>
                        <input id="cont_size" type="text"
                               class="form-control @error('cont_size') is-invalid @enderror"
                               name="cont_size" value="{{ old('cont_size')??$order->cont_size }}"
                               autocomplete="cont_size" autofocus>

                        @error('cont_size')
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
