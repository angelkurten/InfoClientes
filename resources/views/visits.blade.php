@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <container-visits-component :client="{{ $client }}" :visits="{{ $visits }}"></container-visits-component>
    </div>
@endsection
