@extends('layouts.app')
@section('title', 'Dry Goods')


@section('content')

    <script src="{{ asset('js/test.js')}}"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/products/create">Create a dry good</a>

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="table-responsive">
                        <table class="table">
                            <thead>
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


                    </div>

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
