<?php $__env->startSection('content'); ?>
    
    <style>
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

        /* ==== STYLE UMUM ==== */
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
        <form method="POST" action="<?php echo e(route('users.update', $user->id)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-fullscreen">
                <h4>Edit User</h4>
                <div class="row">
                    
                    <div class="user-photo col-md-12">
                        <img id="preview-photo"
                            src="<?php echo e($user->image ? asset('storage/' . $user->image) : asset('images/default-user.png')); ?>"
                            alt="User Photo">
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="adress"
                                value="<?php echo e(old('adress', $user->adress)); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                value="<?php echo e(old('email', $user->email)); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input type="text" class="form-control" name="phonenumber"
                                value="<?php echo e(old('phonenumber', $user->phonenumber)); ?>" required>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password (kosongkan jika tidak ingin ganti)</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option value="admin" <?php echo e(old('role', $user->role) == 'admin' ? 'selected' : ''); ?>>Admin
                                </option>
                                <option value="technician" <?php echo e(old('role', $user->role) == 'technician' ? 'selected' : ''); ?>>
                                    Technician</option>
                                <option value="customer" <?php echo e(old('role', $user->role) == 'customer' ? 'selected' : ''); ?>>
                                    Customer</option>
                            </select>
                        </div>

                        
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="file-upload-wrapper">
                                <label for="image" class="file-upload-btn mb-0">Pilih Foto</label>
                                <span id="file-name-label" class="file-name text-truncate">Belum ada file</span>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                        </div>

                        <input type="hidden" name="is_active" value="<?php echo e($user->is_active); ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview-photo');
        const fileNameLabel = document.getElementById('file-name-label');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                fileNameLabel.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                fileNameLabel.textContent = 'Belum ada file';
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views/pages/maindata/user/edit.blade.php ENDPATH**/ ?>