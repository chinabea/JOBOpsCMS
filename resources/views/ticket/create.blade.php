@extends('layouts.template')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Create Ticket</h3>
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
						<h2>Ticket Details</small></h2>
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
							<form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
								@csrf
								<input class="form-control" type="hidden" name="user_id" value="{{ auth()->id() }}">

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">Assign to<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
										@foreach($userIds as $user)
											<option value="{{ $user->id }}" data-content="
												<span class='text-black'><strong><br>{{ $user->name }}</strong><br>
												<small>Expertise: {{ $user->expertise ?? 'No Expertise' }}</small><br>
												<small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="service_location">Service Location <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="service_location" name="service_location" required="required" class="form-control ">
								</div>
							</div>
							<div class="item form-group">
								<label for="unit" class="col-form-label col-md-3 col-sm-3 label-align">Unit</label>
								<div class="col-md-6 col-sm-6 ">
									<select id="unit" class="form-control" name="unit">
										<option value=""> Select Unit</option>
										<option value="MICT" name="unit"> MICT</option>
										<option value="MIS" name="unit">MIS</option>
										<option value="Repair" name="unit">Repair</option>
										<option value="Network" name="unit">Network</option>
									</select>
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="request">Request <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="request" name="request" required="required" class="form-control">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Priority Level</label>
								<div class="col-md-6 col-sm-6 ">
									<div id="gender" class="btn-group" data-toggle="buttons">
										<label class="btn btn-danger" data-toggle-class="btn-warning" data-toggle-passive-class="btn-default">
											<input type="radio" name="priority_level" value="high" class="join-btn"> &nbsp; High &nbsp;
										</label>
										<label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="priority_level" value="mid" class="join-btn"> Mid
										</label>
										<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="priority_level" value="low" class="join-btn"> Low
										</label>
									</div>
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">Deadline<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" class='date' type="date" name="deadline" id="deadline" required='required'>
								</div>
							</div>
							<div class="item form-group">
								<label for="description" class="col-form-label col-md-3 col-sm-3 label-align">Description<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 ">
									<textarea id="description" class="form-control" type="text" required="required" name="description"></textarea>
								</div>
							</div>
							<div class="item form-group">
								<label for="file_path" class="col-form-label col-md-3 col-sm-3 label-align">Upload File</label>
								<div class="col-md-6 col-sm-6 ">
									<input id="file_path" class="form-control" type="file" name="file_path">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
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
<script>
$('.selectpicker').selectpicker();

</script>

@endsection
