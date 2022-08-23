@extends("layouts.app")
@section("title") Add Category @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">Add Category</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <div class="header">
                <h4>Add Category</h4>
            </div>
            <div class="post-create-card-body">
                <form action="{{ route("article-category.store") }}" method="POST" class="post-create-form">
                    @csrf
                    <x-form.form-item for="name" label="Category Title" type="text" title="name"  />
                    <x-form.form-item for="slug" label="Category Slug" type="text" title="slug"  />
                      <div class="post-create-item">
                        <label for="color" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color" id="color" value="#563d7c" title="Choose your color">
                      </div>
                      <div class="post-create-item post-create-submit">
                        <button class="upload-btn" type="submit">Upload</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="category-list-container">
    <div class="category-list-content">
        <div class="category-chart">
            <div class="category-header">
                <h3>Category Chart</h3>
            </div>
            <div class="category-doughnut">
                <canvas id="op" height=""></canvas>
            </div>
        </div>
        <div class="category-table">
            <div class="category-header">
                <h3>Category lists</h3>
            </div>
            <div class="category-list-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $key=>$category )
                            <tr>
                                <input type="hidden" name="category_id" class="category_id" value="{{ $category->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ ucwords($category->name) }}</td>
                                <td class="icon-action">
                                    <a href="{{ route("article-category.edit",$category->slug) }}" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <form action="" class="d-inline-block" id="delete-form">
                                        <button type="button" id="delete_category" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{ $category->created_at->format("d M Y") }}</td>
                            </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="{{ asset("chart.js/dist/chart.min.js") }}"></script>
@push("script")
<script>
    let orderFromPlace = [5,15,4,9,7];
    let places = ["YGN","MDY","NPY","SHAN","MGW"];

    let op = document.getElementById('op').getContext('2d');
    let opChart = new Chart(op, {
type: 'doughnut',
data: {
    labels:places,
    datasets: [{
        label: '# of Votes',
        data:orderFromPlace,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
},
options: {
    scales: {
        y:{
            display:false,
            ticks: {
                beginAtZero: true
            }
        },
        x:{
            display:false
            }
        
    },
    legend:{
        display: true,
        position: 'bottom',
        labels: {
            fontColor: '#333',
            usePointStyle:true
        }
    }
}
});
</script>
@endpush
@push("script")
<script src="{{ asset("js/sidebar.js") }}"></script>
    <script>
        let url = "{{ route('delete.category') }}";
        $(".category-list-table").delegate("#delete_category","click",function(){
            let getId = $(this).closest("tbody tr").find(".category_id").val();
            $.post(url,{
                category_id:getId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".category-list-table").load(location.href+" .category-list-table");
                console.log(data);
            })
        })
    </script>
@endpush