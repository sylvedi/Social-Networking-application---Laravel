@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div id="wrapper" style="background-color: #ecf0f1;">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
            <h3 class="text-dark mb-4">Admin</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Users Info</p>
                </div>
                <div class="card-body" style="width: 1177px;">
                    <div class="row">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 86px;">Username</th>
                                    <th style="width: 104px;">Firstname</th>
                                    <th style="width: 91px;">Lastname</th>
                                    <th style="width: 175px;">Email</th>
                                    <th style="width: 62px;">City</th>
                                    <th style="width: 10px;">State</th>
                                    <th style="width: 36px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr></tr>
                                <tr></tr>
                                
                                <tr>
                                    <td style="width: -4px;"><img class="rounded-circle mr-2" width="30" height="30" src="{{ asset('img/avatars/avatar5.jpeg') }}" style="margin-top: -2px;">{{ $user->getUsername() }}</td>
                                    <td style="width: 76px;">{{ $user->getFirstname() }}</td>
                                    <td style="width: 69px;">{{ $user->getLastname() }}</td>
                                    <td style="width: 69px;">{{ $user->getEmail() }}</td>
                                    <td>{{ $user->getCity() }}</td>
                                    <td style="width: 15px;">{{ $user->getState() }}</td>
                                    <td style="width: 56px;">
                                    @if (!$user->getSuspended())
                                		<form method="post" action="{{ route('suspendUser') }}">
                                        	{{ csrf_field() }}
                                        	<input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input>
                                        	<button type="submit" value="Suspend">Suspend</button>
                                        </form>
                                    @else
                                    	<form method="post" action="{{ route('unsuspendUser') }}">
                                        	{{ csrf_field() }}
											<input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input>
											<button type="submit" value="Suspend">Restore</button>
                                        </form>
                                    @endif
                                    
                                    <form method="post" action="{{ route('deleteUser') }}">
                                    	{{ csrf_field() }}
                                    	<input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input>
                                    	<button class="btn btn-primary" type="submit" style="width: 36px;height: 37px;margin-right: 14px;background-color: rgb(192,57,43);"><i class="fa fa-trash-o" style="margin-top: -9px;margin-left: -2px;"></i></button>
                                    </form>
                                    
                                    <form method="GET" action="{{ route('editprofile', ['id'=>$user->getId()]) }}"><button class="btn btn-primary" type="submit" style="width: 36px;height: 37px;"><i class="fa fa-save" style="margin-top: -9px;margin-left: -2px;"></i></button><br></form>
                                    
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Firstname</strong></td>
                                    <td><strong>Lastname</strong></td>
                                    <td><strong>Email</strong></td>
                                    <td><strong>City</strong></td>
                                    <td><strong>State</strong></td>
                                    <td><strong></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"></a></div>
@endsection