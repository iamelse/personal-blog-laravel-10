<ul class="nav nav-pills flex-column">
  <?php $__currentLoopData = $root_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $root_folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item">
      <a class="nav-link" href="#" data-type="0" onclick="moveToNewFolder(`<?php echo e($root_folder->url); ?>`)">
        <i class="fa fa-folder fa-fw"></i> <?php echo e($root_folder->name); ?>

        <input type="hidden" id="goToFolder" name="goToFolder" value="<?php echo e($root_folder->url); ?>">
        <div id="items">
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" id="<?php echo e($i); ?>" name="items[]" value="<?php echo e($i); ?>">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </a>
    </li>
    <?php $__currentLoopData = $root_folder->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $directory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item sub-item">
      <a class="nav-link" href="#" data-type="0" onclick="moveToNewFolder(`<?php echo e($directory->url); ?>`)">
        <i class="fa fa-folder fa-fw"></i> <?php echo e($directory->name); ?>

        <input type="hidden" id="goToFolder" name="goToFolder" value="<?php echo e($directory->url); ?>">
        <div id="items">
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" id="<?php echo e($i); ?>" name="items[]" value="<?php echo e($i); ?>">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<script>
  function moveToNewFolder($folder) {
    $("#notify").modal('hide');
    var items =[];
    $("#items").find("input").each(function() {items.push(this.id)});
    performLfmRequest('domove', {
      items: items,
      goToFolder: $folder
    }).done(refreshFoldersAndItems);
  }
</script>
<?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\vendor\unisharp\laravel-filemanager\src\views\move.blade.php ENDPATH**/ ?>