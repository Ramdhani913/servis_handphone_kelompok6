@extends('layouts.app')

<<<<<<< HEAD
@section('content')
    <style>
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
        }

        .user-photo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #3f3f55;
            object-fit: cover;
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
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
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
=======
<style>
/* Container kecil dan di tengah */
.container-new {
  width: 60vw;
  max-width: 1100px;
  padding: 60px 20px; /* tambah padding atas-bawah biar nggak nempel */
  margin: 60px auto; /* jarak dari atas */
  box-sizing: border-box;
}

/* Dua kotak sejajar */
.row-full {
  display: flex;
  justify-content: center; /* biar di tengah */
  align-items: stretch; /* bikin tinggi sejajar */
  gap: 30px;
}

/* Dua kolom sama besar */
.col-custom {
  flex: 1;
  max-width: 48%;
  display: flex;
}

/* Kartu */
.card {
  width: 100%;
  border-radius: 16px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
  border: none;
  background-color: #1e1e1e; /* hitam */
  padding: 30px;
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* biar isi merata */
}

/* Judul */
.card-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 20px;
  color: #fff;
}

/* Input */
.form-control {
  height: 50px;
  font-size: 15px;
  padding: 10px 14px;
  border-radius: 10px;
  border: none;
  background-color: #2b2b2b;
  color: #fff;
}

/* Label */
.col-form-label {
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
  color: #ccc;
}

/* Tombol */
.btn {
  padding: 12px 26px;
  font-size: 16px;
  border-radius: 10px;
  font-weight: 600;
}

.btn-primary {
  background-color: #007bff;
  border: none;
}

.btn-dark {
  background-color: #444;
  border: none;
}

/* Responsive */
@media (max-width: 992px) {
  .row-full {
    flex-direction: column;
    align-items: center;
  }
  .col-custom {
    max-width: 100%;
  }
}
</style>

@section('content')
<form method="POST" action="/users/store" enctype="multipart/form-data">
  @csrf
  <div class="container-new">
    <div class="row-full">

      {{-- Kiri --}}
      <div class="col-custom">
        <div class="card">
          <div>
            <h4 class="card-title">User Info</h4>

            <div class="form-group">
              <label class="col-form-label">Username</label>
              <input type="text" class="form-control" name="name" placeholder="Username" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Alamat</label>
              <input type="text" class="form-control" name="adress" placeholder="Alamat" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">No Handphone</label>
              <input type="text" class="form-control" name="phonenumber" placeholder="Mobile number" required>
            </div>
          </div>
        </div>
      </div>

      {{-- Kanan --}}
      <div class="col-custom">
        <div class="card">
          <div>
            <h4 class="card-title">Account</h4>

            <div class="form-group">
              <label class="col-form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Role</label>
              <select class="form-control" name="role" required>
                <option value="admin">Admin</option>
                <option value="technician">Technician</option>
                <option value="customer">Customer</option>
              </select>
            </div>

            <div class="form-group">
              <label class="col-form-label">Foto</label>
              <div class="row g-2">
                <div class="col-6">
                  <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                    <span id="file-name-label">Upload Foto</span>
                  </label>
                </div>
                <div class="col-6">
                  <input type="text" id="file-name-display" class="form-control" readonly placeholder="No file">
                </div>
              </div>

              <input type="file" id="image" name="image" style="display:none;"
                onchange="(function(f){ 
                  document.getElementById('file-name-label').textContent = f?.name || 'Upload Foto'; 
                  document.getElementById('file-name-display').value = f?.name || ''; 
                })(this.files[0]);">
            </div>
          </div>

          <input type="hidden" name="is_active" value="active">

          <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
>>>>>>> 0cdab11c69774ac7f57a244149b56b3da6621235
@endsection
