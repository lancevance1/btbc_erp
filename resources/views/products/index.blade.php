@extends('layouts.app')
@section('title', 'Dry Goods')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        Dry Goods<a href="/products/create">create dry good</a>

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
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
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products ?? '' as $product)

                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->type}}</td>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->cost}}</td>
                                    <td>{{$product->current_inventory}}</td>
                                    <td>{{$product->order_quantity}}</td>
                                    <td>{{$product->to_be_ordered}}</td>
                                    <td>{{$product->current_inventory_value}}</td>
                                    <td>{{$product->belong_to}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>{{$product->updated_at}}</td>
                                    <td><form action="/products/{{$product->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete {{$product->id}}</button>
                                        </form>

                                        </td>
                                    <td>
                                        <button onclick="location.href='/products/{{ $product->id}}/edit'"
                                                type="button" class="btn btn-secondary">Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @foreach ($products ?? '' as $product)
                            <form action="/products/{{$product->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Delete {{$product->id}}</button>
                            </form>

                            <button onclick="location.href='/products/{{ $product->id}}/edit'"
                                    type="button" class="btn btn-secondary">Edit
                            </button>

                            <a href="/products/{{$product->id}}">
                                <p>
                                    Type: {{$product->type}}
                                    Code: {{ $product->code }}
                                    Description: {{ $product->description }}
                                    Price: {{ $product->price }}
                                    Cost: {{$product->cost}}
                                    Current Inventory: {{$product->current_inventory}}
                                    Order Quantity: {{$product->order_quantity}}
                                    To be ordered: {{$product->to_be_ordered}}
                                    Current Inventory Value: {{$product->current_inventory_value}}
                                    Belong to: {{$product->belong_to}}
                                    Created at: {{ $product->created_at }}
                                    Updated at: {{ $product->updated_at }}</p>
                                <br/>
                            </a>

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
