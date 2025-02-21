@extends('layouts.backend.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header ml-4 mr-4">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content ml-4 mr-4">
            <div class="container-fluid">
                <img src="{{ asset('photo/bg-dashboard.png') }}" style="width: 100%;" class="mb-4">
                <div class="card">
                    <div class="card-header">
                        Tahun Ajaran dan Semester yang sedang berjalan
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->role_id == 1)
                            <form method="post" action="/admin/current_semester/update/{{ $current_semester->id }}">
                                @csrf
                                @method('put')
                                <div class="form-row align-items-center">
                                    <div class="row">
                                        <div class="col-auto">
                                            <label class="sr-only" for="tahun_ajaran">Tahun Ajaran</label>
                                            <input type="text" class="form-control mb-2" id="tahun_ajaran"
                                                name="tahun_ajaran" value="{{ $current_semester->tahun_ajaran }}">
                                            @error('tahun_ajaran')
                                                <div id="tahun_ajaran_error" class="text-danger text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-auto">
                                            <label class="sr-only" for="semester">Semester</label>
                                            <div class="input-group mb-2">
                                                <select name="semester" id="semester" class="form-control">
                                                    <option value="" disabled>Pilih Semester</option>
                                                    <option value="Ganjil"
                                                        @if ($current_semester->semester == 'Ganjil') selected @endif>
                                                        Ganjil
                                                    </option>
                                                    <option value="Genap"
                                                        @if ($current_semester->semester == 'Genap') selected @endif>
                                                        Genap
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <h3>Tahun ajaran Aktif</h3>
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahTahunAjaranModal">Tambah Tahun Ajaran</button>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="tambahTahunAjaranModal" tabindex="-1" aria-labelledby="tambahTahunAjaranModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahTahunAjaranModalLabel">Tambah Data Tahun Ajaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/admin/tahun_ajaran/store" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-hover" id="example1">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tahun Ajaran</th>
                                                <th scope="col">Aktif?</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_tahun_ajaran as $tahun_ajaran)
                                                <tr>
                                                    <th scope="row">{{ $tahun_ajaran->tahun_ajaran }}</th>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input tahun_ajaran" type="checkbox"
                                                                @if ($tahun_ajaran->is_active == 1) checked @endif
                                                                data-tahun_ajaran="{{ $tahun_ajaran->id }}">
                                                        </div>
                                                    </td>
                                                    <td><a href="#" class="badge badge-primary"  data-toggle="modal" data-target="#tambahTahunAjaranModal{{ $tahun_ajaran->id }}">Edit</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <form method="post" action="/admin/current_semester/update/{{ $current_semester->id }}">
                                @csrf
                                @method('put')
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label class="sr-only" for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" class="form-control mb-2" id="tahun_ajaran"
                                            name="tahun_ajaran" value="{{ $current_semester->tahun_ajaran }}" disabled>
                                        @error('tahun_ajaran')
                                            <div id="tahun_ajaran_error" class="text-danger text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label class="sr-only" for="semester">Semester</label>
                                        <div class="input-group mb-2">
                                            <select name="semester" id="semester" class="form-control" disabled>
                                                <option value="" disabled>Pilih Semester</option>
                                                <option value="Ganjil" @if ($current_semester->semester == 'Ganjil') selected @endif>
                                                    Ganjil
                                                </option>
                                                <option value="Genap" @if ($current_semester->semester == 'Genap') selected @endif>
                                                    Genap
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    @foreach ($list_tahun_ajaran as $row)
        <div class="modal fade" id="tambahTahunAjaranModal{{ $row->id }}" tabindex="-1" aria-labelledby="tambahTahunAjaranModal{{ $row->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTahunAjaranModal{{ $row->id }}Label">Edit Data Tahun Ajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/tahun_ajaran/store" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="{{ $row->tahun_ajaran }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script>
        $(function() {
            $('.tahun_ajaran').on('click', function() {
                const tahunAjaran = $(this).data('tahun_ajaran');

                $.ajax({
                    url: "/dashboard/update-tahun-ajaran",
                    type: 'post',
                    data: {

                        '_token': '{{ csrf_token() }}',
                        'tahun_ajaran': tahunAjaran
                    },
                    success: function() {
                        document.location.href = "/dashboard";
                    }
                });
            });
        });
    </script>
@endsection
