<title>Members <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appMembersCtrl">
        <div class="card mb-3">
				<div class="card-header">					
					<div class="row">
						<div class="col-12 col-md-10">
							 <!-- Page Heading -->
							  <i class="fa fa-table"></i>
								Edit Member
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
						<div class="row">
								<div class="col-12 col-md-6">
									<label>Email</label>
									<input type="text"class="form-control" placeholder="Enter Email" ng-model="member.emailBy">
								</div>
								
								<div class="col-12  col-md-6">
									<label >Password</label>
									<input disabled type="password"  class="form-control" placeholder="*******" ng-model="member.passwordBy">
									<input id="param1" type="hidden" value="<?=$param1?>">
								</div>
								<div class="col-12 col-md-6">
									<label>Name</label>
									<input type="text"class="form-control" placeholder="Enter name" ng-model="member.nameBy">
								</div>
								
								<div class="col-12  col-md-6">
									<label >Role</label>
									<select class="form-control" title="Select Role*" data-live-search="true" ng-model="member.roleBy">
											<option data-hidden="true" value="">Select Role*</option>
											<option ng-repeat="item in app_roles" ng-value="item.role_id">{{item.title}}</option>		
									</select>
								</div>
								<div class="col-12  col-md-3 pt-4">
										<button ng-click='goToBack()' type="button" class="btn btn-default">Cancel</button>
										<button ng-click='saveMember()' type="button" class="btn btn-success">Save</button>
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