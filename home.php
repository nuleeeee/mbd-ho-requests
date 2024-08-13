<?php
    require_once("phpconfig/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Office Requests</title>

    <!-- Bootstrap 5.2 -->
    <link href="stylesheets/css/bootstrap.min.css" rel="stylesheet">
    <script src="stylesheets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="stylesheets/css/jquery.datatables.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/css/fixedColumns.dataTables.min.css">
    <link href="stylesheets/css/buttons.datatables.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="stylesheets/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/mbd_logo.ico">
    <link rel="stylesheet" href="stylesheets/styles.css">

    <!-- JQuery -->
    <script type="text/javascript" src="stylesheets/js/jquery-3.7.0.js"></script>

    <!-- Data Tables Min -->
    <script type="text/javascript" charset="utf8" src="stylesheets/js/jquery.datatables.min.js"></script>

    <!-- Alertify JS -->
    <link rel=" stylesheet" href="stylesheets/css/alertify.min.css" />
    <link rel="stylesheet" href="stylesheets/css/bootstrap.rtl.min.css" />

    <!-- SELECT2 -->
    <link rel="stylesheet" href="stylesheets/css/select2.min.css" />
    <script src="stylesheets/js/select2.min.js"></script>

    <!-- Excel -->
    <script src="stylesheets/js/xlsx.full.min.js"></script>

</head>

<body>


    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="home.php"><img src="assets/image2.png" height="40" alt="MBD-Logo"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideBar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="sideBar">
                    <div class="offcanvas-header">
                        <img src="assets/image2.png" height="40" alt="MBD-Logo"/>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_request">
                                    <img src="assets/icons/request.png" height="20" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Request</span>
                                </button>
                            </li>
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_monitoring">
                                    <img src="assets/icons/monitoring.png" height="20" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Monitor</span>
                                </button>
                            </li>
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_used">
                                    <img src="assets/icons/used.png" height="20" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Used</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_logout">
                                    <img src="assets/icons/logout.png" height="20" class="me-2">
                                    <span class="fw-bold lh-1" style="font-size: 12px;">Logout</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->


    <!--Main layout-->
    <main>
        <div id="masterDiv" style="z-index: 1;">

        </div>
    </main>
    <!--Main layout-->


    <!-- MODALS -->
    <div class="modal fade" id="NewModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">

                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="submitBtn">
                        <strong>Submit</strong>
                        <span class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


<!-- Alertify JS -->
<script src="stylesheets/js/alertify.min.js"></script>

<script type="text/javascript">
    // LOGGED IN USER
    var cashiername = localStorage.getItem("login_name");

    $(document).ready(function() {
        if (localStorage.getItem("alertShown") !== "true") {
            localStorage.setItem("alertShown", "true");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Welcome " + cashiername);
        }
    });

    // THIS IS THE ACTIVE ON CLICK FUNCTION
    $(".menu-button").on("click", function() {
        $(".menu-button").removeClass("clicked");
        $(this).addClass("clicked");
    });

    // Initialized
    readfilesphp("homepage/");

    // THIS IS THE LINK NAVIGATION FUNCTIONS
    $("#link_request").click(function(e) {
        readfilesphp("request/");
    });

    $("#link_monitoring").click(function(e) {
        readfilesphp("monitoring/");
    });

    $("#link_used").click(function(e) {
        readfilesphp("used/");
    });

    function readfilesphp(url) {
        $.get(url, function(data) {
            $("#masterDiv").html(data);
        });
    }

    $("#link_logout").click(function(e) {
        $("#NewModal").modal("show");
        $("#NewModal .modal-header").addClass("d-none");
        $("#NewModal .modal-body").html("<p align='center' style='padding: 20px;'><img src=\"assets/spinner.gif\" width=\"10%\"><br>Logging out your account...</p>");
        $("#NewModal .modal-footer").addClass("d-none");
        setTimeout(function() {
            location.href = "logout.php";
        }, 3000);
    });

    $(document).ready(function() {
        var navbar = $(".navbar");

        $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
                navbar.addClass("scrolled");
            } else {
                navbar.removeClass("scrolled");
            }
        });
    });

</script>

</body>

</html>