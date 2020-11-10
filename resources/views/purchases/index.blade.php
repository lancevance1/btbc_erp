@extends('layouts.app')
@section('title', 'Purchase Order')


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
{{--                        <a href="/purchases/create">Create a purchase order</a>--}}
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
{{--                        <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Id</th>--}}
{{--                                <th></th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach ($purchases ?? '' as $tmp)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$tmp->id}}--}}
{{--                                    </td>--}}

{{--                                    <td>--}}
{{--                                        <form action="/purchases/{{$tmp->id}}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-secondary">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
{{--                                   --}}
{{--                                    <td> <button onclick="location.href='/products/{{ $product->id}}/edit'"--}}
{{--                                                 type="button" class="btn btn-secondary">Edit--}}
{{--                                        </button>--}}
{{--                                        <form action="/products/{{$product->id}}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-secondary">Delete</button>--}}
{{--                                        </form></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}


{{--                                    <td colspan="6">--}}
{{--                                        --}}{{--                                            class="collapse show" cpllapse closed--}}
{{--                                        <div  >--}}
{{--                                            <div class="card card-body">--}}



{{--                                                <table class="table">--}}

{{--                                                    <thead>--}}
{{--                                                    <tr>--}}

{{--                                                        <th>Id</th>--}}
{{--                                                        <th>Order Number</th>--}}
{{--                                                        <th>Wine Code</th>--}}
{{--                                                        <th>Run Number</th>--}}
{{--                                                        <th>BAF</th>--}}
{{--                                                        <th>Code</th>--}}
{{--                                                        <th>Supply: BTBC</th>--}}
{{--                                                        <th>Supply: Customers</th>--}}


{{--                                                    </tr>--}}

{{--                                                    </thead>--}}


{{--                                                    <tbody>--}}


{{--                                                    @foreach($tmp->orders as $order)--}}
{{--                                                        @foreach($order->products as $prod)--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{$order->id}}--}}

{{--                                                            </td>--}}
{{--                                                            <td>{{$order->order_number}}</td>--}}
{{--                                                            <td>{{$order->wine_code}}</td>--}}
{{--                                                            <td>{{$order->run_number}}</td>--}}
{{--                                                            <td>{{$order->baf_number}}</td>--}}
{{--                                                            <td>{{$prod->code}}</td>--}}
{{--                                                            <td>{{$prod->pivot->quantity}}</td>--}}
{{--                                                            <td>{{$prod->pivot->quantity_external}}</td>--}}

{{--                                                            <td>--}}

{{--                                                                <button--}}
{{--                                                                    onclick="location.href='/customers/{{ $tmp->id}}/contacts/{{$contact->id}}/edit'"--}}
{{--                                                                    type="button" class="btn btn-secondary">Edit--}}
{{--                                                                </button>--}}

{{--                                                                <form--}}
{{--                                                                    action="/customers/{{$tmp->id}}/contacts/{{$contact->id}}"--}}
{{--                                                                    method="POST">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('DELETE')--}}
{{--                                                                    <button type="submit" class="btn btn-secondary">Delete--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}

{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endforeach--}}

{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}


{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        </div>--}}
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
                                        <th>Expected order Quantity</th>
                                        <th>To be ordered (参考)</th>
                                        <th>To be ordered</th>

                                        <th>Ordered已下订单</th>
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
                                            <td>
                                                    {{$product->order_quantity-$product->current_inventory}}


                                                </td>
                                            <td>
                                                <form action="{{action('PurchaseController@updateOrdered',['id'=>$product->id])}}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input id="to_be_ordered" type="text"
                                                           class="form-control @error('to_be_ordered') is-invalid @enderror"
                                                           name="to_be_ordered" value="{{ old('to_be_ordered')??$product->to_be_ordered}}"
                                                           autocomplete="to_be_ordered" autofocus>

                                                    @error('to_be_ordered')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror

                                                    <div class="row">
                                                        <button type="submit" class="btn btn-primary" >Save</button>
                                                    </div>
                                                </form>

                                                <form action="{{action('PurchaseController@submitOrders',['id'=>$product->id])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                                </form>


                                            </td>


                                            <td>

                                               {{$product->ordered}}

                                            </td>


                                            <td> <button onclick="location.href='/products/{{ $product->id}}/edit'"
                                                         type="button" class="btn btn-secondary">Edit
                                                </button>
                                                <form action="/purchases/export/{{$product->id}}" method="GET">
                                                    @csrf

                                                    <button type="submit" class="btn btn-secondary">Export</button>
                                                </form>



                                                <button onclick="location.href='/products/{{ $product->id}}/edit'"
                                                        type="button" class="btn btn-secondary">Complete
                                                </button>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($purchases ?? '' as $tmp)
                                        <tr>
                                            <td>{{$tmp->id}}
                                            </td>

                                            <td>
                                                <form action="/purchases/{{$tmp->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary">Delete</button>
                                                </form>
                                            </td>
                                            {{--                                   --}}
                                            {{--                                    <td> <button onclick="location.href='/products/{{ $product->id}}/edit'"--}}
                                            {{--                                                 type="button" class="btn btn-secondary">Edit--}}
                                            {{--                                        </button>--}}
                                            {{--                                        <form action="/products/{{$product->id}}" method="POST">--}}
                                            {{--                                            @csrf--}}
                                            {{--                                            @method('DELETE')--}}
                                            {{--                                            <button type="submit" class="btn btn-secondary">Delete</button>--}}
                                            {{--                                        </form></td>--}}
                                        </tr>
                                        <tr>


                                            <td colspan="6">
                                                {{--                                            class="collapse show" cpllapse closed--}}
                                                <div  >
                                                    <div class="card card-body">



                                                        <table class="table">

                                                            <thead>
                                                            <tr>

                                                                {{--                                                        <th>Id</th>--}}
                                                                {{--                                                        <th>Order Number</th>--}}
                                                                {{--                                                        <th>Wine Code</th>--}}
                                                                <th>Run Number</th>
                                                                <th>BAF</th>
                                                                <th>Code</th>
                                                                <th>Supply: BTBC</th>
                                                                <th>Supply: Customers</th>


                                                            </tr>

                                                            </thead>


                                                            <tbody>


                                                            @foreach($tmp->orders as $order)
                                                                @foreach($order->products as $prod)
                                                                    <tr>
                                                                        {{--                                                            <td>{{$order->id}}--}}

                                                                        {{--                                                            </td>--}}
                                                                        {{--                                                            <td>{{$order->order_number}}</td>--}}
                                                                        {{--                                                            <td>{{$order->wine_code}}</td>--}}
                                                                        <td>{{$order->run_number}}</td>
                                                                        <td>{{$order->baf_number}}</td>
                                                                        <td>{{$prod->code}}</td>
                                                                        <td>{{$prod->pivot->quantity}}</td>
                                                                        <td>{{$prod->pivot->quantity_external}}</td>

                                                                        {{--                                                            <td>--}}

                                                                        {{--                                                                <button--}}
                                                                        {{--                                                                    onclick="location.href='/customers/{{ $tmp->id}}/contacts/{{$contact->id}}/edit'"--}}
                                                                        {{--                                                                    type="button" class="btn btn-secondary">Edit--}}
                                                                        {{--                                                                </button>--}}

                                                                        {{--                                                                <form--}}
                                                                        {{--                                                                    action="/customers/{{$tmp->id}}/contacts/{{$contact->id}}"--}}
                                                                        {{--                                                                    method="POST">--}}
                                                                        {{--                                                                    @csrf--}}
                                                                        {{--                                                                    @method('DELETE')--}}
                                                                        {{--                                                                    <button type="submit" class="btn btn-secondary">Delete--}}
                                                                        {{--                                                                    </button>--}}
                                                                        {{--                                                                </form>--}}

                                                                        {{--                                                            </td>--}}
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
