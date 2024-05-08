@extends('layouts.template')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
  </section>
  
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ $user->avatar}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center"><i class="fa fa-briefcase user-profile-icon"></i> {{ $user->job_position }}</p>
                <p class="text-muted text-center"><i class="fa fa-phone"></i> {{ $user->phone_number }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
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
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            
          <div class="card">
              <div class="card-header">
              <h1 class="card-title"><i class="fas fa-chart-bar"></i> Yearly Summary of Requested Tickets</h1>
          </div>
              <div class="card-body">
              <div class="chart">
                <!-- start of user-activity-graph -->
                <div id="tickets_graph_bar" style="width:100%; height:280px;"></div>
                <!-- end of user-activity-graph -->
                </div>
              </div>
              </div>
              
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                  <table id="example1" class="table table-bordered table-hover text-center table-striped table-sm">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th> Request by</th>
                              <th> Location</th>
                              <th> Unit</th>
                              <th> Request</th>
                              <th> Assigned to</th>
                              <th> Priority Level</th>
                              <th> Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($assignedTickets as $ticket)
                          @if(auth()->user()->role == 1 || auth()->user()->id == $ticket->user_id || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $ticket->user->name }}</td>
                              <td>{{ $ticket->service_location }}</td>
                              <td>{{ $ticket->unit }}</td>
                              <td>{{ $ticket->request }}</td>
                              <td>
                                          @foreach ($ticket->users as $assigned_user)
                                              <small>{{ $assigned_user->name }}</small>    
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
                              <td>{{ $ticket->status }}</td>
                              
                            </tr>
                            @endif
                            @endforeach
                      </tbody>
                  </table>
                  </div>
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    
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
    </section>
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
