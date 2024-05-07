

@extends('layouts.template') @section('content') <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
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
                            <!-- </div> -->
                            </form>

                            <table id="datatable" class="table table-bordered table-hover text-center table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fa fa-info-circle"></i> Name</th>
                        <th><i class="fa fa-envelope"></i> Email</th>
                        <th><i class="fa fa-sitemap"></i> Role</th>
                        <th><i class="fa fa-sitemap"></i> Approval</th>
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
                        <td>
                            @if (!$user->is_approved)
                                <a href="{{ route('users.approve', $user->id) }}" class="btn btn-sm btn-info"><i class="fa fa-check-square-o"></i> Approve</a>
                            @else
                                <a href="{{ route('users.disapprove', $user->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Disapprove</a>
                            @endif
                        </td>
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
    </section>
</div> @endsection