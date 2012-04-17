<?php /* Smarty version Smarty-3.1.8, created on 2012-04-11 05:08:21
         compiled from "templates/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20602996884f853cc58fa307-24078908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e27f2c4a7e1cf18177b42281d1171ff2c8485b2' => 
    array (
      0 => 'templates/dashboard.tpl',
      1 => 1334135300,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20602996884f853cc58fa307-24078908',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f853cc5929d81_36126481',
  'variables' => 
  array (
    'username' => 0,
    'tweets' => 0,
    'tweet' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f853cc5929d81_36126481')) {function content_4f853cc5929d81_36126481($_smarty_tpl) {?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


	<div class="container">		
			<div class="row show-grid">
			<div class="span4">4</div>
			<div class="span8 show-grid">
			<?php  $_smarty_tpl->tpl_vars['tweet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tweet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tweets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tweet']->key => $_smarty_tpl->tpl_vars['tweet']->value){
$_smarty_tpl->tpl_vars['tweet']->_loop = true;
?>
				<div class="span8">
				<hr />
					<p>
						<?php echo $_smarty_tpl->tpl_vars['tweet']->value['message'];?>

					</p>
					<div>Posted by <a href="?profile=<?php echo $_smarty_tpl->tpl_vars['tweet']->value['owner'];?>
"><?php echo $_smarty_tpl->tpl_vars['tweet']->value['username'];?>
</a> at <?php echo $_smarty_tpl->tpl_vars['tweet']->value['time'];?>
</div>
				</div>
			<?php }
if (!$_smarty_tpl->tpl_vars['tweet']->_loop) {
?>	
				<div class="span8 ">
					<p>
						This user has no tweets
					</p>
				</div>
			<?php } ?>
			</div>
	</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
<?php }} ?>