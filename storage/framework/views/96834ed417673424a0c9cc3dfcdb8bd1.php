<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['item', 'isActive']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['item', 'isActive']); ?>
<?php foreach (array_filter((['item', 'isActive']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<li class="sidebar-item<?php echo e($isActive ? ' active' : ''); ?>">
    <a href="<?php echo e(route($item['route'])); ?>" class='sidebar-link' target="<?php echo e($item['new_tab'] ? '_blank' : '_self'); ?>">
        <i class="<?php echo e($item['icon']); ?>"></i>
        <span><?php echo e($item['label']); ?></span>
    </a>
</li><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/components/sidebar-item.blade.php ENDPATH**/ ?>