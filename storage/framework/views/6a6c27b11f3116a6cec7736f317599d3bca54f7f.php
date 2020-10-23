<?php $attributes = $attributes->exceptProps(['disabled' => false]); ?>
<?php foreach (array_filter((['disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<input <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'form-input rounded-md shadow-sm']); ?>>
<?php /**PATH D:\xampp\htdocs\laravel-govcongiants\vendor\laravel\jetstream\src/../resources/views/components/input.blade.php ENDPATH**/ ?>