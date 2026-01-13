<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Service\PaymentService;
use App\Service\TransactionService;
use App\Services\PricingService;

class FrontController extends Controller
{
    public function __construct(
        PaymentService $paymentService,
        TransactionService $transactionService,
        PricingService $pricingService,
    ) {
        $this->paymentService = $paymentService;
        $this->transactionService = $transactionService;
        $this->pricingService = $pricingService;
    }

    public function index()
    {
        return view('front.index');
    }

    public function pricing()
    {
        $pricing_packages = $this->pricingService->getAllPackages();
        $user = Auth::user();

        return view('front.pricing', compact('pricing_packages', 'user'));
    }

    public function checkout(Pricing $pricing)
    {
        $checkoutData = $this->transactionService->prepareCheckout($pricing);

        if ($checkoutData['alreadySubcribed']) {
            return redirect()->route('front.pricing')->with('error', 'You are already subcribed to this plan.');
        }

        return view('front.checkout', $checkoutData);
    }

    public function paymentStoreMidtrans()
    {
        try {
            $pricingId = session()->get('pricing_id');

            if (!$pricingId) {
                return response()->join(['error' => 'No pricing data found in the session.'], 400);
            }

            $snapToken = $this->paymentService->createPayment($pricingId);

            if (!$snapToken) {
                return response()->json(['error' => 'Failed to create Midtrans transaction.'], 500);
            }

            return response()->json(['snap_token' => $snapToken], 200);
        } catch (\Exeption $e) {
            return response()->json(['error' => 'Payment failed: '.$e->getMessage()], 500);
        }
    }

    public function paymentMidtransNotification(Request $request)
    {
        try {
            $transactionStatus = $this->paymentService->handlePaymentNotification();

            if (!$transactionStatus) {
                return response()->json(['error' => 'Invalid notification data.'], 400);
            }

            return response()->json(['status' => $transactionStatus]);
        } catch (\Exeption $e) {
            Log::error('Failed to handle Midtrans notification:', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Failed to process notification.'], 500);
        }
    }

    public function checkout_success()
    {
        $pricing = $this->transactionService->getRecentPricing();

        if (!$pricing) {
            return redirect()->route('front.pricing')->with('error', 'No recent subcription found.');
        }

        return view('front.checkout_success', compact('pricing'));
    }
}
