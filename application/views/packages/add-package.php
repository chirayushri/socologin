<title>New Package <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appPackagesCtrl">
        <div class="card mb-3">
				<div class="card-header">					
					<div class="row">
						<div class="col-12 col-md-10">
							 <!-- Page Heading -->
							  <i class="fa fa-table"></i>
								Add new Package
						</div>
						<div class="col-12 col-md-2 pull-right ">						
							  <button ng-click="goTo('packages','view_package')" type="button" class="btn btn-success">
							   <span class="icon text-white-50">
								  <i class="fa fa-flag"></i>
								</span>
								<span class="text">View Packages</span>
								</button>
							</div>
					</div>
				</div>		
		
				<div class="card-body">				
						<div class="row">
								<div class="col-12 col-md-6">
									<label>Title</label>
									<input type="text"class="form-control" placeholder="Enter Title" ng-model="package.package_name">
								</div>
								
								<div class="col-12  col-md-6">
									<label >Price</label>
									<input type="text"  class="form-control" placeholder="Enter Price" ng-model="package.package_price">
								</div>
								<div class="col-12 col-md-12">
									<label>Description</label>
									<textarea class="form-control" ng-model="package.package_description">Write Package Description here</textarea>
								</div>
								
								<div class="col-12  col-md-12 pt-4">
									<label >Features assigned **</label>
									<div class="row">
										<div class="col-12  col-md-4 pt-4">
										<strong>Team Management</strong>
												<div class="form-check">
													<input id="t1" type="checkbox" class="form-check-input" placeholder="Enter Email" ng-model="package.features.add_member" 
													 ng-true-value="1" 
  													 ng-false-value="0" 
													 ng-checked="package.features.add_member == 1" 
													 >
													<label class="form-check-label" for="t1">Add Team Member</label>
												</div>
												<div class="form-check">
													<input id="t2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.edit_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.edit_member == 1"
													 >
													<label class="form-check-label" for="t2">Edit Team Member</label>
												</div>
												<div class="form-check">
													<input id="t3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.delete_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.delete_member == 1"
													 >
													<label class="form-check-label" for="t3">Delete Team Member</label>
												</div>
												<div class="form-check">
													<input id="t4" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.view_member"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.view_member == 1"
													 >
													<label class="form-check-label" for="t4">View Members</label>
												</div><div class="form-check">
													<input id="r1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.add_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.add_role == 1"
													>
													<label class="form-check-label" for="r1">Add Role</label>
												</div>
												<div class="form-check">
													<input id="r2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.edit_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.edit_role == 1"
													>
													<label class="form-check-label" for="r2">Edit Role</label>
												</div>
												<div class="form-check">
													<input id="r3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.delete_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.delete_role == 1"
													>
													<label class="form-check-label" for="r3">Delete Role</label>
												</div>
												
												<div class="form-check">
													<input id="r4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="package.features.view_role"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.view_role == 1"
													>
													<label class="form-check-label" for="r4">View Roles</label>
												</div>
										</div>
									
											<div class="col-12  col-md-4 pt-4">
										<strong>File Management</strong>
												<div class="form-check">
													<input id="f1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.add_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.add_file == 1"
													>
													<label class="form-check-label" for="f1">Add File</label>
												</div>
												<div class="form-check">
													<input id="f2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.edit_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.edit_file == 1"
													>
													<label class="form-check-label" for="f2">Edit File</label>
												</div>
												<div class="form-check">
													<input id="f3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.delete_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.delete_file == 1"
													>
													<label class="form-check-label" for="f3">Delete File</label>
												</div>
												
												<div class="form-check">
													<input id="f4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="package.features.view_file"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.view_file == 1"
													>
													<label class="form-check-label" for="f4">View Files</label>
												</div>
										</div>
										
										<div class="col-12  col-md-4 pt-4">
										<strong>Page Management</strong>
												<div class="form-check">
													<input id="pg1" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.add_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.add_page == 1"
													>
													<label class="form-check-label" for="pg1">Add Page</label>
												</div>
												<div class="form-check">
													<input id="pg2" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.edit_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.edit_page == 1"
													>
													<label class="form-check-label" for="pg2">Edit Page</label>
												</div>
												<div class="form-check">
													<input id="pg3" type="checkbox" class="form-check-input" placeholder="Enter Email" 
													ng-model="package.features.delete_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.delete_page == 1"
													>
													<label class="form-check-label" for="pg3">Delete Page</label>
												</div>
												
												<div class="form-check">
													<input id="pg4" type="checkbox" class="form-check-input" placeholder="Please select" 
													ng-model="package.features.view_page"
													ng-true-value="1" 
  													ng-false-value="0" 
													ng-checked="package.features.view_page == 1"
													>
													<label class="form-check-label" for="pg4">View Pages</label>
												</div>
										</div>
									
									</div>
								</div>	
								
								
								
								<div class="col-12  col-md-3 pt-4">
										<button ng-click='goToBack()' type="button" class="btn btn-default">Cancel</button>
										<button ng-click='addPackage()' type="button" class="btn btn-success">Add package</button>
										
								</div>
								

								<div class="col-12  col-md-9">
									
								</div>
								
						</div>
				</div>
					
		</div>
</div>
        </div>

</div>
        
</div>