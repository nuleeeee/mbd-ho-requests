<div class="pt-5 mt-3"></div>

<div class="container mt-3">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div>
				<h3>For Immediate Use</h3>
			</div>
			<div class="col-lg-4">
				<select id="foruse_item" class="form-select" onchange="limitQuantity()">

				</select>
			</div>
			<div class="col-lg-4">
				<input type="number" id="foruse_qty" min="1" class="form-control" placeholder="Quantity you want to use...">
			</div>
			<div class="col-lg-4">
				<button class="btn custom-btn w-100" onclick="send_for_use()">Apply For Use</button>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3 mb-5">
	<div class="rounded-3 p-3 shadow-sm bg-white">
		<div class="row">
			<div class="col-lg-12" id="grd_used" style="overflow-x: scroll; margin-top: 10px">

			</div>
		</div>
	</div>
</div>

<?php include("modal.php"); ?>

<script>
	var loadGif = "<p align='center'><img src=\"assets/blocks.gif\" width=\"30%\"></p>";


	init();
	getMyUsedItems();


	function init() {
		$.post("used/php/getlistofitems.php", {}, function(result) {
			$("#foruse_item").html(result);
		});
	}


	function getMyUsedItems() {
		$.post("used/php/getmyusedlist.php", {}, function(result) {
			$("#grd_used").html(result);
		});
	}

	var max_limit = 0;

	function limitQuantity() {
		$("#foruse_qty").val("");
		item_id = $("#foruse_item").val();
		$.post("used/php/getquantity.php", {
			item_id: item_id
		}, function(result) {
			max_limit = result;
			$("#foruse_qty").prop("max", max_limit);
		});
	}


	$("#foruse_qty").on("input", function() {
		var inputValue = $(this).val();
		if (parseInt(inputValue) === 0) {
			$(this).val(1);
		} else if (parseInt(inputValue) > max_limit) {
			$(this).val(max_limit);
		}
	});


	function send_for_use() {
		item = $("#foruse_item").val();
		item_label = $("#foruse_item option:selected").text();
		qty = $("#foruse_qty").val();
		if(qty == 0 || item_label == "Please Select") { alert("Invalid"); return; }
		if (confirm("For verification, you'd like to use " + qty + " of " + item_label + "?")) {
			$.post("used/php/sendforuse.php", {
				item: item,
				qty: qty
			}, function(result) {
				if (result == 1) {
					shownotif("(" + qty + ")" + " " + item_label + " is deducted to the inventory.",1);
					getMyUsedItems();
					clearInput();
				} else {
					shownotif(result,3);
					return;
				}
			});
		}
	}


	function clearInput() {
		$("#foruse_item").val(0);
		$("#foruse_qty").val("");
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
			alert("Alt Q");
		}
	};

</script>