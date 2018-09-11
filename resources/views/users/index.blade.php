<h1>All Users</h1> 
<ul>
	@if ($users->count())
		@foreach ($users as $user)
			<li>{{Html::link("/users/{$user->email}", $user->email, $user->email, null)}}</li>
			<li>{{ $user->email}}</li>
		@endforeach
	@else
		<p>Unfortunately, no users! :y</p>
	@endif
</ul>