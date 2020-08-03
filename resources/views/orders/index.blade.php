@extends('layouts.app')
@section('title', 'Orders')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        Orders<a href="/orders/create">new order</a>
                        Total Orders: {{$total_orders ?? ''}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif





                        @foreach ($orders ?? '' as $order)
                            <form action="/orders/{{$order->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Delete {{$order->id}}</button>
                            </form>

                            <button onclick="location.href='/orders/{{ $order->id}}/edit'"
                                    type="button" class="btn btn-secondary">Edit
                            </button>

                                <a href="{{action('OrderController@export',['id'=>$order->id])}}">Export</a>

                            <a href="/orders/{{$order->id}}">
                                <p>Order Number: {{ $order->order_number }}
                                    Wine Code: {{ $order->wine_code }}
                                    Run Number: {{ $order->run_number }}
                                    Created at: {{ $order->created_at }}
                                    Updated at: {{ $order->updated_at }}
{{--{{dd($order->customers->name)}}--}}
                                    Customer Name: {{$order->customers->name ?? null}}

                                    @foreach($order->products as $product)
                                        {{ $product->type }}: {{ $product->code }}
                                        Quantity: {{$product->pivot->quantity}}
                                    @endforeach
                                </p>
                                <br/>
                            </a>

                        @endforeach

                            @foreach ($orders_soft_deleted ?? '' as $tmp)
                                {{$tmp}}
                                <form action="{{action('OrderController@reverse',['id'=>$tmp->id])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-secondary" >Restore {{$tmp->id}}</button>
                                </form>
                                <form action="{{action('OrderController@forceDestroy',['id'=>$tmp->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary" >Permanently delete {{$tmp->id}}</button>
                                </form>
                            @endforeach
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
