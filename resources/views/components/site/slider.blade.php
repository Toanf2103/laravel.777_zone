<div id="slider" class="carousel slide slider" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($listBanner as $index => $banner)
        <button type="button" data-bs-target="#slider" data-bs-slide-to="{{$index}}" class="{{ $index==0?'active':'' }}" aria-current="true" aria-label="Slide {{$index+1}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        
        @foreach($listBanner as $index => $banner)
        <div class="carousel-item {{ $index==0?'active':'' }}">
            <img src="{{ $banner }}" class="d-block w-100" alt="...">
        </div>
        @endforeach

    </div>

    <div class="wrapper-icon left-btn" data-bs-target="#slider" data-bs-slide="prev">
        <i class="fa-light fa-arrow-left"></i>
    </div>
    <div class="wrapper-icon right-btn" data-bs-target="#slider" data-bs-slide="next">
        <i class="fa-light fa-arrow-right"></i>
    </div>
    
</div>