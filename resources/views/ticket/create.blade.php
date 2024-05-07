

@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row align-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
							<form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input class="form-control" type="hidden" name="user_id" value="{{ auth()->id() }}">

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">Assign to<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
										@foreach($userIds as $user)
											<option value="{{ $user->id }}" data-content="
												<span class='text-black'><strong><br>{{ $user->name }}</strong><br>
												<small>Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }}</small><br>
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
    </section>
</div>

@endsection




