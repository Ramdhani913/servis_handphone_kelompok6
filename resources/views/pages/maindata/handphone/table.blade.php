<div class="table-responsive">
  <table class="table table-hover text-center align-middle">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($handphones as $phone)
      <tr>
        <td><img src="{{ asset('storage/' . $phone->image) }}" class="rounded-circle" width="40" height="40"></td>
        <td>{{ $phone->brand }}</td>
        <td>{{ $phone->model }}</td>
        <td>
          <span class="status-toggle fw-bold {{ $phone->is_active == 'active' ? 'text-success' : 'text-danger' }}" style="cursor:pointer" data-id="{{ $phone->id }}">
            {{ $phone->is_active }}
          </span>
        </td>
        <td>
          <a href="{{ route('handphones.edit', $phone->id) }}" class="btn btn-edit btn-sm">Edit</a>
          <form action="{{ route('handphones.destroy', $phone->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-delete btn-sm" type="submit" onclick="return confirm('Yakin hapus Model ini?');">Delete</button>
          </form>
          <a href="{{ route('handphones.show', $phone->id) }}" class="btn btn-detail btn-sm">Detail</a>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {{ $handphones->links() }}
  </div>
</div>
