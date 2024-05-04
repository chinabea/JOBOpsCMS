@extends('layouts.template')

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Report</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          
          <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="profile-user-img img-fluid" src="{{ $user->avatar }}" alt="Avatar" title="Change the avatar"  style="width: 230px; height: 230px;">
                </div>
              </div>
              <h3>{{ $user->name }}</h3>

              <ul class="list-unstyled user_data">
                @if(!empty($user->phone_number))
                    <li><i class="fa fa-phone"></i> {{ $user->phone_number }}</li>
                @endif
                @if(!empty($user->job_position))
                  <li><i class="fa fa-briefcase user-profile-icon"></i> {{ $user->job_position }}</li>
                @endif
              </ul>
              <br />
              <!-- start skills -->
              <h4>Expertise</h4>
              <ul class="list-unstyled user_data">
                  @php
                  
                      $expertiseList = !empty($user->expertise) ? json_decode($user->expertise, true) : null;
                  @endphp

                  @if(!empty($expertiseList) && is_array($expertiseList))
                      @foreach($expertiseList as $skill)
                          <li><i class="fa fa-info-circle"></i> {{ $skill }}</li>
                      @endforeach
                  @else
                      <li><i class="fa fa-info-circle"></i> No expertise listed.</li>
                  @endif
              </ul>
              <!-- end of skills -->

            </div>
            <div class="col-md-9 col-sm-9 ">

              <div class="profile_title">
                <div class="col-md-6">
                  <h2>Ticket Submissions per Month</h2>
                </div>
                
              </div>
              <!-- start of user-activity-graph -->
              <div id="tickets_graph_bar" style="width:100%; height:280px;"></div>
              <!-- end of user-activity-graph -->

              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <!-- <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                  </li> -->
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">Tickets Worked on</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Edit Profile</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <!-- </div> -->
                  <div role="tabpanel" class="tab-pane active" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th> Request by</th>
                              <th> Location</th>
                              <th> Unit</th>
                              <th> Request</th>
                              <th> Assigned to</th>
                              <th> Priority</th>
                              <th> Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($assignedTickets as $ticket)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $ticket->user->name }}</td>
                              <td>{{ $ticket->service_location }}</td>
                              <td>{{ $ticket->unit }}</td>
                              <td>{{ $ticket->request }}</td>
                              <td>
                                @foreach ($ticket->users as $assigned_user)
                                  {{ $assigned_user->name }}
                                @endforeach
                              </td>
                              <td>
                                @if ($ticket->priority_level === 'High')
                                <span class="badge badge-danger">High</span>
                                @elseif ($ticket->priority_level === 'Mid')
                                <span class="badge badge-warning">Mid</span>
                                @elseif ($ticket->priority_level === 'Low')
                                <span class="badge badge-secondary">Low</span>
                                @endif
                              </td>
                              @if(auth()->user()->role == 1 || (auth()->user()->role == 2))
                              <td>{{ $ticket->status }}</td>
                              @else
                              <td class="align-middle"><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $ticket->status }}</small></td>
                              @endif
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    <!-- end user projects -->
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
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
                                <input type="text" class="form-control" id="" name="" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
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
                            <label for="inputEmail" class="col-sm-2 col-form-label">Job Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="job_position" name="job_position" value="{{ $user->job_position }}">
                            </div>
                        </div>
                        
                        <div class="form-group row" id="expertise-area">
                          <label for="expertise" class="col-sm-2 col-form-label">Expertise</label>
                          <div class="col-sm-10">
                              <div id="dynamic-expertise">
                                  <!-- Placeholder for existing expertise entries -->
                                  
            @if(!empty($existingExpertise))
                @foreach($existingExpertise as $expertise)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise" value="{{ $expertise }}">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="button" onclick="removeExpertise(this)">-</button>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No expertise listed.</p>
            @endif
                              
                                  <!-- New expertise entry field -->
                                  <div class="input-group mb-2">
                                      <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise">
                                      <div class="input-group-append">
                                          <button class="btn btn-success" type="button" onclick="addExpertise()">+</button>
                                      </div>
                                  </div>
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


        
<script type="text/javascript" src="{{ asset('cdn/gstatic.com-charts-loader.js') }}"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Tickets'],
            @foreach($monthlyTicketsData as $data)
                ['{{ $data->year }}-{{ $data->month }}', {{ $data->count }}],
            @endforeach
        ]);

        var options = {
            // chart: {
            //     title: 'Monthly Tickets',
            //     subtitle: 'Ticket submissions per month',
            // },
            bars: 'vertical',
            vAxis: {format: 'decimal'},
            height: 280,
            colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('tickets_graph_bar'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<script>
function addExpertise() {
    var container = document.getElementById('dynamic-expertise');
    var input = document.createElement('div');
    input.classList.add('input-group', 'mb-2');
    input.innerHTML = `
        <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise">
        <div class="input-group-append">
            <button class="btn btn-danger" type="button" onclick="removeExpertise(this)">-</button>
        </div>`;
    container.appendChild(input);
}

function removeExpertise(button) {
    var group = button.closest('.input-group');
    group.parentNode.removeChild(group);
}

</script>
@endsection
