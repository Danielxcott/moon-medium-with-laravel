@php
    use App\base;
    use Illuminate\Support\Str;
@endphp
@extends("layouts.app")
@section("title") All reports @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">User report</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <div class="header">
                <h4>User Report</h4>
            </div>
            <div class="post-create-card-body">
                <table class="table table-bordered overflow-scroll report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report's User</th>
                            <th>Report Title</th>
                            <th>Report Article</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $key => $report)
                        <tr>
                            <input type="hidden" class="reportId" value="{{ $report->id }}" name="id">
                            <td>{{ $key+1 }}</td>
                            <td>{{ ucwords($report->user->name )}}</td>
                            <td class="">{{ base::$reportMessages[$report->report_message] }}</td>
                            <td class="article">
                                <h3 class="mb-0">{{ $report->article->title }}</h3>
                                <p class="mb-0">{{ Str::words($report->article->excerpt,30) }}</p>
                            </td>
                            <td class="action">
                                <a href="{{ route("detail.article",$report->article->slug) }}" class="btn btn-outline-primary"><i class="fa-solid fa-clipboard-list"></i></a>
                                <form action="" class="d-inline-block">
                                    <button type="button" class="btn btn-outline-danger" id="trash-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            <td>
                                {{ $report->created_at->format("d M Y") }}
                            <br>
                                {{  $report->created_at->format("h:i a") }}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6">No reports have been sent to you yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push("script")
<script src="{{ asset("js/sidebar.js") }}"></script>
    <script>
        let url = "{{ route('delete.report') }}";
        $(".report-table").delegate("#trash-btn","click",function(){
            let getId = $(this).closest("tbody tr").find(".reportId").val();
            $.post(url,{
                id:getId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".report-table").load(location.href+" .report-table");
                console.log(data);
            })
        })
    </script>
@endpush