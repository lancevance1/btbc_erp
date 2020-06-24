@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <a href="#">new order</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{$user->name ?? ''}} You are logged in!

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
