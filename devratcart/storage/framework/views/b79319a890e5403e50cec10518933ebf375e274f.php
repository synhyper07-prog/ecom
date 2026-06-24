<div class="col-lg-3 col-md-6">
  <div class="left-area">
    <div class="filter-result-area">
      <div class="header-area">
        <h4 class="title"><?php echo e($langg->lang61); ?></h4>
            </div>
            <div class="body-area">
                <form id="catalogForm" action="<?php echo e(route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])); ?>" method="GET">
                    <?php if(!empty(request()->input('search'))): ?>
                        <input type="hidden" name="search" value="<?php echo e(request()->input('search')); ?>">
                    <?php endif; ?>
                    <?php if(!empty(request()->input('sort'))): ?>
                        <input type="hidden" name="sort" value="<?php echo e(request()->input('sort')); ?>">
                    <?php endif; ?>
                    <ul class="filter-list">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <div class="content">
                                <a href="<?php echo e(route('front.category', $element->slug)); ?><?php echo e(!empty(request()->input('search')) ? '?search='.request()->input('search') : ''); ?>" class="category-link"> <i class="fas fa-angle-double-right"></i> <?php echo e($element->name); ?></a>
                                <?php if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs)): ?>
                                    <?php $__currentLoopData = $cat->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subelement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="sub-content open">
                                           <a href="<?php echo e(route('front.category', [$cat->slug, $subelement->slug])); ?><?php echo e(!empty(request()->input('search')) ? '?search='.request()->input('search') : ''); ?>" class="subcategory-link"><i class="fas fa-angle-right"></i><?php echo e($subelement->name); ?></a>
                                            <?php if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs)): ?>
                                               <?php $__currentLoopData = $subcat->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $childcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="child-content open">
                                                        <a href="<?php echo e(route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])); ?><?php echo e(!empty(request()->input('search')) ? '?search='.request()->input('search') : ''); ?>" class="subcategory-link"><i class="fas fa-caret-right"></i> <?php echo e($childcat->name); ?></a>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="price-range-block">
                      <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                      <div class="livecount">
                          <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                          <span><?php echo e($langg->lang62); ?></span>
                          <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                      </div>
                  </div>
                  <button class="filter-btn" type="submit"><?php echo e($langg->lang58); ?></button>
              </form>
            </div>
        </div>
        <?php if((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))): ?>
            <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">Filters</h4>
                </div>
                <div class="body-area">
                    <form id="attrForm" action="<?php echo e(route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])); ?>" method="post">
                      <ul class="filter">
                          <div class="single-filter">
                              <?php if(!empty($cat) && !empty(json_decode($cat->attributes, true))): ?>
                                  <?php $__currentLoopData = $cat->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="my-2 sub-title">
                                         <span><i class="fas fa-arrow-alt-circle-right"></i> <?php echo e($attr->name); ?></span>
                                      </div>
                                      <?php if(!empty($attr->attribute_options)): ?>
                                          <?php $__currentLoopData = $attr->attribute_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class="form-check ml-0 pl-0">
                                                <input name="<?php echo e($attr->input_name); ?>[]" class="form-check-input attribute-input" type="checkbox" id="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>" value="<?php echo e($option->name); ?>">
                                                <label class="form-check-label" for="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>"><?php echo e($option->name); ?></label>
                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                              <?php if(!empty($subcat) && !empty(json_decode($subcat->attributes, true))): ?>
                                  <?php $__currentLoopData = $subcat->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="my-2 sub-title">
                                        <span><i class="fas fa-arrow-alt-circle-right"></i> <?php echo e($attr->name); ?></span>
                                      </div>
                                      <?php if(!empty($attr->attribute_options)): ?>
                                          <?php $__currentLoopData = $attr->attribute_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class="form-check  ml-0 pl-0">
                                                  <input name="<?php echo e($attr->input_name); ?>[]" class="form-check-input attribute-input" type="checkbox" id="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>" value="<?php echo e($option->name); ?>">
                                                  <label class="form-check-label" for="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>"><?php echo e($option->name); ?></label>
                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                              <?php if(!empty($childcat) && !empty(json_decode($childcat->attributes, true))): ?>
                                  <?php $__currentLoopData = $childcat->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="my-2 sub-title">
                                        <span><i class="fas fa-arrow-alt-circle-right"></i> <?php echo e($attr->name); ?></span>
                                      </div>
                                      <?php if(!empty($attr->attribute_options)): ?>
                                          <?php $__currentLoopData = $attr->attribute_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class="form-check  ml-0 pl-0">
                                                <input name="<?php echo e($attr->input_name); ?>[]" class="form-check-input attribute-input" type="checkbox" id="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>" value="<?php echo e($option->name); ?>">
                                                <label class="form-check-label" for="<?php echo e($attr->input_name); ?><?php echo e($option->id); ?>"><?php echo e($option->name); ?></label>
                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                          </div>
                      </ul>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!isset($vendor)): ?>
            <div class="tags-area">
                <div class="header-area">
                    <h4 class="title"><?php echo e($langg->lang63); ?></h4>
                </div>
                <div class="body-area">
                    <ul class="taglist">
                        <?php $__currentLoopData = App\Models\Product::showTags(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($tag)): ?>
                                <li><a class="<?php echo e(isset($tags) ? ($tag == $tags ? 'active' : '') : ''); ?>" href="<?php echo e(route('front.tag',$tag)); ?>"><?php echo e($tag); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>             
        <?php else: ?>
            <div class="service-center">
              <div class="header-area"><h4 class="title"><?php echo e($langg->lang227); ?></h4></div>
              <div class="body-area">
                <ul class="list">
                  <li><a href="javascript:;" data-toggle="modal" data-target="<?php echo e(Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg'); ?>"><i class="icofont-email"></i> <span class="service-text"><?php echo e($langg->lang228); ?></span></a>
                  </li>
                        <li><a href="tel:+<?php echo e($vendor->shop_number); ?>"><i class="icofont-phone"></i> <span class="service-text"><?php echo e($vendor->shop_number); ?></span></a></li>
                    </ul>
                </div>
                <div class="footer-area">
                  <p class="title"><?php echo e($langg->lang229); ?></p>
                  <ul class="list">
                      <?php if($vendor->f_check != 0): ?>
                          <li><a href="<?php echo e($vendor->f_url); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                      <?php endif; ?>
                      <?php if($vendor->g_check != 0): ?>
                        <li><a href="<?php echo e($vendor->g_url); ?>" target="_blank"><i class="fab fa-google"></i></a></li>
                      <?php endif; ?>
                      <?php if($vendor->t_check != 0): ?>
                          <li><a href="<?php echo e($vendor->t_url); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                      <?php endif; ?>
                      <?php if($vendor->l_check != 0): ?>
                          <li><a href="<?php echo e($vendor->l_url); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                      <?php endif; ?>
                  </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($slug) && !empty($slug)): ?>
          <?php if(in_array('size', App\Models\Category::getFilterAttributes($slug))): ?>
              <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">Size</h4>
                </div>
                <div class="body-area">
                    <ul class="taglist">
                        <?php $__currentLoopData = App\Models\Product::getSize($slug); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($size)): ?>
                                <li><a class="" href=""><?php echo e($size); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>      
        <div class="tags-area">
            <div class="header-area"><h4 class="title">Ratings</h4></div>
            <div class="body-area">
              <div id="replay-area">
          <div class="review-area">
            <div class="star-area">
                <ul class="star-list">
                    <li class="stars" data-val="1"><a id="star_one" style="color: #bdbdbd;" href="<?php echo e(route('front.rating-wise-product','1')); ?>"><i class="fas fa-star"></i></a></li>
                    <li class="stars" data-val="2"><a id="star_two" style="color: #bdbdbd;" href="<?php echo e(route('front.rating-wise-product','2')); ?>"><i class="fas fa-star"></i><i class="fas fa-star"></i></a></li>
                    <li class="stars"  data-val="3"><a id="star_three" style="color: #bdbdbd;" href="<?php echo e(route('front.rating-wise-product','3')); ?>"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a></li>
                    <li class="stars"  data-val="4"><a id="star_four" style="color: #bdbdbd;" href="<?php echo e(route('front.rating-wise-product','4')); ?>"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a></li>
                    <li class="stars" data-val="5"><a id="star_five" style="color: #bdbdbd;" href="<?php echo e(route('front.rating-wise-product','5')); ?>"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a></li>
                  </ul>
              </div>
            </div>
        </div>  
            </div>
        </div>    
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
      $( document ).ready(function() {
        $('.stars').css("color", "#bdbdbd");
    });
        $("#star_one").hover(function(){
      $(this).css("color", "#fece37");
        }, function(){
      $(this).css("color", "#bdbdbd");
    });
    $("#star_two").hover(function(){
      $(this).css("color", "#fece37");
        }, function(){
      $(this).css("color", "#bdbdbd");
    });
    $("#star_three").hover(function(){
      $(this).css("color", "#fece37");
        }, function(){
      $(this).css("color", "#bdbdbd");
    });
    $("#star_four").hover(function(){
      $(this).css("color", "#fece37");
        }, function(){
      $(this).css("color", "#bdbdbd");
    });
    $("#star_five").hover(function(){
      $(this).css("color", "#fece37");
        }, function(){
      $(this).css("color", "#bdbdbd");
    });
    </script>
<?php $__env->stopSection(); ?>

<?php /**PATH /home/ratcart2a/public_html/devratcart/resources/views/includes/catalog.blade.php ENDPATH**/ ?>