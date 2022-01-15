@extends('layouts.layout')
@section('content')
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">

        <!-- sidebar menu area start -->
        @include('layouts.sidebar')
        <!-- sidebar menu area end -->

        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="">log out</a>
                                <form id="logout-form" action="" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Table Default</h4>
                                <div class="col-lg-6 mt-5">
                                        <div class="card-body">
                                            <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#exampleModalCenter">Add Employee</button>
                                            <div class="modal fade" id="exampleModalCenter">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span>Add Employee</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="addEmployee" method="POST">
                                                                @csrf
                                                                    <div class="row">
                                                                      <div class="col">
                                                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                                                        @error('name')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                      </div>
                                                                      <div class="col">
                                                                        <input type="text" name="position" class="form-control" placeholder="Position">
                                                                        @error('position')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                      </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                          <input type="text" name="address" class="form-control" placeholder="Address">
                                                                          @error('address')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                        </div>
                                                                        <div class="col">
                                                                          <input type="number" name="age" class="form-control" placeholder="Age">
                                                                          @error('age')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                        </div>
                                                                      </div><br>
                                                                      <div class="form-group">
                                                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                        <small id="emailHelp" name="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                                        @error('email')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="password"">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="number" name="is_admin" class="form-control" placeholder="is admin?">
                                                                        @error('is_admin')
                                                                            <div class="alert alert-danger">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                              </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>                                <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        @if (session()->has('success'))
                                        <div class="alert alert-success text-center">
                                            {{session('success')}}
                                        </div>
                                        @endif
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Is_Admin</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <th>Joined at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $item)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->position}}</td>
                                                <td>{{$item->address}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->is_admin}}</td>
                                                <td>
                                                    <form action="show/{{$item->id}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="delete/{{$item->id}}" method="post">
                                                        @csrf
                                                        {{-- @method('DELETE') --}}
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td> 
                                                <td>$item->created_at</td>
                                            </tr>   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection