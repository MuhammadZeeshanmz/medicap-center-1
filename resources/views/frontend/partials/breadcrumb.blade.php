<!-- Page Header Section Start -->
<section class="page-header {{ $basicInfo->theme_version == 2 || $basicInfo->theme_version == 3 ? 'theme-v2' : '' }}"
         @if(!empty($breadcrumb)) 
           style="background-image: url('{{ asset('assets/img/' . $breadcrumb) }}'); padding: 100px 0;"  {{-- Added padding here --}}
         @else
           style="padding: 100px 0;" {{-- Fallback padding even if no background --}}
         @endif>
    <div class="container">
        <div class="content">
            <h2>{{ !empty($title) ? $title : '' }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ !empty($title) ? $title : '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Header Section End -->


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preload background image if exists
        @if(!empty($breadcrumb))
            const bgImage = new Image();
            bgImage.src = "{{ asset('assets/img/' . $breadcrumb) }}";
            bgImage.onload = function() {
                document.querySelector('.page-header').style.backgroundImage = `url('${this.src}')`;
            };
        @endif
    });
</script>
@endpush