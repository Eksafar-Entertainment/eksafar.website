

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
    </nav>
    <div class="row">
        @foreach($results as $result)
        <div class="col-md-1 col-sm-2 col-3">
            @php
            $href = $result['type']=="dir"?"getListing('".$prefix."/".$result["name"]."')":null;
            @endphp
            <div class="d-block mb-3" onclick="{{$href}}">
                <div style="background-image:url({{$result['icon']}});width: 100%; padding-top:100%; background-size:cover; background-position:center; border-radius:8px"></div>
                <div class="text-nowrap overflow-hidden">
                    <small>{{$result["name"]}}</small>
                </div>
</div>
        </div>
        @endforeach
    </div>

</div>
