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
