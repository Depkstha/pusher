<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data x-init="Echo.private('App.Models.User.{{ auth()->id() }}')
                    .notification((notification) => {
                        console.log('Hello');
                        notifyMe(notification);
                    })

                window.notifyMe = (data) => {
                    if (!('Notification' in window)) {
                        alert('This browser does not support desktop notification');
                    } else if (Notification.permission === 'granted') {
                        createNotification(data);
                    } else if (Notification.permission !== 'denied') {
                        Notification.requestPermission().then((permission) => {
                            if (permission === 'granted') {
                                createNotification(data);
                            }
                        });
                    }
                };

                function createNotification(data) {
                    const notification = new Notification(data.title, {
                        body: data.content,
                        icon: 'https://th.bing.com/th/id/OIP.EhTMbGiYfYzQnWLgjZaoJAHaHa?rs=1&pid=ImgDetMain',
                        vibrate: [100, 50, 100],
                    });
                }">
                    <p class="mb-5">{{ __("You're logged in!") }}</p>

                    <table class="border-seperate border border-slate-500">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">Title</th>
                                <th class="border border-slate-600">Content</th>
                                <th class="border border-slate-600">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                @php
                                    $data = fluent($notification->data);
                                @endphp
                                <tr>
                                    <td class="border border-slate-700">{{ $data->title }}</td>
                                    <td class="border border-slate-700">{{ $data->content }}</td>
                                    <td class="border border-slate-700">{{ $notification->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="notifyMe({title: 'Hello', content: 'World'})">Send Notification</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
