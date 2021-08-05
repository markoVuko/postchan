@extends("layouts.master")

@section("content")

		<div id="admin-panel">
			<div class="admin-ctrl" id="insert-user">
				<form id="insusform">
					<h3>Insert User</h3>
					<input type="text" id="iuname" placeholder="Username..."><br>
					<input type="text" id="iuemail" placeholder="Email..."><br>
					<input type="password" id="iupass" placeholder="Password..."><br>
					<input type="radio" class="iurole" name="role" value="1"> <label class="ulabel">Admin</label>
					<input type="radio" class="iurole" name="role" value="2"> <label class="ulabel">User</label>
					<input type="submit" value="Insert" id="iusub">
				</form>
			</div>
			<div class="admin-ctrl" id="edit-users">
				<form id="editusform">
                    <h3>Edit User</h3>
                    <select id="euname">
                        <option value='0'>Choose User</option>
                        @foreach($data["users"] as $u)
                            <option value='{{ $u->username }}'>{{ $u->username }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="euid" id="euid" value="">
					<input type="text" id="euemail" name="euemail" placeholder="Email..."><br>
					<input type="password" id="eupass1" name="eupass" placeholder="Password..."><br>
					<input type="password" id="eupass2" name="eupass" placeholder="Password..."><br>
					<input type="radio" class="eurole" id="eurole1" name="eurole" value="1"> <label class="ulabel">Admin</label>
					<input type="radio" class="eurole" id="eurole2" name="eurole" value="2"> <label class="ulabel">User</label><br>
					<img src="{{ url('/') }}/img/profile.png" alt="profile picture" id="eupic"><br>
					<input type="file" id="euimg" name="euimg"><br>
					<input type="submit" value="Save" id="saveUser" name="saveUser">
				</form>
			</div>
			</div>
			
			<div class="admin-ctrl" id="contact-feed">
				
					@foreach ($data["contacts"] as $c) {
						<div class="feed-block">
							 	<span>Feedback#{{ $c->IdSent}} </span>
							 	<span class="feedName">From: {{ $c->name }} {{ $c->surname }}</span>
							 	<a href="feed-{{ $c->IdSent }}" class="notsel">Open</a>
							 	<div id="feed-{{ $c->IdSent }}" class="feed-content">
							 		<span>Number: {{ $c->num }}</span><br>
							 		<span>Email: {{ $c->email }}</span><br>
							 		<span>{{ $c->gender }}</span><br>
							 		<span class="feedText">{{ $c->text }}</span>
							 	</div>
							 </div>';
					@endforeach
                 </div> 	
				 
<!--
			
			<div class="admin-ctrl" id="log-stats">
				<table id="log-table">
					<th>Activity</th>
					<th>Time</th>
					<th>Done By</th>
				
					$logModel = new LogModel();
					$logModel->readLogs("app/data/log.txt");
				 
				</table>
			</div>
			<div class="admin-ctrl" id="errors">
				<table id="error-table">
					<th>Page</th>
					<th>Time</th>
					<th>Error Code</th>
				
					$logModel = new LogModel();
					$logModel->readLogs("app/data/dberrors.txt");
				 
				</table>
			</div>-->
        </div>

        <script src="{{ URL::asset('js/admin.js') }}"></script>
@endsection