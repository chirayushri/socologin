<title>New Page <?=$this->session->userdata('logged_user')['name']?>- Welcome in App</title>

<div class="container-fluid pt-2" ng-controller="appPageCtrl">
        <div class="card mb-3">
				<div class="card-header">					
					<div class="row">
						<div class="col-12 col-md-10">
							 <!-- Page Heading -->
							  <i class="fa fa-table"></i>
								Add new Page
						</div>
						<div class="col-12 col-md-2 pull-right ">						
							  <button ng-click="goTo('pages','view_page')" type="button" class="btn btn-success">
							   <span class="icon text-white-50">
								  <i class="fa fa-flag"></i>
								</span>
								<span class="text">View Pages</span>
								</button>
							</div>
					</div>
				</div>		
		
				<div class="card-body">				
						<div class="row">
								<div class="col-12 col-md-6">
									<label>Web Title</label>
									<input type="text"class="form-control" placeholder="Enter Title" ng-model="page.page_name">
								</div>
								
								<div class="col-12 col-md-12">
									<label>Description</label>
									<textarea class="form-control" ng-model="page.page_description">Write page Description here</textarea>
								</div>
								
								<div class="col-12  col-md-12 pt-4">
									<label >Pages added **</label>
									<div id="w-{{$index}}" class="row pt-2" data-ng-repeat="item in page.pages">
											<div class="col-12  col-md-5">
												<input class="form-control" type="text" ng-model="page.pages[$index].name" name="" placeholder="Enter a page name">
											</div>
											
											<div class="col-12  col-md-5">
												<input class="form-control" type="text" ng-model="page.pages[$index].slug" name="" placeholder="Enter a page slug">
											</div>
											
											<div class="col-12  col-md-2 ">
												<button class="btn btn-info btn-circle btn-sm" ng-show="showRow(item)" ng-click="addRow()">
													<i class="fa fa-plus"></i>
												</button>
												
												<button class="btn btn-danger btn-circle btn-sm" ng-click="removeRow($index)">
													<i class="fa fa-trash"></i>
												</button>
											</div>							
																				
									</div>
								</div>	
								
								
								
								<div class="col-12  col-md-3 pt-4">
										<button ng-click='goToBack()' type="button" class="btn btn-default">Cancel</button>
										<button ng-click='addPage()' type="button" class="btn btn-success">Add page</button>
										
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