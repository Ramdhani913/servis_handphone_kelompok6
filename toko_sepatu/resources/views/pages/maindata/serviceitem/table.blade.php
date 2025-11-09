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
          <button class="btn btn-sm btn-delete delete-btn" data-id="{{ $item->id }}">Hapus</button>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center text-muted">Tidak ada data service item.</td>
      </tr>
    @endforelse
  </tbody>
</table>

<div class="mt-3">
  {{ $serviceitems->links() }}
</div>
