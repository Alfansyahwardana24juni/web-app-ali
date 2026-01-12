@extends('layouts.dashboard')

@section('title', 'Pengajuan Sedang Diproses - Pendirian CV')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Pengajuan Sedang Diproses</h1>
                    <p class="text-gray-600 mt-2">Pantau status pengajuan pendirian CV Anda di sini</p>
                </div>
                <div class="text-right">
                    <div id="total-count" class="text-4xl font-bold text-blue-600">{{ $totalPengajuan }}</div>
                    <p class="text-gray-600 text-sm">Total Pengajuan</p>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" id="search-input" placeholder="Cari nama perusahaan..." value="{{ request('search') }}"
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <div id="search-loading" class="absolute right-3 top-2.5 hidden">
                        <i class="fas fa-spinner fa-spin text-blue-500"></i>
                    </div>
                </div>
                <select id="status-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                </select>
            </div>
        </div>

        <!-- Pengajuan List Container -->
        <div id="pengajuan-list-container">
            @include('pendirian.cv.partials.list')
        </div>
    </div>

    <!-- Delete Confirmation Modal (kept same) -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDeleteModal()"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Hapus Data Pengajuan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus data pengajuan untuk <span id="delete-company-name" class="font-bold"></span>?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX Search Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        let searchTimer;
        const searchInput = $('#search-input');
        const statusFilter = $('#status-filter');
        const listContainer = $('#pengajuan-list-container');
        const loadingIcon = $('#search-loading');

        function fetchResults(pageUrl = null) {
            const search = searchInput.val();
            const status = statusFilter.val();
            
            loadingIcon.removeClass('hidden');

            const url = pageUrl || window.location.pathname;

            $.ajax({
                url: url,
                data: pageUrl ? null : { search, status }, // Only send params if not using pageUrl (which already has them)
                success: function(response) {
                    listContainer.html(response.html || response);
                    loadingIcon.addClass('hidden');
                    
                    if (!pageUrl) {
                        // Update URL without reloading page for search/status change
                        const newUrl = new URL(window.location);
                        if (search) newUrl.searchParams.set('search', search); else newUrl.searchParams.delete('search');
                        if (status) newUrl.searchParams.set('status', status); else newUrl.searchParams.delete('status');
                        window.history.pushState({}, '', newUrl);
                    } else {
                        // For pagination, just update the state
                        window.history.pushState({}, '', pageUrl);
                    }
                },
                error: function() {
                    loadingIcon.addClass('hidden');
                    alert('Gagal memuat data.');
                }
            });
        }

        // Intercept pagination clicks
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            if (url) {
                fetchResults(url);
                // Scroll to top of list
                $('html, body').animate({
                    scrollTop: $("#pengajuan-list-container").offset().top - 100
                }, 500);
            }
        });

        searchInput.on('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => fetchResults(), 500); // 500ms debounce
        });

        statusFilter.on('change', () => fetchResults());

        function resetFilters() {
            searchInput.val('');
            statusFilter.val('');
            fetchResults();
        }

        // Delete Modal Logic (same as before)
        function confirmDelete(id, name) {
            document.getElementById('delete-company-name').textContent = name;
            const form = document.getElementById('deleteForm');
            form.action = '/pendirian/cv/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeDeleteModal();
            }
        });
    </script>
@endsection