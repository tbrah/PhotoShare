<header style="background:linear-gradient(159deg, #D76D77 31%, #f99060 79%); width:100%; height:100px;">
	<h1 style="text-align:center; color:#fff; padding-top:28px; font-size:30px;">PhotoShare</h1>
</header>

<h1 style="text-align:center; margin-top:20px; color:#888888;">Reset your current password.</h1>

<p style="text-align:center; color:#888888; font-size:12px;">Click the button below to be redirected to the password reset form.</p>

<a href="http://localhost:4200/login/resetPassword/{{$data['id']}}/{{$data['resetToken']}}" style="text-decoration:none;">
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
Reset Password</button>
</a>

<hr style="opacity:0.3; width:80%; margin-top:25px;">