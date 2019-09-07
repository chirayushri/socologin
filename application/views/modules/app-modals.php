<div class="modal" id="app-delete-box" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-delete-size" >
		<div class="modal-content radius5 border-0">
			<div class="modal-body p15 p-md30">
				<img style="height:45px" class="img-fluid d-block mx-auto mb15 mb-md20" ng-src="<?=base_url('assets/images/delete.png')?>">
				<div class="w400 vd-gblue-clr f-16 f-md-18 mb5 text-center delete-confirm-title">Confirm Delete?</div>
				<p class="f-14 d-gblue-clr text-center delete-confirm-msg">Are you sure you want to delete this items? </p>
			</div>
			<div class="pb-2 text-center">
				<a href="javascript:void(0)" class="btn default-btn f-14 mr5" data-dismiss="modal">No</a>
				<a href="#" class="btn btn-danger f-14 mr5 main-btn">Yes</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="app-member-view-box" tabindex="-1" role="dialog" aria-labelledby="viewmember1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewmember1">View member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="card" >
		  <div class="card-header">
			<span id="memberName"></span>
		  </div>
		  <ul class="list-group list-group-flush">
			<li class="list-group-item"><strong>Role  : </strong> <span id="memberRole"></span></li>
			<li class="list-group-item"><strong>Email : </strong><span id="memberEmail"></span></li>
			<li class="list-group-item"><strong>Joined at : </strong> 
       <span id="memberCreated"></span></li>
		  </ul>
		</div>
       
       
       
      </div>
     
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="app-member-vbox" tabindex="-1" role="dialog" aria-labelledby="v34" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="v34">View member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="app-teamError-box" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" >
		<div class="modal-content radius5 border-0">
			<div class="modal-body p15 p-md30">
				<img style="height:45px" class="img-fluid d-block mx-auto mb15 mb-md20" ng-src="<?=base_url('assets/images/package-denied.png')?>">
				<div class="w400 vd-gblue-clr f-16 f-md-18 mb5 text-center delete-confirm-title">Access Denied !</div>
				<p class="f-14 d-gblue-clr text-center delete-confirm-msg">Member have not access to get this feature </p>
				
			</div>
			<div class="pb-2 text-center">
				<a class="btn btn-warning f-14 mr5 main-btn" href="javascript:void(0)" class="btn default-btn f-14 mr5" data-dismiss="modal">Got it</a>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="app-packageError-box" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" >
		<div class="modal-content radius5 border-0">
			<div class="modal-body p15 p-md30">
				<img style="height:45px" class="img-fluid d-block mx-auto mb15 mb-md20" ng-src="<?=base_url('assets/images/team-denied.png')?>">
				<div class="w400 vd-gblue-clr f-16 f-md-18 mb5 text-center delete-confirm-title">Upgrade now !</div>
				<p class="f-14 d-gblue-clr text-center delete-confirm-msg">Please upgrade your plan to access this feature </p>
			</div>
			<div class="pb-2 text-center">
				<a class="btn btn-warning f-14 mr5 main-btn" href="javascript:void(0)" class="btn default-btn f-14 mr5" data-dismiss="modal">Got it</a>
				<a href="#" class="btn btn-danger f-14 mr5 main-btn">Upgrade</a>
			</div>
		</div>
	</div>
</div>


