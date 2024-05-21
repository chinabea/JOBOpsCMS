
@extends('layouts.template')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
      <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Open Tickets</span>
                <span class="info-box-number">{{ $totalOpenTicketsPerWeek }}</span>
                <small>{{ number_format($totalOpenTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-teal"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Assigned to Me</span>
                <span class="info-box-number">{{ $totalAssignedTickets }}</span>
                <small>{{ number_format($totalAssignedTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-spinner"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">In Progress</span>
                <span class="info-box-number">{{ $totalInProgressTickets }}</span>
                <small>{{ number_format($totalInProgressTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-navy"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Closed Tickets</span>
                <span class="info-box-number">{{ $totalClosedTickets }}</span>
                <small>{{ number_format($totalClosedTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-purple"><i class="fas fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">High Priority</span>
                <span class="info-box-number">{{ $totalHighLevelTickets }}</span>
                <small>{{ number_format($totalHighLevelTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-fuchsia"><i class="far fa-copy"></i></span>

              <div class="info-box-content"> Mid Priority</span>
                <span class="info-box-number">{{ $totalMidLevelTickets }}</span>
                <small>{{ number_format($totalMidLevelTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-gray-dark"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Low Priority</span>
                <span class="info-box-number">{{ $totalLowLevelTickets }}</span>
                <small> {{ number_format($totalLowLevelTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-maroon"><i class="fas fa-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Unassigned Tickets</span>
                <span class="info-box-number">{{ $totalUnassignedTickets }}</span>
                <small>{{ number_format($totalUnassignedTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-orange"><i class="fas fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">For Approval Users</span>
                <span class="info-box-number">{{ $totalPendingApprovalofUsers }}</span>
                <small>{{ number_format($totalPendingApprovalofUsersPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
                <small>{{ number_format($userPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Tickets</span>
                <span class="info-box-number">{{ $totalTickets }}</span>
                <small>{{ number_format($ticketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        
        <!-- AREA CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class=""><i class="fas fa-chart-bar"></i> 
            Ticket Summary <small>Yearly requests</small>
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
        <div class="col-md-9 col-sm-9 ">
          <canvas id="ticketsChart" width="400" height="150"  style="height:280px"></canvas>
        </div>
        <div class="col-md-3 col-sm-3 bg-white">
          <div>
            <div class="align-items-center">
              <h6><i class="fa fa-users"></i> Pending User Approvals</h6>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
            <style>
              .avatar-img {
                  width: 50px;
                  height: 50px;
                  border-radius: 50%;
                  padding: 5px; /* Adjust as needed */
              }
            </style>            
            @forelse ($unapprovedUsers as $user)
              <li class="media event d-flex align-items-center">
                  @if($user->avatar)
                      <img src="{{ $user->avatar }}" alt="{{ $user->name }}'s avatar" style="width: 55px; height: 55px; border-radius: 50%; padding: 5px;">
                      
                  @else
                      <a class="pull-left border-green profile_thumb">
                      <i class="fa fa-user green" aria-hidden="true"></i> <!-- Font Awesome icon -->
                      </a>
                      
                  @endif
                  <div class="media-body" style="margin-left: 10px;">
                      <a class="title" href="{{ route('user.edit', $user->id) }}">{{ $user->name }}</a>
                      <p>{{ $user->job_position }} </p>
                      <p> <small>{{ $user->created_at }}</small></p>
                  </div>
                </li>
                
                <hr>
              @empty
                <li>No unapproved users found.</li>
              @endforelse
            </ul>
          </div>
          </div>
        <div class="clearfix"></div>
      </div>
    </div>
    
<script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('ticketsChart').getContext('2d');
        var ticketsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($monthlyTicketsData as $data) '{{ $data->year }}-{{ $data->month }}', @endforeach],
                datasets: [{
                    label: 'Monthly Ticket Counts',
                    data: [@foreach($monthlyTicketsData as $data) {{ $data->count }}, @endforeach],
                    backgroundColor: 'rgba(38, 185, 154, 0.31)',
                    borderColor: 'rgba(38, 185, 154, 0.7)',
                    pointBorderColor: 'rgba(38, 185, 154, 0.7)',
                    pointBackgroundColor: 'rgba(38, 185, 154, 0.7)',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(220,220,220,1)',
                    pointBorderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        });
    });
    </script>
    </div>
  </section>
</div>

@endsection
