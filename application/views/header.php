<!DOCTYPE html>
<html lang="en" ng-app="socApp">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content=""> 

  <!-- Bootstrap core CSS -->
  <link href="<?=base_url('assets/')?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>vendor/toastr/toastr.min.css" rel="stylesheet"/>
  <!-- Custom styles for this template -->
  <link href="<?=base_url('assets/')?>css/simple-sidebar.css" rel="stylesheet">
  
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
  <script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('assets/')?>vendor/toastr/toastr.min.js"></script>
</head>

<body ng-controller="appMainCtrl">

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">BMS </div>
      <div class="list-group list-group-flush">
        <a href="<?=base_url('dashboard')?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="<?=base_url('about')?>" class="list-group-item list-group-item-action bg-light">About us</a>
        <a ng-click="goTo('pages','view_page')" class="list-group-item list-group-item-action bg-light">Web Pages</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">TeamOpera</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('dashboard')?>">Dashboard</a>
            </li>
			<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Package Management
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                <a class="dropdown-item" ng-click="goTo('package/add','add_package')">Add New Package</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" ng-click="goTo('packages','view_package')">Manage Packages</a>
              </div>
            </li>
			<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Team Management
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                <a class="dropdown-item" ng-click="goTo('member/add','add_member')">Add New Member</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" ng-click="goTo('members','view_member')" >Manage Members</a>
                <a class="dropdown-item" ng-click="goTo('member/roles','view_role')">Manage Roles</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?=($this->session->userdata('logged_user')['picture']!='')?$this->session->userdata('logged_user')['picture']:base_url('assets/images/default.png');?>" class="img-responsive img-circle" style="height:30px">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?=base_url('profile')?>">Profile</a>
                <a class="dropdown-item" href="<?=base_url('change-pasword')?>">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?=base_url('logout')?>">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      </nav>
	  
	  
<?php
 $this->load->view('angular-views');
 $this->load->view('modules/app-modals');
?>