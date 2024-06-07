
@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-4"></p>
                            <table id="example1" class="table table-bordered table-hover text-center table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Approval</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role == 1)
                                                Director
                                            @elseif ($user->role == 2)
                                                ICTRAM Head
                                            @elseif ($user->role == 3)
                                                NICMU Head
                                            @elseif ($user->role == 4)
                                                MIS Head
                                            @elseif ($user->role == 5)
                                                Staff
                                            @elseif ($user->role == 6)
                                                Student
                                            @elseif ($user->role == 7)
                                                ICTRAM Staff
                                            @elseif ($user->role == 8)
                                                NICMU Staff
                                            @elseif ($user->role == 9)
                                                MIS Staff
                                            @else
                                                Guest
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$user->is_approved)
                                                <a href="{{ route('users.approve', $user->id) }}" class="btn btn-sm btn-info"><i class="fa fa-check-square"></i> Approve User</a>
                                            @else
                                                <a href="{{ route('users.disapprove', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-times-circle"></i> Disapprove User</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-user"></i> View User Profile
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('user.destroy', $user->id) }}')">
                                                <i class="fa fa-trash"></i> Delete
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
    </section>
</div>
@endsection
