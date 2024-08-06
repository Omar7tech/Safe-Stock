@extends('user.layout.app')

@section('header-links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Your Products</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table id="products-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Stock Quantity</th>
                        <th>Price</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated by DataTables -->
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Stock Quantity</th>
                        <th>Price</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                search: {
                    return: true
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.data') }}',
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false
                    },
                    {
                        data: 'stock_quantity',
                        name: 'stock_quantity',
                        render: function(data, type) {
                            var number = $.fn.dataTable.render.number(',', 2).display(data);
                            if (type === 'display') {
                                let color = 'green';
                                if (data < 100) {
                                    color = 'red';
                                } else if (data < 500) {
                                    color = 'orange';
                                }
                                return '<span style="color:' + color + '">' + number + '</span>';
                            }
                            return number;
                        }
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: function(data, type) {
                            var number = $.fn.dataTable.render.number(',', 2).display(data);
                            return number;
                        }
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    }
                ],
                dom: '<"top"Bfl>rt<"bottom"ip><"clear">',
                stateSave: true
            });
        });
    </script>
@endsection
