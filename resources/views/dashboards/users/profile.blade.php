@extends('layout')
@section('content')

<style>
   h3 {
        color: #28A828;
  text-shadow: 3px 3px 3px white, 0 0 20px white, 0 0 10px green;
  }
</style>

<br>
<br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <a href="{{ Auth::user()->avatar }}"><img class="profile-user-img img-fluid img-circle" src="{{Auth::user()->avatar}}" alt="User profile picture"></a>
                  </div>
                      <br>
                  <h2 class="profile-username text-center">{{Auth::user()->name}}</h2>

                  <p class="text-muted text-center">User</p>
                  <br>
                  <form enctype="multipart/form-data" action="/user/profile" method="POST">
                  <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br>
                <br>
                <center><button type="submit" class="btn btn-success">Upload</button></center>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Information</a></li>
                    <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="personal_info">
                      <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}" id="AdminInfoForm">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" style="color:grey;" value="{{ Auth::user()->name }}" name="name">

                            <span class="text-danger error-text name_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Email" style="color:grey;" value="{{ Auth::user()->email }}" name="email">
                            <span class="text-danger error-text email_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Gender:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Gender" style="color:grey;" value="{{ Auth::user()->gender }}" name="gender">
                            <span class="text-danger error-text gender_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Save Changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="change_password">
                        <form class="form-horizontal" action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Old Password:</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputName" placeholder="Enter current password" name="oldpassword">
                              <span class="text-danger error-text oldpassword_error"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">New Password:</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
                              <span class="text-danger error-text newpassword_error"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password:</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="cnewpassword" placeholder="ReEnter new password" name="cnewpassword">
                              <span class="text-danger error-text cnewpassword_error"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Update Password</button>
                            </div>
                          </div>
                        </form>
                      </div>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->


@endsection
