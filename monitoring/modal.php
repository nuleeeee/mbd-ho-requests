<!-- NOTIFICATION POPUP -->
<div class="modal fade" id="modal_notification"  tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
        	<img src="assets/icons/success.png" id="notif_1" style="width:50px"/>
        	<img src="assets/icons/warning.png" id="notif_2" style="width:50px"/>
        	<img src="assets/icons/error.png" id="notif_3" style="width:50px"/>
        	<img src="assets/icons/information.png" id="notif_4" style="width:50px"/>
        	Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
         	<label id="notif_txt"></label>
     	 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- VIEW REASON POPUP -->
<div class="modal fade" id="modal_reason"  tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
				<img src="assets/icons/information.png" style="width:30px"/>
				Used for...</h5>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<label id="uses_txt"></label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- PROVIDE REASON POPUP -->
<div class="modal fade" id="modal_provide_reason"  tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
				<img src="assets/icons/information.png" style="width:30px"/>
				Reason for Disapproval</h5>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<textarea id="reason_provided" class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn custom-btn" id="save_reason">Save</button>
			</div>
		</div>
	</div>
</div>