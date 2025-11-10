<div class="table-responsive">
    <table class="table table-hover text-center align-middle text-white">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 50px; height: 50px;">Photo</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td>
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle" width="40"
                                height="40" alt="image">
                        @else
                            <span class="text-secondary">No Image</span>
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td><span class="fw-bold text-danger">{{ $user->role }}</span></td>
                    <td>
                        <span
                            class="fw-bold status-toggle {{ $user->is_active == 'active' ? 'text-success' : 'text-danger' }}"
                            data-id="{{ $user->id }}" style="cursor:pointer;">
                            {{ ucfirst($user->is_active) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-edit">Edit</a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-delete" data-name="{{ $user->name }}">
                                Delete
                            </button>
                        </form>

                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-detail">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-secondary py-3">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
