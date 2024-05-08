
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
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
                <small>{{ number_format($userPercentageChange, 2) }}% From last Week</small>
              </div>
            </div>
          </div>

          <!-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
                <small>{{ number_format($userPercentageChange, 2) }}% From last Week</small>
              </div>
            </div>
          </div> -->

          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Tickets</span>
                <span class="info-box-number">{{ $totalTickets }}</span>
                <small>{{ number_format($ticketsPercentageChange, 2) }}% From last Week</small>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fas fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Open Tickets</span>
                <span class="info-box-number">{{ $totalOpenTickets }}</span>
                <small>{{ number_format($totalOpenTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-spinner"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">In Progress</span>
                <span class="info-box-number">{{ $totalInProgressTickets }}</span>
                <small>{{ number_format($totalInProgressTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        
        
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-navy">
              <span class="info-box-icon"><i class="fas fa-folder"></i></span>

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
            <div class="info-box bg-purple">
              <span class="info-box-icon"><i class="fas fa-flag"></i></span>

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
            <div class="info-box bg-fuchsia">
              <span class="info-box-icon"><i class="fas fa-minus-square"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mid Priority</span>
                <span class="info-box-number">{{ $totalMidLevelTickets }}</span>
                <small>{{ number_format($totalMidLevelTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-pink">
              <span class="info-box-icon"><i class="fas fa-clock"></i></span>

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
        </div>
        
        
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-maroon">
              <span class="info-box-icon"><i class="fas fa-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Unassigned Tickets</span>
                <span class="info-box-number">{{ $totalUnassignedTickets }}</span>
                <small>{{ number_format($totalUnassignedTicketsPercentageChange, 2) }}% From last Week</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-orange">
              <span class="info-box-icon"><i class="fas fa-check"></i></span>

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
            <div class="info-box bg-teal">
              <span class="info-box-icon"><i class="fas fa-user"></i></span>

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
        </div>



















            <!-- AREA CHART -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> Yearly Summary of Requested Tickets</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
