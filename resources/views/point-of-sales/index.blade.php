<x-app-layout>

  @section('content')
    <div class="mx-auto max-w-270">
      <!-- Breadcrumb Start -->
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
          Open Cashier
        </h2>
        <nav>
          <ol class="flex items-center gap-2">
            <li class="font-medium text-primary">Open Cashier</li>
          </ol>
        </nav>
      </div>
      <!-- Breadcrumb End -->
      <!-- ====== Settings Section Start -->
      <div class="grid grid-cols-5 gap-8">
        <div class="col-span-5 xl:col-span-5">
          <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-7">
              <form action="{{ route('pos-session.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-5.5">
                  <div class="w-full">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="code">User</label>
                    <div class="relative">
                      <span class="absolute left-4.5 top-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M12 10a4 4 0 1 0 0-8a4 4 0 0 0 0 8m-4 2.25a4.124 4.124 0 0 0-4.095 3.642l-.65 5.52a.75.75 0 0 0 1.49.176l.65-5.52a2.624 2.624 0 0 1 1.855-2.209v4.193c0 .899 0 1.648.08 2.242c.084.628.27 1.195.726 1.65c.455.456 1.022.642 1.65.726c.594.08 1.344.08 2.242.08h.104c.899 0 1.648 0 2.243-.08c.627-.084 1.194-.27 1.65-.726c.455-.455.64-1.022.725-1.65c.08-.594.08-1.343.08-2.242v-4.193a2.624 2.624 0 0 1 1.856 2.208l.65 5.52a.75.75 0 1 0 1.489-.175l-.65-5.52A4.124 4.124 0 0 0 16 12.25z" />
                        </svg>
                      </span>
                      <input
                        class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                        type="text" name="code" id="code" value="{{ auth()->user()->name }}" disabled />
                      <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                    </div>
                  </div>
                </div>
                <div class="mb-5.5">
                  <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="price">Initial
                    Cash</label>
                  <div class="relative">
                    <span class="absolute left-4.5 top-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M2 5h20v15H2zm18 13V7H4v11zM17 8a2 2 0 0 0 2 2v5a2 2 0 0 0-2 2H7a2 2 0 0 0-2-2v-5a2 2 0 0 0 2-2zm0 5v-1c0-1.1-.67-2-1.5-2s-1.5.9-1.5 2v1c0 1.1.67 2 1.5 2s1.5-.9 1.5-2m-1.5-2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5M13 13v-1c0-1.1-.67-2-1.5-2s-1.5.9-1.5 2v1c0 1.1.67 2 1.5 2s1.5-.9 1.5-2m-1.5-2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5M8 15h1v-5H8l-1 .5v1l1-.5z" />
                      </svg>
                    </span>
                    <input
                      class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                      type="number" name="initial_cash" id="initial_cash" value="{{ @old('initial_cash') }}" />
                  </div>
                  @error('initial_cash')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="flex justify-end gap-4.5">
                  <button
                    class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                    type="submit">
                    Open Cashier
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- ====== Settings Section End -->
    </div>
  @endsection

</x-app-layout>
