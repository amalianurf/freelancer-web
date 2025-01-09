@extends('layouts.app')

@section('title', 'My Request')
    
@section('content')
    @if (count($orders))
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto">
                <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                    <div class="col-span-8">
                        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                            My Requests
                        </h2>
                        <p class="text-sm text-gray-400">
                            {{ auth()->user()->client_order()->count() }} Total Requests
                        </p>
                    </div>
                    <div class="col-span-4 lg:text-right"></div>
                </div>
            </div>

            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <table class="w-full" aria-label="Table">
                                <thead>
                                    <tr class="text-sm font-normal text-left text-gray-900">
                                        <th class="py-4" scope="">Freelancer Name</th>
                                        <th class="py-4" scope="">Service Details</th>
                                        <th class="py-4" scope="">Price</th>
                                        <th class="py-4" scope="">Status</th>
                                        <th class="py-4" scope="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse ($orders as $item)    
                                        <tr class="text-gray-700 border-t">
                                            <td class="px-1 py-5 text-sm w-2/8">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                                        @if ($item->freelancer_user->detail_user->photo)
                                                            <img class="object-cover w-full h-full rounded-full" src="{{ url(Storage::url($item->freelancer_user->detail_user->photo)) }}" alt="user profile" loading="lazy" />
                                                        @else
                                                            <svg class="object-cover w-full h-full rounded-full bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        @endif
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-black">{{ $item->freelancer_user->name ?? '' }}</p>
                                                        <p class="text-sm text-gray-400">{{ $item->freelancer_user->detail_user->role ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-2/6 px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                                        @if ($item->service->thumbnail[0]->thumbnail)   
                                                            <img class="object-cover w-full h-full rounded" src="{{ url(Storage::url($item->service->thumbnail[0]->thumbnail)) }}" alt="thumbnail" loading="lazy" />
                                                        @else
                                                            <img class="object-cover w-full h-full rounded" src="{{ url('https://sprungmonuments.com/wp-content/uploads/2020/04/placeholder-750x500.png') }}" alt="placeholder" loading="lazy" />
                                                        @endif
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-black">
                                                            {{ $item->service->title ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-1 py-5 text-sm">
                                                {{ 'Rp '.number_format($item->service->price) ?? '' }}
                                            </td>
                                            @if ($item->status_order_id == '1')
                                                <td class="px-1 py-5 text-sm text-green-500 text-md">{{ $item->status_order->status }}</td>
                                            @elseif ($item->status_order_id == '2')
                                                <td class="px-1 py-5 text-sm text-yellow-500 text-md">{{ $item->status_order->status }}</td>
                                            @elseif ($item->status_order_id == '3')
                                                <td class="px-1 py-5 text-sm text-blue-500 text-md">{{ $item->status_order->status }}</td>
                                            @elseif ($item->status_order_id == '4')
                                                <td class="px-1 py-5 text-sm text-red-500 text-md">{{ $item->status_order->status }}</td>
                                            @else
                                                <td class="px-1 py-5 text-sm text-black text-md">{{ $item->status_order->status }}</td>
                                            @endif
                                            <td class="px-1 py-5 text-sm">
                                                <a href="{{ route('member.request.show', $item->id) }}" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- empty --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </section>
        </main>
    @else
        <div class="flex h-screen">
            <div class="m-auto text-center">
                <img src="{{ asset('/assets/images/empty-illustration.svg') }}" alt="empty-illustration" class="w-48 mx-auto">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    There is No Request Yet
                </h2>
                <p class="text-sm text-gray-400">
                    It seems that you haven’t ordered any service. <br>
                    Let’s order your first service!
                </p>

                <div class="relative mt-0 md:mt-6">
                    <a href="{{ route('landing.explore') }}" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        Find Services
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection