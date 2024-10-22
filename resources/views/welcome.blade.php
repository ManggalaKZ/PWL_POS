{{-- JS05
Praktikum 2 --}}

@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, anda login sebagai --{{auth()->user()->nama}}--</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        Berikut ini adalah beberapa data anda
        <br>
        Username {{auth()->user()->username}}
        <br>
        Nama {{auth()->user()->nama}}
        <br>
        level {{auth()->user()->level->level_nama}}
    </div>
</div>

@endsection