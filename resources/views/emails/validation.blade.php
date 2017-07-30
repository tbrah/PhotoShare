<header style="background:linear-gradient(159deg, #D76D77 31%, #f99060 79%); width:100%; height:100px;">
	<h1 style="text-align:center; color:#fff; padding-top:28px; font-size:30px;">PhotoShare</h1>
</header>

<h1 style="text-align:center; margin-top:20px; color:#888888;">Thank you for signing up!</h1>

<p style="text-align:center; color:#888888; font-size:12px;">Hi <b>{{$data['username']}}</b>!</p>

<p style="text-align:center; color:#888888; font-size:12px;">Thank you for signing up to PhotoShare. Before you get started there is one more step left.</p>

<p style="text-align:center; color:#888888; font-size:12px;">Click the button below to validate your email and your done!</p>

<a href="http://photoshare.dev:8000/api/verify/{{$data['id']}}/{{$data['token']}}" style="text-decoration:none;">
	<button 
		style="
		display:block;
		margin:0 auto;
		background:linear-gradient(159deg, #D76D77 31%, #f99060 79%);
		padding: 10px 20px;
		border-radius:30px;
		border:none;
		color:#fff;
		cursor:pointer;
		"
		>
Validate</button>
</a>