@extends('layouts.appl')

@section('content')

    @if(count($datas1)>0)
        <ul class="list-group">
            @foreach($datas1 as $datas)
                <li class="list-group-item">{{$datas}}</li>
            @endforeach
        </ul>
    @endif

@endsection