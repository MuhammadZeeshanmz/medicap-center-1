<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code }}" @if($currentLanguageInfo->direction == 1) dir="rtl" @endif>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ 'Service Booking Invoice | ' . config('app.name') }}</title>
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}">
  
  <style>
    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      font-family: Arial, sans-serif;
    }
    .invoice-header {
      margin-bottom: 35px;
      text-align: center;
    }
    .invoice-logo {
      max-width: 180px;
      margin: 0 auto;
    }
    .invoice-title {
      background-color: #007bff;
      color: white;
      padding: 10px 0;
      text-align: center;
      margin-bottom: 30px;
    }
    .invoice-section {
      width: 48%;
      margin-bottom: 20px;
    }
    .float-left {
      float: left;
    }
    .float-right {
      float: right;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
    .invoice-details p {
      margin-bottom: 8px;
    }
    @if($currentLanguageInfo->direction == 1)
      .float-left { float: right !important; }
      .float-right { float: left !important; }
    @endif
  </style>
</head>

<body>
  <div class="invoice-container">
    <!-- Logo -->
    <div class="invoice-header">
      <img class="invoice-logo" src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Company Logo">
    </div>

    <!-- Title -->
    <div class="invoice-title">
      <h2>{{ __('SERVICE BOOKING INVOICE') }}</h2>
    </div>

    @php
      $position = $orderInfo->currency_text_position;
      $currency = $orderInfo->currency_text;
    @endphp

    <div class="clearfix">
      <!-- Appointment Details -->
      <div class="invoice-section float-left">
        <div class="invoice-details">
          <h4><strong>{{ __('Appointment Details') }}</strong></h4>
          
          @php
            $serviceInfo = App\Models\Services\ServiceContent::where('service_id', $orderInfo->service_id)
                          ->select('name', 'address')
                          ->first();
          @endphp
          
          <p><strong>{{ __('Booking No') }}:</strong> #{{ $orderInfo->order_number }}</p>
          <p><strong>{{ __('Service Title') }}:</strong> {{ truncateString($serviceInfo->name, 25) }}</p>
          <p><strong>{{ __('Booking Date') }}:</strong> {{ \Carbon\Carbon::parse($orderInfo->created_at)->format('M d, Y') }}</p>
          <p><strong>{{ __('Appointment Date') }}:</strong> {{ \Carbon\Carbon::parse($orderInfo->booking_date)->format('M d, Y') }}</p>
          <p><strong>{{ __('Appointment Time') }}:</strong> {{ $orderInfo->start_date }} - {{ $orderInfo->end_date }}</p>
          
          @if(!empty($serviceInfo->address))
            <p><strong>{{ __('Location') }}:</strong> {{ $serviceInfo->address }}</p>
          @endif
          
          <p><strong>{{ __('Price') }}:</strong> 
            {{ $position == 'left' ? $currency . ' ' : '' }}
            {{ number_format($orderInfo->customer_paid, 2) }}
            {{ $position == 'right' ? ' ' . $currency : '' }}
          </p>
          
          <p><strong>{{ __('Payment Method') }}:</strong> {{ $orderInfo->payment_method }}</p>
          <p><strong>{{ __('Payment Status') }}:</strong> {{ ucfirst($orderInfo->payment_status) }}</p>
          <p><strong>{{ __('Order Status') }}:</strong> {{ ucfirst($orderInfo->order_status) }}</p>
        </div>
      </div>

      <!-- Billing Details -->
      <div class="invoice-section float-right">
        <div class="invoice-details">
          <h4><strong>{{ __('Billing Details') }}</strong></h4>
          
          <p><strong>{{ __('Name') }}:</strong> {{ $orderInfo->customer_name }}</p>
          <p><strong>{{ __('Email') }}:</strong> {{ $orderInfo->customer_email }}</p>
          <p><strong>{{ __('Contact Number') }}:</strong> {{ $orderInfo->customer_phone }}</p>
          <p><strong>{{ __('Address') }}:</strong> {{ $orderInfo->customer_address }}</p>
          
          @if($orderInfo->customer_zip_code != null)
            <p><strong>{{ __('Zip Code') }}:</strong> {{ $orderInfo->customer_zip_code }}</p>
          @endif
          
          <p><strong>{{ __('Country') }}:</strong> {{ $orderInfo->customer_country }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Image Loading Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Preload logo image
      const logo = new Image();
      logo.src = "{{ asset('assets/img/' . $websiteInfo->logo) }}";
      
      // Preload favicon
      const favicon = new Image();
      favicon.src = "{{ asset('assets/img/' . $websiteInfo->favicon) }}";
    });
  </script>
</body>
</html>