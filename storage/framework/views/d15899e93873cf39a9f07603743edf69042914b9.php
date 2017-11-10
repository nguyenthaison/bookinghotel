<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startSection('head-scripts'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="jumbotron">
        <h1>Thanks a lot!</h1> 
        <h2>Please check your email for contract.</h2>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partial.layout-contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>