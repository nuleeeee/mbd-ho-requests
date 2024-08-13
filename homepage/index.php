<div class="section pt-5 mt-3">
	<div class="overflow-hidden rounded-3 p-md-2 m-md-3 bg-white shadow-sm">
	    <div class="col-md-12 my-5">
            <section class="intro">
                <h1>UPDATES<br><span style="margin-left: -12px;">&darr;</span></h1>
            </section>
            <section class="timeline" id="displytimeline">
                <ul>
                    <li>
                        <div class="main-body">
                            <p class="text-light"><time>No Updates</time>No substantial updates as of yet.</p>
                        </div>
                        <div class="timeline-footer">
                            <p class="text-right"><?php echo date('Y-M-d') ?></p>
                        </div>
                    </li>
                </ul>
            </section>
	    </div>
	</div>
</div>

<div class="section">
	<footer class="container py-5">
		<div class="row">
	    	<div class="col-12 col-md d-flex flex-column">
	      		<div>
	      			<img src="assets/image2.png" height="50">
	      		</div>
	      		<!-- <div style="margin-left: 25px;">
	      			© <?php //echo date('Y'); ?>
	      		</div> -->
	    	</div>
	    	<div class="col-6 col-md">
	      		<h5>Features</h5>
	      		<ul class="list-unstyled text-small">
	        		<li><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Stuff for developers</a></li>
	      		</ul>
	    	</div>
	    	<div class="col-6 col-md">
	      		<h5>Resources</h5>
	      		<ul class="list-unstyled text-small">
	        		<li><a class="link-secondary text-decoration-none" href="#">Business</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Education</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Government</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Resource</a></li>
	      		</ul>
	    	</div>
	    	<div class="col-6 col-md">
	      		<h5>About</h5>
	      		<ul class="list-unstyled text-small">
	        		<li><a class="link-secondary text-decoration-none" href="#">Team</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Locations</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Privacy</a></li>
	        		<li><a class="link-secondary text-decoration-none" href="#">Terms</a></li>
	      		</ul>
	    	</div>
	  	</div>
	</footer>
</div>

<style>
    .intro {
        text-align: center;
        color: #2D2A6D;
    }

    .intro h1 {
        font-size: 46px;
    }

    .timeline ul {
        padding: 5px 0;
    }

    .timeline ul li {
        list-style: none;
        position: relative;
        width: 4px;
        margin: 0 auto;
        padding-top: 50px;
        background-color: #273B7A;
        cursor: pointer;
    }

    .main-body {
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
    }

    .timeline time {
        display: block;
        font-size: 22px;
        margin-bottom: 8px;
        font-weight: 700;
        color: white;
        font-style: italic;
    }

    .timeline ul li:after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        transition: ease-in 1s;
        background-color: inherit;
        z-index: 1
    }

    .timeline ul li:hover:after {
        background-color: #273B7A !important;
        transition: ease-in-out 0.1s;
        cursor: pointer;
    }


    .timeline ul li div {
        position: relative;
        bottom: 0;
        width: 400px;
        padding: 15px;
        background-color: #434EA0;
        transition: all 1s;
        opacity: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .timeline ul li {
        animation: fadeIn 2s ease-in-out forwards;
    }

    .timeline ul li:nth-child(odd) div {
        left: 45px;
        transform: translateX(200px);
    }

    .timeline ul li:nth-child(even) div {
        left: calc(-400px - 45px + 6px);
        transform: translateX(-200px);
    }

    .timeline ul li.in-view:after {
        background-color: #434EA0;
    }

    .timeline ul li.in-view div {
        transform: none !important;
        opacity: 1;
    }



    /* FOOTER */
    .timeline-footer {
        position: relative;
        padding: 5px 15px !important;
        background-color: #f4f4f4 !important;
    }

    .timeline-footer.arrow-left::before {
        content: "";
        position: absolute;
        top: 80%;
        left: -10px;
        transform: translateY(-50%);
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-right: 10px solid #434EA0;
    }

    .timeline-footer.arrow-right::before {
        content: "";
        position: absolute;
        top: 80%;
        right: -10px;
        transform: translateY(-50%);
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 10px solid #434EA0;
    }

    .timeline-footer a {
        cursor: pointer;
        text-decoration: none;
    }


    /* SCROLLBAR */
    #displytimeline {
        overflow-y: scroll;
        overflow-x: hidden;
        height: 500px;
        scrollbar-width: thin;
    }

    /* Track */
    #displytimeline::-webkit-scrollbar {
        width: 8px;
    }

    /* Handle */
    #displytimeline::-webkit-scrollbar-thumb {
        background-color: #4D5596;
        border-radius: 4px;
    }

    /* Handle on hover */
    #displytimeline::-webkit-scrollbar-thumb:hover {
        background-color: #3F4A98;
    }

    /* Track */
    #displytimeline::-webkit-scrollbar-track {
        background-color: #F4F4F4;
    }

    @media screen and (max-width: 900px) {
        .timeline ul li div {
            width: 250px;
        }

        .timeline ul li:nth-child(even) div {
            left: calc(-250px - 45px -6px)
        }
    }

    @media screen and (max-width: 600px) {
        .timeline ul li {
            margin-left: 20px;
        }

        .timeline ul li div {
            width: calc(100vw - 90px);
        }

        .timeline ul li:nth-child(even) div {
            left: 45px;
        }

    }

    /* Responsive styles for smaller screens */
    @media (max-width: 768px) {

        .timeline-footer.arrow-left::before,
        .timeline-footer.arrow-right::before {
            top: 50%;
            transform: translateY(-50%);
        }

        .timeline-footer.arrow-left::before {
            left: -5px;
            border-right: 5px solid #434EA0;
        }

        .timeline-footer.arrow-right::before {
            right: -5px;
            border-left: 5px solid #434EA0;
        }
    }
</style>

<script>
    /* SCROLLING EFFECT */
    var items = document.querySelectorAll('.timeline li');

    function elementInView(el) {
        var rect = el.getBoundingClientRect();

        return (
            rect.top >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    function callBack() {
        for (var i = 0; i < items.length; i++) {
            if (elementInView(items[i])) {
                items[i].classList.add('in-view');
            }
        }
    }

    var timelineElement = document.getElementById('displytimeline');
    timelineElement.addEventListener('scroll', callBack);

    window.onload = callBack;
    window.onscroll = callBack;
    window.onresize = callBack;

    /* FOOTER ARROW */
    var timelineFooterElements = document.querySelectorAll('.timeline-footer');

    timelineFooterElements.forEach(function(element, index) {
        if (index % 2 === 0) {
            element.classList.add('arrow-left');
        } else {
            element.classList.add('arrow-right');
        }
    });
</script>