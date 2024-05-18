
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
                            <h1 class="card-title font-weight-bold">Purchased Equipments</h1>
                            <div class="mb-5"></div>
                            <table id="example1" class="table table-bordered table-sm text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Equipment</th>
                                        <th>Number of Equipment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Equipments</td>
                                        <td>300</td>
                                    </tr>
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