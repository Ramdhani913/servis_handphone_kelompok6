@extends('layouts.app')

@section('content')
    <style>
        /* === FOTO PREVIEW === */
        .user-photo {
            display: flex;
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

        /* === FORM STYLE === */
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
            padding: 40px;
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

        .form-control,
        select.form-control {
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

        @media (max-width: 768px) {
            .card-fullscreen {
                padding: 20px;
            }

            .btn-primary,
            .btn-dark {
                width: 100%;
            }
        }
    </style>

    <div class="container-new">
        <form id="handphoneForm" action="{{ route('handphones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-fullscreen">
                <h4>Create Handphone</h4>

                <div class="row">
                    {{-- FOTO PREVIEW --}}
                    <div class="user-photo col-md-12">
                        <div class="photo-placeholder" id="photo-placeholder">
                            <img id="preview-photo" alt="">
                            <i class="mdi mdi-camera" id="photo-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" id="brand" name="brand" class="form-control"
                                placeholder="Masukkan merek handphone" required>
                        </div>

                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" id="model" name="model" class="form-control"
                                placeholder="Masukkan model handphone" required>
                        </div>

                        <div class="form-group">
                            <label>Release Year</label>
                            <select name="release_year" class="form-control" required>
                                <option value="">Pilih tahun rilis</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- FOTO INPUT --}}
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="file-upload-wrapper">
                                <label class="file-upload-btn mb-0">Pilih Foto</label>
                                <span id="file-name-label" class="file-name text-truncate">Belum ada file</span>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('handphones.index') }}" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>

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

        document.querySelector('.file-upload-btn').addEventListener('click', () => {
            imageInput.click();
        });
    </script>
@endsection
