<h1>Reseting password link</h1>
{{$data->resetToken}}
<a href="http://localhost:4200/login/resetPassword/{{$data['id']}}/{{$data['resetToken']}}">Click me</a>