@extends('layouts.app')
@section('title', 'Orders')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        <a href="/orders/create">new order</a>
                        Total Orders: {{$total_orders ?? ''}}

                        {{--                        <a href="/orders/generatePurchase">generate purchase</a>--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

@if(sizeof($orders)!=0)
                        <form action="/orders/generatePurchase" method="GET">
                            @csrf

                            <button type="submit" class="btn btn-secondary">generate purchase order</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
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
                                            <td><input type="checkbox" name="{{$order->id}}"></td>
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

                                                    <button type="submit" class="btn btn-secondary">Export</button>
                                                </form>

                                                <form action="/orders/{{$order->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary">Delete</button>
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

                        </form>
@endif
{{--                        @foreach ($orders_purchase ?? '' as $tmp)--}}
{{--                            <div>--}}
{{--                                {{$tmp->id}}--}}
{{--                                {{$tmp->order_number}}--}}
{{--                                {{$tmp->run_number}}--}}
{{--                                {{$tmp->baf_number}}--}}
{{--                            </div>--}}

{{--                                <form action="/orders/restorePurchase" method="GET">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="btn btn-secondary">restore</button>--}}
{{--                                </form>--}}


{{--                        @endforeach--}}

{{--                           --}}

                            @if(sizeof($purchases)!=0)
                                <div> <h3>Archive</h3></div>
                            @foreach ($purchases ?? '' as $tmp)

                                <div class="table-responsive ">
                                    <table class="table">
                                        <thead>
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
                                        @foreach ($tmp->orders ?? '' as $order)
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

                                                        <button type="submit" class="btn btn-secondary">Export</button>
                                                    </form>

                                                    <form action="/orders/{{$order->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-secondary">Delete</button>
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

                                <form action="/orders/restorePurchase/{{$tmp->id}}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">restore</button>
                                </form>


                            @endforeach

@endif



                        @foreach ($orders_soft_deleted ?? '' as $tmp)
                            {{$tmp}}
                            <form action="{{action('OrderController@reverse',['id'=>$tmp->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary">Restore {{$tmp->id}}</button>
                            </form>
                            <form action="{{action('OrderController@forceDestroy',['id'=>$tmp->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Permanently delete {{$tmp->id}}</button>
                            </form>
                        @endforeach
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        {{--    {{$name ?? ''}}--}}
        <div class="row">
            <div class="col-3"></div>
        </div>
    </div>
@endsection
