<?php /* Smarty version Smarty-3.1.8, created on 2012-04-11 03:47:31
         compiled from "templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3176148264f8533c22d19e4-71302448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a0270564c79ee7a1c4f40d2a5e8bcfac7e3570' => 
    array (
      0 => 'templates/login.tpl',
      1 => 1334130363,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3176148264f8533c22d19e4-71302448',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8533c2314c91_13197009',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8533c2314c91_13197009')) {function content_4f8533c2314c91_13197009($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Please, sign in</title>
    <meta name="description" content="">
    <meta name="author" content="">
 
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px;
      }
      .container {
        width: 300px;
      }
 
      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px;
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }
 
      .login-form {
        margin-left: 65px;
      }
 
      legend {
        margin-right: -50px;
        font-weight: bold;
        color: #404040;
      }
 
    </style>
 
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="login-form">
                    <h2>Sign in</h2>
                    <form action="" method="post">
                        <fieldset>
                            <div class="clearfix">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div class="clearfix">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <button class="btn primary" type="submit">Sign in</button>
                        </fieldset>
			<input type="hidden" name="signin" value="1" />
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</body>
</html>
<?php }} ?>