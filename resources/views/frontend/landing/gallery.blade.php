@if(count($gallery) > 0)
<div id="fh5co-couple" style="background-color: white;">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-12 text-center heading-section">
                    <h2>Gallery </h2>

                </div>
            </div>
        </div>




        @foreach($gallery as $gallery_image)
        <div class="col-md-4">
            <div>
                <div style="background-size:cover; background-image: url({{$gallery_image->url}}); padding-top: 100%; background-position:center; box-shadow: 0 0 10px rgba(0,0,0,0.09); border-radius: 8px">

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endif