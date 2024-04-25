@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Users</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List of Users</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            









          
          <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $profilePictureUrl }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">Software Engineer</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone Number</b> <a class="float-right">09684648490</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">Profile</li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('user.edit', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role" required>
                                            @if(array_key_exists($user->role, $roles) && $user->role)
                                                <option value="{{ $user->role }}" selected>{{ $roles[$user->role] }}</option>
                                            @else
                                                <option value="" selected disabled>No role assigned - please select a role</option>
                                            @endif
                                            @foreach ($roles as $key => $role)
                                                @if ($key != $user->role)
                                                    <option value="{{ $key }}">{{ $role }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <!-- <p>By clicking submit, you are granting this user permission to access the system.</p> -->
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10"> 
                                                @if (!$user->is_approved)
                                                    <a href="{{ route('users.approve', $user->id) }}" class="btn btn-info">Approve</a>
                                                @else
                                                    <a href="{{ route('users.disapprove', $user->id) }}" class="btn btn-danger">Disapprove</a>
                                                @endif
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>













          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
