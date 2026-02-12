@extends('customer.layouts.master')

@section('title', 'Payment - Booking #' . $booking->id)

@if(!empty($squareEnabled) && $squareEnabled)
@push('head')
<script src="{{ $squareScriptUrl ?? 'https://sandbox.web.squarecdn.com/v1/square.js' }}" type="text/javascript"></script>
@endpush
@endif

@section('content')
<div class="mb-6">
    <a href="{{ route('customer.bookings.show', $booking->id) }}" class="text-blue-600 hover:underline inline-flex items-center gap-2 mb-4">
        <i class="fas fa-arrow-left"></i> Back to Booking Details
    </a>
</div>

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete Deposit Payment</h1>
    <p class="text-gray-600">Booking #{{ $booking->id }} - {{ $booking->service->title }}</p>
</div>

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Payment Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Payment Details</h2>
            
            <form method="POST" action="{{ route('customer.booking.payment.process', $booking->id) }}">
                @csrf
                
                <!-- Payment Amount -->
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-6 mb-6">
                    <div class="text-center">
                        <div class="text-sm text-gray-600 mb-2">Deposit Amount</div>
                        <div class="text-4xl font-bold text-gray-900">${{ number_format($booking->deposit_amount, 2) }}</div>
                        <div class="text-sm text-gray-500 mt-2">
                            Total: ${{ number_format($booking->total_amount, 2) }} | 
                            Remaining: ${{ number_format($booking->remaining_amount, 2) }}
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-3">
                        Payment Method <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="credit_card" 
                                   required
                                   class="mr-3 payment-method-radio"
                                   data-method="credit_card"
                                   {{ old('payment_method') === 'credit_card' ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">Credit/Debit Card</div>
                                <div class="text-sm text-gray-500">Pay securely with card {{ !empty($squareEnabled) && $squareEnabled ? '(Square)' : '' }}</div>
                            </div>
                            <i class="fas fa-credit-card text-gray-400 text-xl"></i>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="bank_transfer" 
                                   required
                                   class="mr-3 payment-method-radio"
                                   data-method="bank_transfer"
                                   {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">Bank Transfer</div>
                                <div class="text-sm text-gray-500">Transfer directly from your bank</div>
                            </div>
                            <i class="fas fa-university text-gray-400 text-xl"></i>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="cash" 
                                   required
                                   class="mr-3 payment-method-radio"
                                   data-method="cash"
                                   {{ old('payment_method') === 'cash' ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">Cash Payment</div>
                                <div class="text-sm text-gray-500">Pay in person or by appointment</div>
                            </div>
                            <i class="fas fa-money-bill-wave text-gray-400 text-xl"></i>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Square Card Form (when Square enabled and Credit Card selected) -->
                @php $squareChargeAmount = ($booking->deposit_amount > 0) ? $booking->deposit_amount : $booking->total_amount; @endphp
                @if(!empty($squareEnabled) && $squareEnabled && !empty($squareAppId) && !empty($squareLocationId) && $squareChargeAmount > 0)
                <div class="mb-6" id="square-card-container" style="display: none;">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Card Details</label>
                    <div id="card-container" class="border border-gray-300 rounded-lg p-4 bg-gray-50 min-h-[120px]"></div>
                    <div id="card-errors" class="text-red-500 text-sm mt-2" role="alert"></div>
                    <form id="square-payment-form" method="POST" action="{{ route('customer.booking.payment.square', $booking->id) }}" style="display: none;">
                        @csrf
                        <input type="hidden" name="nonce" id="card-nonce">
                    </form>
                </div>
                @endif

                <!-- Transaction ID (Optional for card/transfer when Square NOT used) -->
                <div class="mb-6" id="transaction-id-field" style="display: none;">
                    <label for="transaction_id" class="block text-gray-700 text-sm font-bold mb-2">
                        Transaction ID / Reference Number
                    </label>
                    <input type="text" 
                           id="transaction_id" 
                           name="transaction_id" 
                           value="{{ old('transaction_id') }}"
                           placeholder="Enter transaction ID if available"
                           maxlength="255"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Optional: Provide transaction ID for bank transfers or card payments</p>
                    @error('transaction_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Booking Summary -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Booking Summary</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->service->title }}</span>
                        </div>
                        @if($booking->classSchedule)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Class Date:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->classSchedule->class_date->format('F d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Class Time:</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->classSchedule->start_time)->format('h:i A') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Number of Students:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->number_of_students ?? 1 }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div id="submit-regular">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-lock mr-2"></i> Pay Deposit & Confirm Booking
                    </button>
                </div>
                @if(!empty($squareEnabled) && $squareEnabled && !empty($squareAppId) && !empty($squareLocationId) && $squareChargeAmount > 0)
                <div id="submit-square" style="display: none;">
                    <button type="button" id="square-pay-btn" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-lock mr-2"></i> Pay ${{ number_format($squareChargeAmount, 2) }} with Card
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
    
    <!-- Payment Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Payment Summary</h3>
            
            <div class="space-y-3 mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-semibold text-gray-900">${{ number_format($booking->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Deposit Amount:</span>
                    <span class="font-bold text-green-600">${{ number_format($booking->deposit_amount, 2) }}</span>
                </div>
                <div class="border-t pt-3">
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-semibold">Remaining Balance:</span>
                        <span class="font-bold text-gray-900">${{ number_format($booking->remaining_amount, 2) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded p-4 mb-4">
                <p class="text-xs text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>
                    Your booking will be confirmed once the deposit payment is processed.
                </p>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                <p class="text-xs text-yellow-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    <strong>Note:</strong> For cash payments, please contact us to arrange payment and confirmation.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const transactionIdField = document.getElementById('transaction-id-field');
    const squareCardContainer = document.getElementById('square-card-container');
    const submitRegular = document.getElementById('submit-regular');
    const submitSquare = document.getElementById('submit-square');
    const squareEnabled = {{ (!empty($squareEnabled) && $squareEnabled && !empty($squareAppId) && !empty($squareLocationId) && ($squareChargeAmount ?? 0) > 0) ? 'true' : 'false' }};

    function updatePaymentUI() {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (!selected) return;

        if (squareEnabled && selected.value === 'credit_card') {
            if (transactionIdField) transactionIdField.style.display = 'none';
            if (squareCardContainer) squareCardContainer.style.display = 'block';
            if (submitRegular) submitRegular.style.display = 'none';
            if (submitSquare) submitSquare.style.display = 'block';
        } else {
            if (squareCardContainer) squareCardContainer.style.display = 'none';
            if (submitSquare) submitSquare.style.display = 'none';
            if (submitRegular) submitRegular.style.display = 'block';
            if (transactionIdField) {
                transactionIdField.style.display = (selected.value === 'credit_card' || selected.value === 'bank_transfer') ? 'block' : 'none';
            }
        }
    }

    paymentMethods.forEach(radio => {
        radio.addEventListener('change', updatePaymentUI);
    });
    updatePaymentUI();
});
</script>
@if(!empty($squareEnabled) && $squareEnabled && !empty($squareAppId) && !empty($squareLocationId) && ($squareChargeAmount ?? 0) > 0)
<script>
document.addEventListener('DOMContentLoaded', async function() {
    if (typeof Square === 'undefined') return;
    const appId = '{{ $squareAppId }}';
    const locationId = '{{ $squareLocationId }}';
    const payments = Square.payments(appId, locationId);
    let card;

    try {
        card = await payments.card();
        await card.attach('#card-container');
    } catch (e) {
        console.error('Square card init error:', e);
        document.getElementById('card-errors').textContent = 'Unable to load payment form. Please refresh the page.';
        return;
    }

    document.getElementById('square-pay-btn')?.addEventListener('click', async function() {
        const btn = this;
        const errorsEl = document.getElementById('card-errors');
        errorsEl.textContent = '';
        btn.disabled = true;
        btn.textContent = 'Processing...';

        try {
            const result = await card.tokenize();
            if (result.status === 'OK') {
                document.getElementById('card-nonce').value = result.token;
                document.getElementById('square-payment-form').submit();
            } else {
                errorsEl.textContent = result.errors?.length ? result.errors[0].message : 'Tokenization failed.';
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-lock mr-2"></i> Pay ${{ number_format($squareChargeAmount ?? $booking->deposit_amount, 2) }} with Card';
            }
        } catch (e) {
            errorsEl.textContent = e.message || 'An error occurred. Please try again.';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-lock mr-2"></i> Pay ${{ number_format($booking->deposit_amount, 2) }} with Card';
        }
    });
});
</script>
@endif
@endsection
