

<?php $__env->startSection('main'); ?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow">

                <div class="card-header text-white">
                    Book Details
                </div>

                <?php echo $__env->make('layouts.message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="card-body">

                    
                    <a href="<?php echo e(route('books.index')); ?>" class="btn btn-secondary mb-3">
                        <i class="fa fa-arrow-left"></i> Back to Books
                    </a>

                    
                    <div class="row">
                        <div class="col-md-8">

                            <h3><?php echo e($book->title); ?></h3>
                            <p><strong>Author:</strong> <?php echo e($book->author); ?></p>

                            
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

                            <p>
                                <strong>Rating:</strong> 
                                <?php echo e(number_format($avgRating, 1)); ?> / 5
                                (<?php echo e($ratingCount); ?> <?php echo e($ratingCount > 1 ? 'Reviews' : 'Review'); ?>)
                            </p>

                            <p>
                                <strong>Status:</strong>
                                <?php if($book->status == 1): ?>
                                    <span class="text-success">Active</span>
                                <?php else: ?>
                                    <span class="text-danger">Blocked</span>
                                <?php endif; ?>
                            </p>

                            <hr>

                            <p><strong>Description:</strong></p>
                            <p style="text-align: justify;"><?php echo e($book->description ?? 'No description available.'); ?></p>

                        </div>

                        <div class="col-md-4 text-center">
                            
                            <?php if($book->image): ?>
                                <img src="<?php echo e(asset('uploads/books/' . $book->image)); ?>" 
                                     class="img-fluid rounded shadow" 
                                     style="max-height: 250px; object-fit: cover;">
                            <?php else: ?>
                                     <img src="<?php echo e(asset('images/default-placeholder.png')); ?>" alt="" class="img-fluid rounded shadow" 
                                     style="max-height: 250px;">
                            <?php endif; ?>
                        </div>

                    </div>

                    <hr>

                    
                    <div class="d-flex">

                        <a href="<?php echo e(route('books.edit', $book->id)); ?>" 
                           class="btn btn-primary me-2">
                           <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        <form action="<?php echo e(route('books.destroy', $book->id)); ?>" 
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this book?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn btn-danger">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11 Projects\Book-Review-App-In-Laravel-11\resources\views/account/books/show.blade.php ENDPATH**/ ?>