@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<p>Hello {{ $user->name }}, Have a Nice Day!
Kamu login sebagai {{ $user->jabatan }}
@stop

@section('footer')
    <strong>Copyright © <a href="http://Impellink.net" style="text-decoration: none">Biozatix.Net</a></strong>.
    All rights reserved.    
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop