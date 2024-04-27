<x-app-layout>

  @section('content')
    <div class="mx-auto max-w-270">
      <!-- Breadcrumb Start -->
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
          Create User
        </h2>
        <nav>
          <ol class="flex items-center gap-2">
            <li class="font-medium text-primary">Create User
            </li>
          </ol>
        </nav>
      </div>
      <!-- Breadcrumb End -->
      <!-- ====== Settings Section Start -->
      <div
        class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <h3 class="font-medium text-black dark:text-white">
          Create New User
        </h3>
        <div class="max-w-full overflow-x-auto">
          <div class="p-7">
            <form action="{{ route('users.store') }}" method="POST">
              @csrf
              <div class="mb-5.5">
                <div class="w-full">
                  <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="name">Name</label>
                  <div class="relative">
                    <span class="absolute left-4.5 top-4">
                      <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.8">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.72039 12.887C4.50179 12.1056 5.5616 11.6666 6.66667 11.6666H13.3333C14.4384 11.6666 15.4982 12.1056 16.2796 12.887C17.061 13.6684 17.5 14.7282 17.5 15.8333V17.5C17.5 17.9602 17.1269 18.3333 16.6667 18.3333C16.2064 18.3333 15.8333 17.9602 15.8333 17.5V15.8333C15.8333 15.1703 15.5699 14.5344 15.1011 14.0655C14.6323 13.5967 13.9964 13.3333 13.3333 13.3333H6.66667C6.00363 13.3333 5.36774 13.5967 4.8989 14.0655C4.43006 14.5344 4.16667 15.1703 4.16667 15.8333V17.5C4.16667 17.9602 3.79357 18.3333 3.33333 18.3333C2.8731 18.3333 2.5 17.9602 2.5 17.5V15.8333C2.5 14.7282 2.93899 13.6684 3.72039 12.887Z"
                            fill="" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.99967 3.33329C8.61896 3.33329 7.49967 4.45258 7.49967 5.83329C7.49967 7.214 8.61896 8.33329 9.99967 8.33329C11.3804 8.33329 12.4997 7.214 12.4997 5.83329C12.4997 4.45258 11.3804 3.33329 9.99967 3.33329ZM5.83301 5.83329C5.83301 3.53211 7.69849 1.66663 9.99967 1.66663C12.3009 1.66663 14.1663 3.53211 14.1663 5.83329C14.1663 8.13448 12.3009 9.99996 9.99967 9.99996C7.69849 9.99996 5.83301 8.13448 5.83301 5.83329Z"
                            fill="" />
                        </g>
                      </svg>
                    </span>
                    <input
                      class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                      type="text" name="name" id="name" value="{{ @old('name') }}" />
                  </div>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="mb-5.5">
                <div class="w-full">
                  <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="email">Email</label>
                  <div class="relative">
                    <span class="absolute left-4.5 top-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
                        <path fill="currentColor"
                          d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2m-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z" />
                      </svg>
                    </span>
                    <input
                      class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                      type="text" name="email" id="email" value="{{ @old('email') }}" />
                  </div>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="mb-5.5">
                <div class="w-full">
                  <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="password">Password</label>
                  <div class="relative">
                    <span class="absolute left-4.5 top-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                          d="M12 10v4m-1.732-3l3.464 2m0-2l-3.465 2m-3.535-3v4M5 11l3.464 2m0-2L5 13m12.268-3v4m-1.732-3L19 13m0-2l-3.465 2M22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12c0-3.771 0-5.657 1.172-6.828C4.343 4 6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172c.654.653.943 1.528 1.07 2.828" />
                      </svg>
                    </span>
                    <input
                      class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                      type="password" name="password" id="password" value="{{ @old('password') }}" />
                  </div>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="flex justify-end gap-4.5">
                <button
                  class="flex justify-center rounded border border-stroke px-6 py-2 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
                  type="button" onclick="location.href='{{ route('users.index') }}'">
                  Cancel
                </button>
                <button class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                  type="submit">
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- ====== Settings Section End -->
    </div>
  @endsection

</x-app-layout>
