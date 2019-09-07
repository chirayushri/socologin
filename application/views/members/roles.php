<title>Roles <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appRolesCtrl">

        <div class="card mb-3">
			<div class="card-header">				
				<div class="row">
					<div class="col-12 col-md-10">
						 <!-- Page Heading -->
						  <i class="fa fa-table"></i>
							Roles in App
					</div>
					<div class="col-12 col-md-2 pull-right ">						
							  <button ng-click="goTo('member/role/add','add_role')" type="button" class="btn btn-success">
							   <span class="icon text-white-50">
								  <i class="fa fa-flag"></i>
								</span>
								<span class="text">Add Role</span>
								</button>
					</div>
				</div>
			</div>
			
			  <div class="card-body">
				<div class="table-responsive">
				<div class="row pb-2">
						<div class="col-4 col-md-3 text-center">
								<div class="input-group">
											<input class="form-control" placeholder="Search here" type="text" ng-model="searchBy" ng-change="getData()">
											 <div class="input-group-append">
											   <button class="btn" type="submit"> <i class="fa fa-search"></i></button>
											 </div>
										   </div>	
						</div>
						<div class="col-4 col-md-3 text-center">
										
						</div>
						<div class="col-4 col-md-4 text-center">
										
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
								 <a ng-href='' ng-click='deleteItems()' class="btn btn-danger btn-circle btn-sm">
									<i class="fa fa-trash"></i> Delete
								 </a>
						</th>
						<th class="table-cols" ng-click="sortData('title')">Role 
								<i ng-show="orderBy!='title'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='title'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols" ng-click="sortData('created_at')">Joined at
								<i ng-show="orderBy!='created_at'" class="fa fa-sort"></i>
								<i ng-show="orderBy=='created_at'" class="fa {{ (orderType == 'desc' )? 'fa-sort-desc' : 'fa-sort-asc'}}"></i>
						</th>
						<th class="table-cols">Actions</th>
						</div>	
					  </tr>
					</thead>
					
				  <tbody>				
					  <tr ng-repeat="item in results">
						<td>
							<div class="pull-left mt6">
								<input id="check-{{item.role_id}}" type="checkbox" class="check-account checkbox-active" value="{{item.role_id}}"
											 ng-click="checkCustom(item.role_id)" ng-model="item.checked">
								<label for="check-{{item.role_id}}"></label>
							</div>
						</td>
						<td>{{item.title}}</td>
						<td>{{item.created_at*1000 | date}}</td>
						<td>
						 <a ng-href='' ng-click='goToEditRole(item.role_id)' class="btn btn-success btn-circle btn-sm" >
								<i class="fa fa-pencil"></i>
							 </a>
							 <a ng-href='' ng-click='deleteRoles(item.role_id)' class="btn btn-danger btn-circle btn-sm" >
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

							<ul uib-pagination total-items="total_rows" ng-model="currentPage" max-size="3" class="rounded-pagination f-14"
							 items-per-page="pageBy" boundary-link-numbers="true" rotate="true" previous-text="&#9668;" next-text="&#9658;"></ul>



						</div>
					</div>
					<!-- Pagination Div End  -->
				</div>
			  </div>
        </div>

</div>
        
</div>