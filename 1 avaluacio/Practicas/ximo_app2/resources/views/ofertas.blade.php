@extends('layouts.app')

@section('content')
    @include('partials.navbar')

    <h1>Ofertas</h1>
    @include('partials.catalogo', ['productos' => $productos])

    
@endsection
