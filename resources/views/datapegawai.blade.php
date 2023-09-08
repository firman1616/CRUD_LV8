@extends('layout.admin');

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pegawai</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pegawai</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="/tambahpegawai" class="btn btn-info">Tambah Data</a>
                    <a href="/exportpdf" class="btn btn-success">Export PDF</a>
                    <a href="/exportexcel" class="btn btn-success">Export Excel</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import data Pegawai
                    </button>
                    <div class="row g-3 align-items-center">

                        <div class="col-auto">
                            <form action="/pegawai" method="get">
                                <input type="search" name="search" id="cari" class="form-control"
                                    aria-describedby="passwordHelpInline">
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th style="width: 40px">No Telphone</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($data as $index => $row)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>{{ $row->nama }}</td>
                                    <td><img src="{{ asset('fotopegawai/' . $row->foto) }}" style="width: 40px"></td>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->no_telp }}</td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="tampilkandata/{{ $row->id }}" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger delete"
                                            data-id="{{ $row->id }}">Hapus</a>
                                        {{-- delete/{{ $row->id }} --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>


    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif --}}
@endsection
