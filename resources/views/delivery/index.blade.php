@extends('layouts.app')
@section('title', 'Delivery')


@section('content')

    <script src="{{ asset('js/test.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Logbook
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
                                <th>ID</th>
                                <th>name</th>
                                <th>Ordered Quantity</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($del ?? '' as $tmp)
                                @foreach ($tmp->products ?? '' as $prod)
                                <tr>
                                    <td>{{$tmp->id}}
                                    </td>
                                    <td>{{$prod->code}}
                                    </td>

                                    <td>

                                        {{$prod->pivot->change}}

                                    </td>

                                    <td>{{$tmp->created_at}}
                                    </td>
                                    <td>{{$tmp->updated_at}}
                                    </td>

                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $del->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
