@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ Storage::url($advertisement->feature_image) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url($advertisement->first_image) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url($advertisement->second_image) }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <p>{!! $advertisement->description !!}</p>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">More Info</div>
                    <div class="card-body">
                        <p>Country:{{ $advertisement->country->name ?? '' }}</p>
                        <p>State:{{ $advertisement->state->name ?? '' }}</p>
                        <p>City:{{ $advertisement->city->name ?? '' }}</p>
                        <p>Product condition:{{ $advertisement->product_condition ?? '' }}</p>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        {!! $advertisement->displayVideoFromLink() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1>{{ $advertisement->name }}</h1>
                <p>Price: ${{ $advertisement->price }} USD, {{ $advertisement->price_status }}</p>
                <p>Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
                <p>Listing location: {{ $advertisement->listing_location }}</p>

                @if (Auth::check())
                    @if (!$advertisement->didUserSavedAd() && auth()->user()->id != $advertisement->user_id)
                        <save-ad :ad-id="{{ $advertisement->id }}" :user-id="{{ auth()->user()->id }}"></save-ad>
                    @endif
                @endif
                <hr>
                <img src="/img/man.jpg" width="120">
                <p>
                    <a href="{{ route('show.user.ads', [$advertisement->user_id]) }}">{{ $advertisement->user->name }}</a>
                </p>
                <p>
                    @if ($advertisement->phone_number)
                        <show-phone-number :phone-number="{{ $advertisement->phone_number }}"></show-phone-number>
                    @endif
                </p>
                <p>
                    @if (Auth()->check())
                        @if (auth()->user()->id != $advertisement->user_id)
                            <message seller-name="{{ $advertisement->user->name }}"
                                :user-id="{{ auth()->user()->id }}"
                                :receiver-id="{{ $advertisement->user->id }}"
                                :ad-id="{{ $advertisement->id }}"
                            ></message>
                        @endif
                    @endif
                    <span>
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <a href="" data-toggle="modal" data-target="#exampleModal">Report this ad</a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('report.ad') }}" method="post">@csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Report wrong with this ad</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Select reason</label>
                                            <select class="form-control" name="reason" required>
                                                <option value="Fraud">select</option>
                                                <option value="Fraud">fraud</option>
                                                <option value="Duplicate">duplicate</option>
                                                <option value="Spam">spam</option>
                                                <option value="Wrong-category">Wrong Category</option>
                                                <option value="Offensive">offensive</option>
                                                <option value="Other">other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            @if (Auth::check())
                                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                            @else
                                                <input type="email" name="email" class="form-control">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Your Message</label>
                                            <textarea name="message" class="form-control" required></textarea>
                                        </div>
                                        <input type="hidden" name="ad_id" value="{{ $advertisement->id }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Report this ad</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </span>
                </p>
            </div>
        </div>
    </div>
@endsection
