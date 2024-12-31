<!DOCTYPE html>
<html lang="en">

   <?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <body>
      <script src="<?php echo e(asset('assets/static/js/initTheme.js')); ?>"></script>
      <div id="app">
        
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         <div id="main" class='layout-navbar navbar-fixed'>
            <header>
               
                <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </header>
        
            <?php echo $__env->yieldContent('content'); ?>
            
            <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         </div>
      </div>

      <!-- CSRF Token -->
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

      <!-- Notification Counter Script -->
      <script>
         document.addEventListener("DOMContentLoaded", () => {

            function markNotificationAsRead(notificationId, notificationUrl) {
               const url = <?php echo json_encode(route('notifications.mark.as.read', ['id' => '__id__']), 512) ?>.replace('__id__', notificationId);

               fetch(url, {
                        method: 'POST',
                        headers: {
                           'Content-Type': 'application/json',
                           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                  })
                  .then(response => response.json())
                  .then(data => {
                        if (data.success) {
                           const counter = document.getElementById('notificationCounter');
                           const notificationItem = document.getElementById(`notification-${notificationId}`);
                           let count = parseInt(counter.textContent) || 0;

                           // Update counter
                           if (count > 0) {
                              counter.textContent = count - 1;
                              if (count - 1 === 0) {
                                    counter.style.display = 'none';
                              }
                           }

                           // Remove notification item
                           if (notificationItem) {
                              notificationItem.remove();
                           }

                           // Debug: Check the URL before redirecting
                           console.log('Redirecting to URL:', notificationUrl);

                           // Open the URL in a new tab
                           if (notificationUrl && notificationUrl !== '#') {
                              window.open(notificationUrl, '_blank'); // Open in a new tab
                           } else {
                              console.error('Notification URL is invalid');
                           }
                        }
                  })
                  .catch(error => console.error('Error marking notification as read:', error));
            }

            // Attach event listeners to notification items
            document.querySelectorAll('.notification-item').forEach(item => {
               item.addEventListener('click', (event) => {
                  event.preventDefault();
                  const notificationId = item.dataset.id; // Get notification ID from data-id attribute
                  const notificationUrl = item.dataset.url; // Get the URL from the data-url attribute
                  console.log('Notification clicked with ID:', notificationId); // Debugging line
                  markNotificationAsRead(notificationId, notificationUrl); // Pass the URL to the function
               });
            });
         });
      </script>
      
      <script src="<?php echo e(asset('assets/static/js/components/dark.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/compiled/js/app.js')); ?>"></script>
      <?php echo $__env->yieldPushContent('scripts'); ?>
   </body>
</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/template/main.blade.php ENDPATH**/ ?>