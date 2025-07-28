@if ($secInfo->footer_section_status == 1)
  <footer class="landing-footer bg-primary-light footer-text">
    <!-- Background Image -->
    <div class="footer-top position-relative overflow-hidden z-1 pt-100 pb-70">
      <img src="{{ asset('assets/img/front-pages/backgrounds/footer-bg-' . $configData['style'] . '.png') }}"
           alt="footer bg"
           class="footer-bg banner-bg-img z-n1"
           data-app-light-img="front-pages/backgrounds/footer-bg-light.png"
           data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
      
      <div class="container">
        <div class="row gx-0 gy-4 g-md-5 text-center text-md-start">

          <!-- Column 1: Logo + Contact Info + Social -->
          <div class="col-lg-5">
            <div class="navbar-brand mt-10 mb-4">
              @if (!empty($basicInfo->footer_logo))
                <a href="{{ route('index') }}" title="Home">
                  <img src="{{ asset('assets/admin/img/footer/' . $basicInfo->footer_logo) }}" alt="Brand Logo">
                </a>
              @endif
            </div>
            <ul class="info-list mb-4">
              @if (!empty($basicInfo->email_address))
                <li><a href="mailto:{{ $basicInfo->email_address }}">{{ $basicInfo->email_address }}</a></li>
              @endif
              @if (!empty($basicInfo->contact_number))
                <li><a href="tel:{{ $basicInfo->contact_number }}">{{ $basicInfo->contact_number }}</a></li>
              @endif
            </ul>
            @if (count($socialMediaInfos) > 0)
              <div class="social-link mb-4">
                @foreach ($socialMediaInfos as $socialMediaInfo)
                  <a href="{{ $socialMediaInfo->url }}" target="_blank" title="social">
                    <i class="{{ $socialMediaInfo->icon }}"></i>
                  </a>
                @endforeach
              </div>
            @endif
          </div>

          <!-- Column 2: Newsletter -->
          <div class="col-lg-3 col-md-6">
            <h6 class="footer-title mb-4">{{ __('Subscribe') }}</h6>
            <div class="newsletter-form mx-auto">
              <form id="newsletterForm" class="subscription-form" action="{{ route('store_subscriber') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input class="form-control mb-2" placeholder="{{ __('Enter email') }}" type="email" name="email_id" required autocomplete="off">
                  <button class="btn btn-primary w-100" type="submit">{{ __('Subscribe') }}</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Column 3: Quick Links -->
          <div class="col-lg-4 col-md-6">
            <h6 class="footer-title mb-4">{{ __('Quick Links') }}</h6>
            <ul class="footer-links list-unstyled">
              @foreach ($quickLinkInfos as $quickLinkInfo)
                <li class="mb-2">
                  <a href="{{ $quickLinkInfo->url }}">{{ $quickLinkInfo->title }}</a>
                </li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom py-3 border-top">
      <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
        <div class="mb-2 mb-md-0">
          <span class="footer-text">
            {!! @$footerInfo->copyright_text !!}
          </span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Add Review Modal Start -->
  @include('frontend.services.booking-modal.modal-page')
  <!-- Add Review Modal End -->
@endif
