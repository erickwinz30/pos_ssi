<x-pos-layout>
  <!-- page content -->
  <div class="flex-grow flex">
    <!-- store menu -->
    <div class="flex flex-col bg-blue-gray-50 h-full w-full py-4">
      <div class="flex px-2 flex-row relative">
        <div class="absolute left-5 top-3 px-2 py-2 rounded-full bg-cyan-500 text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <input type="text"
          class="bg-white rounded-3xl shadow text-lg w-full h-16 py-4 pl-16 transition-shadow focus:shadow-2xl focus:outline-none"
          placeholder="Cari menu ..." x-model="keyword" @keyup.enter="searchProducts">
      </div>
      <div class="h-full overflow-hidden mt-4">
        <div class="h-full overflow-y-auto px-2">
          @if (count($products) === 0)
            <div
              class="select-none bg-blue-gray-100 rounded-3xl flex flex-wrap content-center justify-center h-full opacity-25">
              <div class="w-full text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 inline-block" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
                <p class="text-xl">
                  YOU DON'T HAVE
                  <br>
                  ANY PRODUCTS TO SHOW
                </p>
              </div>
            </div>
          @endif
          @if (count($products) === 0)
            <div
              class="select-none bg-blue-gray-100 rounded-3xl flex flex-wrap content-center justify-center h-full opacity-25">
              <div class="w-full text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 inline-block" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-xl">
                  EMPTY SEARCH RESULT
                  <br>
                  ""
                </p>
              </div>
            </div>
          @endif
          <div class="grid grid-cols-4 gap-4 pb-3">
            @foreach ($products as $product)
              <div
                class="select-none cursor-pointer transition-shadow overflow-hidden rounded-2xl bg-white shadow hover:shadow-lg product-item"
                title="{{ $product->name }}" data-product-id="{{ json_encode($product) }}"
                x-on:click="addToCart({{ json_encode($product) }}, '{{ $product->getFirstMediaUrl('product-img') }}')">
                <img src="{{ $product->getFirstMediaUrl('product-img') }}" alt="{{ $product->name }}"
                  style="width: 300px; height: 300px; object-fit: cover;">
                <div class="flex pb-3 px-3 text-sm -mt-3">
                  <p class="flex-grow truncate mr-1">{{ $product->name }}</p>
                  <p class="nowrap font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <!-- end of store menu -->

    <!-- modal receipt -->
    <div x-show="isShowModalReceipt"
      class="fixed w-full h-screen left-0 top-0 z-10 flex flex-wrap justify-center content-center p-24">
      <div x-show="isShowModalReceipt" class="fixed glass w-full h-screen left-0 top-0 z-0"
        x-on:click="closeModalReceipt()" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"></div>
      <div x-show="isShowModalReceipt" class="w-96 rounded-3xl bg-white shadow-xl overflow-hidden z-10"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">
        <div id="receipt-content" class="text-left w-full text-sm p-6 overflow-auto">
          <div class="text-center">
            <img src="{{ asset('img/receipt-logo.png') }}" alt="Tailwind POS" class="mb-3 w-8 h-8 inline-block">
            <h2 class="text-xl font-semibold">Point of Sales</h2>
            <p>Universitas Dinamika</p>
          </div>
          <div class="flex mt-4 text-xs">
            <div class="flex-grow">No: <span x-text="receiptNo"></span></div>
            <div x-text="receiptDate"></div>
          </div>
          <hr class="my-2">
          <div>
            <table class="w-full text-xs">
              <thead>
                <tr>
                  <th class="py-1 w-1/12 text-center">#</th>
                  <th class="py-1 text-left">Item</th>
                  <th class="py-1 w-2/12 text-center">Qty</th>
                  <th class="py-1 w-3/12 text-right">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <div id="receiptTableContainer">
                  <template x-for="(item, index) in cart" :key="item">
                    <tr>
                      <td class="py-2 text-center" x-text="index+1"></td>
                      <td class="py-2 text-left">
                        <span x-text="item.name"></span>
                        <br />
                        <small x-text="priceFormat(item.price)"></small>
                      </td>
                      <td class="py-2 text-center" x-text="item.qty"></td>
                      <td class="py-2 text-right" x-text="priceFormat(item.qty * item.price)">
                      </td>
                    </tr>
                  </template>
                </div>
              </tbody>
            </table>
          </div>
          <hr class="my-2">
          <div>
            <div class="flex font-semibold">
              <div class="flex-grow">TOTAL</div>
              <div x-text="priceFormat(getTotalPrice())"></div>
            </div>
            <div class="flex text-xs font-semibold">
              <div class="flex-grow">PAY AMOUNT</div>
              <div x-text="priceFormat(cash)"></div>
            </div>
            <hr class="my-2">
            <div class="flex text-xs font-semibold">
              <div class="flex-grow">CHANGE</div>
              <div x-text="priceFormat(change)"></div>
            </div>
          </div>
        </div>
        <div class="p-4 w-full">
          <input type="hidden" id="sesion_id" name="session_id" value="{{ $session->id ?? null }}">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="payment-method">Payment
              Method</label>
            <select id="payment_method" name="payment_method"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              @foreach (\App\PaymentMethodEnum::toArray() as $item)
                <option value="{{ $item }}">{{ $item }}</option>
              @endforeach
            </select>
          </div>
          <button class="bg-cyan-500 text-white text-lg px-4 py-3 rounded-2xl w-full focus:outline-none"
            x-on:click="printAndProceed()">PROCEED</button>
        </div>
      </div>
    </div>
    <!-- modal receipt -->

    <!-- modal end session -->
    <div x-show="isShowModalEndSession"
      class="fixed w-full h-screen left-0 top-0 z-10 flex flex-wrap justify-center content-center p-24">
      <div x-show="isShowModalEndSession" class="fixed glass w-full h-screen left-0 top-0 z-0"
        x-on:click="closeModalEndSession()" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"></div>
      <div x-show="isShowModalEndSession" class="w-96 rounded-3xl bg-white shadow-xl overflow-hidden z-10"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">

        <div class="p-4 w-full">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="payment-method">
              Initial Cash
            </label>
            <input type="text"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              value="Rp. {{ number_format($session->initial_cash, 0, ',', '.') }}" disabled>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="payment-method">
              Cash In
            </label>
            <input type="text"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              value="Rp. {{ number_format($session->cash_in, 0, ',', '.') }}" disabled>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="payment-method">
              Ending Cash System
            </label>
            @php
              $endingCashSytem = $session->initial_cash + $session->cash_in;
            @endphp
            <input type="text" name="ending_cash_system" id="ending_cash_system"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              value="Rp. {{ number_format($endingCashSytem, 0, ',', '.') }}" disabled>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="payment-method">
              Ending Cash Actual
            </label>
            <input type="text" name="ending_cash_actual" id="ending_cash_actual"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan kas aktual">
          </div>
          <button class="bg-cyan-500 text-white text-lg px-4 py-3 rounded-2xl w-full focus:outline-none"
            x-on:click="processEndSession()">End Session</button>
        </div>
      </div>
    </div>
    <!-- modal end session -->
  </div>
</x-pos-layout>
