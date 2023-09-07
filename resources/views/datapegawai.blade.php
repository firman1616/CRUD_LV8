<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="
        https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css
        " rel="stylesheet">

    <title>CRUD LARAVEL</title>
</head>

<body>
    <h1 class="text-center mb-4">Data Pegawai</h1>

    <div class="container">
        <a href="/tambahpegawai" class="btn btn-info">Tambah Data</a>
        <br><br>
        <div class="row g-3 align-items-center">

            <div class="col-auto">
                <form action="/pegawai" method="get">
                    <input type="search" name="search" id="cari" class="form-control"
                        aria-describedby="passwordHelpInline">
                </form>
            </div>
        </div>
        <br>
        <a href="/exportpdf" class="btn btn-success">Export PDF</a>
        <a href="/exportexcel" class="btn btn-success">Export Excel</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Import data Pegawai
        </button>

        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif --}}
        <div class="row">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Telephone</th>
                        <th scope="col">Dibuat</th>
                        <th scope="col">Action</th>
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
                                <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}">Hapus</a>
                                {{-- delete/{{ $row->id }} --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/importexcel" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
</body>
<script>
    $('.delete').on('click', function(params) {
        var idPegawai = $(this).attr('data-id');
        Swal.fire({
            title: 'Yakin Akan Menghapus Data?',
            text: "Data dengan ID " + idPegawai + " akan dihapus ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/delete/" + idPegawai +
                    Swal.fire(
                        'Deleted!',
                        'Data Berhasil terhapus',
                        'success'
                    )
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Data tidak jadi dihapus',
                })
            }
        })
    })
</script>

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Congrats');
    @endif
</script>

</html>
