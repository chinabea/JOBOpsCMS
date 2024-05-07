
@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
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
														<small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
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
    </section>
</div>

@endsection

