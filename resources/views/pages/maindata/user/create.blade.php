@extends('layouts.app')

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
@endsection
