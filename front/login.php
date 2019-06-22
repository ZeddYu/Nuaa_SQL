<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Books Managment System</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/vue.js"></script>
	<script src="https://cdn.bootcss.com/axios/0.19.0/axios.min.js"></script>
	<!-- <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script> -->
</head>

<body>
	<p class="tip">Books Managment System</p>
	<div class="cont">
		<div class="form sign-in">
			<div id="login_box">
				<h2>Welcome </h2>
				<label>
					<span>Usernmae</span>
					<input type="text" name="username" v-model="username"/>
				</label>
				<label>
					<span>Password</span>
					<input type="password" name="password" v-model="password"/>
				</label>
				<button type="button" class="submit" v-on:click="login">Sign In</button>
				<!-- <button type="button" class="submit" onclick="login()">Sign In</button> -->
			</div>
		</div>
		<div class="sub-cont">
			<div class="img">
				<div class="img__text m--up">
					<h2>New here?</h2>
					<p>Sign up and discover great amount of new opportunities!</p>
				</div>
				<div class="img__text m--in">
					<h2>One of us?</h2>
					<p>If you already has an account, just sign in. We've missed you!</p>
				</div>
				<div class="img__btn">
					<span class="m--up">Sign Up</span>
					<span class="m--in">Sign In</span>
				</div>
			</div>
			<div class="form sign-up">
				<h2>Time to feel like home,</h2>
                <div id="register_box">
                    <label>
                        <span>Username</span>
                        <input type="text" name="username" v-model="username"/>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" v-model="password"/>
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="en_password" v-model="en_password"/>
                    </label>
					<button type="button" class="submit" v-on:click="register">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<script src="js/login.js"></script>
</body>
</html>