@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ticket</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
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
                    <h2>Request a Ticket</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="">Location</label>
                            <input class="form-control" name="service_location" id="service_location" required></input>
                        </div>
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input class="form-control" name="unit" id="unit" required></input>
                        </div>
                        <div class="form-group">
                            <label for="">Request</label>
                            <input class="form-control"name="request" id="request" required></input>
                        </div>
                        <div class="form-group">
                            <label for="">Priority Level</label>
                            <select name="priority_level" id="priority_level" class="form-control" required>
                                @foreach ($priorities as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Deadline</label>
                            <input type="date" class="form-control"name="deadline" id="deadline" required></input>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input class="form-control"name="description" id="description" required></input>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file_upload">
                                <label class="custom-file-label" for="exampleInputFile"></label>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-round btn-success">Submit</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
