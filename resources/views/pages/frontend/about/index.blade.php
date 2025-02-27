@extends('layouts.frontend.app')

@section('content')
  @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  @endpush

  @push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
          duration: 1000,
          once: true,
        });
      });
    </script>
  @endpush

  <!-- SEO Meta Tags -->
  @section('meta')
    <meta name="description" content="Learn more about Lana Septiana, a Laravel developer passionate about building scalable web applications.">
    <meta name="keywords" content="Laravel, Web Developer, Fullstack Development, PHP, Backend, APIs">
    <meta name="author" content="Lana Septiana">
  @endsection

  <!-- About Section -->
  <section id="about" class="py-16 lg:py-32 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-6xl mx-auto px-6">
      <h1 data-aos="fade-up" class="mt-10 lg:mt-0 text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 dark:text-gray-100">
        Hi, I'm <span class="text-blue-600 dark:text-blue-400">Lana Septiana</span> 🤟
      </h1>

      <div class="mt-10 flex flex-col lg:flex-row items-center gap-10">
        <!-- Bio Content -->
        <article class="w-full lg:w-3/4 text-left">
          <div data-aos="fade-left" class="space-y-3 lg:space-y-4">
            <div>
              <h2 class="text-xl lg:text-3xl font-extrabold text-gray-900 dark:text-gray-100">Short Bio</h2>
              <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300">
                I'm a Laravel web developer with experience in building dynamic and scalable web applications. I specialize in creating high-quality, efficient, and user-friendly solutions using Laravel, focusing on full-stack development.
              </p>
            </div>

            <div>
              <h2 class="text-xl lg:text-3xl font-extrabold text-gray-900 dark:text-gray-100">Career</h2>
              <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300">
                As a Laravel Web Developer, I’ve worked on various projects, including API development, system maintenance, and backend solutions. I focus on building scalable, secure, and efficient applications while sharing Laravel best practices.
              </p>
            </div>

            <div>
              <h2 class="text-xl lg:text-3xl font-extrabold text-gray-900 dark:text-gray-100">About Me</h2>
              <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300">
                I frequently reflect on my journey as a developer, constantly learning and improving. If you're curious about my thoughts and experiences, feel free to explore my archived posts.
              </p>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
@endsection