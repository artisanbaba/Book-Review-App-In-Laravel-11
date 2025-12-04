<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"> <!-- CSRF token for AJAX -->
        <!-- CSRF Meta Tag --> 
        <title>Book Review App</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css"> 

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    </head>
    <body class="bg-light">
        <div class="container-fluid shadow-lg header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h1 class="text-center"><a href="<?php echo e(route('home')); ?>" class="h3 text-white text-decoration-none">Book Review App</a></h1>
                    <div class="d-flex align-items-center navigation">
                        <?php if(Auth::check()): ?>
                            <a href="<?php echo e(route('account.showProfile')); ?>" class="text-white">Account</a> 
                        <?php else: ?>
                            <a href="<?php echo e(route('account.showLogin')); ?>" class="text-white">Login</a>&emsp;<span class="text-white">|</span>&emsp;
                            <a href="<?php echo e(route('account.showRegister')); ?>" class="text-white ps-2">Register</a> 
                        <?php endif; ?> 
                    </div>
                </div>  
            </div>
        </div> 

        <?php echo $__env->yieldContent('main'); ?>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
        <?php echo $__env->yieldPushContent('scripts'); ?>      
       
    </body>
</html><?php /**PATH E:\PHP Development\Projects\Laravel 11 Projects\Book-Review-App-In-Laravel-11\resources\views/layouts/app.blade.php ENDPATH**/ ?>