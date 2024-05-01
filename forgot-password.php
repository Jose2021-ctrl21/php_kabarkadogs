<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recover password</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><B>What is your username ?</B></p>
                <form method="post">
                    <div id="mgs"></div>
                    <div class="form-group">
                        <label>Username: </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="username" placeholder="username" autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                </div>
                            </div>
                        </div>
                        <span class="username-error"></span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="btn_recover" class="btn btn-block" style="background:green">Next</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                     <style>
                        .btn-cancel{
                            background-color: lightgray;
                            color: black;
                        }
                        .btn-cancel:hover{
                            background-color: gray;
                             color:black;
                        }
                    </style>
                    <a href="login.php"><button class="btn btn-cancel">Cancel</button></a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            let btn = document.querySelector('#btn_recover');
            btn.addEventListener('click', (e) => {
                e.preventDefault();

                const username = document.querySelector('input[id=username]').value;
                console.log(username);
                var data = new FormData(this.form);
                data.append('username', username);

                function isValidUname() {
                    if ($("#username").val() === "") {
                        $("#username").addClass("is-invalid");
                        $(".username-error").html('Please input your Username');
                        $(".username-error").css({
                            "color": "red",
                            "font-size": "14px"
                        });
                        return false;
                    } else {
                        $("#username").removeClass("is-invalid").addClass("is-valid");
                        return true;
                    }
                };

                isValidUname();

                if (isValidUname() === true) {

                    $.ajax({
                        url: 'config/init/recover.php',
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        async: false,
                        cache: false,
                        success: function(response) {
                            $("#mgs").html(response);
                            $('#mgs').animate({
                                scrollTop: 0
                            }, 'slow');
                        },
                        error: function(response) {
                            console.log("Failed");
                        }
                    });
                }

            });
        });
    </script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>