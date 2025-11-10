<div class="table-responsive">
  <table class="table table-hover text-center align-middle">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Nama</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($users as $user)
      <tr>
        <td>
          @if ($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle" width="40" height="40" alt="image">
          @else
            <span class="text-secondary">No Image</span>
          @endif
        </td>
        <td>{{ $user->name }}</td>
        <td><span class="fw-bold text-danger">{{ $user->role }}</span></td>
        <td>
          <span class="fw-bold status-toggle {{ $user->is_active == 'active' ? 'text-success' : 'text-danger' }}"
                data-id="{{ $user->id }}"
                style="cursor: pointer;">
                {{ ucfirst($user->is_active) }}
          </span>
        </td>
        <td>
          <a href="{{ route('users.edit', $user->id) }}"><button class="btn btn-edit btn-sm">Edit</button></a>
          <form action="/users/{{ $user->id }}/delete" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Yakin hapus user ini?');">Delete</button>
          </form>
          <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-detail btn-sm">Detail</button></a>
        </td>
      </tr> 
      @empty
      <tr>
        <td colspan="5" class="text-secondary py-3">Tidak ada data ditemukan.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
  {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
