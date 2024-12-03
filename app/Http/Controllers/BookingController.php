<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\BookingTransaction;
use App\Models\WorkshopParticipant;
use App\Models\Workshop;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function booking(Workshop $workshop){
        return view('booking.booking', compact('workshop'));
    }

    public function bookingStore(StoreBookingRequest $request, Workshop $workshop)
    {
        $validated = $request->validated();
        $validated ['workshop_id'] = $workshop->id;

        try {
            $this->bookingService->storeBooking($validated);
            return redirect()->route('front.payment');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create booking. Please try again.']);
        }
    }

    public function payment ()
    {
        if (!$this->bookingService->isBookingSessionAvailable()) {
            return redirect()->route('front.index');

            }

            $data = $this->bookingService->getBookingDetails();

            if (!$data) {
            return redirect()->route('front.index');
            }

            return view('booking.payment', $data);
    }

    public function paymentStore(StorePaymentRequest $request)
    {
        $validated = $request->validated();

        try {
            $bookingTransactionId = $this->bookingService->finalizeBookingAndPayment($validated);
            return redirect()->route('front.booking_finished', $bookingTransactionId);
        } catch (\Exception $e) {
            Log :: error('Payment storage failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Unable to store payment details. Please try again.' . $e->getMessage
            ()]);
        }
    }

    public function bookingFinished(BookingTransaction $bookingTransaction)
    {

    return view('booking.booking_finished', compact('bookingTransaction'));
    }

    public function checkBooking(){
        return view('booking.my_booking');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();
        $myBookingDetails = $this->bookingService->getMyBookingDetails($validated);
        if ($myBookingDetails) {
            $participants = WorkshopParticipant::where('booking_transaction_id', $myBookingDetails->id)->get();
            $workshop = $myBookingDetails->workshop;

            // Mengambil jumlah (quantity) yang dipesan
            $quantity = isset($orderData['quantity']) ? $orderData['quantity'] : 1;

            // Menghitung subTotalAmount
            $subTotalAmount = $workshop->price * $quantity;

            // Mengambil rate pajak dari workshop, jika ada
            $taxRate = $workshop->tax_rate ?? 0.11; // Default tax 11% jika tidak ada di workshop
            $totalTax = $subTotalAmount * $taxRate;

            // Menghitung totalAmount
            $totalAmount = $subTotalAmount + $totalTax;

            // Menyimpan hasil perhitungan ke dalam $orderData
            $orderData['sub_total_amount'] = $subTotalAmount;
            $orderData['total_tax'] = $totalTax;
            $orderData['total_amount'] = $totalAmount;

            
            return view('booking.my_booking_details', compact('myBookingDetails','participants','workshop','orderData'));
        }
        return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaction not found']);
       
    }

}
