@php
  $version = $basicInfo->theme_version ?? 'default';
@endphp
@extends('frontend.layout')
@section('pageHeading')
  {{ !empty($pageHeading) ? $pageHeading->appointment_page_title : __('Appointments') }}
@endsection

@section('content')
  <!-- Breadcrumb Section -->
  @if(isset($bgImg) && $bgImg->breadcrumb)
    @includeIf('frontend.partials.breadcrumb', [
        'breadcrumb' => $bgImg->breadcrumb,
        'title' => !empty($pageHeading) ? $pageHeading->appointment_page_title : __('Appointments'),
    ])
  @endif

  <!-- Dashboard-area start-->
  <div class="user-dashboard pt-100">
    <div class="container">
      <div class="row gx-xl-5">
        <div class="col-lg-3">
          @includeIf('frontend.user.side-navbar')
        </div>
        <div class="col-lg-9">
          <div class="account-info radius-md mb-40">
            <div class="title row">
              <div class="col-lg-6">
                <h4 class="mt-2">{{ __('Appointments') }}</h4>
              </div>

              <div class="col-lg-6">
                <form action="{{ route('user.appointment.index') }}" method="GET">
                  <input type="text" class="form-control search-input" name="search_appointment" placeholder="Search by Booking Number/Service Title..." value="{{ request()->input('search_appointment') ?? '' }}">
                </form>
              </div>
            </div>
            
            @if (empty($appointments) || count($appointments) == 0)
              <h6 class="text-center mt-4">{{ __('NO APPOINTMENTS FOUND') . '!' }}</h6>
            @else
              <div class="main-info">
                <div class="main-table">
                  <div class="table-responsive">
                    <table class="table table-striped w-100">
                      <thead>
                        <tr>
                          <th>{{ __('Service Title') }}</th>
                          <th>{{ __('Vendor') }}</th>
                          <th>{{ __('Appointment Date') }}</th>
                          <th>{{ __('Appointment Time') }}</th>
                          <th>{{ __('Status') }}</th>
                          <th>{{ __('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($appointments as $appointment)
                          <tr>
                            <td width="200px">
                              @if (!empty($appointment->name))
                                <a href="{{ route('frontend.service.details', ['slug' => $appointment->slug, 'id' => $appointment->service_id]) }}" target="_blank">
                                  {{ strlen($appointment->name) > 40 ? substr($appointment->name, 0, 40) . '...' : $appointment->name }}
                                </a>
                              @endif
                            </td>
                            <td>
                              @if ($appointment->vendor_id != 0 && !empty($appointment->vendor))
                                <a href="{{ route('frontend.vendor.details', ['username' => $appointment->vendor->username]) }}" target="_blank">
                                  {{ $appointment->vendor->username }}
                                </a>
                              @else
                                <a href="{{ route('frontend.vendor.details', ['username' => 'admin']) }}" target="_blank">
                                  {{ __('admin') }}
                                </a>
                              @endif
                            </td>
                            <td>{{ $appointment->booking_date ? \Carbon\Carbon::parse($appointment->booking_date)->isoFormat('Do MMMM YYYY') : '' }}</td>
                            <td>
                              {{ $appointment->start_time ?? '' }} - {{ $appointment->end_time ?? '' }}
                            </td>
                            <td>
                              @php
                                $order_bg = 'bg-secondary';
                                if (!empty($appointment->order_status)) {
                                    switch($appointment->order_status) {
                                        case 'pending':
                                            $order_bg = 'bg-warning';
                                            break;
                                        case 'processing':
                                            $order_bg = 'bg-info';
                                            break;
                                        case 'accepted':
                                            $order_bg = 'bg-success';
                                            break;
                                        case 'rejected':
                                            $order_bg = 'bg-danger';
                                            break;
                                        case 'completed':
                                            $order_bg = 'bg-primary';
                                            break;
                                    }
                                }
                              @endphp
                              <span class="badge {{ $order_bg }}">{{ !empty($appointment->order_status) ? ucfirst(__($appointment->order_status)) : '' }}</span>
                            </td>
                            <td>
                              @if(!empty($appointment->id))
                                <a href="{{ route('user.appointment.details', $appointment->id) }}" class="btn btn-sm btn-primary">
                                  <i class="fas fa-eye"></i> {{ __('Details') }}
                                </a>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif
            
            @if(!empty($appointments) && $appointments->hasPages())
              <nav class="pagination-nav pb-25" data-aos="fade-up">
                <ul class="pagination justify-content-center">
                  {{ $appointments->appends(request()->query())->links() }}
                </ul>
              </nav>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dashboard-area end -->
@endsection