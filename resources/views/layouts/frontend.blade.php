<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Blog Web</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="{{ asset('js/app.js') }}" defer></script>
	
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <link rel="stylesheet" href="/css/aos.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">

    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/icomoon.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
	#deleteComment a:hover {
        cursor: pointer;
        color:red
      }
	.info-user>ul>li>ul{
    display: none;
}
.info-user>ul>li>ul>li>a{
    font-size: 13px !important;
    margin-left: 35px;
}
.info-user>ul>li:hover>ul {
    display: block;
    -webkit-animation: slide-down .5s ease-out;
    -moz-animation: slide-down .5s ease-out;
} 
.div-logo{
    		display: flex;
			align-items: center;
			justify-content: center
    	}
    	.div-logo a{
    		margin: 0;
    		/*position: absolute;
		    top: 50%;
		    left: 50%;
		    margin-right: -50%;
		    transform: translate(-50%, -50%)*/
    	}
    	.img{
    		width: 150px;
    		height: 150px;

    	}

    	.div-1{
    		display: flex;
    		justify-content: space-between;
    	}

    	.block-1{
    		width: 900px;
    		height: auto;
    		display: flex;
    		background-color: rgb(180, 176, 176, 0.3);
    		padding: 20px;
    	}
		
		.block-2{
			flex-basis: 30%;
			display:table-cell;
			vertical-align:middle;
			text-align:center
		}

    	.block-2 img{
    		width: 150px;
    		height: 150px;
    		object-fit: cover;
    		border-radius: 50%;
    	}

    	.block-3 {
    		flex-basis: 80%;
    		margin-left: 20px;
    	}
</style>
  </head>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" class="info-user" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="/home">Home</a></li>
					<li><a href="/pages/about">About</a></li>
					<li><a href="/pages/contact">Contact</a></li>
					@if(Auth::check())
					<li><img width="20px" height="20px" style="margin-right: 10px" src="images/user.png"
						alt=""><a href="#">{{ Auth::user()->name }} </a> <ul class="menu_child_level_2">
							@if(Auth::user()->is_admin == 1)
							<li>
								<a href="/admin/home">Admin Dashboard</a>
							</li>	
							@endif
							<li>
							<a href="/user/post">Manager Post</a>
						</li>	
						<li>
						<a href="/user/info/{{ Auth::user()->id }}/edit">Info</a>
						</li>
						<li>
							<a  href="{{ route('logout') }}"
							onclick="event.preventDefault();
										  document.getElementById('logout-form').submit();">
							 {{ __('Logout') }}</a>
							 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
						</ul> 
					</li>
					@else 
                    <li><a href="/login">Login</a></li>
					@endif
				</ul>
			</nav>

			<div class="colorlib-footer">
				<h1 id="colorlib-logo" class="mb-4"><a href="index.html" style="background-image: url(/images/bg_1.jpg);">TMT <span> Blog</span></a></h1>
				<div class="mb-4">
					<h3>Subscribe for newsletter</h3>
					<form action="/subscribe" method="post" class="colorlib-subscribe-form">
						@csrf
						<div class="form-group d-flex">
            	<div class="icon"><span class="icon-paper-plane"></span></div>
              <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
            </div>
		  </form>
		  @if(session('success'))
              <div class="alert alert-success">
                {{ "Subscribe Success" }}
              </div> 
		 @endif
		</aside> <!-- END COLORLIB-ASIDE -->
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
	    		<div class="row d-flex">
					@if(Session::get("pages") == null) 
					<div class="col-xl-8 py-5 px-md-5" style="padding-right: 100px">
					@else 
					<div class="col-xl-12 py-5 px-md-5" style="padding-right: 100px">
					@endif
	    				<div id="app" class="row pt-md-4">
						@yield('content')
			    		</div><!-- END-->
			    		<div class="row">
			          <div class="col">
			            <div class="block-27">
			            </div>
			          </div>
			        </div>
					</div>
				@if(Session::get("pages") == null) 
					
	    			<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <div class="sidebar-box pt-md-4">
				</div>
	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Categories</h3>
	              <ul class="categories">
                      @foreach ($categories as $item)
				  <li><a href="/category/{{ $item->slug }}">{{  $item->name }} <span>({{ $item->cat_count }})</span> </a></li>
                      @endforeach
	              </ul>
	            </div>

	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Popular Post In Month</h3>
	            @foreach ($popularPosts as $item)
				<div class="block-21 mb-4 d-flex">
	                <a class="blog-img mr-4" style="background-image: url(storage/upload/{{ $item->image }});"></a>
	                <div class="text">
					<h3 class="heading"><a href="/{{ $item->slug }}">{{ $item->title }}</a></h3>
	                  <div class="meta">
					  <div><a href="#"><span class="icon-calendar"></span>{{ $item->published_at }}</a></div>
	                    <div><a href="#"><span class="icon-person"></span> {{ $item->name }}</a></div>
	                    <div><a href="#"><span class="icon-chat"></span>{{ $item->cat_count }}</a></div>
	                  </div>
	                </div>
	              </div>
				@endforeach
	            </div>

	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Tag Cloud</h3>
	              <ul class="tagcloud">
	                <a href="#" class="tag-cloud-link">animals</a>
	                <a href="#" class="tag-cloud-link">human</a>
	                <a href="#" class="tag-cloud-link">people</a>
	                <a href="#" class="tag-cloud-link">cat</a>
	                <a href="#" class="tag-cloud-link">dog</a>
	                <a href="#" class="tag-cloud-link">nature</a>
	                <a href="#" class="tag-cloud-link">leaves</a>
	                <a href="#" class="tag-cloud-link">food</a>
	              </ul>
	            </div>

							

	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Archives</h3>
	              <ul class="categories">
	              	<li><a href="#">Decob14 2018 <span>(10)</span></a></li>
	                <li><a href="#">September 2018 <span>(6)</span></a></li>
	                <li><a href="#">August 2018 <span>(8)</span></a></li>
	                <li><a href="#">July 2018 <span>(2)</span></a></li>
	                <li><a href="#">June 2018 <span>(7)</span></a></li>
	                <li><a href="#">May 2018 <span>(5)</span></a></li>
	              </ul>
	            </div>


	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Quote</h3>
	              <p>We made story's</p>
				</div>
			  </div><!-- END COL -->
			  @endif
			  
	    		</div>
	    	</div>
	    </section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="//js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/jquery.easing.1.3.js"></script>
  <script src="/js/jquery.waypoints.min.js"></script>
  <script src="/js/jquery.stellar.min.js"></script>
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.magnific-popup.min.js"></script>
  <script src="/js/aos.js"></script>
  <script src="/js/jquery.animateNumber.min.js"></script>
  <script src="/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="/js/google-map.js"></script>
  <script src="/js/main.js"></script>
    
  </body>
</html>