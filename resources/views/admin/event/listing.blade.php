@include("admin.common.header")


<div class="container py-2">
    <table class="table">
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{$event->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            @for($pageNo = 1; $pageNo <= $events->lastPage(); $pageNo++)
            <li class="page-item {{ $events->currentPage() == $pageNo?'active':''}}"><a class="page-link" href="#">{{$pageNo}}</a></li>
            @endfor
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
    {{dd($events)}}
</div>

@include("admin.common.footer")