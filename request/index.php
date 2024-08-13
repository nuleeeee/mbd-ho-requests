<div class="pt-3"></div>

<div class="container pt-5 mt-3">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div class="row mb-3">
				 <div class="col-lg-4">
				 	<input type="text" id="employee_name" class="form-control" readonly>
				 </div>
				 <div class="col-lg-4">
				 	<input type="text" id="employee_position" class="form-control" readonly>
				 </div>
				 <div class="col-lg-4">
				 	<input type="text" id="employee_department" class="form-control" readonly>
				 </div>
			</div>
			<div class="row mb-3">
				 <div class="col-lg-8">
				 	<input type="text" id="request_itemname" class="form-control" placeholder="Item Name">
				 </div>
				 <div class="col-lg-4">
				 	<input type="number" id="request_itemqty" class="form-control" min="1" placeholder="Item Quantity">
				 </div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-12">
					<textarea class="form-control" id="request_reason" rows="3" placeholder="Used for..."></textarea>
				</div>
			</div>
			<div class="row">
				<div class="text-end">
					<button class="btn custom-btn col-lg-4" onclick="send_request_form()">Send Request</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3 mb-5">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div class="table-responsive">
				<div class="col-lg-12" id="grd_requests" style="overflow-x: scroll; margin-top: 10px">

				</div>
			</div>
		</div>
	</div>
</div>

<?php include "modal.php"; ?>

<script>
	var loadGif = "<p align='center'><img src=\"assets/spinner.gif\" width=\"30%\"></p>";

	var cashiername = localStorage.getItem("login_name");
	var datenow = formatDate(new Date());

	myInfo();
	myRequests();

	function send_request_form()
	{
		request_itemname = $("#request_itemname").val().replace(/'/g, "`").replace(/"/g, "&quot;").replace(/(\r\n|\n|\r)/gm, "<br>");
		request_itemqty = $("#request_itemqty").val();
		request_reason = $("#request_reason").val().replace(/'/g, "`").replace(/"/g, "&quot;").replace(/(\r\n|\n|\r)/gm, "<br>");

		if (request_itemname == "" || request_itemqty == "" || request_reason == "") {
			shownotif("Fill in the blanks",3);
			return;
		}

		$.post("request/php/sendrequestform.php", {
			request_itemname: request_itemname,
			request_itemqty: request_itemqty,
			request_reason: request_reason
		}, function(result) {
			if (result == 1) {
				shownotif("Success",1);
				myRequests();
				clearInput();
			} else {
				shownotif(result,3);
			}
		});
	}


	function myInfo() {
		$.post("request/php/getinfo.php", {}, function(result){
			data = JSON.parse(result);
			$('#employee_name').val(data.personnel);
			$('#employee_position').val(data.position);
			$('#employee_department').val(data.deptname);
		});
	}


	function myRequests() {
		$("#grd_requests").html(loadGif);
		$.post("request/php/getrequests.php", {}, function (result) {
			$("#grd_requests").html(result);
		});
	}


	function open_reason(reason) {
		$("#modal_reason").modal("show");

		$("#uses_txt").html(reason);
	}


	function edit_request(req_id, itemname, qty, reason, disreason) {
		$("#modal_edit").modal("show");

		if(disreason == "-") {
			$(".div-disapproved").addClass("d-none");
		} else {
			$(".div-disapproved").removeClass("d-none");
		}

		$("#txt_itemname").val(itemname);
		$("#txt_qty").val(qty);
		$("#txt_reason").val(reason);
		$("#txt_disapprovedreason").val(disreason);

		$().off().on("click", function(e) {
			save_edit(req_id);
		});
	}


	function save_edit(req_id) {
		txt_itemname = $("#txt_itemname").val();
		txt_qty = $("#txt_qty").val();
		txt_reason = $("#txt_reason").val();

		$.post("request/php/saveedit.php", {
			req_id:req_id,
			txt_itemname: txt_itemname,
			txt_qty: txt_qty,
			txt_reason: txt_reason
		}, function(result) {
			if(result == 1) {
				shownotify("Changes applied", 1);
				myRequests();
			} else {
				shownotify(result, 3);
				return;
			}
		});
	}


	function clearInput() {
		$("#request_itemname").val("");
		$("#request_itemqty").val("");
		$("#request_reason").val("");
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
			alert("ZXC");
		}
	};

</script>