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
                            <h4 class="page-title pull-left">Tasks</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">yousef alsaadany<i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="">log out</a>
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
                                <h4 class="header-title">Tasks</h4>                               
                                <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">
                                            @if (session()->has('success'))
                                                <div class="alert alert-success text-center">{{session('success')}}</div>
                                            @endif
                                            @php
                                                $i= 1;
                                            @endphp
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Project Name</th>
                                                <th>Description</th>
                                                <th>Sent at</th>
                                                <th>Delete</th>
                                                <th>Whatsapp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $item)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->project}}</td>
                                                <td><pre>{{$item->description}}</pre></td>
                                                <td>{{$item->created_at}}</td> 
                                                <td>
                                                    <form action="deleteorder/{{$item->id}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td> 
                                                <td>{{$item->Whatsapp}}</td>
                                            </tr>   
                                            @endforeach
                                            {!!$tasks->links()!!}
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



