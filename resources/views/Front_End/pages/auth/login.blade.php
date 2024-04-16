<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assest/assets/css/login_style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('back_assest/assets/plugins/notifications/css/lobibox.min.css') }}" />
    </head>

    <body>
        <h2></h2>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="{{ route('front.login_post') }}" method="post" >
                    @csrf
                    <input type="hidden" name="form_type" value="signup">
                    <h1>Create Account</h1>
                    <div class="social-container">
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="Name" name="name" required />
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="tel" placeholder="phone" name="phone" required/>
                    <input type="password" placeholder="Password" name="password" required />
                    <button>Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('front.login_post') }}" method="post">
                    @csrf
                    <input type="hidden" name="form_type" value="signin">
                    <h1>Sign in</h1>
                    <div class="social-container">
                    </div>
                    <span>or use your account</span>
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="password" placeholder="Password" name="password" required />
                    <a href="../auth/forgetpass.html">Forgot your password?</a>
                    <button>Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
              <!--notification js -->
              <script src="{{ asset('back_assest/assets/js/jquery.min.js') }}"></script>

	<script src="{{ asset('back_assest/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('back_assest/assets/plugins/notifications/js/notifications.min.js') }}"></script>
        <script>
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            signUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
        </script>
         @if(session()->has('error'))
         <script>
             Lobibox.notify('error', {
             pauseDelayOnHover: true,
             continueDelayOnInactiveTab: false,
             position: 'top right',
             icon: 'bx bx-x-circle',
             msg: "{{ session('error') }}"
         });
         </script>

         @endif
         @if(session()->has('success'))
         <script>
             Lobibox.notify('success', {
             pauseDelayOnHover: true,
             continueDelayOnInactiveTab: false,
             position: 'top right',
             icon: 'bx bx-check-circle',
             msg: "{{ session('success') }}"
         });
         </script>
         @endif
         @if(session()->has('errors'))
         @foreach ($errors as $error)
         <script>
             Lobibox.notify('success', {
             pauseDelayOnHover: true,
             continueDelayOnInactiveTab: false,
             position: 'top right',
             icon: 'bx bx-check-circle',
             msg: "{{ session('error') }}"
         });
         </script>
         @endforeach
         @endif
    </body>

</html>
