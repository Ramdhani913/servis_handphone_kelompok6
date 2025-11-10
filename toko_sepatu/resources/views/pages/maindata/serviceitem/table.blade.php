<table class="table table-hover text-white">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Service</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($serviceitems as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->service_name }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>
                    <span class="status-toggle {{ $item->is_active === 'active' ? 'text-success' : 'text-danger' }}"
                        data-id="{{ $item->id }}" style="cursor:pointer;">
                        {{ $item->is_active }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('serviceitems.edit', $item->id) }}" class="btn btn-sm btn-edit">Edit</a>
                    <form action="{{ route('serviceitems.destroy', $item->id) }}" method="POST" style="display:inline;"
                        class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-delete" data-name="{{ $item->service_id }}">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Tidak ada data service item.</td>
            </tr>
        @endforelse
    </tbody>
</table>
