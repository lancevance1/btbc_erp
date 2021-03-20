@extends('layouts.app')
@section('title', 'Create Order')

@section('content')
    <div class="container">

        <form action="/orders" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Bottling Approval Form (BAF)</h1>
                    </div>
                    <ul>
                        <li>
                            <a href="#Customer-Information"> Customer Information</a>
                        </li>
                        <li>
                            <a href="#Order-Information"> Order Information</a>
                        </li>
                        <li>
                            <a href="#Drygoods-Information"> Dry Goods Information</a>
                        </li>
                        <li>
                            <a href="#Pallet-Information"> Pallet Information</a>
                        </li>
                    </ul>


                    <div class="row">
                        <h3 id="Customer-Information">Customer Information</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="customer_id" class=" col-form-label ">Customer *</label>

                            <select id="customer_id"
                                    class="form-control @error('customer_id') is-invalid @enderror" name="customer_id">
                                <option value="">Please select...</option>
                                @foreach($customers as $tmp)
                                    <option value='{{$tmp->id}}'
                                            @if (old('customer_id') == $tmp->id ) selected="selected" @endif>
                                        {{$tmp->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <h3 id="Order-Information">Order Information</h3>
                    </div>
                    <div class="form-group row">

                        <div class="col">
                            <label for="baf_number" class="col-form-label ">BAF Number</label>
                            <input id="baf_number" type="text"
                                   class="form-control @error('baf_number') is-invalid @enderror"
                                   name="baf_number" value="{{ old('baf_number') }}"
                                   autocomplete="baf_number" autofocus
                                   placeholder="BA123">

                            @error('baf_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="order_number" class=" col-form-label ">Order No.</label>
                            <input id="order_number" type="text"
                                   class="form-control @error('order_number') is-invalid @enderror"
                                   name="order_number" value="{{ old('order_number') }}"
                                   autocomplete="order_number" autofocus>

                            @error('order_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col">
                            <label for="run_number" class="col-form-label ">Run No.</label>
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
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col">
                            <label for="cases_required" class=" col-form-label ">Cases Required</label>
                            <input id="cases_required" type="number"
                                   class="form-control @error('cases_required') is-invalid @enderror"
                                   name="cases_required" value="{{ old('cases_required') }}"
                                   autocomplete="cases_required" autofocus>

                            @error('cases_required')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="samples_required" class=" col-form-label ">Samples Required</label>
                            <input id="samples_required" type="number"
                                   class="form-control @error('samples_required') is-invalid @enderror"
                                   name="samples_required" value="{{ old('samples_required') ??0}}"
                                   autocomplete="samples_required" autofocus>

                            @error('samples_required')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="pack_size" class=" col-form-label ">Pack Size (750ml)</label>
                            <input id="pack_size" type="number"
                                   class="form-control @error('pack_size') is-invalid @enderror"
                                   name="pack_size" value="{{ old('pack_size')?? 6 }}"
                                   autocomplete="pack_size" autofocus>

                            @error('pack_size')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="run_length" class=" col-form-label ">Run Length</label>
                            <select id="run_length"
                                    class="form-control" name="run_length">

                                <option value="">Please select...</option>
                                <option value='Exact Cases'
                                        @if (old('run_length') == 'Exact Cases') selected="selected" @endif>
                                    Exact Cases
                                </option>
                                <option value='Run Out Labels'
                                        @if (old('run_length') == 'Run Out Labels') selected="selected" @endif>
                                    Run Out Labels
                                </option>
                                <option value='Run Out Glass'
                                        @if (old('run_length') == 'Run Out Glass') selected="selected" @endif>
                                    Run Out Glass
                                </option>
                                <option value='Run Out Cartons'
                                        @if (old('run_length') == 'Run Out Cartons') selected="selected" @endif>
                                    Run Out Cartons
                                </option>
                                <option value='Run Out Caps'
                                        @if (old('run_length') == 'Run Out Caps') selected="selected" @endif>
                                    Run Out Caps
                                </option>
                                <option value='Run Out Corks'
                                        @if (old('run_length') == 'Run Out Corks') selected="selected" @endif>
                                    Run Out Corks
                                </option>


                            </select>
                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col">
                            <label for="COA" class="col-form-label ">COA</label>
                            <select id="COA"
                                    class="form-control" name="COA">

                                <option value='1' @if (old('COA') == '1') selected="selected" @endif>
                                    YES
                                </option>
                                <option value='0' @if (old('COA') == '0') selected="selected" @endif>
                                    NO
                                </option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="LIP" class=" col-form-label ">LIP</label>
                            <select id="LIP"
                                    class="form-control" name="LIP">


                                <option value='1' @if (old('LIP') == '1') selected="selected" @endif>
                                    YES
                                </option>
                                <option value='0' @if (old('LIP') == '0') selected="selected" @endif>
                                    NO
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="do2" class=" col-form-label ">DO2 %</label>
                            <input id="do2" type="number" placeholder="Insert..." step="0.1"
                                   class="form-control @error('do2') is-invalid @enderror"
                                   name="do2" value="{{ old('do2') }}"
                                   autocomplete="do2" autofocus>

                            @error('do2')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="col">
                            <label for="additives" class=" col-form-label ">Additives</label>
                            <input id="additives" type="text"
                                   class="form-control @error('additives') is-invalid @enderror"
                                   name="additives" value="{{ old('additives') }}"
                                   autocomplete="additives" autofocus>

                            @error('additives')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="alc_on_label" class=" col-form-label ">Alc% on Label</label>
                            <input id="alc_on_label" type="number" placeholder="Insert..." step="0.1"
                                   class="form-control @error('alc_on_label') is-invalid @enderror"
                                   name="alc_on_label" value="{{ old('alc_on_label') }}"
                                   autocomplete="alc_on_label" autofocus>

                            @error('alc_on_label')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="alc_in_tank" class=" col-form-label ">Alc% in Tank</label>
                            <input id="alc_in_tank" type="number" placeholder="Insert..." step="0.1"
                                   class="form-control @error('alc_in_tank') is-invalid @enderror"
                                   name="alc_in_tank" value="{{ old('alc_in_tank') }}"
                                   autocomplete="alc_in_tank" autofocus>

                            @error('alc_in_tank')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="turbidity" class=" col-form-label ">Turbidity</label>
                            <input id="turbidity" type="number" placeholder="Insert..." step="0.1"
                                   class="form-control @error('turbidity') is-invalid @enderror"
                                   name="turbidity" value="{{ old('turbidity') }}"
                                   autocomplete="turbidity" autofocus>

                            @error('turbidity')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="required_by" class=" col-form-label ">Required By</label>
                            <input id="required_by" type="date"
                                   class="form-control @error('required_by') is-invalid @enderror"
                                   name="required_by" value="{{ old('required_by') }}"
                                   autocomplete="required_by" autofocus>

                            @error('required_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="delivered_by" class=" col-form-label ">Delivered By</label>
                            <input id="delivered_by" type="date"
                                   class="form-control @error('delivered_by') is-invalid @enderror"
                                   name="delivered_by" value="{{ old('delivered_by') }}"
                                   autocomplete="delivered_by" autofocus>

                            @error('delivered_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group row">
                        <h3 id="Drygoods-Information">Dry Goods Information</h3>
                    </div>


                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="wine">Wine</label>
                            <select id="wine"
                                    class="form-control @error('wine') is-invalid @enderror" name="wine"
                            >
                                <option value="">Please select...</option>
                                @foreach($wines as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('wine') == $product->id) selected="selected" @endif>

                                        {{$product->code}}
                                    </option>

                                @endforeach
                            </select>
                            @error('wine')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="quantity_wine">Supply: BTBC</label>
                            <input id="quantity_wine" type="number"
                                   class="form-control @error('quantity_wine') is-invalid @enderror"
                                   name="quantity_wine" value="{{ old('quantity_wine') }}"
                                   autocomplete="quantity_wine" autofocus
                                   placeholder="Insert quantity, e.g. 123">

                            @error('quantity_wine')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_wine_external">Supply: Customer</label>
                            <input id="quantity_wine_external" type="number"
                                   class="form-control @error('quantity_wine_external') is-invalid @enderror"
                                   name="quantity_wine_external" value="{{ old('quantity_wine_external') }}"
                                   autocomplete="quantity_wine_external" autofocus
                                   placeholder="Insert quantity, e.g. 123">

                            @error('quantity_wine_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">

                            <label for="bottle" class=" col-form-label ">Bottle</label>
                            <select id="bottle"
                                    class="form-control @error('bottle') is-invalid @enderror" name="bottle">
                                <option value="">Please select...</option>
                                @foreach($bottles as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('bottle') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('bottle')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div><div class="form-group col-md-3">

                            <label for="quantity_bottle" class=" col-form-label ">Supply: BTBC</label>
                            <input id="quantity_bottle" type="number"
                                   class="form-control @error('quantity_bottle') is-invalid @enderror"
                                   name="quantity_bottle" value="{{ old('quantity_bottle') }}"
                                   autocomplete="quantity_bottle" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_bottle')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">

                            <label for="quantity_bottle_external" class=" col-form-label ">Supply: customer</label>
                            <input id="quantity_bottle_external" type="number"
                                   class="form-control @error('quantity_bottle_external') is-invalid @enderror"
                                   name="quantity_bottle_external" value="{{ old('quantity_bottle_external') }}"
                                   autocomplete="quantity_bottle" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_bottle_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="cork" class="col-form-label ">Cork</label>
                            <select id="cork"
                                    class="form-control @error('cork') is-invalid @enderror" name="cork">
                                <option value="">Please select...</option>
                                @foreach($corks as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('cork') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('cork')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_cork" class="col-form-label ">Supply: BTBC</label><input
                                id="quantity_cork" type="number"
                                class="form-control @error('quantity_cork') is-invalid @enderror"
                                name="quantity_cork" value="{{ old('quantity_cork') }}"
                                autocomplete="quantity_cork" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_cork')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_cork_external" class=" col-form-label ">Supply: Customer</label><input
                                id="quantity_cork_external" type="number"
                                class="form-control @error('quantity_cork_external') is-invalid @enderror"
                                name="quantity_cork_external" value="{{ old('quantity_cork_external') }}"
                                autocomplete="quantity_cork_external" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_cork_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">

                            <label for="capsule" class=" col-form-label ">Capsule</label>
                            <select id="capsule"
                                    class="form-control @error('capsule') is-invalid @enderror" name="capsule">
                                <option value="">Please select...</option>
                                @foreach($capsules as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('capsule') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('capsule')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">

                            <label for="quantity_capsule" class=" col-form-label ">Supply: BTBC</label>
                            <input id="quantity_capsule" type="number"
                                   class="form-control @error('quantity_capsule') is-invalid @enderror"
                                   name="quantity_capsule" value="{{ old('quantity_capsule') }}"
                                   autocomplete="quantity_capsule" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_capsule')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">

                            <label for="quantity_capsule_external" class=" col-form-label ">Supply: Customer</label>
                            <input id="quantity_capsule_external" type="number"
                                   class="form-control @error('quantity_capsule_external') is-invalid @enderror"
                                   name="quantity_capsule_external" value="{{ old('quantity_capsule_external') }}"
                                   autocomplete="quantity_capsule_external" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_capsule_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">


                            <label for="screw_cap" class="col-form-label ">Screw Cap</label>
                            <select id="screw_cap"
                                    class="form-control @error('screw_cap') is-invalid @enderror" name="screw_cap">
                                <option value="">Please select...</option>
                                @foreach($screwCaps as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('screw_cap') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('screw_cap')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">

                            <label for="quantity_screw_cap" class=" col-form-label ">Supply: BTBC</label><input
                                id="quantity_screw_cap" type="number"
                                class="form-control @error('quantity_screw_cap') is-invalid @enderror"
                                name="quantity_screw_cap"
                                value="{{ old('quantity_screw_cap') }}"
                                autocomplete="quantity_screw_cap" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_screw_cap')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">

                            <label for="quantity_screw_cap_external" class=" col-form-label ">Supply: Customer</label><input
                                id="quantity_screw_cap_external" type="number"
                                class="form-control @error('quantity_screw_cap_external') is-invalid @enderror"
                                name="quantity_screw_cap_external"
                                value="{{ old('quantity_screw_cap_external') }}"
                                autocomplete="quantity_screw_cap_external" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_screw_cap_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="carton" class=" col-form-label ">Carton</label>
                            <select id="carton"
                                    class="form-control @error('carton') is-invalid @enderror" name="carton">
                                <option value="">Please select...</option>
                                @foreach($cartons as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('carton') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('carton')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_carton" class=" col-form-label ">Supply: BTBC</label><input
                                id="quantity_carton" type="number"
                                class="form-control @error('quantity_carton') is-invalid @enderror"
                                name="quantity_carton" value="{{ old('quantity_carton') }}"
                                autocomplete="quantity_carton" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_carton')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_carton_external" class=" col-form-label ">Supply: Customer</label><input
                                id="quantity_carton_external" type="number"
                                class="form-control @error('quantity_carton_external') is-invalid @enderror"
                                name="quantity_carton_external" value="{{ old('quantity_carton_external') }}"
                                autocomplete="quantity_carton_external" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_carton_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>la
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="divider" class=" col-form-label ">Divider</label>
                            <select id="divider"
                                    class="form-control @error('divider') is-invalid @enderror" name="divider">
                                <option value="">Please select...</option>
                                @foreach($dividers as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('divider') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('divider')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">

                            <label for="quantity_divider" class=" col-form-label ">Supply: BTBC</label><input
                                id="quantity_divider" type="number"
                                class="form-control @error('quantity_divider') is-invalid @enderror"
                                name="quantity_divider" value="{{ old('quantity_divider') }}"
                                autocomplete="quantity_divider" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_divider')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">

                            <label for="quantity_divider_external" class=" col-form-label ">Supply: Customer</label><input
                                id="quantity_divider_external" type="number"
                                class="form-control @error('quantity_divider_external') is-invalid @enderror"
                                name="quantity_divider_external" value="{{ old('quantity_divider_external') }}"
                                autocomplete="quantity_divider_external" autofocus placeholder="Insert quantity, e.g. 123">

                            @error('quantity_divider_external')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="carton_labels" class=" col-form-label ">Carton Labels</label>
                            <select id="carton_labels"
                                    class="form-control @error('carton_labels') is-invalid @enderror"
                                    name="carton_labels">

                                <option value='0' @if (old('carton_labels') == '0') selected="selected" @endif>
                                    NO
                                </option>
                                <option value='1' @if (old('carton_labels') == '1') selected="selected" @endif>
                                    YES
                                </option>
                            </select>
                            @error('carton_labels')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="bottle_print" class=" col-form-label ">Bottle Print</label>
                            <input id="bottle_print" type="text"
                                   class="form-control @error('bottle_print') is-invalid @enderror"
                                   name="bottle_print" value="{{ old('bottle_print') ??'LOT/TIME YYYY/MM/DD'}}"
                                   autocomplete="bottle_print" placeholder="LOT/TIME YYYY/MM/DD" autofocus>

                            @error('bottle_print')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5>Bottle Label Height</h5>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col">
                            <label for="neck" class=" col-form-label ">Neck</label>
                            <input id="neck" type="text"
                                   class="form-control @error('neck') is-invalid @enderror"
                                   name="neck" value="{{ old('neck') ?? 'BEST FIT'}}"
                                   autocomplete="neck" autofocus>

                            @error('neck')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <small class="text-muted">
                                mm from base of cap center to front label.
                            </small>
                        </div>
                        <div class="form-group col">
                            <label for="front" class=" col-form-label ">Front</label>
                            <input id="front" type="text"
                                   class="form-control @error('front') is-invalid @enderror"
                                   name="front" value="{{ old('front')??'BEST FIT' }}"
                                   autocomplete="front" autofocus>

                            @error('front')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <small class="text-muted">
                                mm from Base of Bottle.
                            </small>
                        </div>


                        <div class="col">
                            <label for="back" class=" col-form-label ">Back</label>
                            <input id="back" type="text"
                                   class="form-control @error('back') is-invalid @enderror"
                                   name="back" value="{{ old('back')??'BEST FIT' }}"
                                   autocomplete="back" autofocus>

                            @error('back')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <small class="text-muted">
                                mm from Base of Bottle or Top of Back label level with front.
                            </small>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col">
                            <label for="bottles_direction" class="col-form-label ">Bottles
                                Direction</label>
                            <select id="bottles_direction"
                                    class="form-control" name="bottles_direction">


                                <option value='upright'
                                        @if (old('bottles_direction') == 'upright') selected="selected" @endif>
                                    Upright
                                </option>
                                <option value='inverted'
                                        @if (old('bottles_direction') == 'inverted') selected="selected" @endif>
                                    Inverted
                                </option>
                                <option value='laydown'
                                        @if (old('bottles_direction') == 'laydown') selected="selected" @endif>
                                    Laydown
                                </option>

                            </select>
                        </div>
                        <div class="col">

                            <label for="cartons_direction" class="col-form-label ">Carton Direction</label>
                            <select id="cartons_direction"
                                    class="form-control" name="cartons_direction">


                                <option value='upright'
                                        @if (old('cartons_direction') == 'upright') selected="selected" @endif>
                                    Upright
                                </option>
                                <option value='inverted'
                                        @if (old('cartons_direction') == 'inverted') selected="selected" @endif>
                                    Inverted
                                </option>
                                o

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <h3 id="Pallet-Information">Pallet Information</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="pallet" class=" col-form-label ">Pallet
                                <type></type>
                            </label>
                            <select id="pallet"
                                    class="form-control @error('pallet') is-invalid @enderror" name="pallet">
                                <option value="">Please select...</option>
                                @foreach($pallets as $product)
                                    <option value='{{$product->id}}'
                                            @if (old('pallet') == $product->id) selected="selected" @endif>
                                        {{$product->code}}
                                    </option>
                                @endforeach
                            </select>
                            @error('pallet')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col">
                            <label for="slip_sheet" class=" col-form-label ">Slip Sheet</label>
                            <select id="slip_sheet"
                                    class="form-control" name="slip_sheet">
                                <option value='1' @if (old('slip_sheet') == '1') selected="selected" @endif>
                                    YES
                                </option>
                                <option value='0' @if (old('slip_sheet') == '0') selected="selected" @endif>
                                    NO
                                </option>

                            </select>
                        </div>
                        <div class="col">

                            <label for="card_board" class="col-form-label ">Card Board</label>
                            <select id="card_board"
                                    class="form-control" name="card_board">

                                <option value='0' @if (old('card_board') == '0') selected="selected" @endif>
                                    NO
                                </option>
                                <option value='1' @if (old('card_board') == '1') selected="selected" @endif>
                                    YES
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="stretch_wrap" class=" col-form-label ">Stretch Wrap</label>
                            <input id="stretch_wrap" type="text"
                                   class="form-control @error('stretch_wrap') is-invalid @enderror"
                                   name="stretch_wrap" value="{{ old('stretch_wrap')??'Std' }}"
                                   autocomplete="stretch_wrap" autofocus>

                            @error('stretch_wrap')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="cont_size" class=" col-form-label ">Cont.Size</label>
                            <input id="cont_size" type="text"
                                   class="form-control @error('cont_size') is-invalid @enderror"
                                   name="cont_size" value="{{ old('cont_size')??'20FT' }}"
                                   autocomplete="cont_size" autofocus>

                            @error('cont_size')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
