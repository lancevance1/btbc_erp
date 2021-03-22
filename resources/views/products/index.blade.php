@extends('layouts.app')
@section('title', 'Dry Goods')


@section('content')

    <script src="{{ asset('js/test.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/products/create">Create new dry good</a>
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

                                <th>Current Inventory</th>
                                <th>Order Quantity</th>
                                <th>To be ordered</th>
                                <th>Current Inventory Value</th>
                                <th>Suppliers</th>
                                <th>Cost</th>
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

                                    <td>{{$product->current_inventory}}</td>
                                    <td>{{$product->order_quantity}}</td>
                                    <td>{{$product->to_be_ordered}}</td>
                                    <td>{{$product->cost*$product->current_inventory}}</td>

                                    @foreach($product->suppliers as $tmp)
                                        @if($tmp->pivot->isChosen == true)
                                    <td> <form action="/products/changeSupplier/{{$product->id}}" method="POST">
                                            <div class="form-group row"><select id="supplier"
                                                class="form-control @error('supplier') is-invalid @enderror" name="supplier"
                                        >

                                            @foreach($product->suppliers as $sup)

                                                @if($sup->pivot->isChosen == true)
                                                    <option value='{{$sup->id}}'
                                                            selected="selected">

                                                        {{$sup->name}}
                                                    </option>
                                                @else
                                                    <option value='{{$sup->id}}'
                                                    >

                                                        {{$sup->name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                            </select></div>



                                            @csrf
                                                @method('PATCH')
                                            <button type="submit" class="btn btn-primary">Change</button>
                                        </form>

                                    </td>


                                            <td>{{$tmp->pivot->price}}</td>

                                        @endif

                                    @endforeach
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
