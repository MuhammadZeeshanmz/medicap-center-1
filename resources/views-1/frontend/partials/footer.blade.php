<!-- Footer: Start -->
@if ($secInfo->footer_section_status == 1)
    <footer class="landing-footer bg-body footer-text">
        <div class="footer-top position-relative overflow-hidden z-1">
            <img src="{{ asset('assets/img/front-pages/backgrounds/footer-bg-' . $configData['style'] . '.png') }}"
                alt="footer bg" class="footer-bg banner-bg-img z-n1"
                data-app-light-img="front-pages/backgrounds/footer-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
            <div class="container">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="go-top"><i class="fas fa-long-arrow-up"></i></div>
                    <div class="footer-top pt-100 pb-70 text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="navbar-brand mt-10">
                                        <span></span>
                                        @if (!empty($basicInfo->footer_logo))
                                            <a href="{{ route('index') }}" target="_self" title="Link">
                                                <img src="{{ asset('assets/admin/img/footer/' . $basicInfo->footer_logo) }}"
                                                    alt="Brand Logo">
                                            </a>
                                        @endif
                                        <span></span>
                                    </div>
                                    <ul class="info-list mt-20">
                                        @if (!empty($basicInfo->email_address))
                                            <li>

                                                <a
                                                    href="mailto:{{ $basicInfo->email_address }}">{{ $basicInfo->email_address }}</a>
                                            </li>
                                        @endif
                                        @if (!empty($basicInfo->contact_number))
                                            <li>

                                                <a
                                                    href="tel:{{ $basicInfo->contact_number }}">{{ $basicInfo->contact_number }}</a>
                                            </li>
                                        @endif
                                    </ul>
                                    @if (count($socialMediaInfos) > 0)
                                        <div class="social-link mt-20 d-flex justify-content-center" style="gap: 20px;">
                                            @foreach ($socialMediaInfos as $socialMediaInfo)
                                                <a href="{{ $socialMediaInfo->url }}" target="_blank"
                                                    title="instagram"><i class="{{ $socialMediaInfo->icon }}"></i></a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="newsletter-form mx-auto mt-30">
                                        <form id="newsletterForm" class="subscription-form"
                                            action="{{ route('store_subscriber') }}" method="POST">
                                            @csrf
                                            <div class="form-group d-flex">
                                                <input class="form-control" placeholder="{{ __('Enter email') }}"
                                                    type="email" name="email_id" required="" autocomplete="off">
                                                <button
                                                    class="btn btn-md btn-primary btn-gradient no-animation position-absolute"
                                                    style ="right:438px;" type="submit">{{ __('Subscribe') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="footer-links list-unstyled mt-30 d-flex justify-content-space-around">
                                        @foreach ($quickLinkInfos as $quickLinkInfo)
                                            <li>
                                                <a href="{{ $quickLinkInfo->url }}">{{ $quickLinkInfo->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </span>
                    <a href="{{ config('variables.creatorUrl') }}" target="_blank"
                        class="fw-medium text-white footer-link">{{ config('variables.creatorName') }},</a>
                    <span class="footer-text"> Made with ❤️ for a better web.</span>
                </div>
                {{-- <div>
                    <a href="{{ config('variables.githubFreeUrl') }}" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/github-' . $configData['style'] . '.png') }}"
                            alt="github icon" data-app-light-img="front-pages/icons/github-light.png"
                            data-app-dark-img="front-pages/icons/github-dark.png" />
                    </a>
                    <a href="{{ config('variables.facebookUrl') }}" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/facebook-' . $configData['style'] . '.png') }}"
                            alt="facebook icon" data-app-light-img="front-pages/icons/facebook-light.png"
                            data-app-dark-img="front-pages/icons/facebook-dark.png" />
                    </a>
                    <a href="{{ config('variables.twitterUrl') }}" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/twitter-' . $configData['style'] . '.png') }}"
                            alt="twitter icon" data-app-light-img="front-pages/icons/twitter-light.png"
                            data-app-dark-img="front-pages/icons/twitter-dark.png" />
                    </a>
                    <a href="{{ config('variables.instagramUrl') }}" class="footer-link" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/instagram-' . $configData['style'] . '.png') }}"
                            alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png"
                            data-app-dark-img="front-pages/icons/instagram-dark.png" />
                    </a>
                </div> --}}
            </div>
        </div>
    </footer>
@endif
<!-- Footer: End -->



<!-- Add Review Modal Start -->
@include('frontend.services.booking-modal.modal-page')
<!-- Add Review Modal End -->
