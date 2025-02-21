@extends('layouts.backend.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header ml-4 mr-4">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Daftar Mahasiswa Bimbingan</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content ml-4 mr-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body table-responsive">
                                <table id="example1" class="table table-hover borderless"
                                    style="width: 100%; border: 0; margin: 0 auto;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th style="width: 150px;">NIM</th>
                                            <th style="width: 150px;">Judul</th>
                                            <th style="width: 150px;">Title</th>
                                            <th style="width: 150px;">PBB 1</th>
                                            <th style="width: 150px;">PBB 2</th>
                                            <th style="width: 150px;">PUJ 1</th>
                                            <th style="width: 150px;">PUJ 2</th>
                                            <th style="width: 150px;">Progress Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @if ($item_proposal)
                                            @foreach ($item_proposal as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->mahasiswa->nim }}</td>
                                                    <td>{{ $item->mahasiswa->nama }}</td>
                                                    <td>{{ $item->judul_indo }}</td>
                                                    <td>{{ $item->judul_inggris }}</td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ $item->tipe }}</td>
                                                </tr>
                                            @endforeach
                                        @elseif($item_prasidang)
                                            @foreach ($item_prasidang as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->mahasiswa->nim }}</td>
                                                    <td>{{ $item->mahasiswa->nama }}</td>
                                                    <td>{{ $item->judul_indo }}</td>
                                                    <td>{{ $item->judul_inggris }}</td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ $item->tipe }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($item_sidang as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->mahasiswa->nim }}</td>
                                                    <td>{{ $item->mahasiswa->nama }}</td>
                                                    <td>{{ $item->judul_indo }}</td>
                                                    <td>{{ $item->judul_inggris }}</td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->pembimbing2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji1_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ App\Models\Dosen::where(['id' => $item->penguji2_id])->first()->kode }}
                                                    </td>
                                                    <td>{{ $item->tipe }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('#periode').on('change', function() {
            window.location.href = "{{ route('backend.admin.nilai-mutu') }}" + '?periode=' + this.value
        });
    </script>
@endsection
