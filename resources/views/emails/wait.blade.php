<h1>{{ $data['title'] }}</h1>

<p>{{ $data['description'] }}</p>

<a href="{{ url('/approve/' . $data['email'] . '') }}">Approve or reject</a>