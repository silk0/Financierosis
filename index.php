<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Financiero</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="vertical-dark/dist/assets/images/favicon.ico">

        <!-- App css -->
        <link href="vertical-dark/dist/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="vertical-dark/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="vertical-dark/dist/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <script language=JavaScript> 
        function go(){
            
        
            if(document.getElementById('usuario').value=="" || document.getElementById('pass').value==""){
                alert("complete los campos");
            }else{
                document.location.href='vertical-dark/dist/checkLogin.php?usuario='+document.getElementById('usuario').value+'&pass='+document.getElementById('pass').value;
            }
        } 

    </script> 

    <body class="authentication-bg authentication-bg-pattern d-flex align-items-center">

        <div class="home-btn d-none d-sm-block">
            <a href="index.html"><i class="fas fa-home h2 text-white"></i></a>
        </div>
        
        <div class="account-pages w-100 mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <a href="index.html">
                                        <span><img src="vertical-dark/dist/assets/images/logo-light.png" alt="" height="28"></span>
                                    </a>
                                </div>
                                <div class="nk-block toggled" id="l-login">
                                <form class="pt-2" name="form" id="form" method="GET" action="chekLogin.php">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Usuario</label>
                                        <input class="form-control" type="email" name="usuario" id="usuario" required="" placeholder="Ingrese su usuario">
                                    </div>

                                    <div class="form-group mb-3">                                        
                                        <label for="password">Contraseña</label>
                                        <input name="pass" id="pass" class="form-control" type="password" required="" id="password" placeholder="Ingrese s contraseña">
                                    </div>
                                    

                                    <div class="form-group mb-0 text-center">
                                        <button onclick="go();" class="btn btn-success btn-block" type="submit"> Iniciar </button>
                                    </div>

                                </form>
                                <!-- end row -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="vertical-dark/dist/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="vertical-dark/dist/assets/js/app.min.js"></script>
        
    </body>
</html>