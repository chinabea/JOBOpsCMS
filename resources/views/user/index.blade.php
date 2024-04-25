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
            <form action="{{ route('generate.users.report') }}" method="post">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="end_date">
                        </div>
                    </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Actions</label>
                        <div>
                            <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> </button>
                            <button type="submit" class="btn btn-info"><i class="fa fa-file-pdf"></i> Generate PDF</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <table id="datatable" class="table table-bordered table-hover text-center table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fa fa-info-circle"></i> Name</th>
                        <th><i class="fa fa-envelope"></i> Email</th>
                        <th><i class="fa fa-sitemap"></i> Role</th>
                        <th><i class="fa fa-pencil-square-o"></i> Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">
                            @if ($user->role == 1)
                                Admin
                            @elseif ($user->role == 2)
                                MICT Staff
                            @elseif ($user->role == 3)
                                Staff
                            @else
                                Guest
                            @endif
                        </td>
                        <!-- <td>
                            @if (!$user->is_approved)
                                <a href="{{ route('users.approve', $user->id) }}" class="btn btn-sm btn-info">Approve</a>
                            @else
                                <a href="{{ route('users.disapprove', $user->id) }}" class="btn btn-sm btn-danger">Disapprove</a>
                            @endif
                        </td> -->
                        <td class="align-middle">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-user"></i> View Profile
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('user.destroy', $user->id) }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
