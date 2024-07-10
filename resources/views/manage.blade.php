

@extends('layouts.template') 
@section('content') 
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Manage</h1>
          </div> 
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-widget widget-user shadow">
                            <div class="widget-user-header bg-info">
                                <h4 class="widget-user-desc">ICT Repair and Management <br> Unit</h4>
                            </div>
                            <a href="{{ route('ictrams.index') }}">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ asset('dist/img/MICT-Logo.png') }}" alt="User Avatar">
                                </div>
                            </a>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $countIctramJobTypes }}</h5>
                                            <a href="{{ route('ictrams.JobTypes') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">JOB TYPES</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        <h5 class="description-header">{{ $countIctramEquipments }}</h5>
                                            <a href="{{ route('ictrams.Equipments') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">EQUIPMENTS</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                        <h5 class="description-header">{{ $countIctramProblems }}</h5>
                                            <a href="{{ route('ictrams.Problems') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">ISSUES</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-widget widget-user shadow">
                            <div class="widget-user-header bg-warning">
                                <h3 class="widget-user-username"></h3>
                                <h4 class="widget-user-desc">Network Internet and Communicationations Management   </h4>
                            </div>
                            <a href="{{ route('nicmus.index') }}">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ asset('dist/img/MICT-Logo.png') }}" alt="User Avatar">
                                </div>
                            </a>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        <h5 class="description-header">{{ $countMisRequests }}</h5>
                                            <a href="{{ route('mises.RequestTypes') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">REQUEST TYPE</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        <h5 class="description-header">{{ $countMisAsnames }}</h5>
                                            <a href="{{ route('mises.AsNames') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">ACCOUNTS</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                        <h5 class="description-header">{{ $countMisJobTypes }}</h5>
                                            <a href="{{ route('mises.JobTypes') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">JOB TYPES</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-widget widget-user shadow">
                            <div class="widget-user-header bg-danger">
                                <h4 class="widget-user-desc">Management Information System Unit</h4>
                            </div>
                            <a href="{{ route('mises.index') }}">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ asset('dist/img/MICT-Logo.png') }}" alt="User Avatar">
                                </div>
                            </a>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $countNicmuJobTypes }}</h5>
                                            <a href="{{ route('nicmus.JobTypes') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">JOB TYPES</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $countNicmuEquipments }}</h5>
                                            <a href="{{ route('nicmus.Equipments') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">EQUIPMENTS</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $countNicmuProblems }}</h5>
                                            <a href="{{ route('nicmus.Problems') }}" style="text-decoration: none; color: inherit;">
                                                <span class="description-text">ISSUES</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $OfficeName }}</h3>
                                    
                                    <p>Office Names</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <a href="{{ route('office-names.index') }}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $buildingNumber }}</h3>

                                <p>Building Numbers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('building-numbers.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div> 
@endsection