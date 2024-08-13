<div class="pt-3"></div>

<div class="container pt-5 mt-3">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div>
				<h3>Request & For Use Approval</h3>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div class="table-responsive">
				<div class="col-lg-12" id="grd_forapproval" style="overflow-x: scroll; margin-top: 10px">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="container pt-5 mt-3">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div>
				<h3>H.O. Inventory</h3>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3 mb-5">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div class="table-responsive">
				<div class="col-lg-12" id="grd_inventory" style="overflow-x: scroll; margin-top: 10px">

				</div>
			</div>
		</div>
	</div>
</div>

<?php include("modal.php"); ?>

<script>
	var loadGif = "<p align='center'><img src=\"assets/spinner.gif\" width=\"30%\"></p>";

	init();
	function init() {
		$("#grd_forapproval").html(loadGif);
		$("#grd_inventory").html(loadGif);

		$.post("monitoring/php/getforapproval.php", {}, function(result1) {
			$("#grd_forapproval").html(result1);
		});

		$.post("monitoring/php/getinventory.php", {}, function(result2) {
			$("#grd_inventory").html(result2);
		});
	}


	function approve_request(req_id) {
		$.post("monitoring/php/approverequest.php", {
			req_id: req_id,
			status: 1
		}, function(result){
			if(result == 1) {
				shownotif("Request Approved",1);
				init();
			} else {
				shownotif(result,3);
				return;
			}
		});
	}


	function disapprove_request(req_id) {
		if(confirm("Disapprove this request?")) {
			$.post("monitoring/php/approverequest.php", {
				req_id: req_id,
				status: 2
			}, function(result) {
				if(result == 1) {
					provide_reason(req_id);
				} else {
					shownotif(result,3);
					return;
				}
			});
		}
	}


	function open_reason(reason) {
		$("#modal_reason").modal("show");

		$("#uses_txt").html(reason);
	}


	function provide_reason(req_id) {
		$("#modal_provide_reason").modal("show");

		$("#save_reason").off().on("click", function(e) {
			reason = $("#reason_provided").val();
			$.post("monitoring/php/reasondisapproval.php", {
				req_id: req_id,
				reason: reason
			}, function(result){
				if(result == 1) {
					$("#modal_provide_reason").modal("hide");
					shownotif("Request Disapproved",1);
					init();
				} else {
					shownotif(result,3);
					return;
				}
			});
		});
	}


	function shownotif(msg,type)
	{
		$('#modal_notification').modal('show');
		$("#notif_1").hide();
		$("#notif_2").hide();
		$("#notif_3").hide();
		$("#notif_4").hide();
		var_forshow = "#notif_" + type;

		$("#notif_txt").html(msg);
		$(var_forshow).show();
	}


	function formatDate(date) {
	var d = new Date(date),
		month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
	}


	document.onkeyup = function(e) {
		//Q
		if(e.altKey && e.which == 81)
		{

		}

	};


</script>