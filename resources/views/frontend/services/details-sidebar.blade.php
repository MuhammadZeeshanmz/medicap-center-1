<div class="col-lg-4 col-xl-3">
  <aside class="service-sidebar" data-aos="fade-up">
    
    <!-- Contact Form Widget -->
    <div class="sidebar-widget contact-widget border p-25 radius-md mb-30">
      <h6 class="widget-title text-center mb-20">
        {{ __('Contact for service inquiry') }}
      </h6>
      
      <!-- Vendor Profile -->
      <div class="vendor-profile mb-20">
        <div class="vendor-avatar">
          <div class="lazy-container ratio ratio-1-1 rounded-pill">
            @if ($details->vendor_id != 0)
              @if ($details->vendor->photo != null)
                <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                  <img class="lazyload blur-up" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                    data-src="{{ asset('assets/admin/img/vendor-photo/' . $details->vendor->photo) }}" alt="{{ $details->vendor->username }}">
                </a>
              @else
                <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                  <img class="lazyload" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                    data-src="{{ asset('assets/img/user.png') }}" alt="{{ $details->vendor->username }}">
                </a>
              @endif
            @else
              <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
                <img class="lazyload blur-up" src="{{ asset('assets/frontend/images/placeholder.png') }}"
                  data-src="{{ asset('assets/img/admins/' . $admin->image) }}" alt="{{ $admin->username }}">
              </a>
            @endif
          </div>
        </div>
        
        <div class="vendor-details">
          @if ($details->vendor_id != 0)
            @if ($details->vendorInfo)
              @if ($details->vendorInfo->name != null)
                <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                  <h6 class="mb-1">{{ $details->vendorInfo->name }}</h6>
                </a>
              @else
                <a href="{{ route('frontend.vendor.details', ['username' => $details->vendor->username]) }}">
                  <h6 class="mb-1">{{ $details->vendor->username }}</h6>
                </a>
              @endif
            @endif
            @if ($details->vendor->show_phone_number == 1)
              <a href="tel:{{ $details->vendor->phone }}">{{ $details->vendor->phone }}</a>
            @endif
            @if ($details->vendor->show_email_addresss == 1)
              <a href="mailto:{{ $details->vendor->email }}">{{ $details->vendor->email }}</a>
            @endif
          @else
            <a href="{{ route('frontend.vendor.details', ['username' => $admin->username]) }}">
              <h6 class="mb-1">{{ $admin->username }}</h6>
            </a>
            <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>
          @endif
        </div>
      </div>
      
      <!-- Contact Form -->
      <form action="{{ route('frontend.services.contact.message') }}" method="post">
        @csrf
        <input type="hidden" name="vendor_id" value="{{ $details->vendor_id }}">
        <input type="hidden" name="service_id" value="{{ $details->id }}">
        
        <div class="form-group mb-20">
          <input type="text" class="form-control" placeholder="{{ __('First Name') }}*" name="first_name" required>
        </div>
        <div class="form-group mb-20">
          <input type="text" class="form-control" placeholder="{{ __('Last Name') }}" name="last_name">
        </div>
        <div class="form-group mb-20">
          <input type="email" class="form-control" placeholder="{{ __('Email Address') }}*" name="email" required>
        </div>
        <div class="form-group mb-20">
          <textarea name="message" id="message" class="form-control" cols="30" rows="8" required
            placeholder="{{ __('Message') . '*' }}..."></textarea>
        </div>

        <button class="btn btn-md w-100 btn-primary btn-gradient" type="submit">
          {{ __('Send message') }}
        </button>
      </form>
    </div>

    <!-- Business Hours Widget -->
    @if ($allDays->count() > 0)
      <div class="sidebar-widget hours-widget border p-25 radius-md mb-30">
        <h4 class="widget-title mb-20">
          {{ __('Business Days') }}
        </h4>
        <ul class="hours-list">
          @php
            $holidays = $details->vendor_id != 0 
              ? App\Models\Staff\StaffGlobalDay::where('vendor_id', $details->vendor_id)->where('is_weekend', 1)->get()
              : App\Models\Admin\AdminGlobalDay::where('is_weekend', 1)->get();
          @endphp

          @foreach ($allDays as $day)
            <li class="hours-item">
              <span>{{ __($day['day']) }}</span>
              <span>{{ $day['minTime'] }}-{{ $day['maxTime'] }}</span>
            </li>
          @endforeach
          
          @foreach ($holidays as $holiday)
            <li class="hours-item closed">
              <span>{{ __($holiday->day) }}</span>
              <span class="text-danger">{{ __('Close') }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Address Widget -->
    <div class="sidebar-widget address-widget border p-25 radius-md mb-30">
      <h4 class="widget-title mb-20">
        {{ __('Our Address') }}
      </h4>
      
      @if (!empty($details->latitude) && !empty($details->longitude))
        <div id="map" class="map-container"></div>
      @endif

      <ul class="contact-info mt-20">
        @if (!empty($service->address))
          <li class="contact-item">
            <i class="far fa-map-marker-alt"></i>
            <span>{{ $service->address }}</span>
          </li>
        @endif
        
        @if ($details->vendor_id != 0)
          @if ($details->vendor->phone != null)
            <li class="contact-item">
              <i class="far fa-headset"></i>
              <a href="tel:{{ $details->vendor->phone }}">{{ $details->vendor->phone }}</a>
            </li>
          @endif
          <li class="contact-item">
            <i class="far fa-envelope"></i>
            <a href="mailTo:{{ $details->vendor->email }}">{{ $details->vendor->email }}</a>
          </li>
        @else
          <li class="contact-item">
            <i class="far fa-envelope"></i>
            <a href="mailTo:{{ $admin->email }}">{{ $admin->email }}</a>
          </li>
        @endif
      </ul>
    </div>
    
    <div class="pb-40"></div>
  </aside>
</div>