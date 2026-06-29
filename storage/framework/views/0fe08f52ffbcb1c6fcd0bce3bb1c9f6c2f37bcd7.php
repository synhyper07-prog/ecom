<!DOCTYPE html>

<html lang="en">



<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(isset($page->meta_tag) && isset($page->meta_description)): ?>
        <meta name="keywords" content="<?php echo e($page->meta_tag); ?>">
        <meta name="description" content="<?php echo e($page->meta_description); ?>">
		<title><?php echo e($gs->title); ?></title>
    <?php elseif(isset($blog->meta_tag) && isset($blog->meta_description)): ?>
        <meta name="keywords" content="<?php echo e($blog->meta_tag); ?>">
        <meta name="description" content="<?php echo e($blog->meta_description); ?>">
		<title><?php echo e($gs->title); ?></title>
    <?php elseif(isset($productt)): ?>
		<meta name="keywords" content="<?php echo e(!empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): ''); ?>">
		<meta name="description" content="<?php echo e($productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description)); ?>">
	    <meta property="og:title" content="<?php echo e($productt->name); ?>" />
	    <meta property="og:description" content="<?php echo e($productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description)); ?>" />
	    <meta property="og:image" content="<?php echo e(asset('assets/images/thumbnails/'.$productt->thumbnail)); ?>" />
	    <meta name="author" content="RatCart">
    	<title><?php echo e(substr($productt->name, 0,11)."-"); ?><?php echo e($gs->title); ?></title>
    <?php else: ?>
	    <meta name="keywords" content="RatCart">
	    <meta name="author"   content="RatCart">
		<title><?php echo e($gs->title); ?></title>
    <?php endif; ?>
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="<?php echo e(asset('assets/images/'.$gs->favicon)); ?>"/>
	<?php if($langg->rtl == "1"): ?>
		<!-- stylesheet -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl/all.css')); ?>">
	    <!--Updated CSS-->
	 	<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color))); ?>">
	<?php else: ?>
		<!-- stylesheet -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/all.css')); ?>">
	    <!--Updated CSS-->
	 	<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color))); ?>">
	<?php endif; ?>

	<?php echo $__env->yieldContent('styles'); ?>
	<style type="text/css">
		    .logo-header .search-box .categori-container .categoris option {
			    background: none !important; 
			}
			.verify-btn{
			    height: 48px;
			    text-align: center;
			    border: 0px;
			    color: #fff;
			    font-weight: 700;
			    text-transform: uppercase;
			    margin-top: 20px;
			    -o-transition: all 0.3s ease-in;
			    transition: all 0.3s ease-in;
			    cursor: pointer;
			    margin: 0;
			    font-family: inherit;
			    font-size: inherit;
			    line-height: inherit;
			    border-radius: 0;
			    box-sizing: border-box;
			    -webkit-writing-mode: horizontal-tb !important;
                text-rendering: auto;
                letter-spacing: normal;
                word-spacing: normal;
                text-indent: 0px;
			    text-shadow: none;
			    display: inline-block;
			    align-items: flex-start;
			    font: 400 13.3333px Arial;
                padding: 17px 6px;
			}
			a.btnDowloadFixed {
			    position: fixed;
			    right: 0;
			    top: 30%;
			    z-index: 99;
			    background: #fff;
			    padding: 10px 10px;
			    font-size: 20px;
			    transition: .3s linear;
			    box-shadow: 0 3px 5px #00000012
			}
			a.btnDowloadFixed svg,a.btnDowloadFixed i{
				color: #3DDC84
			}
			a.btnDowloadFixed:hover svg,a.btnDowloadFixed:hover i{
				color:#fff;
			}
			a.btnDowloadFixed span {
				display: none;

			}
			a.btnDowloadFixed:hover{
				background: #FF7F50;
				color:#fff;
			    padding: 10px 20px;

			}
			a.btnDowloadFixed:hover span{
				display: inline-block;
			}
			@media  only screen and (max-width:991px){
				a.btnDownloadApp.btn.btn-outline-light {
				    display: none;
				}
				a.btnDowloadFixed {
				    position: fixed;
				    top: unset;
				    bottom: 0;
				    left: 0;
				    background: #0f78f2;
				    right: 0;
				    width: 100%;
				    padding: 10px;
				    text-align: center;
				    color:#fff;
				}
				a.btnDowloadFixed span{
					display: inline-block;
					color: #ffff
				}
			}

	</style>
</head>
<body>

<a href="https://play.google.com/store/apps/details?id=com.knovatik.ratcart" class="btnDowloadFixed" target="blank"> <i class="fab fa-android"></i> <span>GET APP</span></a> 

<?php if($gs->is_loader == 1): ?>
	<div class="preloader" id="preloader" style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center #FFF;"></div>
	<?php endif; ?>
	<div class="xloader d-none" id="xloader" style="background: url(<?php echo e(asset('assets/front/images/xloading.gif')); ?>) no-repeat scroll center center #FFF;"></div>
