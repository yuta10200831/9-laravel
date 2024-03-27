@extends('layouts.header')

@section('title', '収入源一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h1 class="text-2xl font-semibold mb-4 text-center text-blue-800">収入源一覧</h1>
 <div class="text-right mb-4">
  <a href="{{ route('income_sources.create') }}"
   class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-200">
   収入源を追加する
  </a>
 </div>

 <div class="shadow overflow-hidden rounded border-b border-gray-200">
  <table class="min-w-full bg-white">
   <thead class="bg-blue-500 text-white">
    <tr>
     <th class="text-left py-3 px-4 uppercase font-semibold text-sm">収入源名</th>
     <th class="text-left py-3 px-4 uppercase font-semibold text-sm">編集</th>
     <th class="text-left py-3 px-4 uppercase font-semibold text-sm">削除</th>
    </tr>
   </thead>
   <tbody class="text-gray-700">
    @foreach ($incomeSources as $incomeSource)
    <tr>
     <td class="text-left py-3 px-4">{{ $incomeSource->name }}</td>
     <td class="text-left py-3 px-4">
      <a href="{{ route('income_sources.edit', $incomeSource) }}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded transition-colors duration-200 inline-block">
       編集
      </a>
      <form action="{{ route('income_sources.destroy', $incomeSource) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition-colors duration-200"
        onclick="return confirm('この収入源を削除してもよろしいですか？');">
        削除
       </button>
      </form>
     </td>
    </tr>
    @endforeach
   </tbody>
  </table>
 </div>
</div>
@endsection