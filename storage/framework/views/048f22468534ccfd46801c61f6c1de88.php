

<?php $__env->startSection('main'); ?>  
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header text-white">
                        Books
                    </div>
                    
                    <?php echo $__env->make('layouts.message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <div class="card-body pb-0">    
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('books.create')); ?>" class="btn btn-primary">Add Book</a>
                            <form action="" method="get">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex"> 
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="<?php echo e(Request::get('keyword')); ?>">
                                    <button type="submit" class="btn btn-primary ms-2">Search</button>

                                    <a href="<?php echo e(route('books.index')); ?>" class="btn btn-secondary ms-2">Clear</a>
                                </div>
                            </form>
                        </div>
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                                <tbody>
                                    <?php if($books->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
                                        
                                        <tr>
                                            <td><?php echo e($book->title); ?></td>
                                            <td><?php echo e($book->author); ?></td>
                                            <td><?php echo e(number_format($avgRating, 1)); ?> (<?php echo e(($ratingCount > 1) ? $ratingCount . ' Reviews' : $ratingCount . ' Review'); ?>)</td>
                                            <td>
                                                <?php if($book->status == 1): ?>
                                                    <span class="text-success">Active</span>
                                                <?php else: ?>
                                                    <span class="text-danger">Block</span>
                                                <?php endif; ?>
                                            </td>
                                            
                                            <td class="actionBtn">
                                                <a href="<?php echo e(route('books.show', $book->id)); ?>" class="btn btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>

                                                <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                                </a>  
                                                
                                                <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?> 
                                </tbody>
                            </thead>
                        </table>   
                        <?php if($books->isNotEmpty()): ?>
                        <?php echo e($books->links()); ?>      
                        <?php endif; ?>                        
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PHP Development\Projects\Laravel 11 Projects\Book-Review-App-In-Laravel-11\resources\views/account/books/list.blade.php ENDPATH**/ ?>