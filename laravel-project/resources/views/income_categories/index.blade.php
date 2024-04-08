@extends('layouts.header')

@section('title', '収入カテゴリー一覧')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
 <h1 class="text-xl font-bold text-blue-800 mb-4">カテゴリ一覧</h1>
 <div class="mb-4 flex justify-end">
  <a href="{{ route('income_categories.create') }}"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
   新しいカテゴリを追加
  </a>
 </div>
 <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
  <table class="min-w-full">
   <thead class="bg-blue-200">
    <tr>
     <th class="py-3 px-6 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
      カテゴリ名
     </th>
     <th class="py-3 px-6 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">
      操作
     </th>
    </tr>
   </thead>
   <tbody class="bg-white divide-y divide-gray-200">
    @foreach ($incomeCategories as $category)
    <tr>
     <td class="py-4 px-6 whitespace-nowrap">
      {{ $category->name }}
     </td>
     <td class="py-4 px-6 whitespace-nowrap">
      <a href="{{ route('income_categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900">
       編集
      </a>
      <form action="{{ route('income_categories.destroy', $category->id) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('削除してもよろしいですか？');">
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