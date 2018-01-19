<h1>All Users</h1> 
<ul>
	@if ($users->count())
		@foreach ($users as $user)
			<li>{{Html::link("/users/{$user->username}", $user->username, $user->username, null)}}</li>
			<li>{{ $user->username}}</li>
		@endforeach
	@else
		<p>Unfortunately, no users! :y</p>
	@endif
</ul>