<!doctype html>
<html lang="en" dir="ltr">
    <head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <!--Robots Please remove during Live-->
	    <meta name="robots" content="noindex, nofollow">
	    <!--Favicon-->
	    <link rel="icon" href="images/fav.gif">
	    <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('assets/vendor_template/images/fav.gif')); ?>">
      	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<!-- Title -->
		<title><?php echo e($gs->title); ?></title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	    <!--Latest Bootstrap css  4.5.0 -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <!-- Main and Responsive css -->
    	<link rel="stylesheet" href="<?php echo e(asset('assets/vendor_template/css/main.min.css')); ?>">
		<!-- Main Css -->
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light">
	        <a class="navbar-brand" href="<?php echo e(route('vendor.front.index')); ?>"><img style="height: 40px;" src="<?php echo e(asset('assets/vendor_template/images/ratcart.png')); ?>" alt=""></a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	            <ul class="navbar-nav mx-auto">
	                <li class="nav-item <?php if(\Request::route()->getName() == 'vendor.front.fee-structure'): ?> active  <?php endif; ?>">
	                    <a class="nav-link" href="<?php echo e(route('vendor.front.fee-structure')); ?>">Fee Structure <span class="sr-only">(current)</span></a>
	                </li>
	                <li class="nav-item <?php if(\Request::route()->getName() == 'vendor.front.services'): ?> active  <?php endif; ?>">
	                    <a class="nav-link" href="<?php echo e(route('vendor.front.services')); ?>">Services</a>
	                </li>
	                <li class="nav-item <?php if(\Request::route()->getName() == 'vendor.front.resources'): ?> active  <?php endif; ?>">
	                    <a class="nav-link" href="<?php echo e(route('vendor.front.resources')); ?>">Resources</a>
	                </li>
	                <li class="nav-item <?php if(\Request::route()->getName() == 'vendor.front.faq'): ?> active  <?php endif; ?>">
	                    <a class="nav-link" href="<?php echo e(route('vendor.front.faq')); ?>">FAQs</a>
	                </li>
	            </ul>
	            <ul class="navbar-nav ml-auto">
	                <li class="nav-item mr-3">
	                    <a class="nav-link btn btn-primary  px-5 text-white" href="<?php echo e(route('vendor.login')); ?>">Login</a>
	                </li>
	                <li class="nav-item ">
	                    <a class="nav-link btn btn-warning px-5 text-white" href="<?php echo e(route('vendor-register')); ?>">Register Now</a>
	                </li>
	            </ul>
	        </div>
	    </nav>
        <?php echo $__env->yieldContent('content'); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</body>
</html>
<?php /**PATH /home/ratcart2a/public_html/devratcart/resources/views/layouts/vendor-front.blade.php ENDPATH**/ ?>