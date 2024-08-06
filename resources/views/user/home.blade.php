@extends('user.layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="title">Hello, {{ Auth::user()->name }}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $totalProducts }}</h3>
                    <p>Total Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Total Categories</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h3>{{ $totalSuppliers }}</h3>
                    <p>Total Suppliers</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="productsPerCategoryChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="productsPerSupplierChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <canvas id="monthlyProductCountChart"></canvas>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const productsPerCategory = @json($productsPerCategory);
    const productsPerSupplier = @json($productsPerSupplier);
    const monthlyProductCount = @json($monthlyProductCount);

    // Products per category chart
    const ctxCategory = document.getElementById('productsPerCategoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'bar',
        data: {
            labels: productsPerCategory.map(category => category.name),
            datasets: [{
                label: 'Products per Category',
                data: productsPerCategory.map(category => category.products_count),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Products per supplier chart
    const ctxSupplier = document.getElementById('productsPerSupplierChart').getContext('2d');
    new Chart(ctxSupplier, {
        type: 'pie',
        data: {
            labels: productsPerSupplier.map(supplier => supplier.name),
            datasets: [{
                label: 'Products per Supplier',
                data: productsPerSupplier.map(supplier => supplier.products_count),
                backgroundColor: productsPerSupplier.map((_, index) => `rgba(${index * 30}, ${index * 60}, ${index * 90}, 0.2)`),
                borderColor: productsPerSupplier.map((_, index) => `rgba(${index * 30}, ${index * 60}, ${index * 90}, 1)`),
                borderWidth: 1
            }]
        }
    });

    // Monthly product count chart
    const ctxMonthly = document.getElementById('monthlyProductCountChart').getContext('2d');
    new Chart(ctxMonthly, {
        type: 'line',
        data: {
            labels: monthlyProductCount.map(item => `${item.year}-${item.month}`),
            datasets: [{
                label: 'Monthly Product Count',
                data: monthlyProductCount.map(item => item.count),
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
