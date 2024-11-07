<?php $__env->startSection('content'); ?>
<div id="auth" class="container-fluid h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-6 col-12">
            <div id="auth-left" data-aos="fade-up">
                <div id="welcome" class="auth-step">
                    <h1 class="h1 display-5 fw-bold mb-5">Hello, Master</h1>
                    <p class="fs-5">
                        This is the initial setup of your application. During this process, 
                        we will configure your database and prepare everything for you to get started.
                    </p>
                    <p class="fs-5">
                        First, we will ensure your database schema is up to date by running migrations. 
                        Migrations are used to create the necessary tables and structures in your database.
                    </p>
                    <p class="fs-5">
                        Then, we will seed the database with some initial data to help you get started. 
                        Seeding is the process of populating the database with sample data.
                    </p>
                    <div class="row">
                        <div class="text-end">
                            <button id="next-to-migrations" class="btn px-4 btn-primary">Next</button>
                        </div>
                    </div>
                </div>

                <div id="migrations" class="auth-step d-none" data-aos="fade-up">
                    <h1 class="h1 display-5 fw-bold mb-5">Database Migrations</h1>
                    <p class="fs-5">
                        We are about to run the database migrations to set up the necessary tables 
                        and structure for your application. This process will create all the tables required 
                        for your application to function properly.
                    </p>
                    <p class="fs-5">
                        Please be patient as this might take a few moments. Once the migrations are complete, 
                        you will be able to proceed to the next step.
                    </p>
                    <div class="row">
                        <div class="text-end">
                            <button id="run-migrations" class="btn btn-primary">Run Migrations</button>
                        </div>
                    </div>
                </div>

                <div id="seeding" class="auth-step d-none" data-aos="fade-up">
                    <h1 class="h1 display-5 fw-bold mb-5">Database Seeding</h1>
                    <p class="fs-5">
                        Now we will seed the database with some initial data to help you get started. 
                        This step is crucial as it provides sample data that you can use to test your application.
                    </p>
                    <p class="fs-5">
                        Seeding the database will populate the tables with default values and ensure that 
                        your application is ready for use immediately. Please wait while we complete this step.
                    </p>
                    <div class="row">
                        <div class="text-end">
                            <button id="run-seeder" class="btn btn-primary">Run Seeder</button>
                        </div>
                    </div>
                </div>

                <div id="redirecting" class="auth-step d-none" data-aos="fade-up">
                    <h1 class="h1 display-5 fw-bold mb-5">Setup Complete</h1>
                    <p class="fs-5">
                        Your application setup is complete. Click the button below to go to the homepage.
                    </p>
                    <p class="fs-5">
                        Thank you for your patience. Your application is now ready to use, and you can start 
                        exploring its features immediately. We hope you have a great experience!
                    </p>
                    <div class="row">
                        <div class="text-end">
                            <button id="go-now" class="btn btn-primary">Go Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="d-none position-fixed w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); z-index: 1050;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init();

            document.getElementById('next-to-migrations').addEventListener('click', function() {
                showStep('migrations');
            });

            document.getElementById('run-migrations').addEventListener('click', function() {
                showLoading();
                fetch('<?php echo e(route('initial.setup.migrate')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                }).then(response => response.json())
                  .then(data => {
                      hideLoading();
                      if (data.success) {
                          Swal.fire({
                              toast: true,
                              position: 'top-end',
                              icon: 'success',
                              title: 'Migrations completed successfully!',
                              showConfirmButton: false,
                              timer: 3000
                          });
                          showStep('seeding');
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Migration Failed!',
                              text: data.message
                          });
                      }
                  }).catch(error => {
                      hideLoading();
                      Swal.fire({
                          icon: 'error',
                          title: 'Error!',
                          text: 'An error occurred while running migrations.'
                      });
                  });
            });

            document.getElementById('run-seeder').addEventListener('click', function() {
                showLoading();
                fetch('<?php echo e(route('initial.setup.seed')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                }).then(response => response.json())
                  .then(data => {
                      hideLoading();
                      if (data.success) {
                          Swal.fire({
                              toast: true,
                              position: 'top-end',
                              icon: 'success',
                              title: 'Seeding completed successfully!',
                              showConfirmButton: false,
                              timer: 3000
                          });
                          showStep('redirecting');
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Seeding Failed!',
                              text: data.message
                          });
                      }
                  }).catch(error => {
                      hideLoading();
                      Swal.fire({
                          icon: 'error',
                          title: 'Error!',
                          text: 'An error occurred while running the seeder.'
                      });
                  });
            });

            document.getElementById('go-now').addEventListener('click', function() {
                window.location.href = '<?php echo e(route('home.index')); ?>';
            });
        });

        function showStep(stepId) {
            document.querySelectorAll('.auth-step').forEach(function(step) {
                step.classList.add('d-none');
            });
            document.getElementById(stepId).classList.remove('d-none');
        }

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('d-none');
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('d-none');
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.initial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\welcome.blade.php ENDPATH**/ ?>