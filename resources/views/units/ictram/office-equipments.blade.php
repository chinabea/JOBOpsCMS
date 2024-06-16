
@extends('layouts.template') @section('content') 
<div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title font-weight-bold">Equipments</h1>
                            <div class="mb-5"></div>
                            <table id="example1" class="table table-bordered table-sm text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Office</th>
                                        <th>Equipment</th>
                                        <th>Number of Request</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topRequestedOffices as $equipment)
                                        @if($equipment->ictramEquipment && $equipment->ictramEquipment->equipment_name !== 'N/A')
                                            <tr>
                                                <td>{{ $equipment->office_name }}</td>
                                                <td>{{ $equipment->ictramEquipment->equipment_name }}</td>
                                                <td>{{ $equipment->request_count }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 

@endsection