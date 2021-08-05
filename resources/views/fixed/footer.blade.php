
<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="{{ url('/') }}/home"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="{{ url('/') }}/contact"><i class="fa fa-angle-double-right"></i>Contact</a></li>
						<li><a href="{{ url('/') }}/Documentation.pdf"><i class="fa fa-angle-double-right"></i>Documentation</a></li>
						@if(session()->has("user"))
							@if(session()->get("user")->IdRole==1)
							<li><a href="{{ route('admin') }}"><i class="fa fa-angle-double-right"></i>Admin</a></li>
							@endif
							<li><a href="{{ route('profiles') }}"><i class="fa fa-angle-double-right"></i>Profiles</a></li>
							<li><a href="{{ route('logout') }}"><i class="fa fa-angle-double-right"></i>Logout</a></li>
						@endif
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.linkedin.com/in/marko-vukojevic-a196021a2/"><i class="fa fa-angle-double-right"></i>Author</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Sponsors</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Facebook</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Instagram</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Twitter</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Youtube</a></li>
					</ul>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p><u><a href="https://www.linkedin.com/in/marko-vukojevic-a196021a2/">Marko Vukojevic 204/17</a></u></p>
				</div>
				</hr>
			</div>	
		</div>
	</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>