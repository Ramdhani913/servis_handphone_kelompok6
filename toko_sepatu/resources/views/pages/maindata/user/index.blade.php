@extends('layouts.app')

@section('content')
    <div class="container-fluid grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Hoverable Table</h4>
                    <p class="card-description"> Add class <code>.table-hover</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
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
                          <tr>
                            <td><img src="assets/images/faces/face1.jpg" class="mr-2" alt="image"></td>
                            <td>Jacob</td>
                            <td class="text-danger">Admin</td>
                            <td class="text-sucess">Active</i></td>
                            <td>
                                <label class="badge badge-danger">Fixed</label>
                                <label class="badge badge-warning">Pending</label> 
                                <label class="badge badge-success">In progress</label>
                            </td>
                          </tr>
                          <tr>
                            <td><img src="assets/images/faces/face1.jpg" class="mr-2" alt="image"></td>
                            <td>Jacob</td>
                            <td class="text-danger">Admin</td>
                            <td class="text-sucess">Active</i></td>
                            <td>
                                <label class="badge badge-danger">Fixed</label>
                                <label class="badge badge-warning">Pending</label> 
                                <label class="badge badge-success">In progress</label>
                            </td>
                          </tr>
                          <tr>
                             <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ Create New User</a>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
@endsection