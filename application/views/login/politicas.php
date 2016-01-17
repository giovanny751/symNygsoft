<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            var base_url_js = '<?php echo base_url() ?>';
        </script>
        <meta charset="utf-8"/>
        <title>Inicio de Sesion</title>
        <meta http-equiv="X-UA-Compatible" content2="IE=edge">
        <meta content2="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content2="" name="description"/>
        <meta content2="" name="author"/>
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
    </head>
    <body class="login">
        <div class="logo">
            <a href="<?php echo base_url('') ?>">
                <img src="<?php echo base_url('/images/vice/logo_vice_02.png') ?>" alt=""/>
            </a>
        </div>
        <div class="menu-toggler sidebar-toggler">
        </div>
        <div class="content2">
            <form action="<?php echo base_url('index.php/login/politica') ?>" method="post">
                <div class="portlet box green">
                    <div class="caption">
                        &nbsp;&nbsp;<i class="fa fa-users"></i>
                        Politicas de Seguridad 
                    </div>
                    <div class="portlet-body">
                        <?php
                        echo $inicio[0]->ini_politicas
                        ?>
                        <p><center>
                            <div >
                                <input type="hidden" name="username" id="username" value="<?php echo $username ?>">
                                <input type="hidden" name="password" id="password" value="<?php echo $password ?>">
                            </div>
                            <button class="btn green" id="aceptar">Aceptar</button>
                            <button class="btn btn-danger" id="cancelar">Cancelar</button>
                        </center>
                    </div>
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
            
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                Demo.init(); // init demo features
                Login.init();
                UIConfirmations.init(); // init page demo
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
    </body>
</html>
<style>
    .login .content2 {
        background: url("../img/bg-white-lock.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
        border-radius: 7px;
        margin: 0 auto;
        padding: 20px 30px 15px;
        width: 760px;
    }
    .login .content2 h3 {
        color: #eee;
    }
    .login .content2 h4 {
        color: #eee;
    }
    .login .content2 p, .login .content2 label {
        color: #fff;
    }
    .login .content2 .login-form, .login .content2 .forget-form {
        margin: 0;
        padding: 0;
    }
    .login .content2 .form-control {
        background-color: #fff;
    }
    .login .content2 .forget-form {
        display: none;
    }
    .login .content2 .register-form {
        display: none;
    }
    .login .content2 .form-title {
        font-weight: 300;
        margin-bottom: 25px;
    }
    .login .content2 .form-actions {
        background-color: transparent;
        border: 0 none;
        clear: both;
        margin-left: -30px;
        margin-right: -30px;
        padding: 0 30px 25px;
    }
    .login .content2 .form-actions .checkbox {
        margin-left: 0;
        padding-left: 0;
    }
    .login .content2 .forget-form .form-actions {
        border: 0 none;
        margin-bottom: 0;
        padding-bottom: 20px;
    }
    .login .content2 .register-form .form-actions {
        border: 0 none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .login .content2 .form-actions .checkbox {
        display: inline-block;
        margin-top: 8px;
    }
    .login .content2 .form-actions .btn {
        margin-top: 1px;
    }
    .login .content2 .forget-password {
        margin-top: 25px;
    }
    .login .content2 .create-account {
        border-top: 1px dotted #eee;
        margin-top: 15px;
        padding-top: 10px;
    }
    .login .content2 .create-account a {
        display: inline-block;
        margin-top: 5px;
    }
    .login .content2 .select2-container i {
        color: #ccc;
        display: inline-block;
        font-size: 16px;
        height: 16px;
        margin: 4px 4px 0 -1px;
        position: relative;
        text-align: center;
        top: 1px;
        width: 16px;
        z-index: 1;
    }
    .login .content2 .has-error .select2-container i {
        color: #b94a48;
    }
    .login .content2 .select2-container a span {
        font-size: 13px;
    }
    .login .content2 .select2-container a span img {
        margin-left: 4px;
    }
    .caption {
        display: inline-block;
        float: left;
        font-size: 18px;
        font-weight: 400;
        line-height: 18px;
        padding: 10px 0;
        color: #fff;
    }
    
</style>




