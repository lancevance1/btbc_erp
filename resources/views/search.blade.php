@extends('layouts.app')
@section('title', 'Search Results')


@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Search Results: {{$count}}

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (count($orders)>0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> <h3>Orders</h3>
                                    <tr>
                                        <th>BAF</th>
                                        <th>Order Number</th>
                                        <th>Wine Code</th>
                                        <th>Run Number</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders ?? '' as $order)
                                        <tr>
                                            <td><a href="/orders/{{$order->id}}">{{$order->baf_number}}</a></td>
                                            <td><a href="/orders/{{$order->id}}">{{$order->order_number}}</a></td>
                                            <td>{{$order->products->where("type","wine")->first()->code??null}}</td>
                                            <td>{{$order->run_number}}</td>

                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->updated_at}}</td>

                                            <td>
                                                {{--                                        <button onclick="location.href='/orders/{{ $order->id}}/pallets/create'"--}}
                                                {{--                                                type="button" class="btn btn-secondary">Create Pallets Specs--}}
                                                {{--                                        </button>--}}
                                                {{--                                        <button onclick="location.href='/orders/{{ $order->id}}/pallets'"--}}
                                                {{--                                                type="button" class="btn btn-secondary">Show Pallets Specs--}}
                                                {{--                                        </button>--}}

                                                <button onclick="location.href='/orders/{{ $order->id}}/edit'"
                                                        type="button" class="btn btn-secondary">Edit
                                                </button>
                                                <form action="/orders/export/{{$order->id}}" method="GET">
                                                    @csrf

                                                    <button type="submit" class="btn btn-secondary">Export </button>
                                                </form>

                                                <form action="/orders/{{$order->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary">Delete </button>
                                                </form>








                                            </td>
                                            {{--                                        <a href="/orders/{{$order->id}}">--}}



                                            {{--                                            <p>Order Number: {{ $order->order_number }}--}}
                                            {{--                                                Wine Code: {{ $order->wine_code }}--}}
                                            {{--                                                Run Number: {{ $order->run_number }}--}}
                                            {{--                                                Created at: {{ $order->created_at }}--}}
                                            {{--                                                Updated at: {{ $order->updated_at }}--}}
                                            {{--                                                --}}{{--{{dd($order->customers->name)}}--}}
                                            {{--                                                Customer Name: {{$order->customers->name ?? null}}--}}

                                            {{--                                                @foreach($order->products as $product)--}}
                                            {{--                                                    {{ $product->type }}: {{ $product->code }}--}}
                                            {{--                                                    Quantity: {{$product->pivot->quantity}}--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </p>--}}
                                            {{--                                            <br/>--}}
                                            {{--                                        </a>--}}
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
@endif
                            @if (count($products)>0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead><h3>Dry Goods</h3>
                                <tr>

                                    <th>Type</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Current Inventory</th>
                                    <th>Order Quantity</th>
                                    <th>To be ordered</th>
                                    <th>Current Inventory Value</th>
                                    <th>Belong to</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products ?? '' as $product)

                                    <tr>



                                        <td>{{$product->type}}

                                        </td>
                                        <td><a href="/products/{{$product->id}}">{{$product->code}}</a>

                                        </td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->cost}}</td>
                                        <td>{{$product->current_inventory}}</td>
                                        <td>{{$product->order_quantity}}</td>
                                        <td>{{$product->to_be_ordered}}</td>
                                        <td>{{$product->cost*$product->current_inventory}}</td>
                                        <td>{{$product->belong_to}}</td>
                                        <td> <button onclick="location.href='/products/{{ $product->id}}/edit'"
                                                     type="button" class="btn btn-secondary">Edit
                                            </button>
                                            <form action="/products/{{$product->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary">Delete</button>
                                            </form></td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

@endif

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
