@extends('layouts.app')
@section('title', 'Show Order')

@section('content')
    <div class="container">
        <form action="/orders/{{ $order->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Delete</button>
        </form>
        <a href="/orders/{{$order->id}}/edit">
            Edit
        </a>
        {{$order}}
        Customer Name: {{$order->customers->name}}
        @foreach($order->products as $tmp)
            Product code: {{$tmp->code}}
            Quantity: {{$tmp->pivot->quantity}}
        @endforeach


    </div>
@endsection
