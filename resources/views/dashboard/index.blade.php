@extends('layouts.app')
@section('title', 'Dashboard')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Welcome {{$user->name ?? ''}} <br/>
                    Dashboard<a href="/orders/create">new order</a>
                    Total Orders: {{$total_orders}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif





                        @foreach ($orders as $order)
                            <a href="/orders/{{$order->id}}">
                                <p>Order Number: {{ $order->order_number }}
                                    Wine Code: {{ $order->wine_code }}
                                    Run Number: {{ $order->run_number }}
                                    Created at: {{ $order->created_at }}
                                    Updated at: {{ $order->updated_at }}</p>
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
