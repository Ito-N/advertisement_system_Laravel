@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">アカウント確認</div>
            <div class="card-body">
                <form action="{{ route('verification.send') }}" method="post">@csrf
                    <button type="submit" class="btn btn-danger">確認</button>
                </form>
            </div>
        </div>
    </div>

@endsection
