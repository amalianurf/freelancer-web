@extends('layouts.app')

@section('title', 'My Order')
    
@section('content')
    @if (count($orders))
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto">
                <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                    <div class="col-span-8">
                        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                            My Orders
                        </h2>
                        <p class="text-sm text-gray-400">
                            {{ auth()->user()->freelancer_order()->count() }} Total Orders
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
                                        <th class="py-4" scope="">Buyers Name</th>
                                        <th class="py-4" scope="">Service Details</th>
                                        <th class="py-4" scope="">Expires</th>
                                        <th class="py-4" scope="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse ($orders as $item)
                                        <tr class="text-gray-700 border-t">
                                            <td class="px-1 py-5 text-sm w-2/8">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                                        @if ($item->client_user->detail_user->photo)
                                                            <img class="object-cover w-full h-full rounded-full" src="{{ url(Storage::url($item->client_user->detail_user->photo)) }}" alt="user profile" loading="lazy" />
                                                        @else
                                                            <svg class="object-cover w-full h-full rounded-full bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        @endif
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-black">{{ $item->client_user->name ?? '' }}</p>
                                                        <p class="text-sm text-gray-400">{{ $item->client_user->detail_user->role ?? '' }}</p>
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
                                                        <a href="{{ route('member.service.show', $item->service->id) }}" class="font-medium text-black">
                                                            {{ $item->service->title ?? '' }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-1 py-5 text-xs text-red-500">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline mb-1">
                                                    <path d="M7.0002 12.8332C10.2219 12.8332 12.8335 10.2215 12.8335 6.99984C12.8335 3.77818 10.2219 1.1665 7.0002 1.1665C3.77854 1.1665 1.16687 3.77818 1.16687 6.99984C1.16687 10.2215 3.77854 12.8332 7.0002 12.8332Z" stroke="#F26E6E" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7 3.5V7L9.33333 8.16667" stroke="#F26E6E" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                @if ($item->status_order_id == '1')
                                                    completed
                                                @elseif ($item->status_order_id == '4')
                                                    rejected
                                                @elseif (((strtotime($item->expired) - strtotime(date('Y-m-d'))) / 86400) < 0)
                                                    {{ (strtotime(date('Y-m-d')) - strtotime($item->expired)) / 86400 ?? '' }} days overdue
                                                @else
                                                    {{ (strtotime($item->expired) - strtotime(date('Y-m-d'))) / 86400 ?? '' }} days left
                                                @endif
                                            </td>
                                            <td class="px-1 py-5 text-sm">
                                                @if ($item->status_order_id == '2')
                                                    <a href="{{ route('member.accept.order', $item->id) }}" class="px-4 py-2 mt-2 mr-2 text-center text-white rounded-xl bg-serv-email">
                                                        Accept
                                                    </a>
                                                    <a href="{{ route('member.reject.order', $item->id) }}" class="px-4 py-2 mt-2 text-center text-white rounded-xl bg-serv-email">
                                                        Reject
                                                    </a>
                                                @elseif ($item->status_order_id == '3')
                                                    <a href="{{ route('member.service.show', $item->service->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-email">
                                                        Details
                                                    </a>
                                                    <a href="{{ route('member.order.edit', $item->id) }}" class="px-4 py-2 mt-2 text-center text-white rounded-xl bg-serv-email">
                                                        Submit
                                                    </a>
                                                @else
                                                    <a href="{{ route('member.service.show', $item->service->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-email">
                                                        Details
                                                    </a>
                                                    <a class="px-4 py-2 mt-1 text-center text-black">
                                                        {{ $item->status_order_id == '1' ? 'Accepted' : 'Rejected' }}
                                                    </a>
                                                @endif
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
                    There is No Order Yet
                </h2>
                <p class="text-sm text-gray-400">
                    It seems that you haven’t any client yet. <br>
                    Let’s create or promote your service to get your first client!
                </p>
            </div>
        </div>
    @endif
@endsection