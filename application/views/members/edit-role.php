<title>Edit Role <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appRolesCtrl">
        <div class="card mb-3">
				<div class="card-header">					
					<div class="row">
						<div class="col-12 col-md-10">
							 <!-- Page Heading -->
							  <i class="fa fa-table"></i>
								Edit Role
						</div>
						<div class="col-12 col-md-2 pull-right ">						
							  <button ng-click="goTo('member/roles')" type="button" class="btn btn-success">
							   <span class="icon text-white-50">
								  <i class="fa fa-flag"></i>
								</span>
								<span class="text">View Roles</span>
								</button>
							</div>
					</div>
				</div>		
		
				<div class="card-body">				
					<form action="" method="">
						<div class="row">
								<div class="col-12 col-md-12">
									<label>Role Title</label>
									<input type="text" class="form-control" placeholder="Enter Title" ng-model="role.title">
									<input type="hidden" id="param2" value="<?=$param1?>"> 
								</div>
								
							<div class="col-12  col-md-12 pt-4">
									<label >Features assigned **</label>
									<div class="row">
										<div class="col-12  col-md-4 pt-4">
										<strong>Package Management</strong>
												<div class="form-check">
													<input id="p1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.add_package"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.add_package == 1"
													>
													<label class="form-check-label" for="p1">Add Package</label>
												</div>
												<div class="form-check">
													<input id="p2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.edit_package"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.edit_package == 1"
													>
													<label class="form-check-label" for="p2">Edit Package</label>
												</div>
												<div class="form-check">
													<input id="p3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.delete_package"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.delete_package == 1"
													>
													<label class="form-check-label" for="p3">Delete Package</label>
												</div>
												
												<div class="form-check">
													<input id="p4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="role.features.view_package"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.view_package == 1"
													>
													<label class="form-check-label" for="p4">View Packages</label>
												</div>
										</div>
										
										<div class="col-12  col-md-4 pt-4">
										<strong>Team Management</strong>
												<div class="form-check">
													<input id="t1" type="checkbox" class="form-check-input" placeholder="Enter Email" ng-model="role.features.add_member" 
													 ng-true-value="1" 
  													 ng-false-value="0" 
													 ng-checked="role.features.add_member == 1" 
													 >
													<label class="form-check-label" for="t1">Add Team Member</label>
												</div>
												<div class="form-check">
													<input id="t2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.edit_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.edit_member == 1"
													 >
													<label class="form-check-label" for="t2">Edit Team Member</label>
												</div>
												<div class="form-check">
													<input id="t3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.delete_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.delete_member == 1"
													 >
													<label class="form-check-label" for="t3">Delete Team Member</label>
												</div>
												<div class="form-check">
													<input id="t4" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.view_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.view_member == 1"
													 >
													<label class="form-check-label" for="t4">View Members</label>
												</div><div class="form-check">
													<input id="r1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.add_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.add_role == 1"
													>
													<label class="form-check-label" for="r1">Add Role</label>
												</div>
												<div class="form-check">
													<input id="r2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.edit_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.edit_role == 1"
													>
													<label class="form-check-label" for="r2">Edit Role</label>
												</div>
												<div class="form-check">
													<input id="r3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.delete_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.delete_role == 1"
													>
													<label class="form-check-label" for="r3">Delete Role</label>
												</div>
												
												<div class="form-check">
													<input id="r4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="role.features.view_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.view_role == 1"
													>
													<label class="form-check-label" for="r4">View Roles</label>
												</div>
										</div>
									
											<div class="col-12  col-md-4 pt-4">
										<strong>File Management</strong>
												<div class="form-check">
													<input id="f1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.add_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.add_file == 1"
													>
													<label class="form-check-label" for="f1">Add File</label>
												</div>
												<div class="form-check">
													<input id="f2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.edit_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.edit_file == 1"
													>
													<label class="form-check-label" for="f2">Edit File</label>
												</div>
												<div class="form-check">
													<input id="f3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.delete_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.delete_file == 1"
													>
													<label class="form-check-label" for="f3">Delete File</label>
												</div>
												
												<div class="form-check">
													<input id="f4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="role.features.view_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.view_file == 1"
													>
													<label class="form-check-label" for="f4">View Files</label>
												</div>
										</div>
										
										<div class="col-12  col-md-4 pt-4">
										<strong>Page Management</strong>
												<div class="form-check">
													<input id="pg1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.add_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.add_page == 1"
													>
													<label class="form-check-label" for="pg1">Add Page</label>
												</div>
												<div class="form-check">
													<input id="pg2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.edit_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.edit_page == 1"
													>
													<label class="form-check-label" for="pg2">Edit Page</label>
												</div>
												<div class="form-check">
													<input id="pg3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="role.features.delete_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.delete_page == 1"
													>
													<label class="form-check-label" for="pg3">Delete Page</label>
												</div>
												
												<div class="form-check">
													<input id="pg4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="role.features.view_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="role.features.view_page == 1"
													>
													<label class="form-check-label" for="pg4">View Pages</label>
												</div>
										</div>
										
									
									
									</div>
								</div>	
								
								
								                                                                                                           	
								
								
								
								<div class="col-12  col-md-3 pt-4">
										<button ng-click='goToBack()' type="button" class="btn btn-default">Cancel</button>
										<button ng-click='saveRole()' type="button" class="btn btn-success">Save</button>
								</div>
								<div class="col-12  col-md-9">
									
								</div>
								
						</div>
					</form>
				</div>
					
		</div>
</div>
        </div>

</div>
        
</div>