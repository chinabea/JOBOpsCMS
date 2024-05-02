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



   
								<div class="x_content">
									<br>
									<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

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
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Unit</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" class="form-control" type="text" name="middle-name" value="{{ $ticket->unit }}">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" class="form-control" type="text" name="middle-name" value="{{ $ticket->request }}">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Assigned to</label>
											<div class="col-md-6 col-sm-6 ">
											<input id="middle-name" class="form-control" type="text" name="middle-name" value="@foreach($ticket->users as $assigned_user){{ $loop->first ? '' : ', ' }}{{ $assigned_user->name }}@endforeach">

											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Priority</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" class="form-control" type="text" name="middle-name" value="{{ $ticket->priority_level }}">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" class="form-control" type="text" name="middle-name" value="{{ $ticket->status }}">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group justify-content-center">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button class="btn btn-primary" type="reset">Reset</button>
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

@endsection
