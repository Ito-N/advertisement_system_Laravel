<div class="card ">
    <div class="card-body ">
        @if (!auth()->user()->avatar)
            <img class="mx-auto d-block img-thumbnail" src="/img/man.jpg" width="130">
        @endif
        @if (auth()->user()->avatar && !auth()->user()->fb_id)
            <img src="{{ Storage::url(auth()->user()->avatar) }}" width="130">
        @endif
        @if (auth()->user()->fb_id)
            <img src="{{ auth()->user()->avatar }}" width="130">
        @endif
        <p class="text-center"><b>{{ auth()->user()->name }}</b></p>
    </div>
    <hr style="border:2px solid blue;">
    <div class="vertical-menu">
        <a href="#">ダッシュボード</a>
        <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">プロフィール</a>
        <a href="{{ route('ads.create') }}" class="{{ request()->is('ads/create') ? 'active' : '' }}">広告掲載</a>
        <a href="{{ route('ads.index') }}" class="{{ request()->is('ads') ? 'active' : '' }}">広告商品一覧</a>
        <a href="{{ route('pending.ad') }}" class="{{ request()->is('ad-pending') ? 'active' : '' }}">保留一覧</a>
        <a href="{{ route('saved.ad') }}" class="{{ request()->is('saved-ads') ? 'active' : '' }}">保存一覧</a>
        <a href="{{ route('messages') }}" class="{{ request()->is('messages') ? 'active' : '' }}">広告主に連絡</a>
    </div>
</div>