<?php if($gs->is_popup== 1): ?>
<?php if(isset($visited)): ?>
    <div style="display:none">
        <img src="<?php echo e(asset('assets/images/'.$gs->popup_background)); ?>">
    </div>
    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url(<?php echo e(asset('assets/images/'.$gs->popup_background)); ?>);">
            <span class="preload-close"><i class="fas fa-times"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1><?php echo e($gs->popup_title); ?></h1>
                <p><?php echo e($gs->popup_text); ?></p>
                <form action="<?php echo e(route('front.subscribe')); ?>" id="subscribeform" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <input type="email" name="email"  placeholder="<?php echo e($langg->lang741); ?>" required="">
                        <button id="sub-btn" type="submit"><?php echo e($langg->lang742); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->
<?php endif; ?>

<?php endif; ?>
	<section class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="content">
						<div class="left-content">
							<div class="list">
								<ul>
									<?php if($gs->is_language == 1): ?>
										<li>
											<div class="language-selector">
												<i class="fas fa-globe-americas"></i>
												<select name="language" class="language selectors nice">
													<?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e(route('front.language',$language->id)); ?>" <?php echo e(Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : ( $language->is_default == 1 ? 'selected' : '')); ?> ><?php echo e($language->language); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</li>
									<?php endif; ?>
									<?php if($gs->is_currency == 1): ?>
										<li>
											<div class="currency-selector">
												<span><?php echo e(Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign); ?></span>
												<select name="currency" class="currency selectors nice">
													<?php $__currentLoopData = DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e(route('front.currency',$currency->id)); ?>" <?php echo e(Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : ( $currency->is_default == 1 ? 'selected' : '')); ?> ><?php echo e($currency->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="right-content">
							<div class="list">
								<ul>
									<?php if(!Auth::guard('web')->check()): ?>
										<li class="login">
											<a href="<?php echo e(route('user.login')); ?>" class="sign-log">
												<div class="links">
													<span class="sign-in"><?php echo e($langg->lang12); ?></span> <span>|</span>
													<span class="join"><?php echo e($langg->lang13); ?></span>
												</div>
											</a>
										</li>
									<?php else: ?>
										<li class="profilearea my-dropdown">
											<a href="javascript: ;" id="profile-icon" class="profile carticon"><span class="text"><i class="far fa-user"></i>	<?php echo e($langg->lang11); ?> <i class="fas fa-chevron-down"></i></span></a>
											<div class="my-dropdown-menu profile-dropdown">
												<ul class="profile-links">
													<?php if(Auth::user()->is_vendor== 0): ?>
														<li><a href="<?php echo e(route('user-dashboard')); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e($langg->lang221); ?></a></li>
													<?php elseif(Auth::user()->IsVendor()== 2): ?>
													    <li><a href="<?php echo e(route('vendor-dashboard')); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e($langg->lang222); ?></a></li>
													<?php endif; ?>
													<li><a href="<?php echo e(route('user-profile')); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e($langg->lang205); ?></a></li>
													<li><a href="<?php echo e(route('user-logout')); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e($langg->lang223); ?></a></li>
												</ul>
											</div>
										</li>
									<?php endif; ?>
                        			<?php if($gs->reg_vendor == 1): ?>
										<li>
                        				    <?php if(Auth::check()): ?>
	                        				<?php if(Auth::guard('web')->user()->is_vendor == 2): ?>
	                        					<a href="<?php echo e(route('vendor-dashboard')); ?>" class="sell-btn"><?php echo e($langg->lang220); ?></a>
		                        				<?php elseif(Auth::guard('web')->user()->is_vendor == 1): ?>
		                        					<a href="<?php echo e(route('user-package')); ?>" class="sell-btn">Package</a>
		                        				<?php else: ?>	
	                        				<?php endif; ?>
										</li>
                        				<?php else: ?>
                        				    		
										<?php endif; ?>
									<?php endif; ?>
									<li class="login">
										<a class="btnDownloadApp btn btn-outline-light" href="https://play.google.com/store/apps/details?id=com.knovatik.ratcart" target="blank" title="Download application">Download app</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Top Header Area End -->
	<!-- Logo Header Area Start -->
	<section class="logo-header">
		<div class="container">
			<div class="row ">
				<div class="col-lg-2 col-sm-6 col-5 remove-padding">
					<div class="logo">
						<a href="<?php echo e(route('front.index')); ?>">
							<img src="<?php echo e(asset('assets/images/'.$gs->logo)); ?>" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12 remove-padding order-last order-sm-2 order-md-2">
					<div class="search-box-wrapper">
						<div class="search-box">
							<div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<option value=""><?php echo e($langg->lang1); ?></option>
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <option value="<?php echo e($data->slug); ?>" <?php echo e(Request::route('category') == $data->slug ? 'selected' : ''); ?>><?php echo e($data->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<form id="searchForm" class="search-form" action="<?php echo e(route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])); ?>" method="GET">
								<?php if(!empty(request()->input('sort'))): ?>
									<input type="hidden" name="sort" value="<?php echo e(request()->input('sort')); ?>">
								<?php endif; ?>
								<?php if(!empty(request()->input('minprice'))): ?>
									<input type="hidden" name="minprice" value="<?php echo e(request()->input('minprice')); ?>">
								<?php endif; ?>
								<?php if(!empty(request()->input('maxprice'))): ?>
									<input type="hidden" name="maxprice" value="<?php echo e(request()->input('maxprice')); ?>">
								<?php endif; ?>
								<input type="text" id="prod_name" name="search" placeholder="<?php echo e($langg->lang2); ?>" value="<?php echo e(request()->input('search')); ?>" autocomplete="off">
								<div class="autocomplete">
								  <div id="myInputautocomplete-list" class="autocomplete-items"></div>
								</div>
								<button type="submit"><i class="icofont-search-1"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6 col-7 remove-padding order-lg-last">
					<div class="helpful-links">
						<ul class="helpful-links-inner">
							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="<?php echo e($langg->lang3); ?>">
								<a href="javascript:;" class="cart carticon">
									<div class="icon">
										<i class="icofont-cart"></i>
										<span class="cart-quantity" id="cart-count"><?php echo e(Session::has('cart') ? count(Session::get('cart')->items) : '0'); ?></span>
									</div>
								</a>
								<div class="my-dropdown-menu" id="cart-items">
									<?php echo $__env->make('load.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								</div>
							</li>
							<li class="wishlist"  data-toggle="tooltip" data-placement="top" title="<?php echo e($langg->lang9); ?>">
								<?php if(Auth::guard('web')->check()): ?>
									<a href="<?php echo e(route('user-wishlists')); ?>" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count"><?php echo e(Auth::user()->wishlistCount()); ?></span>
									</a>
								<?php else: ?>
									<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">0</span>
									</a>
								<?php endif; ?>
							</li>
							<li class="compare"  data-toggle="tooltip" data-placement="top" title="<?php echo e($langg->lang10); ?>">
								<a href="<?php echo e(route('product.compare')); ?>" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count"><?php echo e(Session::has('compare') ? count(Session::get('compare')->items) : '0'); ?></span>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->
	<!--Main-Menu Area Start-->
	<div class="mainmenu-area mainmenu-bb">
		<div class="container">
			<div class="row align-items-center mainmenu-area-innner">
				<div class="col-lg-3 col-md-6 categorimenu-wrapper remove-padding">
					<!--categorie menu start-->
					<div class="categories_menu">
						<div class="categories_title">
							<h2 class="categori_toggle"><i class="fa fa-bars"></i>  <?php echo e($langg->lang14); ?> <i class="fa fa-angle-down arrow-down"></i></h2>
						</div>
						<div class="categories_menu_inner">
							<ul>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								    <li class="<?php echo e(count($category->subs) > 0 ? 'dropdown_list':''); ?> <?php echo e($loop->index >= 14 ? 'rx-child' : ''); ?>">
									    <?php if(count($category->subs) > 0): ?>
											<div class="img"><img src="<?php echo e(asset('assets/images/categories/'.$category->photo)); ?>" alt=""></div>
											<div class="link-area"><span><a href="<?php echo e(route('front.category',$category->slug)); ?>"><?php echo e($category->name); ?></a></span><a href="javascript:;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
											</div>
									    <?php else: ?>
									        <a href="<?php echo e(route('front.category',$category->slug)); ?>"><img src="<?php echo e(asset('assets/images/categories/'.$category->photo)); ?>"> <?php echo e($category->name); ?></a>
									    <?php endif; ?>
										<?php if(count($category->subs) > 0): ?>
											<ul class="<?php echo e($category->subs()->withCount('childs')->get()->sum('childs_count') > 0 ? 'categories_mega_menu' : 'categories_mega_menu column_1'); ?>">
												<?php $__currentLoopData = $category->subs()->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li><a href="<?php echo e(route('front.subcat',['slug1' => $category->slug, 'slug2' => $subcat->slug])); ?>"><?php echo e($subcat->name); ?></a>
														<?php if(count($subcat->childs) > 0): ?>
															<div class="categorie_sub_menu">
																<ul>
																	<?php $__currentLoopData = $subcat->childs()->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	   <li><a href="<?php echo e(route('front.childcat',['slug1' => $category->slug, 'slug2' => $subcat->slug, 'slug3' => $childcat->slug])); ?>"><?php echo e($childcat->name); ?></a></li>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																</ul>
															</div>
														<?php endif; ?>
													</li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endif; ?>
									</li>
								    <?php if($loop->index == 14): ?>
					                    <li><a href="<?php echo e(route('front.categories')); ?>"><i class="fas fa-plus"></i> <?php echo e($langg->lang15); ?> </a></li>
						                <?php break; ?>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
					<!--categorie menu end-->
				</div>

				<div class="col-lg-9 col-md-6 mainmenu-wrapper remove-padding">
					<nav hidden>
						<div class="nav-header">
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
						</div>
						<ul class="menu">
							<?php if($gs->is_home == 1): ?>
							   <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e($langg->lang17); ?></a></li>
							<?php endif; ?>
							<!-- <li class="active" ><a  href="<?php echo e(route('front.blog')); ?>"><?php echo e($langg->lang18); ?></a></li> -->
							<?php if($gs->is_faq == 1): ?>
							   <li><a href="<?php echo e(route('front.faq')); ?>"><?php echo e($langg->lang19); ?></a></li>
							<?php endif; ?>
							<?php $__currentLoopData = DB::table('pages')->where('header','=',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e(route('front.page',$data->slug)); ?>"><?php echo e($data->title); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php if($gs->is_contact == 1): ?>
							    <li><a href="<?php echo e(route('front.contact')); ?>"><?php echo e($langg->lang20); ?></a></li>
							<?php endif; ?>
							<!-- <li><a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn"><?php echo e($langg->lang16); ?></a></li> -->
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--Main-Menu Area End-->
    <?php echo $__env->yieldContent('content'); ?>

	<!-- Footer Area Start -->

	<footer class="footer" id="footer">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-lg-4">

					<div class="footer-info-area">

						<div class="footer-logo">

							<a href="<?php echo e(route('front.index')); ?>" class="logo-link">

								<img src="<?php echo e(asset('assets/images/'.$gs->footer_logo)); ?>" alt="">

							</a>

						</div>

						<div class="text">

							<p>

									<?php echo $gs->footer; ?>


							</p>

						</div>

					</div>

					<div class="fotter-social-links">

						<ul>

	                   	    <?php if($socialsetting->f_status == 1): ?>

	                            <li>

		                            <a href="<?php echo e($socialsetting->facebook); ?>" class="facebook" target="_blank">

		                                <i class="fab fa-facebook-f"></i>

		                            </a>

	                            </li>

	                          <?php endif; ?>

	                          <?php if($socialsetting->g_status == 1): ?>

	                            <li>

		                            <a href="<?php echo e($socialsetting->gplus); ?>" class="google-plus" target="_blank">

		                                <i class="fab fa-google-plus-g"></i>

		                            </a>

	                            </li>

	                          <?php endif; ?>

	                          <?php if($socialsetting->t_status == 1): ?>

	                            <li>

		                            <a href="<?php echo e($socialsetting->twitter); ?>" class="twitter" target="_blank">

		                                <i class="fab fa-twitter"></i>

		                            </a>

	                            </li>

	                          <?php endif; ?>

	                          <?php if($socialsetting->l_status == 1): ?>

	                            <li>

		                            <a href="<?php echo e($socialsetting->linkedin); ?>" class="linkedin" target="_blank">

		                                <i class="fab fa-linkedin-in"></i>

		                            </a>

	                            </li>

	                          <?php endif; ?>

	                          <?php if($socialsetting->d_status == 1): ?>

	                            <li>

		                            <a href="<?php echo e($socialsetting->dribble); ?>" class="dribbble" target="_blank">

		                                <i class="fab fa-dribbble"></i>

		                            </a>

	                            </li>

	                        <?php endif; ?>



						</ul>

					</div>

				</div>

				<div class="col-md-6 col-lg-4">

					<div class="footer-widget info-link-widget">

						<h4 class="title">

								<?php echo e($langg->lang21); ?>


						</h4>

						<ul class="link-list">

							<li>

								<a href="<?php echo e(route('front.index')); ?>">

									<i class="fas fa-angle-double-right"></i><?php echo e($langg->lang22); ?>


								</a>

							</li>



							<?php $__currentLoopData = DB::table('pages')->where('footer','=',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<li>

								<a href="<?php echo e(route('front.page',$data->slug)); ?>">

									<i class="fas fa-angle-double-right"></i><?php echo e($data->title); ?>


								</a>

							</li>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



							<li>

								<a href="<?php echo e(route('front.contact')); ?>">

									<i class="fas fa-angle-double-right"></i><?php echo e($langg->lang23); ?>


								</a>

							</li>

						</ul>

					</div>

				</div>

				<div class="col-md-6 col-lg-4">

					<div class="footer-widget recent-post-widget">

						<h4 class="title">

							<?php echo e($langg->lang24); ?>


						</h4>

						<ul class="post-list">

							<?php $__currentLoopData = App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<li>

								<div class="post">

								  <div class="post-img">

									<img style="width: 73px; height: 59px;" src="<?php echo e(asset('assets/images/blogs/'.$blog->photo)); ?>" alt="">

								  </div>

								  <div class="post-details">

									<a href="<?php echo e(route('front.blogshow',$blog->id)); ?>">

										<h4 class="post-title">

											<?php echo e(mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title); ?>


										</h4>

									</a>

									<p class="date">

										<?php echo e(date('M d - Y',(strtotime($blog->created_at)))); ?>


									</p>

								  </div>

								</div>

							  </li>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</ul>

					</div>

				</div>



				<div class="col-md-5 col-lg-5">

					<div class="footer-widget recent-post-widget">

						<h4 class="title">Payment Partners</h4>

						<ul class="post-list">

							<li>

								<div class="post">

								  <div class="post-img">

									<img style="height: 50px; width:200px;" src="https://ratcart.com/assets/images/224x40.png" alt="">

								  </div>

								</div>

							</li>

						</ul>

					</div>

				</div>

				<div class="col-md-5 col-lg-5">

					<div class="footer-widget recent-post-widget">

						<h4 class="title">Delivery Partners</h4>

						<ul class="post-list">

							<li>

								<div class="post">

								  <div class="post-img">

									<img style="height: 50px; width:200px;" src="https://ratcart.com/assets/images/23_lgoog.png" alt="">

								  </div>

								</div>

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>



		<div class="copy-bg">

			<div class="container">

				<div class="row">

					<div class="col-lg-12">

							<div class="content">

								<div class="content">

									<p><?php echo $gs->copyright; ?></p>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</footer>

	<!-- Footer Area End -->



	<!-- Back to Top Start -->

	<div class="bottomtotop">

		<i class="fas fa-chevron-right"></i>

	</div>

	<!-- Back to Top End -->



	<!-- LOGIN MODAL -->

	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"

		aria-hidden="true">

		<div class="modal-dialog  modal-dialog-centered" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

				<div class="modal-body">

					<nav class="comment-log-reg-tabmenu">

						<div class="nav nav-tabs" id="nav-tab" role="tablist">

							<a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"

								role="tab" aria-controls="nav-log" aria-selected="true">

								<?php echo e($langg->lang197); ?>


							</a>

							<a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"

								aria-controls="nav-reg" aria-selected="false">

								<?php echo e($langg->lang198); ?>


							</a>

						</div>

					</nav>

					<div class="tab-content" id="nav-tabContent">

						<div class="tab-pane fade show active" id="nav-log1" role="tabpanel"

							aria-labelledby="nav-log-tab1">

							<div class="login-area">

								<div class="header-area">

									<h4 class="title"><?php echo e($langg->lang172); ?></h4>

								</div>

								<div class="login-form signin-form">
									<?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<form class="mloginform" action="<?php echo e(route('user.login.submit')); ?>" method="POST">
										<?php echo e(csrf_field()); ?>

										<div class="form-input">
											<input type="text" name="email" placeholder="Enter Email or Mobile no." required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password" placeholder="<?php echo e($langg->lang174); ?>" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp" <?php echo e(old('remember') ? 'checked' : ''); ?>>
												<label for="mrp"><?php echo e($langg->lang175); ?></label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot"><?php echo e($langg->lang176); ?></a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="<?php echo e($langg->lang177); ?>">
										<button type="submit" class="submit-btn"><?php echo e($langg->lang178); ?></button>
										<?php if($socialsetting->f_check == 1 ||
									     	$socialsetting->g_check == 1): ?>
											<div class="social-area">
												<h3 class="title"><?php echo e($langg->lang179); ?></h3>
												<p class="text"><?php echo e($langg->lang180); ?></p>
												<ul class="social-links">
													<?php if($socialsetting->f_check == 1): ?>
														<li><a href="<?php echo e(route('social-provider','facebook')); ?>"><i class="fab fa-facebook-f"></i></a>
														</li>
													<?php endif; ?>
													<?php if($socialsetting->g_check == 1): ?>
													    <li><a href="<?php echo e(route('social-provider','google')); ?>"><i class="fab fa-google-plus-g"></i></a></li>
													<?php endif; ?>
												</ul>
											</div>
										<?php endif; ?>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
							<div class="login-area signup-area">
								<div class="header-area">
									<h4 class="title"><?php echo e($langg->lang181); ?></h4>
								</div>
								<div class="login-form signup-form">
									<?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<form class="mregisterform" action="<?php echo e(route('user-register-submit')); ?>" method="POST">
										<?php echo e(csrf_field()); ?>

										<div class="form-input">
											<input type="text" class="User Name" name="name" placeholder="<?php echo e($langg->lang182); ?>" required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="email" class="User Name" name="email" placeholder="<?php echo e($langg->lang183); ?>" required="">
											<i class="icofont-email"></i>
										</div>
										<div class="form-input">
											<input type="text" class="User Name" name="phone" placeholder="<?php echo e($langg->lang184); ?>" required="">
											<i class="icofont-phone"></i>
										</div>
										<div class="form-input">
											<input type="text" class="User Name" name="address" placeholder="<?php echo e($langg->lang185); ?>" required="">
											<i class="icofont-location-pin"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password" placeholder="<?php echo e($langg->lang186); ?>" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password_confirmation" placeholder="<?php echo e($langg->lang187); ?>" required=""><i class="icofont-ui-password"></i>
										</div>
										<?php if($gs->is_capcha == 1): ?>
											<ul class="captcha-area">
												<li>
													<p><img class="codeimg1" src="<?php echo e(asset("assets/images/capcha_code.png")); ?>" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i></p>
												</li>
											</ul>
											<div class="form-input">
												<input type="text" class="Password" name="codes" placeholder="<?php echo e($langg->lang51); ?>" required="">
												<i class="icofont-refresh"></i>
											</div>
										<?php endif; ?>
										<input class="mprocessdata" type="hidden" value="<?php echo e($langg->lang188); ?>">
										<button type="submit" class="submit-btn"><?php echo e($langg->lang189); ?></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- LOGIN MODAL ENDS -->



	<!-- FORGOT MODAL -->

	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"

		aria-hidden="true">

		<div class="modal-dialog  modal-dialog-centered" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

				<div class="modal-body">



					<div class="login-area">

						<div class="header-area forgot-passwor-area">

							<h4 class="title"><?php echo e($langg->lang191); ?> </h4>

							<p class="text"><?php echo e($langg->lang192); ?> </p>

						</div>

						<div class="login-form">

							<?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

							<form id="mforgotform" action="<?php echo e(route('user-forgot-submit')); ?>" method="POST">

								<?php echo e(csrf_field()); ?>


								<div class="form-input">

									<input type="email" name="email" class="User Name"

										placeholder="<?php echo e($langg->lang193); ?>" required="">

									<i class="icofont-user-alt-5"></i>

								</div>

								<div class="to-login-page">

									<a href="javascript:;" id="show-login">

										<?php echo e($langg->lang194); ?>


									</a>

								</div>

								<input class="fauthdata" type="hidden" value="<?php echo e($langg->lang195); ?>">

								<button type="submit" class="submit-btn"><?php echo e($langg->lang196); ?></button>

							</form>

						</div>

					</div>



				</div>

			</div>

		</div>

	</div>

	<!-- FORGOT MODAL ENDS -->





<!-- VENDOR LOGIN MODAL -->

	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">

	    <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">

		    <div class="modal-content">

		        <div class="modal-header">

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

		        </div>

		        <div class="modal-body">

					<nav class="comment-log-reg-tabmenu">

						<div class="nav nav-tabs" id="nav-tab1" role="tablist">

							<a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">

								<?php echo e($langg->lang234); ?>


							</a>

							<a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">

								<?php echo e($langg->lang235); ?>


							</a>

						</div>

					</nav>

					<div class="tab-content" id="nav-tabContent">

						<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">

					        <div class="login-area">

					          <div class="login-form signin-form">

					            <?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					            <form class="mloginform" action="<?php echo e(route('user.login.submit')); ?>" method="POST">

					                <?php echo e(csrf_field()); ?>


					                <div class="form-input">

						                <input type="email" name="email" placeholder="<?php echo e($langg->lang173); ?>" required="">

						                <i class="icofont-user-alt-5"></i>

					                </div>

					                <div class="form-input">

						                <input type="password" class="Password" name="password" placeholder="<?php echo e($langg->lang174); ?>" required="">

						                <i class="icofont-ui-password"></i>

					                </div>

					                <div class="form-forgot-pass">

						                <div class="left">

						                  <input type="checkbox" name="remember"  id="mrp1" <?php echo e(old('remember') ? 'checked' : ''); ?>>

						                  <label for="mrp1"><?php echo e($langg->lang175); ?></label>

						                </div>

						                <div class="right">

						                  <a href="javascript:;" id="show-forgot1">

						                    <?php echo e($langg->lang176); ?>


						                  </a>

						                </div>

					                </div>

					                <input type="hidden" name="modal"  value="1">

					                <input type="hidden" name="vendor"  value="1">

					                <input class="mauthdata" type="hidden"  value="<?php echo e($langg->lang177); ?>">

					                <button type="submit" class="submit-btn"><?php echo e($langg->lang178); ?></button>

						                <?php if($socialsetting->f_check == 1 || $socialsetting->g_check == 1): ?>

							                <div class="social-area">

							                    <h3 class="title"><?php echo e($langg->lang179); ?></h3>

							                    <p class="text"><?php echo e($langg->lang180); ?></p>

							                    <ul class="social-links">

								                    <?php if($socialsetting->f_check == 1): ?>

								                       <li><a href="<?php echo e(route('social-provider','facebook')); ?>"><i class="fab fa-facebook-f"></i></a></li>

								                    <?php endif; ?>

								                    <?php if($socialsetting->g_check == 1): ?>

								                       <li><a href="<?php echo e(route('social-provider','google')); ?>"><i class="fab fa-google-plus-g"></i></a></li>

								                    <?php endif; ?>

							                    </ul>

							                </div>

						                <?php endif; ?>

					            </form>

					          </div>

					        </div>

						</div>

						<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">

			                <div class="login-area signup-area">

			                    <div class="login-form signup-form">

			                       <?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			                        <form class="mregisterform" action="<?php echo e(route('user-register-submit')); ?>" method="POST">

			                            <?php echo e(csrf_field()); ?>


				                        <div class="row">

				                            <div class="col-lg-6">

				                                <div class="form-input">

					                                <input type="text" class="User Name" name="name" placeholder="<?php echo e($langg->lang182); ?>" required="">

					                                <i class="icofont-user-alt-5"></i>

				                            	</div>

				                            </div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="email" class="User Name" name="email" placeholder="<?php echo e($langg->lang183); ?>" required="">

					                                <i class="icofont-email"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6 ">

					                            <ul class="captcha-area">

						                            <li>

						                                <div class="form-input">

						                                    <p>

						                                    	<input type="text" class="User Name" name="phone" id="phone_no" placeholder="<?php echo e($langg->lang184); ?>"  required=""><i class="icofont-phone"></i>

						                                    </p>

						                                </div>  

						                                <p style="margin-top: -14px !important; color: red;" id="otp_link_div"><a href="javascript:void(0);" id="otp_form" style="color: red !important; text-decoration: underline red;">Verify Mobile No.</a></p>

						                                <p style="margin-top: -14px !important; color: green; display: none;" id="otp_verify_div"><a href="#" id="otp_verify_div" style="color: green !important;">Mobile No verified</a></p>

						                                <div class="form-input" id="otp_input_div"  style="display: none;">

						                                    <p style="margin-top: -14px !important; color: red;" >

						                                        <input type="text" class="User Name" name="otp" id="otp" placeholder="Enter otp" style="background: #f8f9fa0d; width: 70%">

						                                        <a href="javascript:void(0);"  class="verify-btn" style="width: 20%; background: #47a010;" id="verify_otp">Verify</a>

						                                    </p>

						                                </div>   

						                            </li>

					                            </ul>

					                        </div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="address" placeholder="<?php echo e($langg->lang185); ?>" required="">

					                                <i class="icofont-location-pin"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="shop_name" placeholder="<?php echo e($langg->lang238); ?>" required="">

					                                <i class="icofont-cart-alt"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="owner_name" placeholder="<?php echo e($langg->lang239); ?>" required="">

					                                <i class="icofont-cart"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="shop_number" placeholder="<?php echo e($langg->lang240); ?>" required="">

					                                <i class="icofont-shopping-cart"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="shop_address" placeholder="<?php echo e($langg->lang241); ?>" required="">

					                                <i class="icofont-opencart"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="reg_number" placeholder="<?php echo e($langg->lang242); ?>" required="">

					                                <i class="icofont-ui-cart"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="text" class="User Name" name="shop_message" placeholder="<?php echo e($langg->lang243); ?>" required="">

					                                <i class="icofont-envelope"></i>

					                            </div>

				                           	</div>



				                            <div class="col-lg-6">

					                            <div class="form-input">

					                                <input type="password" class="Password" name="password" placeholder="<?php echo e($langg->lang186); ?>" required="">

					                                <i class="icofont-ui-password"></i>

					                            </div>

				                           	</div>

				                            <div class="col-lg-6">

				 								<div class="form-input">

				                                <input type="password" class="Password" name="password_confirmation" placeholder="<?php echo e($langg->lang187); ?>" required="">

				                                <i class="icofont-ui-password"></i>

				                            	</div>

				                           	</div>

				                           	<div class="col-lg-6">

						                        <div class="form-input">

						                            <input type="file" title =" Choose profile pic " class="file" id="files" name="user_image"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Vendor Image</i> 

						                        </div>

						                    </div>

						                    <div class="col-lg-6">

						                        <div class="form-input">

						                            <input type="file" title =" Choose profile pic " class="file" id="files" name="user_signature"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Vendor Signature</i> 

						                        </div>

						                    </div>

						                    <div class="col-lg-6">

						                        <div class="form-input">

						                            <input type="file" title =" Choose Adhar card " class="file" id="files" name="user_adhar_card"   aria-label="File browser example"  required=""><i class="" style="margin-top: 11px;">Adhar card</i> 

						                        </div>

						                    </div>

				                            <?php if($gs->is_capcha == 1): ?>

												<div class="col-lg-6">

												    <ul class="captcha-area">

												        <li>

												         	<p>

												         		<img class="codeimg1" src="<?php echo e(asset("assets/images/capcha_code.png")); ?>" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>

												         	</p>



												        </li>

												    </ul>

												</div>

						                        <div class="col-lg-6">

						                            <div class="form-input">

						                                <input type="text" class="Password" name="codes" placeholder="<?php echo e($langg->lang51); ?>" required="">

						                                <i class="icofont-refresh"></i>

						                            </div>

						                        </div>

				                            <?php endif; ?>

								            <input type="hidden" name="vendor"  value="1">

				                            <input class="mprocessdata" type="hidden"  value="<?php echo e($langg->lang188); ?>">

				                            <button type="submit" class="submit-btn" disabled="disabled"><?php echo e($langg->lang189); ?></button>

				                        </div>

			                        </form>

			                    </div>

			                </div>

						</div>

					</div>

		        </div>

		    </div>

	    </div>

    </div>

<!-- VENDOR LOGIN MODAL ENDS -->



<!-- Product Quick View Modal -->



	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">

		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">

		  <div class="modal-content">

			<div class="submit-loader">

				<img src="<?php echo e(asset('assets/images/'.$gs->loader)); ?>" alt="">

			</div>

			<div class="modal-header">

			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">&times;</span>

			  </button>

			</div>

			<div class="modal-body">

				<div class="container quick-view-modal">



				</div>

			</div>

		  </div>

		</div>

	  </div>

<!-- Product Quick View Modal -->



<!-- Order Tracking modal Start-->

    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">

        <div class="modal-dialog  modal-lg" role="document">

            <div class="modal-content">

	            <div class="modal-header">

	                <h6 class="modal-title"> <b><?php echo e($langg->lang772); ?></b> </h6>

	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

	                <span aria-hidden="true">&times;</span>

	                </button>

	            </div>

	            <div class="modal-body">

	                <div class="order-tracking-content">

	                    <form id="track-form" class="track-form">

	                        <?php echo e(csrf_field()); ?>


	                        <input type="text" id="track-code" placeholder="<?php echo e($langg->lang773); ?>" required="">

	                        <button type="submit" class="mybtn1"><?php echo e($langg->lang774); ?></button>

	                        <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>

	                    </form>

	                </div>

	                <div>

			            <div class="submit-loader d-none">

							<img src="<?php echo e(asset('assets/images/'.$gs->loader)); ?>" alt="">

						</div>

						<div id="track-order">



						</div>

	                </div>

	            </div>

            </div>

        </div>

    </div>

<!-- Order Tracking modal End -->

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script type="text/javascript">

    $( "#otp_form" ).click(function(){

    	if($("#phone_no").val() =="" ){

    		alert("Mobile no can not be blank");

    	}

    	else{

            var mobile = $("#phone_no").val();

	        $.ajax({

	            method:"GET",

	            url:"<?php echo e(route('front.sendotp')); ?>/"+mobile,

                success:function(data){

	                if ((data.errors)){

	                	alert("Mobile user already exists");

	                }

	                else{

	                	$('#phone_no').attr('readonly', true); 

		                $("#otp_link_div").hide();

	                    $("#otp_input_div").show();

	                }

	            }

	        });

	    }    

    });



    $( "#verify_otp" ).click(function(){

	    	if($("#phone_no").val() =="" ){

	    		alert("Mobile no can not be blank");

	    	}

	    	if($("#otp").val() =="" ){

	    		alert("Otp can not be blank");

	    	}

	    	else{

	            var mobile = $("#phone_no").val();

	            var otp    = $("#otp").val();

		        $.ajax({

			            method:"GET",

			            url:"<?php echo e(route('front.verifyotp')); ?>/"+mobile+'/'+otp,

		                success:function(data){

		                if ((data.errors)) {

		                	alert("Otp does not match");

		                	$("#otp_link_div").hide();

		                    $("#otp_input_div").show();

		                }

		                else{

			                $("#otp_link_div").hide();

		                    $("#otp_input_div").hide();

		                    $("#otp_verify_div").show();

		                    $(".submit-btn").attr("disabled", false);

		                }

		           }

		        });

		    }    

    });

</script>

<script type="text/javascript">

  var mainurl = "<?php echo e(url('/')); ?>";

  var gs      = <?php echo json_encode(\App\Models\Generalsetting::first()->makeHidden(['stripe_key', 'stripe_secret', 'smtp_pass', 'instamojo_key', 'instamojo_token', 'paystack_key', 'paystack_email', 'paypal_business', 'paytm_merchant', 'paytm_secret', 'paytm_website', 'paytm_industry', 'paytm_mode', 'molly_key', 'razorpay_key', 'razorpay_secret'])); ?>;

  var langg    = <?php echo json_encode($langg); ?>;

</script>



	<!-- jquery -->

	

	<script src="<?php echo e(asset('assets/front/js/jquery.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/front/js/vue.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/front/jquery-ui/jquery-ui.min.js')); ?>"></script>

	<!-- popper -->

	<script src="<?php echo e(asset('assets/front/js/popper.min.js')); ?>"></script>

	<!-- bootstrap -->

	<script src="<?php echo e(asset('assets/front/js/bootstrap.min.js')); ?>"></script>

	<!-- plugin js-->

	<script src="<?php echo e(asset('assets/front/js/plugin.js')); ?>"></script>



	<script src="<?php echo e(asset('assets/front/js/xzoom.min.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/front/js/jquery.hammer.min.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/front/js/setup.js')); ?>"></script>



	<script src="<?php echo e(asset('assets/front/js/toastr.js')); ?>"></script>

	<!-- main -->

	<script src="<?php echo e(asset('assets/front/js/main.js')); ?>"></script>

	<!-- custom -->

	<script src="<?php echo e(asset('assets/front/js/custom.js')); ?>"></script>



    <?php echo $seo->google_analytics; ?>




	<?php if($gs->is_talkto == 1): ?>

		<!--Start of Tawk.to Script-->

		<?php echo $gs->talkto; ?>


		<!--End of Tawk.to Script-->

	<?php endif; ?>



	<?php echo $__env->yieldContent('scripts'); ?>



</body>



</html>

<?php /**PATH /var/www/html/ecom/ratcart/resources/views/layouts/front.blade.php ENDPATH**/ ?>