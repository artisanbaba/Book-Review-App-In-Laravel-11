

<?php $__env->startSection('main'); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Edit Review
                    </div>
                    <div class="card-body pb-0"> 
                    <form action="<?php echo e(route('user-reviews.update', $review->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="card-body">
                            <div class="mb-3">                                
                                <label for="book" class="form-label ">Book Name</label>
                               <div class="bg bg-secondary text-white p-2"># <?php echo e($review->book->title); ?></div>
                            </div>

                            <div class="mb-3">                                
                                <label for="review" class="form-label">Review</label>
                                <textarea name="review" id="review" rows="5" placeholder="Review" class="form-control <?php $__errorArgs = ['review'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('review', $review->review)); ?></textarea>
                                <?php $__errorArgs = ['review'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1" <?php echo e(old('rating', $review->rating) == 1 ? 'selected' : ''); ?>>1</option>
                                    <option value="2" <?php echo e(old('rating', $review->rating) == 2 ? 'selected' : ''); ?>>2</option>
                                    <option value="3" <?php echo e(old('rating', $review->rating) == 3 ? 'selected' : ''); ?>>3</option>
                                    <option value="4" <?php echo e(old('rating', $review->rating) == 4 ? 'selected' : ''); ?>>4</option>
                                    <option value="5" <?php echo e(old('rating', $review->rating) == 5 ? 'selected' : ''); ?>>5</option>
                                </select>
                            </div> 
                             
                            <button class="btn btn-primary mt-2">Update</button>                     
                        </div>
                    </form>
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11\BookReviewApp\resources\views/account/user-review/edit.blade.php ENDPATH**/ ?>