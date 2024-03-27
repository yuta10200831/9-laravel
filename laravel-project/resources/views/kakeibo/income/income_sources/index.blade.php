@extends('layouts.header')

@section('title', '収入源一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800 text-center">収入源一覧</h2>
 <div class="mb-4 text-right">
  <a href="{{ route('income_sources.create') }}"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">収入源を追加する</a>
 </div>
 <table class="table-auto w-full">
  <thead class="bg-blue-200">
   <tr>
    <th class="px-4 py-2 text-left">収入源名</th>
    <th class="px-4 py-2 text-left">操作</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($incomeSources as $incomeSource)
   <tr>
    <td class="border px-4 py-2">{{ $incomeSource->name }}</td>
    <td class="border px-4 py-2">
     <a href="{{ route('income_sources.edit', $incomeSource) }}" class="text-blue-600 hover:text-blue-900">編集</a>
     <form action="{{ route('income_sources.destroy', $incomeSource) }}" method="POST" class="inline-block">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-red-600 hover:text-red-900 ml-2"
       onclick="return confirm('この収入源を削除してもよろしいですか？');">削除</button>
     </form>
    </td>
   </tr>
   @endforeach
  </tbody>
 </table>
</div>
@endsection