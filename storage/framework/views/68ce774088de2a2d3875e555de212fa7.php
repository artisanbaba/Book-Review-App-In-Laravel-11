<div class="card border-0 shadow-lg">
    <div class="card-header  text-white">
        Welcome, <?php echo e(Auth::user()->name); ?>                        
    </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <?php if(Auth::user()->image): ?>
                <img src="<?php echo e(asset('uploads/profile/' . Auth::user()->image)); ?>"
                    class="rounded-circle img-fluid"
                    style="width: 120px; height: 120px; object-fit: cover;">
            <?php endif; ?>
        </div>
        <div class="h5 text-center">
            <strong><?php echo e(Auth::user()->name); ?></strong>
            <p class="h6 mt-2 text-muted"><?php echo e((Auth::user()->reviews->count() > 1) ? Auth::user()->reviews->count() . ' Reviews' : Auth::user()->reviews->count() . ' Review'); ?></p>
        </div>
    </div>
</div>
<div class="card border-0 shadow-lg mt-3">
    <div class="card-header  text-white">
        Navigation
    </div>
    <div class="card-body sidebar">
        <ul class="nav flex-column">
            <?php if(Auth::user()->role == 'admin'): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('books.index')); ?>">Books</a>                               
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('reviews.index')); ?>">Reviews</a>                               
                </li>
            <?php endif; ?>    
            <li class="nav-item">
                <a href="<?php echo e(route('account.showProfile')); ?>">Profile</a>                               
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('user-reviews.index')); ?>">My Reviews</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('account.changePassword')); ?>">Change Password</a>
            </li> 
            <li class="nav-item">
                <a href="<?php echo e(route('account.logout')); ?>">Logout</a>
            </li>                           
        </ul>
    </div>
</div><?php /**PATH E:\PHP Development\Projects\Laravel 11\BookReviewApp\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>