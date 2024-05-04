@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tickets</h3>
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
            <h2>Requested Ticket</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="{{ route('create.ticket') }}" class="btn btn-round btn-success">
                  <i class="fa fa-plus-square"></i> Add Ticket
              </a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> 
			<br>
			<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
				<div class="field item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">
						Assign to<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6">
						@if(isset($userIds) && $userIds->isNotEmpty())
							<select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
								@foreach($userIds as $user)
									<option value="{{ $user->id }}" 
										@foreach($ticket->users as $assigned_user)
											{{ $assigned_user->id == $user->id ? 'selected' : '' }}
										@endforeach>
										<span class='text-black'>
											<strong>{{ $user->name }}</strong><br>
											<small>Expertise: {{ $user->expertise ?? 'No Expertise' }}</small><br>
											<small>Assigned to Tickets: {{ $user->tickets->count() }}</small><br>
										</span>
									</option>
								@endforeach
							</select>
						@endif
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Requested by <span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" id="first-name" required="required" class="form-control" value="{{ $ticket->user->name }}" disabled>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Location Service <span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" id="last-name" name="last-name" required="required" class="form-control" value="{{ $ticket->service_location }}">
					</div>
				</div>
				<div class="item form-group">
					<label for="unit" class="col-form-label col-md-3 col-sm-3 label-align">Unit</label>
					<div class="col-md-6 col-sm-6 ">
						<select id="unit" class="form-control" name="unit">
							<option value="MICT" {{ $ticket->unit == 'MICT' ? 'selected' : '' }}> MICT</option>
							<option value="MIS" {{ $ticket->unit == 'MIS' ? 'selected' : '' }}>MIS</option>
							<option value="Repair" {{ $ticket->unit == 'Repair' ? 'selected' : '' }}>Repair</option>
							<option value="Network" {{ $ticket->unit == 'Network' ? 'selected' : '' }}>Network</option>
						</select>
					</div>
				</div>
				<div class="item form-group">
					<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
					<div class="col-md-6 col-sm-6 ">
						<input id="middle-name" class="form-control" type="text" name="middle-name" value="{{ $ticket->request }}">
					</div>
				</div>
				<div class="item form-group">
					<label for="priority_level" class="col-form-label col-md-3 col-sm-3 label-align">Priority</label>
					<div class="col-md-6 col-sm-6 ">
						<select id="priority_level" class="form-control" name="priority_level">
							<option value="High" {{ $ticket->priority_level == 'High' ? 'selected' : '' }}>High</option>
							<option value="Mid" {{ $ticket->priority_level == 'Mid' ? 'selected' : '' }}>Mid</option>
							<option value="Low" {{ $ticket->priority_level == 'Low' ? 'selected' : '' }}>Low</option>
						</select>
					</div>
				</div>
				<div class="item form-group">
					<label for="status" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
					<div class="col-md-6 col-sm-6 ">
						<select id="status" class="form-control" name="status">
							<option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
							<option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
							<option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
						</select>
					</div>
				</div>
				<div class="item form-group">
					<label for="description" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea id="description" class="form-control" type="text" name="description" value="{{ $ticket->description }}"></textarea>
					</div>
				</div>
				<div class="ln_solid"></div>
				<div class="item form-group justify-content-center">
					<div class="col-md-6 col-sm-6 offset-md-3">
						<button class="btn btn-secondary btn-round" type="button" onclick="history.back();"><i class="fa fa-reply"></i> Cancel</button>
						<button class="btn btn-primary btn-round" id="reset" type="reset"><i class="fa fa-refresh"></i> Reset</button>
						<button type="submit" class="btn btn-info btn-round"><i class="fa fa-upload"></i> Submit</button>
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

@endsection
