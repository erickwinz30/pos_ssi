<x-app-layout>

  @section('content')
    <div class="mx-auto max-w-270">
      <!-- Breadcrumb Start -->
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
          Detail Product
        </h2>
        <nav>
          <ol class="flex items-center gap-2">
            <li class="font-medium text-primary">Detail Product
            </li>
          </ol>
        </nav>
      </div>
      <!-- Breadcrumb End -->
      <!-- ====== Settings Section Start -->
      <div
        class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <h3 class="font-medium text-black dark:text-white">
          Detail New Product
        </h3>
        <div class="max-w-full overflow-x-auto">
          <div class="p-7">
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="code">Code</label>
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
                  <div
                    class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="text" name="code" id="code" value="{{ @old('code') }}">{{ $product->code }}</div>
                </div>
              </div>
            </div>
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="name">Name</label>
                <div class="relative">
                  <span class="absolute left-4.5 top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
                      <path fill="currentColor"
                        d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2m-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z" />
                    </svg>
                  </span>
                  <div
                    class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="text" name="name" id="name" value="{{ @old('name') }}">{{ $product->name }}</div>
                </div>
              </div>
            </div>
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="price">Price</label>
                <div class="relative">
                  <span class="absolute left-4.5 top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <path
                          d="M3 20.4V3.6a.6.6 0 0 1 .6-.6h16.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H3.6a.6.6 0 0 1-.6-.6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 8.5c-.685-.685-1.891-1.161-3-1.191M9 15c.644.86 1.843 1.35 3 1.391m0-9.082c-1.32-.036-2.5.561-2.5 2.191c0 3 5.5 1.5 5.5 4.5c0 1.711-1.464 2.446-3 2.391m0-9.082V5.5m0 10.891V18.5" />
                      </g>
                    </svg>
                  </span>
                  <div
                    class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="number" name="price" id="price" value="{{ @old('price') }}">Rp
                    {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
              </div>
            </div>
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="is_having_stock">Stock
                  Status</label>
                <div class="relative">
                  <span class="absolute left-4.5 top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <g fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.636 5.636a1 1 0 0 0-1.414-1.414c-4.296 4.296-4.296 11.26 0 15.556a1 1 0 0 0 1.414-1.414a9 9 0 0 1 0-12.728zm14.142-1.414a1 1 0 1 0-1.414 1.414a9 9 0 0 1 0 12.728a1 1 0 1 0 1.414 1.414c4.296-4.296 4.296-11.26 0-15.556zM8.464 8.464A1 1 0 0 0 7.05 7.05a7 7 0 0 0 0 9.9a1 1 0 1 0 1.414-1.414a5 5 0 0 1 0-7.072zM16.95 7.05a1 1 0 1 0-1.414 1.414a5 5 0 0 1 0 7.072a1 1 0 0 0 1.414 1.414a7 7 0 0 0 0-9.9zM9 12a3 3 0 1 1 6 0a3 3 0 0 1-6 0z"
                          fill="currentColor" />
                      </g>
                    </svg>
                  </span>
                  {{-- <input
                      class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                      type="number" name="is_having_stock" id="is_having_stock" value="{{ @old('is_having_stock') }}" /> --}}
                  <div
                    class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="number" name="is_have_stock" id="is_have_stock" value="{{ @old('is_have_stock') }}">
                    @if ($product->is_have_stock == 1)
                      Stock Available
                    @else
                      Stock Unavailable
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="stock">Stock</label>
                <div class="relative">
                  <span class="absolute left-4.5 top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M5 22q-.825 0-1.412-.587T3 20V8.725q-.45-.275-.725-.712T2 7V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v3q0 .575-.275 1.013T21 8.724V20q0 .825-.587 1.413T19 22zM5 9v11h14V9zM4 7h16V4H4zm5 7h6v-2H9zm3 .5" />
                    </svg>
                  </span>
                  <div
                    class="w-full rounded border border-stroke py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="number" name="stock" id="stock" value="{{ @old('stock') }}">{{ $product->stock }}
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-5.5">
              <div class="w-full">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="picture">Picture</label>
                <div class="relative">

                  <div
                    class="w-full rounded border border-stroke py-3 pl-11 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    type="file" name="picture" id="picture"><img
                      src="{{ $product->getFirstMediaUrl('product-img') }}" alt=""></div>
                </div>
              </div>
            </div>
            <div class="flex justify-end gap-4.5">
              <button
                class="flex justify-center rounded border border-stroke px-6 py-2 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
                type="button" onclick="location.href='{{ route('products.index') }}'">
                Kembali
              </button>
              {{-- <button class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                type="submit">
                Save
              </button> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- ====== Settings Section End -->
      <div
        class="rounded-sm border border-stroke bg-white mt-4 px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
          <table class="w-full table-auto">
            <thead>
              <tr class="bg-gray-2 text-left dark:bg-meta-4">
                <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                  Description
                </th>
                <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                  Moving Qty
                </th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                  Moving Price
                </th>
                <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                  Updated At
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($stockLog as $log)
                <tr>
                  <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                    <h5 class="font-medium text-black dark:text-white">{{ $log->description }}</h5>
                  </td>
                  <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                    <p class="text-black dark:text-white">{{ $log->moving_stock }}</p>
                  </td>
                  <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                    <p class="text-black dark:text-white">Rp. {{ number_format($log->moving_price, 0, ',', '.') }}</p>
                  </td>
                  <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                    <p
                      class="inline-flex rounded-full bg-success bg-opacity-10 px-3 py-1 text-sm font-medium text-success">
                      {{ $product->created_at->format('d-M-Y') }}
                    </p>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!-- ====== Settings Section End -->
        </div>
      </div>
    </div>
  @endsection

</x-app-layout>
