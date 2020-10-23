<?php echo e($data->links()); ?>

        
<div class="divide-y divide-gray-400">
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="text-left py-2">
        <a class="text-blue-700 font-black text-2xl text-opacity-100 hover:text-orange-700" href="<?php echo e($element->link); ?>"><?php echo e($element->title); ?></a>
            <p class="py-5"><?php echo e($element->description); ?></p>
            <div class="pb-3">
                <p class="font-bold">Notice ID</p>
                <p><?php echo e($element->notice_id); ?></p>
            </div>
            <div>
                <p class="font-bold">Department/Ind.Agency</p>
                <p class="text-blue-700"><?php echo e($element->department); ?></p>
            </div>
            <div>
                <p class="font-bold">Sub-tier</p>
                <p class="text-blue-700"><?php echo e($element->sub_tier); ?></p>
            </div>
            <div class="pb-3">
                <p class="font-bold">Office</p>
                <p><?php echo e($element->office); ?></p>
            </div>
            <p><span class="font-bold">Current Response Date: </span><?php echo e($element->response_deadline); ?></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($data->links()); ?>

<?php /**PATH D:\xampp\htdocs\laravel-govcongiants\resources\views/data/result.blade.php ENDPATH**/ ?>