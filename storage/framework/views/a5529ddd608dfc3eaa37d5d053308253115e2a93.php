<script src="<?php echo e(asset('vendor/backpack/pnotify/pnotify.custom.min.js')); ?>"></script>


<script type="text/javascript">
  jQuery(document).ready(function($) {

    PNotify.prototype.options.styling = "bootstrap3";
    PNotify.prototype.options.styling = "fontawesome";

    <?php $__currentLoopData = Alert::getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            $(function(){
              new PNotify({
                // title: 'Regular Notice',
                text: "<?php echo e($message); ?>",
                type: "<?php echo e($type); ?>",
                icon: false
              });
            });

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  });
</script>