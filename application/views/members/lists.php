<title>Members <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appMembersCtrl">

        <div class="card mb-3">
			<div class="card-header">				
				<div class="row">
					<div class="col-12 col-md-10">
						 <!-- Page Heading -->
						  <i class="fa fa-table"></i>
							Members in App
					</div>
					<div class="col-12 col-md-2 pull-right ">
						
					<button ng-click="goTo('member/add','add_member')" class="btn btn-primary btn-icon-split">
						<span class="icon text-white-50">
						  <i class="fa fa-flag"></i>
						</span>
						<span class="text">New Member</span>
					  </button>
					</div>
				</div>
			</div>
			
			  <div class="card-body">
				<div class="table-responsive">
				<div class="row pb-2">
						<div class="col-4 col-md-3 text-center">
									<select class="form-control f-14" ng-model="filterBy" ng-change="getData()">
										<option value="all">All Members</option>
										<option value="added">Recently added Members </option>
										<option value="updated">Recently modified Members </option>
										<option value="weekly">Last week added members </option>
										<option value="monthly">Last month added members </option>
									</select>
						</div>
						<div class="col-4 col-md-3 text-center">
										
						</div>
						<div class="col-4 col-md-4 text-center">
										<div class="input-group">
											<input class="form-control" placeholder="Search here" type="text" ng-model="searchBy" ng-change="getData()">
											 <div class="input-group-append">
											   <button class="btn" type="submit"> <i class="fa fa-search"></i></button>
											 </div>
										   </div>
						</div>
						<div class="col-4 col-md-2 text-center">
												<select class="form-control" ng-model="pageBy" ng-change="getData()" >
													<option>10</option>
													<option>20</option>
													<option>30</option>
												</select>
						</div>
					</div>	
		
					<div ng-if="total_rows < 1">							  
						<?php
						 $this->load->view('modules/no-record');
						?>
					</div>
				
				  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" ng-if="total_rows > 0">
					<thead>
					  <tr>
						<th>
							<div class="pull-left mt6">
								<input id="check-All" type="checkbox" ng-click="checkAll(results)" ng-checked="results && isAllSelected(results)"
								 ng-model="allChecked">
								<label for="check-All"></label>
							</div>
						</th>
						<th class="table-options" style="display:none" colspan="5"> 
								 <a ng-href='' ng-click='deleteMembers()' class="btn btn-danger btn-circle btn-sm">
									<i class="fa fa-trash"></i> Delete
								 </a>
						</th>
						<th class="table-cols" ng-click="sortData('name')">Name 
								<i ng-show="orderBy!='name'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='name'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols" ng-click="sortData('email')">Email 
								<i ng-show="orderBy!='email'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='email'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols" ng-click="sortData('role_id')">Role
								<i ng-show="orderBy!='role_id'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='role_id'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols" ng-click="sortData('status')">Status
								<i ng-show="orderBy!='status'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='status'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols" ng-click="sortData('created_at')">Joined at
								<i ng-show="orderBy!='created_at'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='created_at'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols">Actions</th>
						</div>	
					  </tr>
					</thead>
					
					<tbody >				
					  <tr ng-repeat="item in results">
						<td>
							<div class="pull-left mt6">
								<input id="check-{{item.member_id}}" type="checkbox" class="check-account checkbox-active" value="{{item.member_id}}"
											 ng-click="checkCustom(item.member_id)" ng-model="item.checked">
								<label for="check-{{item.member_id}}"></label>
							</div>
						</td>
						<td>{{item.name}}</td>
						<td>{{item.email}}</td>
						<td>{{item.role_title}}</td>
						<td>
							<button ng-click='statusMember(item.member_id,1)' ng-show='item.status==1' type="button" class="btn btn-success">Active</button>
							<button ng-click='statusMember(item.member_id,0)' ng-show='item.status==0' type="button" class="btn btn-danger">Inactive</button>
						</td>
						<td>{{item.created_at*1000 | date}}</td>
						<td>
						 <a ng-href='' ng-click='goToEditMember(item.member_id)' class="btn btn-success btn-circle btn-sm" >
								<i class="fa fa-pencil"></i>
							 </a>
							 <a ng-href='' ng-click='viewMember($index)' class="btn btn-primary btn-circle btn-sm">
								<i class="fa fa-eye"></i>
							 </a>
							 <a ng-href='' ng-click='deleteMembers(item.member_id)' class="btn btn-danger btn-circle btn-sm" >
								<i class="fa fa-trash"></i>
							 </a>
						</td>
					  </tr>
					</tbody>
				  </table>
				  <!-- Pagination Div Start -->
					<div class="row mt15 mt-md30" ng-show="total_rows > 0">
						<div class="col-12 col-md-5 mb10 mb-md0 f-14">
							<div class="d-flex justify-content-start align-items-center mb5">
									<span class="bs-h40 entries-width px15">
									
									</span>
									<span class="d-none d-xl-block">Showing {{(currentPage - 1) * pageBy + 1}} to {{end}} of {{total_rows}} entries</span>
							</div> 	
						</div>
						<div class="col-12 col-md-7 text-right pull-right">

							<ul uib-pagination total-items="total_rows" ng-model="currentPage" max-size="3" class="f-14"
							 items-per-page="pageBy" boundary-link-numbers="true" rotate="true" previous-text="&#9668;" next-text="&#9658;"></ul>

						</div>
					</div>
					<!-- Pagination Div End  -->
				</div>
		</div>
</div>

</div>
        
</div>