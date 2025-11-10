@extends('layouts.app')

@section('content')
    {{-- === STYLE UNTUK FOTO UPLOAD === --}}
    <style>
        .user-photo {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }

        .photo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #3f3f55;
            background-color: #26263b;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .photo-placeholder img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: none;
            /* disembunyikan dulu */
        }

        .photo-placeholder i {
            font-size: 24px;
            color: #555;
            transition: color 0.3s;
        }

        .photo-placeholder:hover i {
            color: #888;
        }

        .file-upload-wrapper {
            background-color: #26263b;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-upload-btn {
            background-color: #6c63ff;
            color: #fff;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.3s;
        }

        .file-upload-btn:hover {
            background-color: #5a52e0;
        }

        .file-name {
            color: #ccc;
            font-size: 0.95rem;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* === STYLE UMUM === */
        body {
            background-color: #12121c;
        }

        .container-new {
            width: 100%;
            margin: 40px auto;
            padding: 50px 24px;
            box-sizing: border-box;
        }

        .card-fullscreen {
            background-color: #1e1e2d;
            color: #fff;
            border-radius: 12px;
            padding: 40px 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .card-fullscreen h4 {
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #26263b;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #5a52e0;
        }

        .btn-dark {
            background-color: #333;
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
            color: #fff;
            margin-left: 10px;
        }

        .btn-dark:hover {
            background-color: #555;
        }

        .form-actions {
            display: flex;
            justify-content: flex-start;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .user-photo {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .user-photo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #3f3f55;
            object-fit: cover;
            background-color: #26263b;
        }

        @media (max-width: 768px) {
            .card-fullscreen {
                padding: 20px 20px;
            }

            .btn-primary,
            .btn-dark {
                width: 100%;
            }
        }
    </style>

    <div class="container-new">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-fullscreen">
                <h4>Create User</h4>
                <div class="row">
                    {{-- FOTO PREVIEW --}}
                    <div class="user-photo col-md-12">
                        <div class="photo-placeholder" id="photo-placeholder">
                            <img id="preview-photo" alt="" src="">
                            <i class="mdi mdi-camera" id="photo-icon"></i>
                        </div>
                    </div>


                    {{-- LEFT COLUMN --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="name" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="adress" placeholder="Alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input type="text" class="form-control" name="phonenumber" placeholder="Mobile number"
                                required>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="technician">Technician</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>

                        {{-- FOTO INPUT --}}
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="file-upload-wrapper">
                                <label for="image" class="file-upload-btn mb-0">Pilih Foto</label>
                                <span id="file-name-label" class="file-name text-truncate">Belum ada file</span>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                        </div>

                        <input type="hidden" name="is_active" value="active">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    {{-- SCRIPT PREVIEW GAMBAR DAN NAMA FILE --}}
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview-photo');
        const fileNameLabel = document.getElementById('file-name-label');
        const photoIcon = document.getElementById('photo-icon');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                fileNameLabel.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    photoIcon.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                fileNameLabel.textContent = 'Belum ada file';
                preview.src = '';
                preview.style.display = 'none';
                photoIcon.style.display = 'block';
            }
        });
    </script>
@endsection
