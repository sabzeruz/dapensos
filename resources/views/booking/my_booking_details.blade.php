@extends('layouts.app')
@section('title','My Booking Details')
@section('content')
{{-- myBookingDetails --}}

<div id="background" class="relative w-full">
    <div class="absolute w-full h-[300px] bg-[linear-gradient(0deg,#4EB6F5_0%,#5B8CE9_100%)] -z-10"></div>
</div>
<section id="Content" class="w-full max-w-[1280px] mx-auto px-[52px] mt-16 mb-[100px]">
    <div class="flex flex-col gap-16">
        <div class="flex flex-col items-center gap-1">
            <p class="font-bold text-[32px] leading-[48px] capitalize text-white">Your workshop booking</p>
            <p class="font-semibold text-white">happy Learning~</p>
        </div>
        <main class="flex gap-8">
            <section id="Sidebar" class="group flex flex-col w-[420px] rounded-3xl p-8 bg-white"> 
                <div class="flex flex-col gap-4">
                    <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Workshop Details</h2>
                    <div class="thumbnail-container relative rounded-xl bg-[#D9D9D9] overflow-hidden">
                        <img src="{{Storage::url($workshop->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                    </div>
                    <div class="card-detail flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <img src="{{asset('assets/images/icons/calendar-2.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <span class="font-medium text-aktiv-grey">
                                    {{$workshop->started_at->format('M d, Y')}}
                                </span>
                            </div>
                            <div class="flex items-center gap-1">
                                <img src="{{asset('assets/images/icons/timer.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <span class="font-medium text-aktiv-grey">
                                    {{$workshop->time_at->format('h:i A')}} - Finish
                                </span>
                            </div>
                        </div>
                        <h3 class="font-Neue-Plak-bold text-xl">
                            {{$workshop->name}}
                        </h3>
                    </div>
                </div>
                <div id="closes-section" class="accordion flex flex-col gap-8 transition-all duration-300 mt-8 group-has-[:checked]:mt-0 group-has-[:checked]:!h-0 overflow-y-scroll">
                    <div class="flex flex-col gap-4">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Instructor Details</h2>
                        <div class="flex items-center gap-3 rounded-xl border border-[#E6E7EB] p-4">
                            <div class="flex w-16 h-16 shrink-0 rounded-full overflow-hidden bg-[#D9D9D9]">
                                <img src="{{Storage::url($workshop->instructor->avatar)}}" class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col gap-[2px] flex-1">
                                <p class="font-semibold text-lg leading-[27px]">
                                    {{$workshop->instructor->name}}
                                </p>
                                <p class="font-medium text-aktiv-grey">
                                    {{$workshop->instructor->occupation}}
                                </p>
                            </div>
                            <img src="{{asset('assets/images/icons/verify.svg')}}" class="flex w-[62px] h-[62px] shrink-0" alt="icon">
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">This workshop will teach</h2>
                        <div class="flex flex-col gap-6">
                            @forelse ($workshop->benefits as $itemBenefit)
                            <div class="flex items-center gap-2">
                                <img src="{{asset('assets/images/icons/tick-circle.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="font-semibold text-lg leading-[27px]">
                                    {{$itemBenefit->name}}
                                </p>
                            </div>
                            @empty
                            <p>belum ada benefits</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Location Details</h2>
                        <div class="flex flex-col gap-4 rounded-xl border border-[#E6E7EB] p-5 pb-[21px]">
                            <div class="flex w-full h-[180px] rounded-xl overflow-hidden">
                                <img src="{{Storage::url($workshop->venue_thumbnail)}}" class="w-full h-full object-cover" alt="location">
                            </div>
                            <div class="flex flex-col gap-3">
                                <p class="font-medium leading-[25.6px] text-aktiv-grey">
                                    {{$workshop->address}}
                                </p>
                                <a href="https://www.google.com/maps/place/{{$workshop->address}}" class="font-semibold text-aktiv-orange">View in Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <label class="group mt-8">
                    <input type="checkbox" class="hidden">
                    <p class="before:content-['Show_Less'] group-has-[:checked]:before:content-['Show_More'] before:font-semibold before:text-lg before:leading-[27px] flex items-center justify-center gap-[6px]">
                        <img src="{{asset('assets/images/icons/arrow-up.svg')}}" class="w-6 h-6 group-has-[:checked]:rotate-180 transition-all duration-300" alt="icon">
                    </p>
                </label> --}}
            </section>
           
            <div class="flex flex-col w-[724px] h-gap-8">
                @if ($myBookingDetails->is_paid == 0)
                <div class="flex flex-col rounded-3xl bg-white overflow-hidden">
                    <div class="flex items-center p-8 gap-4 bg-[#FDF6E4]">
                        <img src="{{asset('assets/images/icons/wallet-time.svg')}}" class="w-[74px] h-[74px] flex shrink-0" alt="icon">
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-lg leading-[27px]">Status Payment Pending!</p>
                            <p class="font-medium text-lg leading-[27px] text-[#B4A476]">Your order is pending. Please wait a few minutes for review.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 p-8">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Booking Details</h2>
                        <div class="flex flex-col rounded-xl border border-[#E6E7EB] p-6 gap-4">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Booking ID</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    {{$myBookingDetails->booking_trx_id}}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Quantity</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    {{$myBookingDetails->quantity}}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Price</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    Rp {{number_format($myBookingDetails->workshop->price, 0, ',', '.')}}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">PPN 11%</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    Rp {{number_format($orderData['total_tax'], 0, ',', '.')}}
                                </p>
                            </div>
                            <hr class="border-[#E6E7EB]">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Total Price</p>
                                <p class="font-semibold text-lg leading-[27px] text-right text-aktiv-red">
                                    Rp {{number_format($myBookingDetails->total_amount, 0, ',', '.')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif  ($myBookingDetails->is_paid == 1)
                <div class="flex flex-col rounded-3xl bg-white overflow-hidden">
                    <div class="flex items-center p-8 gap-4 bg-[#D4EAE8]">
                        <img src="{{asset('assets/images/icons/wallet-check.svg')}}" class="w-[74px] h-[74px] flex shrink-0" alt="icon">
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-lg leading-[27px]">Status Payment Success!</p>
                            <p class="font-medium text-lg leading-[27px] text-[#58938E]">Your order is confirmed. We appreciate your patience.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 p-8">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Booking Details</h2>
                        <div class="flex flex-col rounded-xl border border-[#E6E7EB] p-6 gap-4">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Booking ID</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">{{$myBookingDetails->booking_trx_id}}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Quantity</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    {{$myBookingDetails->quantity}}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Price</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    Rp {{number_format($myBookingDetails->workshop->price, 0, ',', '.')}}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">PPN 11%</p>
                                <p class="font-semibold text-lg leading-[27px] text-right">
                                    
                                    Rp {{number_format($orderData['total_tax'], 0, ',', '.')}}
                                </p>
                            </div>
                            <hr class="border-[#E6E7EB]">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-aktiv-grey">Total Price</p>
                                <p class="font-semibold text-lg leading-[27px] text-right text-aktiv-red">
                                    Rp {{number_format($myBookingDetails->total_amount, 0, ',', '.')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex flex-col rounded-3xl p-8 gap-4 bg-white">
                    <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Your Bank Account</h2>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-4">
                            <p class="font-medium text-aktiv-grey">
                                {{$myBookingDetails->customer_bank_account}}
                            </p>
                            <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB] overflow-hidden">
                                <img src="{{asset('assets/images/icons/bank-black.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="font-semibold text-lg leading-[27px]">
                                    {{$myBookingDetails->customer_bank_name}}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <p class="font-medium text-aktiv-grey">Full Name</p>
                            <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB] overflow-hidden">
                                <img src="{{asset('assets/images/icons/profile-circle-black.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="font-semibold text-lg leading-[27px]">{{$myBookingDetails->name}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <p class="font-medium text-aktiv-grey">Bank account number</p>
                            <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB] overflow-hidden">
                                <img src="{{asset('assets/images/icons/card-edit-black.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <p class="font-semibold text-lg leading-[27px]">
                                    {{$myBookingDetails->customer_bank_number}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- resources/views/check-booking/details.blade.php -->
                <div class="flex flex-col rounded-3xl p-8 gap-8 bg-white">
                    <div class="flex flex-col gap-4">
                        <h2 class="font-Neue-Plak-bold text-xl leading-[27.5px]">Attendants Details</h2>
                        <div class="flex flex-col gap-6">
                            @foreach ($participants as $index => $participant)
                                <div class="attendant-wrapper flex flex-col gap-[10px]">
                                    <div id="Attendant {{ $index + 1 }}" class="group/accordion peer flex flex-col rounded-2xl border border-[#E6E7EB] p-6">
                                        <label class="flex items-center justify-between">
                                            <p class="font-semibold text-lg leading-[27px]">Attendant Ke - {{ $index + 1 }}</p>
                                            <input type="checkbox" name="accodion" class="hidden">
                                            <img src="{{ asset('assets/images/icons/arrow-square-up.svg') }}" class="w-6 h-6 transition-all duration-300 group-has-[:checked]/accordion:rotate-180" alt="icon">
                                        </label>
                                        <div class="accordion flex flex-col gap-6 mt-6 transition-all duration-300 group-has-[:checked]/accordion:!h-0 group-has-[:checked]/accordion:mt-0 overflow-y-hidden">
                                            <hr class="border-[#E6E7EB]">
                                            <div class="flex flex-col gap-4">
                                                <p class="font-medium text-aktiv-grey">Full Name</p>
                                                <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB] overflow-hidden">
                                                    <img src="{{ asset('assets/images/icons/profile-circle-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                                    <p class="font-medium text-lg leading-[27px]">{{ $participant->name }}</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <p class="font-medium text-aktiv-grey">Occupation</p>
                                                <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB] overflow-y-scroll">
                                                    <img src="{{ asset('assets/images/icons/briefcase-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                                    <p class="font-medium text-lg leading-[27px]">{{ $participant->occupation }}</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <p class="font-medium text-aktiv-grey">Email Address</p>
                                                <div class="input-wrapper flex items-center rounded-xl p-4 gap-2 bg-[#FBFBFB]">
                                                    <img src="{{ asset('assets/images/icons/sms-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                                    <p class="font-medium text-lg leading-[27px]">{{ $participant->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</section>
@endsection

<script src="{{asset('js/filament/accodion.js')}}"></script>