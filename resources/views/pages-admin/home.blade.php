@extends('layout-backend.default')
@section('content')
	<h1 class="text-center">- HOLAHALO KATALOG -</h1>
	<div style="text-align: center;">Hello, {{ Auth::user()->name }}</div>
	<a href="{{ url('/') }}"><input type="button" class="btn btn-success" value="LIHAT PRODUK"></a>
@stop