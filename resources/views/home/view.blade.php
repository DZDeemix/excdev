@extends('layouts.app')

@section('content')
    <user-component link="{{route('transactions.show')}}"></user-component>
@endsection
