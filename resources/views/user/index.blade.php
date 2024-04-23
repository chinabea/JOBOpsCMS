@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Plain Page</h3>
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
                    <table id="datatable" class="table table-bordered table-hover text-center table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if($users->count() > 0)
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
                                @endif
                            </tbody>
                        </table>
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
