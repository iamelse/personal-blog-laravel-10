<!DOCTYPE html>
<html lang="en">

   @include('partials.head')

   <body>
      <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
      <div id="app">
        
        @include('partials.sidebar')

         <div id="main" class='layout-navbar navbar-fixed'>
            <header>
               
                @include('partials.navbar')

            </header>
        
            @yield('content')
            
            @include('partials.footer')

         </div>
      </div>

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Notification Counter Script -->
      <script>
         document.addEventListener("DOMContentLoaded", () => {

            function markNotificationAsRead(notificationId, notificationUrl) {
               const url = @json(route('notifications.mark.as.read', ['id' => '__id__'])).replace('__id__', notificationId);

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

                            // Check if no notifications are left
                           const notificationList = document.getElementById('notificationList');
                           if (!notificationList.querySelector('.notification-item')) {
                              const noNotificationMessage = document.createElement('li');
                              noNotificationMessage.classList.add('dropdown-item', 'notification-item');
                              noNotificationMessage.innerHTML = `
                                 <p class="text-center py-1 mb-0 notification-subtitle font-thin text-sm text-gray-500">
                                       You are all set! No new notifications.
                                 </p>`;
                              notificationList.insertBefore(noNotificationMessage, notificationList.querySelector('.dropdown-header').nextSibling);
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
      
      <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
      <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
      <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
      @stack('scripts')
   </body>
</html>