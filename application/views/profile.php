
<title>View Profile - Welcome in App</title>

<div class="container-fluid">
        <h1 class="mt-4">Profile Details</h1>
     		
		<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Profile Details</div>
			  <div class="card-body">
				<div class="table-responsive">
				  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">					
					  <?php 
					  foreach($this->session->userdata('logged_user') as $user=>$key){
						?>

					  <tr>
						<td><strong><?=$user?></strong></td>
						<td><?=$key?></td>
					  </tr>
					  
						<?php	
					  }
					  ?>					
					</table>
				</div>
			  </div>         
        </div>
</div>
    