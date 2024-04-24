

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
                        <form action="{{ route('edit.ticket', $ticket->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <label for="">Unit</label> <br>
                            <input class="form-control" name="unit" id="unit" value="{{ $ticket->unit }}" ></input><br>

                            <label for="">Request</label> <br>
                            <input class="form-control" name="request" id="request" value="{{ $ticket->request }}" ></input><br>

                            <label for="">Description</label> <br>
                            <input class="form-control" name="description" id="description" value="{{ $ticket->description }}"></input><br>

                            <button type="submit" class="btn btn-primary col start" name="submit_project">
                                <i class="fas fa-upload"></i>
                                <span>Submit</span>
                            </button>
                        </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
