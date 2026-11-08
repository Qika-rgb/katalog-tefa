@extends('layouts.frontend')

@section('content')
<div class="container">

    <!-- 1. DKV -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.dkv') }}</h2>
            <p>{{ __('messages.home_dkv_desc') }}</p>

            <!-- DKV (Kategori ID: 4) -->
            <a href="{{ url('/portofolio?kategori=4') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_dkv.png') }}" alt="Ilustrasi TEFA DKV" width="450" height="350" fetchpriority="high">
        </div>
    </div>


    <!-- 2. GAME / GIM -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.gim') }}</h2>
            <p>{{ __('messages.home_gim_desc') }}</p>

            <!-- GIM (Kategori ID: 5) -->
            <a href="{{ url('/portofolio?kategori=5') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_gim.png') }}" alt="Ilustrasi TEFA Game" loading="lazy" decoding="async" width="450" height="350">
        </div>
    </div>


    <!-- 3. TKJ -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.tkj') }}</h2>
            <p>{{ __('messages.home_tkj_desc') }}</p>

            <!-- TKJ (Kategori ID: 2) -->
            <a href="{{ url('/portofolio?kategori=2') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_tkj.png') }}" alt="Ilustrasi TEFA TKJ" loading="lazy" decoding="async" width="450" height="350">
        </div>
    </div>


    <!-- 4. RPL -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.rpl') }}</h2>
            <p>{{ __('messages.home_rpl_desc') }}</p>

            <!-- RPL (Kategori ID: 0) -->
            <a href="{{ url('/portofolio?kategori=0') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_rpl.png') }}" alt="Ilustrasi TEFA RPL" loading="lazy" decoding="async" width="450" height="350">
        </div>
    </div>


    <!-- 5. PSPT -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.pspt') }}</h2>
            <p>{{ __('messages.home_pspt_desc') }}</p>

            <!-- PSPT (Kategori ID: 3) -->
            <a href="{{ url('/portofolio?kategori=3') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_pspt.png') }}" alt="Ilustrasi TEFA PSPT" loading="lazy" decoding="async" width="450" height="350">
        </div>
    </div>


    <!-- 6. ANIMASI -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>{{ __('messages.animasi') }}</h2>
            <p>{{ __('messages.home_animasi_desc') }}</p>

            <!-- ANIMASI (Kategori ID: 1) -->
            <a href="{{ url('/portofolio?kategori=1') }}" class="btn-dark">
                {{ __('messages.see_portfolio') }}
            </a>
        </div>

        <div class="img-content">
            <img src="{{ asset('images/tefa_animasi.png') }}" alt="Ilustrasi TEFA Animasi" loading="lazy" decoding="async" width="450" height="350">
        </div>
    </div>

</div>
@endsection