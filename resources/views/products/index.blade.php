@extends('templates.layoutApp')

@push('styles')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/tabulator_bootstrap5.min.css"
        crossorigin="anonymous"
    />
@endpush

@section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Products</h1>
            </div>

            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Products
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title">Data Products</h3>

                  <button type="button" class="btn btn-primary">
                    data-bs-toggle="modal"
                    data-bs-target="#createProductModal">
                    <i class="bi bi-plus-circle me-1" aria-hidden="true"></i>
                    PRODUCT
                  </button>
</div>

                    <div class="card-body">
                        <div class="card-tools mb-3">
                            <div class="input-group input-group-sm" style="width: 16rem">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input
                                    id="table-filter"
                                    type="search"
                                    class="form-control"
                                    placeholder="Filter rows..."
                                    aria-label="Filter rows"
                                />
                            </div>
                        </div>

                        <div class="d-flex gap-2 mb-3">
                            <button id="export-csv" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-csv me-1"></i>
                                Export CSV
                            </button>

                            <button id="export-json" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-json me-1"></i>
                                Export JSON
                            </button>

                            <button id="print-table" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-printer me-1"></i>
                                Print
                            </button>
                        </div>

                        <div id="product-table" aria-label="Products"></div>

                        <div
                            id="table-pagination"
                            class="d-flex flex-wrap gap-2 justify-content-end mt-2">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--end::App Content-->

@endsection

@section('modal')
    @include('products.modal')
@endsection

@push('script')

<script
    src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
    crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const table = new Tabulator('#product-table', {
            ajaxURL: "{{ route('products.api') }}",
            layout: 'fitColumns',
            filterMode: 'local',
            pagination: true,
            paginationMode: 'local',
            paginationElement: document.getElementById('table-pagination'),
            paginationSize: 10,
            paginationSizeSelector: [10, 25, 50, 100],
            movableColumns: true,

            columns: [
                {
                    title: 'ID',
                    field: 'id',
                    width: 80,
                    headerSort: true
                },
                {
                    title: 'Product Name',
                    field: 'name',
                },
                {
                    title: 'Price',
                    field: 'price',
                },
                {
                    title: 'Stock',
                    field: 'stock',
                    width: 120,
                },
                {
                    title: 'Aksi',
                    field: 'id',
                    formatter: function(cell) {
                        var id = cell.getValue();
                        var editUrl = "{{ url('products') }}/" + id + "/edit";

                        return `<a href="${editUrl}" class="btn btn-success btn-sm">Edit</a>
                        <button onclick="deleteProduct(${id})" class="btn btn-danger btn-sm">Hapus</button>`;
                    },
                    headerSort: false,
                    width: 200,
                    hozAlign: 'center',
                },
            ],
        });

        document.getElementById('table-filter')
            .addEventListener('input', (e) => {
                const value = e.target.value;

                if (value) {
                    table.setFilter('name', 'like', value);
                } else {
                    table.clearFilter();
                }
            });

        document.getElementById('export-csv')
            .addEventListener('click', () => {
                table.download('csv', 'products.csv');
            });

        document.getElementById('export-json')
            .addEventListener('click', () => {
                table.download('json', 'products.json');
            });

        document.getElementById('print-table')
            .addEventListener('click', () => {
                table.print(false, true);
            });

    });
</script>

@endpush