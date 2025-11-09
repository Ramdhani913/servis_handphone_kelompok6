@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Services</h3>
                    <p class="text-subtitle text-muted">
                       Manage service handphone data
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="multiple-column-form">
            <form class="form" action="{{ route('services.store') }}" method="POST" data-parsley-validate id="form-add-service">
                @csrf
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label for="customer">Customer</label>
                                                <select class="form-control" name="customer" data-parsley-required="true" id="customer">
                                                    <option value="" hidden>--Choose Customer--</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="handphone">Handphone</label>
                                                <select class="form-control" name="handphone" data-parsley-required="true" id="handphone">
                                                    <option value="" hidden>--Choose Handphone--</option>
                                                    @foreach ($handphones as $handphone)
                                                        <option value="{{ $handphone->id }}">{{ $handphone->brand }} | {{ $handphone->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                                <div class="form-group mb-3">
                                                <label for="technician">Technician</label>
                                                <select class="form-control" name="technician" data-parsley-required="true" id="technician">
                                                    <option value="" hidden>--Choose Technician--</option>
                                                    @foreach ($technicians as $technician)
                                                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="damagedescription">Damage Description</label>
                                                <input type="text" name="damagedescription" data-parsley-required="true" id="damagedescription" class="form-control" placeholder="ex : Broken Screen, Not Charging, Camera Error">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service Detail Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Service Type</td>
                                                <td>Price</td>
                                                <td>Action</td>
                                            </tr>                                            
                                        </thead>
                                        <tbody id="table-body-servicetype">
                                            
                                        </tbody>
                                    </table>
                                    <div class="mb-5">
                                        <button type="button" id="add-row-servicetype" class="btn btn-secondary w-100">Add Other Service</button>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('custom.css')
<style>
    /* Style umum untuk tema gelap */
    .form-control {
        color: #ffffff !important;
        background-color: #1e1e2d !important;
        border: 1px solid #3a3a4f !important;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #2a2a3d !important;
        color: #ccc !important;
    }

    .form-control::placeholder {
        color: #888 !important;
    }

    select.form-control {
        color: #ffffff !important;
        background-color: #1e1e2d !important;
    }

    /* Tombol sekunder dark mode */
    .btn-secondary {
        background-color: #2c2c3e !important;
        border: 1px solid #3a3a4f !important;
        color: #fff !important;
    }
    .btn-secondary:hover {
        background-color: #3a3a4f !important;
    }

    /* === CLASS BARU untuk kolom Price === */
    .input-price-white {
        background-color: #ffffff !important;
        color: #000000 !important;
        border: 1px solid #ccc !important;
    }
</style>
@endpush

@push('custom.js')
<script>
    var serviceItems = {!! json_encode($serviceItems) !!};

    $(document).ready(function () {
        addNewServiceTypeRow();
        $('#add-row-servicetype').on('click', function () {
            addNewServiceTypeRow(); 
        });
    });

    function addNewServiceTypeRow() {
        let rowCount = $('#table-body-servicetype tr').length;
        row = rowCount + 1;

        var selectServiceItem = '<option value="" hidden>Select Service Type...</option>';
        serviceItems.forEach(serviceItem => {
            selectServiceItem += `<option value="${serviceItem.id}">${serviceItem.service_name}</option>`
        });

        let rowHtml = `
            <tr class="servicetype-row">
                <td>${row}</td>
                <td>
                    <select class="form-control select2" onchange="getServiceItemPrice(${row}, this.value)" name="service_type[]" data-parsley-required="true" id="service_type_${row}">
                        ${selectServiceItem}
                    </select>
                </td>
                <td>
                    <!-- Gunakan class baru di sini -->
                    <input type="text" name="price[]" disabled readonly id="price_${row}" class="form-control input-price-white" placeholder="0" style="text-color: black;">
                </td>
                <td>
                    <button onclick="removeServiceTypeRow(this)" class="btn btn-danger btn-remove-product-purcahse-row"><i class="bi bi-trash3"></i></button>
                </td>
            </tr>
        `;

        $('#table-body-servicetype').append(rowHtml);
        updateNumberServiceTypeRow();
    }

    function updateNumberServiceTypeRow() {
        $('#table-body-servicetype tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
        toggleServiceTypeRowButtons();
    }

    function toggleServiceTypeRowButtons(){
        let rowCount = $('#table-body-servicetype tr').length;
        $('.btn-remove-product-purcahse-row').prop('disabled', rowCount < 2);
    } 

    function removeServiceTypeRow(row) {
        $(row).closest('.servicetype-row').remove();
        updateNumberServiceTypeRow();
    }

    function getServiceItemPrice(row, id) {
        let price = serviceItems.find(serviceItem => serviceItem.id == id).price;
        $('#table-body-servicetype #price_' + row).val(currency(price));
    }
</script>
@endpush
