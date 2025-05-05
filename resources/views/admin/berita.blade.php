@extends('components.layouts.app')

@section('content')
<!-- DataTables CSS & Bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2 class="text-xl font-semibold mb-4">Daftar Berita</h2>

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahBeritaModal">Tambah Berita</button>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="beritaTable" class="display table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Publish</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $berita)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Gambar Berita" width="50" height="50">
                        </td>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ $berita->kategori }}</td>
                        <td>
                            <span class="badge {{ $berita->stts === 'private' ? 'bg-danger' : ($berita->stts === 'published' ? 'bg-success' : 'bg-secondary') }}">
                                {{ $berita->stts }}
                            </span>
                        </td>
                        <td>{{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->format('d-m-Y') : '-' }}</td>
                        <td class="text-center">
                            <div class="d-inline-flex justify-content-center align-items-center flex-wrap" style="gap: 6px;">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showBeritaModal{{ $berita->id }}">Show</button>
                                <button class="btn btn-warning btn-sm"  href="javascript:void(0)" onclick="editBerita({{ $berita->id }})" data-bs-toggle="modal" data-bs-target="#editBeritaModal">Edit</button>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Show Berita per berita -->
                    <div class="modal fade" id="showBeritaModal{{ $berita->id }}" tabindex="-1" aria-labelledby="showBeritaLabel{{ $berita->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showBeritaLabel{{ $berita->id }}"><strong>{{ $berita->judul }}</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Foto Penulis" class="img-fluid" style="max-width: 150px;">
                                    </div>
                                    <div class="mb-3">
                                        {!! nl2br(e($berita->isi)) !!}
                                    </div>
                                    @if($berita->video)
                                <div class="mb-3 text-center">
                                            <video controls style="max-width: 450px; border-radius: 8px;">
                                                <source src="{{ asset('storage/'.$berita->video) }}" type="video/mp4">
                                                Browser Anda tidak mendukung pemutaran video.
                                            </video>
                                </div>
                                    @endif
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <small class="text-muted">Penulis: {{ $berita->penulis }}</small><br>
                                        <small class="text-muted">Dipublikasikan pada: {{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->format('d-m-Y') : '-' }}</small>
                                    </div>
                                    @if ($berita->stts == 'private')
                                    <form action="{{ route('berita.publish', $berita->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editBeritaModal" tabindex="-1" aria-labelledby="editBeritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editBeritaForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_judul">Judul</label>
                        <input type="text" class="form-control" id="edit_judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_penulis">Penulis</label>
                        <input type="text" class="form-control" id="edit_penulis" name="penulis" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kategori">Kategori</label>
                        <select class="form-control" id="edit_kategori" name="kategori" required>
                            <option value="" selected>Pilih Kategori</option>
                            <option value="Prestasi">Prestasi</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Berita">Berita</option>
                            <option value="Informasi">Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_isi">Isi</label>
                        <textarea class="form-control" id="edit_isi" name="isi" rows="12" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="private">Private</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <!-- Bagian Gambar dan Video Sejajar -->
                    <div class="mb-3 d-flex align-items-start gap-3">
                        <!-- Gambar Baru -->
                        <div style="flex: 1;">
                            <label for="edit_gambar">Gambar Baru (opsional)</label>
                            <input type="file" class="form-control" id="edit_gambar" name="gambar" accept="image/*">
                            <small id="edit_gambarPreview" class="form-text text-muted"></small>
                        </div>

                        <!-- Preview Gambar -->
                        <div id="edit_gambarPreviewContainer" style="flex: 1; display: flex; justify-content: center; align-items: center;">
                            {{-- Preview Gambar akan ditampilkan di sini --}}
                        </div>
                    </div>

                    <!-- Bagian Video (Input dan Preview Video Sejajar) -->
                    <div class="mb-3 d-flex align-items-start gap-3">
                        <!-- Input File Video -->
                        <div style="flex: 1;">
                            <label for="edit_video" class="form-label">Video (Opsional)</label>
                            <input type="file" class="form-control" id="edit_video" name="video" accept="video/mp4,video/quicktime">
                        </div>

                        <!-- Preview Video -->
                        <div id="edit_videoPreview" style="flex: 1;">
                            {{-- Akan diisi lewat JavaScript --}}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Form Tambah Berita -->
<div class="modal fade" id="tambahBeritaModal" tabindex="-1" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBeritaModalLabel">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk tambah berita -->
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori" required>
                            <option value="" selected>Pilih Kategori</option>
                            <option value="Prestasi">Pretasi</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Berita">Berita</option>
                            <option value="Informasi">Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label">Video (Opsional)</label>
                        <input type="file" class="form-control" id="video" name="video" accept="video/mp4,video/quicktime">
                    </div>                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    function editBerita(id) {
        $.ajax({
            url: '/berita/' + id + '/edit',
            method: 'GET',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_judul').val(response.judul);
                $('#edit_penulis').val(response.penulis);
                $('#edit_kategori').val(response.kategori);
                $('#edit_isi').val(response.isi.replace(/<br\s*\/?>/gi, '\n'));
                $('#edit_status').val(response.stts);
                $('#editBeritaForm').attr('action', '/berita/' + id);
                if (response.gambar) {
                    $('#edit_gambarPreview').html('<img src="storage/' + response.gambar + '" class="img-fluid" style="max-width: 150px;">');
                } else {
                    $('#edit_gambarPreview').html('Tidak ada gambar sebelumnya.');
                }
                if (response.video) {
                    $('#edit_videoPreview').html(`
    <video controls style="max-width: 150px; height:300px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <source src="storage/${response.video}" type="video/mp4">
        Browser tidak mendukung tag video.
    </video>
`);

                } else {
                    $('#edit_videoPreview').html('Tidak ada video sebelumnya.');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        $('#beritaTable').DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
        });
    });
</script>
@endsection
