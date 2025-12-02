

<?php $__env->startSection('main'); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="col-md-9">
                <?php echo $__env->make('layouts.message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Reviews
                    </div>
                    <div class="card-body pb-0"> 
                        <div class="d-flex justify-content-end">                            
                            <form action="" method="get">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex"> 
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="<?php echo e(Request::get('keyword')); ?>">
                                    <button type="submit" class="btn btn-primary ms-2">Search</button>

                                    <a href="<?php echo e(route('reviews.index')); ?>" class="btn btn-secondary ms-2">Clear</a>
                                </div>
                            </form>
                        </div>

                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Review</th>
                                    <th>Book</th>                                    
                                    <th>Rating</th>
                                    <th>Create At</th>
                                    <th>User</th>  
                                    <th>Status</th>                                  
                                    <th width="100">Action</th>
                                </tr>
                                <tbody>
                                    <?php if($reviews->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(Str::limit($review->review, 50)); ?></td>              
                                            <td><?php echo e($review->book->title); ?></td>                                            
                                            <td><i class="fa-regular fa-star"></i> <?php echo e($review->rating); ?></td>
                                            <td><?php echo e($review->created_at->format('d M, Y')); ?></td>
                                            <td><?php echo e($review->user->name); ?></td>
                                            <td>
                                                <?php if($review->status == 1): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Block</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('reviews.edit', $review->id)); ?>" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No reviews found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </thead>
                        </table> 
                        
                        <?php if($reviews->isNotEmpty()): ?>
                        <?php echo e($reviews->links()); ?>      
                        <?php endif; ?>  
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11\BookReviewApp\resources\views/account/reviews/list.blade.php ENDPATH**/ ?>