@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Pesan</h1>
        </div>
        <a href="{{ route('admin.contacts') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold m-0">{{ $contact['subject'] }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted" style="width:150px;">Nama</td>
                            <td>: <strong>{{ $contact['name'] }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>: {{ $contact['email'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Telepon</td>
                            <td>: {{ $contact['phone'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal</td>
                            <td>: {{ substr($contact['created_at'], 0, 16) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>:
                                @php
                                    $badgeMap = ['unread'=>'danger','read'=>'warning','replied'=>'success'];
                                @endphp
                                <span class="badge badge-{{ $badgeMap[$contact['status']] ?? 'secondary' }}">
                                    {{ ucfirst($contact['status']) }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <p class="font-weight-bold text-muted mb-1">Pesan:</p>
                        <div class="p-3 bg-light rounded">
                            {{ $contact['message'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold m-0">Update Status</h6>
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('admin.contacts.status', $contact['id']) }}">
                        @csrf
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="unread"  {{ $contact['status'] == 'unread'  ? 'selected' : '' }}>Unread</option>
                                <option value="read"    {{ $contact['status'] == 'read'    ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $contact['status'] == 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-amber btn-block">
                            <i class="fas fa-save mr-1"></i> Simpan Status
                        </button>
                    </form>

                    <hr>

                    <a href="mailto:{{ $contact['email'] }}"
                       class="btn btn-outline-primary btn-block">
                        <i class="fas fa-envelope mr-1"></i> Balas via Email
                    </a>

                    <form method="POST"
                          action="{{ route('admin.contacts.destroy', $contact['id']) }}"
                          class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-block"
                                onclick="return confirm('Hapus pesan ini?')">
                            <i class="fas fa-trash mr-1"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection