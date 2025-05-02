@extends('components.layouts.app')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <h2 class="text-xl font-semibold mb-4">Daftar Pengurus</h2>

    <!-- Button Tambah Pengurus -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahPengurusModal">Tambah Pengurus</button>

    <!-- Card Container -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- DataTable -->
            <table id="pengurusTable" class="display table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Divisi</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengurus as $index => $pengurusItem)
                        <tr>
                            <td>{{ $index + 1 }}</td>  <!-- Menampilkan nomor urut -->
                            <td>
                                <img src="{{ asset('storage/'.$pengurusItem->foto) }}" alt="Foto" width="50" height="50">
                            </td>
                            <td>{{ $pengurusItem->nama }}</td>
                            <td>{{ $pengurusItem->email }}</td>
                            <td>{{ $pengurusItem->alamat }}</td>
                            <td>{{ $pengurusItem->nomor_telepon }}</td>
                            <td>{{ $pengurusItem->divisi }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex justify-content-center align-items-center flex-wrap" style="gap: 6px;">
                                   <!-- Tombol Edit -->
<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editPengurus({{ $pengurusItem->id }})" data-bs-toggle="modal" data-bs-target="#editPengurusModal">Edit</a>

                                    <form action="{{ route('pengurus.destroy', $pengurusItem->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form Tambah Pengurus -->
<div class="modal fade" id="tambahPengurusModal" tabindex="-1" aria-labelledby="tambahPengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPengurusModalLabel">Tambah Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk tambah pengurus -->
                <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="divisi" class="form-label">Divisi</label>
                        <input type="text" class="form-control" id="divisi" name="divisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<!-- Modal Edit Pengurus -->
<div class="modal fade" id="editPengurusModal" tabindex="-1" aria-labelledby="editPengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPengurusModalLabel">Edit Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPengurusForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Input hidden untuk simpan ID -->
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="edit_nomor_telepon" name="nomor_telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_divisi" class="form-label">Divisi</label>
                        <input type="text" class="form-control" id="edit_divisi" name="divisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_foto" class="form-label">Foto Baru (opsional)</label>
                        <input type="file" class="form-control" id="edit_foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Pengurus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function editPengurus(id) {
    $.ajax({
        url: '/pengurus/' + id + '/edit',
        type: 'GET',
        success: function(data) {
            console.log("Data Diterima:", data);

            // Isi data ke form edit
            $('#edit_id').val(data.id); // ini buat jaga2 kalo mau pakai hidden id
            $('#edit_nama').val(data.nama);
            $('#edit_email').val(data.email);
            $('#edit_alamat').val(data.alamat);
            $('#edit_nomor_telepon').val(data.nomor_telepon);
            $('#edit_divisi').val(data.divisi);

            // Update action form (penting!!)
            $('#editPengurusForm').attr('action', '/pengurus/' + id);

            // Debugging tambahan
            console.log("Edit ID: " + data.id + ", Nama: " + data.nama);

            // Show modal pakai Bootstrap 5
            const modal = new bootstrap.Modal(document.getElementById('editPengurusModal'));
            modal.show();
        },
        error: function(xhr, status, error) {
            console.error("Terjadi kesalahan saat mengambil data pengurus: " + error);
        }
    });
}

</script>


<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pengurusTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
@endsection
