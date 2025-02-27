@extends('layouts.auth')

@section('content')
<!-- ===== Page Wrapper Start ===== -->
<div class="relative z-1 flex h-screen w-full overflow-hidden bg-white px-4 py-6 dark:bg-gray-900 sm:p-0">
   <div class="flex flex-1 flex-col rounded-2xl p-6 sm:rounded-none sm:border-0 sm:p-8">
      <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
         <div>
            <div class="mb-5 sm:mb-8">
               <h1 class="mb-2 text-title-sm font-semibold text-gray-800 dark:text-white/90 sm:text-title-md">
                  Sign In
               </h1>
               <p class="text-sm text-gray-500 dark:text-gray-400">
                  Enter your username and password to sign in!
               </p>
            </div>
            <div>
               <form action="{{ route('auth.login') }}" method="POST">
                  @csrf
                  <div class="space-y-5">
                     <!-- Identity -->
                     <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Username <span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ hasError: {{ session('errors') && session('errors')->has('identity') ? 'true' : 'false' }} }">
                           <input
                              type="text"
                              id="identity"
                              name="identity"
                              value="{{ old('identity') }}"
                              placeholder="Username or Email"
                              :class="hasError ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-700 focus:border-brand-300 dark:focus:border-brand-800'"
                              class="dark:bg-dark-900 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:ring focus:ring-brand-500/10 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                              />
                              <!-- Error Message -->
                              <span class="text-xs mt-1 font-medium text-red-500 dark:text-red-500" x-show="hasError">
                                 @error('identity') * {{ $message }} @enderror
                             </span>                            
                        </div>
                     </div>
                     <!-- Password -->
                     <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                           Password <span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ showPassword: false, hasError: {{ session('errors') && session('errors')->has('password') ? 'true' : 'false' }} }" class="relative">
                           <input
                              :type="showPassword ? 'text' : 'password'"
                              id="password"
                              name="password"
                              placeholder="Enter your password"
                              :class="hasError ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-700 focus:border-brand-300 dark:focus:border-brand-800'"
                              class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                           />
                           <span
                              @click="showPassword = !showPassword"
                              class="absolute right-4 top-1/2 z-30 -translate-y-1/2 cursor-pointer text-gray-500 dark:text-gray-400"
                           >
                              <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                           </span>
                           <!-- Error Message -->
                           <span class="absolute text-xs font-medium text-red-500 dark:text-red-500 mt-1 left-0 min-h-[20px]" x-show="hasError">
                              @error('password') * {{ $message }} @enderror
                           </span>
                        </div>
                     </div>
                     <!-- Checkbox -->
                     <div class="flex items-center justify-between">
                        <div x-data="{ checkboxToggle: false, hasError: {{ session('errors') && session('errors')->has('password') ? 'true' : 'false' }} }" :class="hasError ? 'pt-5' : 'pt-0' ">
                           <label for="checkboxLabelOne" class="flex cursor-pointer select-none items-center text-sm font-normal text-gray-700 dark:text-gray-400">
                              <div class="relative">
                                 <input
                                    type="checkbox"
                                    id="checkboxLabelOne"
                                    class="sr-only"
                                    @change="checkboxToggle = !checkboxToggle"
                                    />
                                 <div
                                    :class="checkboxToggle ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'"
                                    class="mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]"
                                    >
                                    <span :class="checkboxToggle ? '' : 'opacity-0'">
                                       <svg
                                          width="14"
                                          height="14"
                                          viewBox="0 0 14 14"
                                          fill="none"
                                          xmlns="http://www.w3.org/2000/svg"
                                          >
                                          <path
                                             d="M11.6666 3.5L5.24992 9.91667L2.33325 7"
                                             stroke="white"
                                             stroke-width="1.94437"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             />
                                       </svg>
                                    </span>
                                 </div>
                              </div>
                              Keep me logged in
                           </label>
                        </div>
                        <a
                           href="/reset-password.html"
                           class="text-sm text-brand-500 hover:text-brand-600 dark:text-brand-400"
                           >Forgot password?</a
                           >
                     </div>
                     <!-- Button -->
                     <div>
                        <button
                           type="submit"
                           class="flex w-full items-center justify-center rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600"
                           >
                        Sign In
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div
      class="relative z-1 hidden flex-1 items-center justify-center bg-brand-950 p-8 dark:bg-white/5 lg:flex"
      >
      <!-- ===== Common Grid Shape Start ===== -->
      <include src="./partials/common-grid-shape.html"></include>
      <!-- ===== Common Grid Shape End ===== -->
      <div class="flex max-w-xs flex-col items-center">
         <a href="index.html" class="mb-4 block">
         <img src="{{ asset('tailadmin/images/logo/auth-logo.svg') }}" alt="Logo" />
         </a>
         <p class="text-center text-gray-400 dark:text-white/60">
            Free and Open-Source Tailwind CSS Admin Dashboard Template
         </p>
      </div>
   </div>
</div>
<!-- ===== Page Wrapper End ===== -->
@endsection