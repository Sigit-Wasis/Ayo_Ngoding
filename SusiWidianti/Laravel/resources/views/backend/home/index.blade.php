@extends('backend.app')

@section('content')

<div class="content-wrapper">
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Jenis Barang</h1>
                </div>
                 <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jenis Barang</li>
                 </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nama jenis barang</th>
      <th scope="col">deskripsi</th>
      <th scope="col">dibuat pada</th>
      <th scope="col">dibuat oleh</th>
    </tr>
  </thead>
  <tbody>
    @foreach($jenisBarang as $jenis)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $jenis->nama_jenis_barang}}</td>
      <td>{{ $jenis->deskripsi_barang}}</td>
      <td>{{ $jenis->craeted_at ?? \Carbon\Carbon::now() }}</td>
      <td>{{ $jenis->craeted_by}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
         </div>
        </div>
    </section>
</div>
@endsection