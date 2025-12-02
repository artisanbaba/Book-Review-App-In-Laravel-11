

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
                        Profile
                    </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="mt-3">Joined</h4>
                        <p class="text-muted">
                            Member since: <?php echo e($user->created_at->format('d M, Y')); ?>

                        </p>
                    </div>

                    <hr>

                    <div class="row justify-content-center">                             
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold ">Email</label>
                            <p class="text-muted"><?php echo e($user->email); ?></p>
                        </div> 
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold">Total Reviews</label>
                            <p class="text-muted"><?php echo e($user->reviews->count()); ?></p>
                        </div> 
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold">Joined</label>
                            <p class="text-muted"><?php echo e($user->created_at->format('d M, Y')); ?></p>
                        </div> 
                    </div>

                    <div class="mt-3 text-end">
                        <a href="<?php echo e(route('account.editProfile', Auth::user()->id)); ?>" class="btn btn-primary btn-sm">Edit Profile</a>
                    </div>

                </div>
                </div>                
            </div>
        </div>       
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11\BookReviewApp\resources\views/account/user/profile.blade.php ENDPATH**/ ?>