@push('pagetitle', 'Dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-2">
                <div class="font-bold text-xl">Sita Geledah</div>
                <a href="{{ route('permohonan.index') }}" class="rounded-full px-2 bg-indigo-600 text-xs text-white p-1 rounded  leading-none flex items-center">
                    Detail
                </a>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fa fa-tasks fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Pengajuan Baru</h5>
                                <h3 class="font-bold text-3xl">{{ $data['new'][0] }}<span class="text-green-500"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-sync-alt fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Sedang Diproses</h5>
                                <h3 class="font-bold text-3xl">{{ $data['processed'][0] }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-check fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Jumlah Selesai</h5>
                                <h3 class="font-bold text-3xl">{{ $data['done'][0] }}<span class="text-yellow-600"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-red-600"><i class="fas fa-exclamation-circle fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Jumlah Ditolak</h5>
                                <h3 class="font-bold text-3xl">{{ $data['rejected'][0] }}<span class="text-red-500"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>
            <div class="flex space-x-2">
                <div class="font-bold text-xl">Perpanjangan Tahanan</div>
                <a href="{{ route('tahanan.index') }}" class="rounded-full px-2 bg-indigo-600 text-xs text-white p-1 rounded  leading-none flex items-center">
                    Detail
                </a>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fa fa-tasks fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Pengajuan Baru</h5>
                                <h3 class="font-bold text-3xl">{{ $data['new'][1] }}<span class="text-green-500"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-sync-alt fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Sedang Diproses</h5>
                                <h3 class="font-bold text-3xl">{{ $data['processed'][1] }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-check fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Jumlah Selesai</h5>
                                <h3 class="font-bold text-3xl">{{ $data['done'][1] }}<span class="text-yellow-600"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 px-4 py-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-red-600"><i class="fas fa-exclamation-circle fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold text-xs uppercase text-gray-600">Jumlah Ditolak</h5>
                                <h3 class="font-bold text-3xl">{{ $data['rejected'][1] }}<span class="text-red-500"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>