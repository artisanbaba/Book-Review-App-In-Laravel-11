

<?php $__env->startSection('main'); ?>  

    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Books</h2>
                    <div class="mt-2">
                        <a href="<?php echo e(route('home')); ?>" class="text-dark">Clear</a>
                    </div>
                </div>
                <div class="card shadow-lg border-0">
                    <form action="" method="GET"> 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-11 col-md-11">
                                    <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Search by title" value="<?php echo e(Request::get('keyword')); ?>">
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <button class="btn btn-primary btn-lg w-100"><i class="fa-solid fa-magnifying-glass"></i></button>  
                                </div>                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt-4">
                    <?php if($books->isNotEmpty()): ?>
                        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card border-1 shadow-lg">
                                <a href="<?php echo e(route('book.detail', $book->id)); ?>">
                                    <?php if($book->image != ''): ?>
                                        <img src="<?php echo e(asset('uploads/books/'.$book->image)); ?>" alt="" class="card-img-top"> 
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/default-placeholder.png')); ?>" alt="" class="img-fluid card-img-top">
                                    <?php endif; ?> 
                                </a>
                                
                                <div class="card-body">
                                    <h3 class="h4 heading"><a href="<?php echo e(route('book.detail', $book->id)); ?>"><?php echo e($book->title); ?></a></h3>
                                    <p>by <?php echo e($book->author); ?></p>

                                    <?php
                                        $ratingCount = $book->reviews_count;
                                        $ratingSum = $book->reviews_sum_rating;

                                        if ($ratingCount > 0) {
                                            $avgRating = $ratingSum / $ratingCount;
                                        } else {
                                            $avgRating = 0;
                                        }

                                        $avgRatingPer = ($avgRating / 5) * 100;
                                    ?>                                    

                                    <div class="star-rating d-inline-flex ml-2" title="">
                                        <span class="rating-text theme-font theme-yellow">
                                            <?php echo e(number_format($avgRating, 1)); ?>

                                        </span>

                                        <div class="star-rating d-inline-flex mx-2" title="">
                                            <div class="back-stars ">
                                                <i class="fa fa-star " aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
            
                                                <div class="front-stars" style="width: <?php echo e($avgRatingPer); ?>%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="theme-font text-muted"><?php echo e(($ratingCount > 1) ? "($ratingCount Reviews)" : "($ratingCount Review)"); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?> 

                    <?php echo e($books->links()); ?> 

                </div>
            </div>
        </div>
    </div>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11 Projects\Book-Review-App-In-Laravel-11\resources\views/home.blade.php ENDPATH**/ ?>