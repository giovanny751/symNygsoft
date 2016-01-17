<html lang="en">
    <link href="<?php echo base_url('img/nygsoft.jpg'); ?>" rel="shortcut icon" type="image/x-icon">
    <head>
        <script>
            var base_url_js = '<?php echo base_url() ?>';
        </script>
        <meta charset="utf-8"/>
        <title>Inicio de Sesion</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/select2/select2.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/pages/css/login-soft.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/css/components.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/layout.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/themes/default.css') ?>" id="style_color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
        <style type="text/css">
/*            html{
                background-image: url("<?php echo base_url("/img/Ingreso_ultima.png") ?>");
                background-size: 100%;
                background-repeat: no-repeat;
            }
            body{
                background-color: transparent;
            }
            .login{
                background-color: transparent !important;
            }
            .login .content{
                margin: 0 65%;
                background-color: rgba(150, 208, 222, 0.15);
            }
            .login .content h3 {
                color: #0C7093;
            }
            .login .content h4 {
                color: #0C7093;
            }
            .login .content p, .login .content label {
                color: #0C7093;
            }
            a {
                color: #0C7093;
                cursor: pointer;
                text-decoration: underline;
                text-shadow: none;
            }*/
        </style>
    </head>
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo base_url('') ?>">
                <!--<img src="<?php echo base_url('/images/vice/logo_vice_02.png') ?>" alt=""/>-->
                <!--<img src="<?php echo base_url('uploads/FinalG22.jpg'); ?>" style="width: 90px">-->
            </a>
        </div>
        <div class="menu-toggler sidebar-toggler">
        </div>
        <div class="content">
            <?php echo form_open('index.php/login/verify', 'class="form-signin login-form" role="form" autocomplete="off"'); ?>
            <h3 class="form-title">Ingreso al Sistema</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
                    Ingrese su Usuario
                </span>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuario" name="username"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                </div>
            </div>
            <div class="form-actions" align="center">
                <button class="btn btn-large btn blue" title="" data-original-title="Politica sus datos seran almacenados en nuestra base de datos">
                    Ingresar al Sistema<i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
            <div class="forget-password">
                <h4>Olvidaste tu contraseña?</h4>
                <p>
                    no se preocupe, haga clic <a href="javascript:;" id="forget-password">
                        aquí </a>  para restablecer la contraseña.
                </p>
            </div>
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>            
            <?php } ?>              

            <?php echo form_close(); ?> 
            <form class="forget-form" action="<?php echo base_url('index.php/login/reset'); ?>" method="post">
                <h3>Olvido la contraseña?</h3>
                <p>
                    Dirección de correo electrónico para restablecer la contraseña.
                </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn">
                        <i class="m-icon-swapleft"></i> Atras </button>
                    <button type="submit" class="btn blue pull-right">
                        Enviar <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="copyright">
            <?php echo date("Y") ?> &copy; 
        </div>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-1.11.0.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-migrate-1.2.1.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery.cokie.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/jquery-validation/js/messages_es.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/backstretch/jquery.backstretch.min.js') ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/select2/select2.min.js') ?>"></script>
        <script src="<?php echo base_url('/assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/pages/scripts/login-soft.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/pages/scripts/login-soft.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/admin/pages/scripts/ui-confirmations.js') ?>" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                Demo.init(); // init demo features
                Login.init();
                UIConfirmations.init(); // init page demo
                // init background slide images
                $.backstretch([
                    base_url_js + "/assets/admin/pages/media/bg/1.jpg",
                    base_url_js + "/assets/admin/pages/media/bg/2.jpg",
                    base_url_js + "/assets/admin/pages/media/bg/3.jpg",
                    base_url_js + "/assets/admin/pages/media/bg/4.jpg"
                ], {
                    fade: 1000,
                    duration: 8000
                }
                );
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>