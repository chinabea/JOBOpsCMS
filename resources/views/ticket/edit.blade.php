
@extends('layouts.template')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Ticket</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Ticket</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a class="dropdown-item" href="#">Settings 1</a>
                  </li>
                  <li><a class="dropdown-item" href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            
            <form action="{{ route('edit.ticket', $ticket->id) }}" method="post">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Requested by <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="first-name" required="required" class="form-control" value="{{ $ticket->user->name }}" disabled>
                  </div>
                </div>

                
                <div class="field item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Assign to<span class="required">*</span></label>
					<div class="col-md-6 col-sm-6">
						@if(isset($userIds) && $userIds->isNotEmpty())
						<select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
							@foreach($userIds as $user)
								<option value="{{ $user->id }}"
										@foreach($ticket->users as $assigned_user)
											{{ $assigned_user->id == $user->id ? 'selected' : '' }}
										@endforeach>
									{{ $user->name }}
								</option>
							@endforeach
						</select>
						@endif
					</div>
				</div>

                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Location Service <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="service_location" name="service_location" required="required" class="form-control" value="{{ $ticket->service_location }}">
                  </div>
                </div>
                <div class="item form-group">
                  <label for="unit" class="col-form-label col-md-3 col-sm-3 label-align">Unit</label>
                  <div class="col-md-6 col-sm-6 ">
                    <input id="unit" class="form-control" type="text" name="unit" value="{{ $ticket->unit }}">
                  </div>
                </div>
                <div class="item form-group">
                  <label for="request" class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
                  <div class="col-md-6 col-sm-6 ">
                    <input id="request" class="form-control" type="text" name="request" value="{{ $ticket->request }}">
                  </div>
                </div>


                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Priority Level</label>
                  <div class="col-md-6 col-sm-6">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                      <label class="btn btn-danger <?= ($priority_level == 'High') ? 'active' : '' ?>" data-toggle-class="btn-warning" data-toggle-passive-class="btn-default">
                        <input type="radio" name="priority_level" value="High" class="join-btn" <?= ($priority_level == 'High') ? 'checked' : '' ?>> &nbsp; High &nbsp;
                      </label>
                      <label class="btn btn-warning <?= ($priority_level == 'Mid') ? 'active' : '' ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="priority_level" value="Mid" class="join-btn" <?= ($priority_level == 'Mid') ? 'checked' : '' ?>> Mid
                      </label>
                      <label class="btn btn-secondary <?= ($priority_level == 'Low') ? 'active' : '' ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="priority_level" value="Low" class="join-btn" <?= ($priority_level == 'Low') ? 'checked' : '' ?>> Low
                      </label>
                    </div>
                  </div>
                </div>

                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
                  <div class="col-md-6 col-sm-6">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                      <label class="btn btn-secondary <?= ($status == 'Open') ? 'active' : '' ?>" data-toggle-class="btn-warning" data-toggle-passive-class="btn-default">
                        <input type="radio" name="status" value="Open" class="join-btn" <?= ($status == 'Open') ? 'checked' : '' ?>> &nbsp; Open &nbsp;
                      </label>
                      <label class="btn btn-warning <?= ($status == 'In Progress') ? 'active' : '' ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="status" value="In Progress" class="join-btn" <?= ($status == 'In Progress') ? 'checked' : '' ?>> In Progress
                      </label>
                      <label class="btn btn-info <?= ($status == 'Closed') ? 'active' : '' ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="status" value="Closed" class="join-btn" <?= ($status == 'Closed') ? 'checked' : '' ?>> Closed
                      </label>
                    </div>
                  </div>
                </div>

                <div class="item form-group">
                  <label for="file_path" class="col-form-label col-md-3 col-sm-3 label-align">Upload File</label>
                  <div class="col-md-6 col-sm-6 ">
                    <input id="file_path" class="form-control" type="file" name="file_path">
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="item form-group justify-content-center">
                  <div class="col-md-6 col-sm-6 offset-md-3">
									<button class="btn btn-primary" id="reset" type="reset">Reset</button>
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
<!-- /page content -->


@endsection
