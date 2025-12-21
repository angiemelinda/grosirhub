@extends('layouts.admin')

@section('title', 'Supplier')
@section('header', 'Supplier')

@section('content')
<div class="bg-white shadow rounded-lg p-5 overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-orange-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @php
                $suppliers = [
                    ['name'=>'Supplier A','email'=>'supplierA@example.com','phone'=>'08123456789','active'=>true],
                    ['name'=>'Supplier B','email'=>'supplierB@example.com','phone'=>'08198765432','active'=>false],
                    ['name'=>'Supplier C','email'=>'supplierC@example.com','phone'=>'08111222333','active'=>true],
                ];
            @endphp
            @foreach($suppliers as $s)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s['name'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s['email'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s['phone'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($s['active'])
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 text-sm text-gray-500">Data contoh untuk tampilan.</div>
@endsection

