@extends('backend.app')
@section('title', 'Beranda')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <marquee behavior="scroll" direction="left" scrollamount="30" style="font-size: 200px;">
            INFO JUDUL SKRIPSI 😫
        </marquee>
    </section>
</div>

@endsection
