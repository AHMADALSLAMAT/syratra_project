<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="../../assets/css/login_style.css">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    </head>

    <body>
        <h2></h2>
        <div class="container" id="container">
            <div class="form-container sign-in-container" style="width: 100%;">
                <form action="#">
                    <h1>Forget Password ? </h1>
                    <div class="social-container">
                    </div>
                    <span> use your registerd email or <a href="../auth/login.html" style="font-weight: bold;"> Back To
                            Login</a></span>
                    <input type="email" placeholder="Email" style="width: 100%;" />
                    <button>Check Email</button>
                </form>
            </div>
        </div>
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
    </body>

</html>
