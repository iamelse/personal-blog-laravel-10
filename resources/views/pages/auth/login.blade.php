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
                <form>
                   <div class="space-y-5">
                      <!-- Email -->
                      <div>
                         <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Username <span class="text-error-500">*</span>
                         </label>
                         <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Username or Email"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                      </div>
                      <!-- Password -->
                      <div>
                         <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Password<span class="text-error-500">*</span>
                         </label>
                         <div x-data="{ showPassword: false }" class="relative">
                            <input
                               :type="showPassword ? 'text' : 'password'"
                               placeholder="Enter your password"
                               class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                               />
                            <span
                               @click="showPassword = !showPassword"
                               class="absolute right-4 top-1/2 z-30 -translate-y-1/2 cursor-pointer text-gray-500 dark:text-gray-400"
                               >
                               <svg
                                  x-show="!showPassword"
                                  class="fill-current"
                                  width="20"
                                  height="20"
                                  viewBox="0 0 20 20"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                  >
                                  <path
                                     fill-rule="evenodd"
                                     clip-rule="evenodd"
                                     d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"
                                     fill="#98A2B3"
                                     />
                               </svg>
                               <svg
                                  x-show="showPassword"
                                  class="fill-current"
                                  width="20"
                                  height="20"
                                  viewBox="0 0 20 20"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                  >
                                  <path
                                     fill-rule="evenodd"
                                     clip-rule="evenodd"
                                     d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"
                                     fill="#98A2B3"
                                     />
                               </svg>
                            </span>
                         </div>
                      </div>
                      <!-- Checkbox -->
                      <div class="flex items-center justify-between">
                         <div x-data="{ checkboxToggle: false }">
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