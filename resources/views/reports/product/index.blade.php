<x-app-layout>

    @section('content')
        <div class="mx-auto max-w-270">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Report Product
                </h2>
                <nav>
                    <ol class="flex items-center gap-2">
                        <li class="font-medium text-primary">Report - Product</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->
            <!-- ====== Settings Section Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-5.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1 mb-3">
                <h3 class="text-title-md3 font-bold text-black dark:text-white mb-2">
                    Filter :
                </h3>
                <form action="{{ route('reports.product.index') }}" method="GET">
                    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                        <div class="w-full sm:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="start_date">Start
                                Date</label>
                            <div class="relative">
                                <span class="absolute left-4 5 top-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M8 14q-.425 0-.712-.288T7 13q0-.425.288-.712T8 12q.425 0 .713.288T9 13q0 .425-.288.713T8 14m4 0q-.425 0-.712-.288T11 13q0-.425.288-.712T12 12q.425 0 .713.288T13 13q0 .425-.288.713T12 14m4 0q-.425 0-.712-.288T15 13q0-.425.288-.712T16 12q.425 0 .713.288T17 13q0 .425-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                                    </svg>
                                </span>
                                <input
                                    class="w-full rounded border border-stroke px-4.5 pl-11.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                    type="date" name="start_date" id="start_date"
                                    value="{{ count($filter) > 0 ? $filter['startDate'] : '' }}" />
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="end_date">End
                                Date</label>
                            <div class="relative">
                                <span class="absolute left-4 5 top-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M8 14q-.425 0-.712-.288T7 13q0-.425.288-.712T8 12q.425 0 .713.288T9 13q0 .425-.288.713T8 14m4 0q-.425 0-.712-.288T11 13q0-.425.288-.712T12 12q.425 0 .713.288T13 13q0 .425-.288.713T12 14m4 0q-.425 0-.712-.288T15 13q0-.425.288-.712T16 12q.425 0 .713.288T17 13q0 .425-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                                    </svg>
                                </span>
                                <input
                                    class="w-full rounded border border-stroke px-4.5 pl-11.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                    type="date" name="end_date" id="end_date"
                                    value="{{ count($filter) > 0 ? $filter['endDate'] : '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4.5 mb-2">
                        <button
                            class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                            type="submit">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
            <div
                class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                <div class="max-w-full overflow-x-auto">
                    <div class="flex justify-between items-center">
                        <h3 class="text-title-md3 font-bold text-black dark:text-white mb-5">Periode :
                            {{ count($filter) > 0 ? Carbon\Carbon::parse($filter['startDate'])->format('d F Y') . ' - ' . Carbon\Carbon::parse($filter['endDate'])->format('d F Y') : '-' }}
                        </h3>
                        <button id="downloadButton"
                            class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90 mb-4"
                            onclick="downloadPDF({{ json_encode($filter) }})" {{ count($reports) <= 0 ? 'disabled' : '' }}>
                            <span id="downloadText">Download Reports</span>
                            <span id="loadingSpinner" class="hidden">Loading...</span>
                        </button>
                    </div>

                    <table class="w-full table-auto mb-5">
                        <thead>
                            <tr class="bg-gray-2 text-left dark:bg-meta-4">
                                <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                    No
                                </th>
                                <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                    Product
                                </th>
                                <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                    Sold Qty
                                </th>
                                <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                    Total Income
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $item)
                                <tr>
                                    <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                                        <h5 class="font-medium text-black dark:text-white">{{ $loop->index + 1 }}</h5>
                                    </td>
                                    <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                                        <h5 class="font-medium text-black dark:text-white">({{ $item->code }})
                                            {{ $item->name }}</h5>
                                    </td>
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <p class="text-black dark:text-white">{{ $item->qty }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <p class="text-black dark:text-white">Rp
                                            {{ number_format($item->penjualan, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark" colspan="4">
                                        No Data Available
                                    </td>
                                </tr>
                            @endforelse
                            @if (count($reports) > 0)
                                <tr class="bg-gray-2">
                                    <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11"
                                        colspan="2">
                                        <h5 class="font-bold text-black dark:text-white">Grand Total</h5>
                                    </td>
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <p class="text-black dark:text-white font-bold">
                                            {{ number_format($reports->sum('qty'), 0, ',', '.') }}
                                        </p>
                                    </td>
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <p class="text-black dark:text-white font-bold">
                                            Rp {{ number_format($reports->sum('penjualan'), 0, ',', '.') }}
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-8">
            </div>
            <!-- ====== Settings Section End -->
        </div>
    @endsection
    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/reports/product.js') }}"></script>
    @endpush
</x-app-layout>
