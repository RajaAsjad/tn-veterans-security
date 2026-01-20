<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::with(['booking.service', 'customer']);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by payment type
        if ($request->has('payment_type') && $request->payment_type) {
            $query->where('payment_type', $request->payment_type);
        }
        
        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Filter by QuickBooks sync status
        if ($request->has('quickbooks_synced') && $request->quickbooks_synced !== '') {
            $query->where('synced_to_quickbooks', $request->quickbooks_synced);
        }
        
        $payments = $query->orderBy('payment_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Calculate totals
        $totalAmount = Payment::where('status', 'completed')->sum('amount');
        $pendingAmount = Payment::where('status', 'pending')->sum('amount');
        $todayAmount = Payment::whereDate('payment_date', today())
            ->where('status', 'completed')
            ->sum('amount');
        
        return view('admin.payments.index', compact('payments', 'totalAmount', 'pendingAmount', 'todayAmount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load(['booking.service', 'customer', 'booking.classSchedule']);
        return view('admin.payments.show', compact('payment'));
    }
}
