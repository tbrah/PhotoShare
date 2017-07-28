<h1>Thank you for signing up!</h1>
<p>Hi <b>{{$data['username']}}</b>!</p>
<p>Be sure to click the button below to confirm your email to complete the registration</p>
<a href="http://photoshare.dev:8000/api/verify/{{$data['id']}}/{{$data['token']}}">Click me</a>
{{$data['token']}}