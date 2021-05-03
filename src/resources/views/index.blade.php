@extends('layouts.app')
@section('content')

<div class="slider" style="margin-top: -25px;">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="slider/slider1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="slider/slider2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="slider/slider3.png" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <span>
        <h1>Car</h1>
        <a href="{{ route('category.show', $category->slug) }}" class="float-right">View all</a>
    </span>
    <br>
    <div id="carouselExampleFade{{ $category->id }}" class="carousel slide" data-ride="carousel" data-interval="2500">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    @forelse ($firstAds as $firstAd)
                        <div class="col-3">
                            <a href="{{ route('product.view', [$firstAd->id, $firstAd->slug]) }}">
                                <img src="{{ Storage::url($firstAd->feature_image) }}" class="img-thumbnail" alt="..." style="min-height: 170px">
                            </a>
                            <p class="text-center card-footer" style="color: #222;">
                                {{ $firstAd->name }} /${{ $firstAd->price }}
                            </p>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    @forelse ($secondsAds as $secondsAd)
                    <div class="col-3">
                        <a href="{{ route('product.view', [$secondsAd->id, $secondsAd->slug]) }}">
                            <img src="{{ Storage::url($secondsAd->feature_image) }}" class="img-thumbnail" alt="..." style="min-height: 170px">
                        </a>
                        <p class="text-center card-footer" style="color: #222;">
                            {{ $secondsAd->name }} /${{ $secondsAd->price }}
                        </p>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade{{ $category->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade{{ $category->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="container mt-5">
    <span>
        <h1>Electronics</h1>
        <a href="{{ route('category.show', $categoryElectronic->slug) }}" class="float-right">View all</a>
    </span>
    <br>
    <div id="carouselExampleFade{{ $categoryElectronic->id }}" class="carousel slide" data-ride="carousel" data-interval="2500">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    @forelse ($firstAdsForElectronics as $firstAdsForElectronic)
                        <div class="col-3">
                            <a href="{{ route('product.view', [$firstAdsForElectronic->id, $firstAdsForElectronic->slug]) }}">
                                <img src="{{ Storage::url($firstAdsForElectronic->feature_image) }}" class="img-thumbnail" alt="..." style="min-height: 170px">
                            </a>
                            <p class="text-center card-footer" style="color: #222;">
                                {{ $firstAdsForElectronic->name }} /${{ $firstAdsForElectronic->price }}
                            </p>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    @forelse ($secondsAdsForElectronics as $secondsAdsForElectronic)
                        <div class="col-3">
                            <a href="{{ route('product.view', [$secondsAdsForElectronic->id, $secondsAdsForElectronic->slug]) }}">
                                <img src="{{ Storage::url($secondsAdsForElectronic->feature_image) }}" class="img-thumbnail" alt="..." style="min-height: 170px">
                            </a>
                            <p class="text-center card-footer" style="color: #222;">
                                {{ $secondsAdsForElectronic->name }} /${{ $secondsAdsForElectronic->price }}
                            </p>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade{{ $categoryElectronic->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade{{ $categoryElectronic->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>



@endsection
