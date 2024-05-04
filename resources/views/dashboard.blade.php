@extends('layouts.template')

@section('content')

  <!-- page content -->
  <div class="right_col" role="main">
    <!-- top tiles -->

    <div class="row" style="display: inline-block;" >
    <div class="tile_count">
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Users</span>
        <div class="count">{{ $totalUsers }}</div>
        <span class="count_bottom">
          @if ($userPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($userPercentageChange, 2) }}%</i> From last Week
          @elseif ($userPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($userPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-book"></i> Total Tickets</span>
        <div class="count">{{ $totalTickets }}</div>
        <span class="count_bottom">
          @if ($ticketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($ticketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($ticketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($ticketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-folder-open"></i> Open Tickets</span>
        <div class="count">{{ $totalOpenTickets }}</div>
        <span class="count_bottom">
          @if ($totalOpenTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalOpenTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalOpenTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalOpenTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-line-chart"></i> In Progress</span>
        <div class="count">{{ $totalInProgressTickets }}</div>
        <span class="count_bottom">
          @if ($totalInProgressTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalInProgressTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalInProgressTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalInProgressTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-folder"></i> Closed Tickets</span>
        <div class="count">{{ $totalClosedTickets }}</div>
        <span class="count_bottom">
          @if ($totalClosedTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalClosedTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalClosedTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalClosedTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-flag"></i> High Priority</span>
        <div class="count">{{ $totalHighLevelTickets }}</div>
        <span class="count_bottom">
          @if ($totalHighLevelTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalHighLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalHighLevelTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalHighLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-minus-square"></i> Mid Priority</span>
        <div class="count">{{ $totalMidLevelTickets }}</div>
        <span class="count_bottom">
          @if ($totalMidLevelTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalMidLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalMidLevelTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalMidLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-sort-amount-asc"></i> Low Priority</span>
        <div class="count">{{ $totalLowLevelTickets }}</div>
        <span class="count_bottom">
          @if ($totalLowLevelTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalLowLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalLowLevelTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalLowLevelTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-times"></i> Unassigned Tickets</span>
        <div class="count">{{ $totalUnassignedTickets }}</div>
        <span class="count_bottom">
          @if ($totalUnassignedTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalUnassignedTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalUnassignedTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalUnassignedTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-check-square-o"></i> For Approval Users</span>
        <div class="count">{{ $totalPendingApprovalofUsers }}</div>
        <span class="count_bottom">
          @if ($totalPendingApprovalofUsersPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalPendingApprovalofUsersPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalPendingApprovalofUsersPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalPendingApprovalofUsersPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Assigned to Me</span>
        <div class="count">{{ $totalAssignedTickets }}</div>
        <span class="count_bottom">
          @if ($totalAssignedTicketsPercentageChange > 0)
              <i class="green"><i class="fa fa-sort-asc"></i> {{ number_format($totalAssignedTicketsPercentageChange, 2) }}%</i> From last Week
          @elseif ($totalAssignedTicketsPercentageChange < 0)
              <i class="red"><i class="fa fa-sort-desc"></i> {{ number_format($totalAssignedTicketsPercentageChange, 2) }}%</i> From last Week
          @else
              <i>No change</i> From last Week
          @endif
        </span>
      </div>
    </div>
  </div>

  <!-- /top tiles -->
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <!-- <h3>Ticket Summary</h3> -->
            <h3>Ticket Summary <small>Yearly requests</small></h3>
          </div>
        </div>

        <div class="col-md-9 col-sm-9 ">
          <canvas id="ticketsChart" width="400" height="150"  style="height:280px"></canvas>
        </div>
        <div class="col-md-3 col-sm-3 bg-white">
            <div>
              <div class="x_title align-items-center">
                <h2><i class="fa fa-users"></i> Pending User Approvals</h2>
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
    </div>
  <br />
  <!-- other rows here -->
</div>
<!-- /page content -->

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
@endsection
