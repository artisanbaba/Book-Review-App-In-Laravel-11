

<?php $__env->startSection('main'); ?> 
<div class="container mt-3 ">
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <a href="<?php echo e(route('home')); ?>" class="text-decoration-none text-dark ">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to books</strong>
            </a>
            <div class="row mt-4">
                <div class="col-md-4">
                    <?php if($book->image != ''): ?>
                        <img src="<?php echo e(asset('uploads/books/'.$book->image)); ?>" alt="" class="card-img-top"> 
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/default-placeholder.png')); ?>" alt="" class="img-fluid card-img-top">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <?php echo $__env->make('layouts.message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

                    <h3 class="h2 mb-3"><?php echo e($book->title); ?></h3>
                    
                    <div class="h4 text-muted"><?php echo e($book->author); ?></div>
                    <div class="star-rating d-inline-flex ml-2" title="">
                        <span class="rating-text theme-font theme-yellow"><?php echo e(number_format($avgRating, 1)); ?></span>
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
                        <span class="theme-font text-muted"><span class="theme-font text-muted"><?php echo e(($ratingCount > 1) ? "($ratingCount Reviews)" : "($ratingCount Review)"); ?></span></span>
                    </div>

                    <div class="content mt-3">
                        <?php echo e($book->description); ?>

                    </div>

                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Readers also enjoyed</h2>
                        </div> 
                        <?php if($relatedBooks->isNotEmpty()): ?>
                            <?php $__currentLoopData = $relatedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedBook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-lg-4 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <a href="<?php echo e(route('book.detail', $relatedBook->id)); ?>">
                                        <?php if($relatedBook->image != ''): ?>
                                            <img src="<?php echo e(asset('uploads/books/'.$relatedBook->image)); ?>" alt="" class="card-img-top"> 
                                        <?php else: ?> 
                                            <img src="<?php echo e(asset('images/default-placeholder.png')); ?>" alt="" class="img-fluid card-img-top">
                                        <?php endif; ?> 
                                    </a>

                                    <?php
                                        $relatedRatingCount = $relatedBook->reviews_count;
                                        $relatedRatingSum = $relatedBook->reviews_sum_rating;

                                        if ($relatedRatingCount > 0) {
                                            $relatedAvgRating = $relatedRatingSum / $relatedRatingCount;
                                        } else {
                                            $relatedAvgRating = 0;
                                        }

                                        $relatedAvgRatingPer = ($relatedAvgRating / 5) * 100;
                                    ?>

                                    <div class="card-body">
                                        <h3 class="h4 heading">
                                            <a href="<?php echo e(route('book.detail', $relatedBook->id)); ?>"><?php echo e($relatedBook->title); ?></a>
                                        </h3>
                                        <p>by <?php echo e($relatedBook->author); ?></p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">
                                                <?php echo e(number_format($relatedAvgRating, 1)); ?>

                                            </span>

                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                
                                                    <div class="front-stars" style="width: <?php echo e($relatedAvgRatingPer); ?>%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted"><span class="theme-font text-muted"><?php echo e(($relatedRatingCount > 1) ? "($relatedRatingCount Reviews)" : "($relatedRatingCount Review)"); ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                                                                 
                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-12  mt-4">
                            <div class="d-flex justify-content-between">
                                <h3>Reviews</h3>
                                <div>
                                    <?php if(Auth::check()): ?>
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Review
                                      </button>  
                                    <?php else: ?>
                                        <a href="<?php echo e(route('account.login')); ?>" class="btn btn-primary">
                                            Login to Add Review
                                        </a>    
                                    <?php endif; ?>
                                </div>
                            </div>                        
                            <?php if($book->reviews->isNotEmpty()): ?>
                                <?php $__currentLoopData = $book->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card border-0 shadow-lg my-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-3"><?php echo e($review->user->name); ?></h4>
                                            <span class="text-muted"><?php echo e($review->created_at->format('d M, Y')); ?></span>         
                                        </div>
                                        <?php
                                            $reviewPresent = ($review->rating/5) * 100; // Convert rating to percentage for star width
                                        ?>

                                        <div class="mb-3">
                                            <div class="star-rating d-inline-flex" title="">
                                                <div class="star-rating d-inline-flex " title="">
                                                    <div class="back-stars ">
                                                        <i class="fa fa-star " aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars" style="width: <?php echo e($reviewPresent); ?>%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                            
                                        </div>
                                        <div class="content">
                                            <p><?php echo e($review->review); ?></p>
                                        </div>
                                    </div>
                                </div>         
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p class="text-muted">No reviews found for this book.</p>
                                <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>   

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>Atomic Habits</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form action="" id="bookReviewForm" name="bookReviewForm">
                <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                <div class="modal-body">                
                    <div class="mb-3">
                        <label for="" class="form-label">Review</label>
                        <textarea name="review" id="review" class="form-control" cols="5" rows="5" placeholder="Review"></textarea>
                        <p class="invalid-feedback" id="reviewError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $('#bookReviewForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '<?php echo e(route("book.saveReview")); ?>',
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            success: function(response){
                if(response.status === 'success'){
                    // alert('Review submitted successfully!');
                    location.reload();
                } else {
                    let errors = response.errors;

                    if(errors.review){
                        $('#review').addClass('is-invalid');
                        $('#reviewError').text(errors.review[0]);
                    } else {
                        $('#review').removeClass('is-invalid');
                        $('#reviewError').text('');
                    }
                }
            },
            error: function(xhr){
                alert('An error occurred while submitting your review. Please try again.');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11 Projects\Book-Review-App-In-Laravel-11\resources\views/book-detail.blade.php ENDPATH**/ ?>