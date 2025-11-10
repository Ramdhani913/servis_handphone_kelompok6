<?php $__env->startSection('content'); ?>
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
        <form method="POST" action="<?php echo e(route('users.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-fullscreen">
                <h4>Create User</h4>
                <div class="row">
                    
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
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\user\create.blade.php ENDPATH**/ ?>