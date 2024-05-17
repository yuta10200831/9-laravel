@extends('layouts.header')

@section('title', '支出一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800">支出一覧</h2>
 <div class="mb-4">
  <p class="text-xl">合計額: <span class="font-bold">{{ number_format($totalSpending) }}円</span></p>
 </div>

 <div class="mb-6">
  <form method="GET" action="{{ route('spendings.index') }}" class="flex items-center space-x-2 mb-6">
   <select name="category_id" class="form-control">
    <option value="">カテゴリーで絞り込む</option>
    @foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
     {{ $category->name }}
    </option>
    @endforeach
   </select>
   <input type="date" name="start_date" class="form-control" placeholder="開始日">
   <span class="mx-2 text-gray-500">〜</span>
   <input type="date" name="end_date" class="form-control" placeholder="終了日">
   <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-blue font-bold py-2 px-6 rounded shadow">
    検索
   </button>
  </form>
  <button onclick="openModal('newSpendingModal')"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
   新規登録
  </button>
 </div>

 <div class="bg-white shadow-md rounded my-6">
  <table class="text-left w-full border-collapse">
   <thead>
    <tr>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">支出名</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">カテゴリー</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">金額</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">日付</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">操作</th>
    </tr>
   </thead>
   <tbody>
    @foreach ($spendings as $spending)
    <tr class="hover:bg-grey-lighter">
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->name }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->category->name }}</td>
     <td class="py-4 px-6 border-b border-grey-light">¥{{ number_format($spending->amount) }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $spending->accrual_date->format('Y-m-d') }}</td>
     <td class="py-4 px-6 border-b border-grey-light">
      <button onclick="openModal('editSpendingModal{{ $spending->id }}')"
       class="text-blue-500 hover:text-blue-800">編集</button>
      <form action="{{ route('spendings.destroy', $spending->id) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit" class="text-red-500 hover:text-red-800"
        onclick="return confirm('この支出を削除してもよろしいですか？');">削除</button>
      </form>
     </td>
    </tr>
    @endforeach
   </tbody>
  </table>
 </div>
</div>

<!-- 新規登録モーダル -->
<div id="newSpendingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
 <div class="bg-white p-8 rounded-lg shadow-xl w-3/4 max-w-4xl">
  <span onclick="closeModal('newSpendingModal')" class="text-gray-600 hover:text-gray-800 cursor-pointer">&times;
   閉じる</span>
  <h2 class="text-2xl mb-4">新規支出登録</h2>
  <form action="{{ route('spendings.store') }}" method="POST">
   @csrf
   <div class="mb-4">
    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">支出名:</label>
    <input type="text" name="name"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="mb-4">
    <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">カテゴリー:</label>
    <select name="category_id"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
     <option value="">選択してください</option>
     @foreach ($categories as $category)
     <option value="{{ $category->id }}">{{ $category->name }}</option>
     @endforeach
    </select>
   </div>
   <div class="mb-4">
    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">金額:</label>
    <input type="number" name="amount"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="mb-4">
    <label for="accrual_date" class="block text-gray-700 text-sm font-bold mb-2">日付:</label>
    <input type="date" name="accrual_date"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">登録</button>
   </div>
  </form>
 </div>
</div>

<!-- 編集モーダル -->
@foreach ($spendings as $spending)
<div id="editSpendingModal{{ $spending->id }}"
 class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
 <div class="bg-white p-8 rounded-lg shadow-xl w-3/4 max-w-4xl">
  <span onclick="closeModal('editSpendingModal{{ $spending->id }}')"
   class="text-gray-600 hover:text-gray-800 cursor-pointer">&times; 閉じる</span>
  <h2 class="text-2xl mb-4">支出の編集</h2>
  <form action="{{ route('spendings.update', $spending->id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-4">
    <label for="name{{ $spending->id }}" class="block text-gray-700 text-sm font-bold mb-2">支出名:</label>
    <input type="text" name="name" value="{{ $spending->name }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="mb-4">
    <label for="category_id{{ $spending->id }}" class="block text-gray-700 text-sm font-bold mb-2">カテゴリー:</label>
    <select name="category_id"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
     @foreach ($categories as $category)
     <option value="{{ $category->id }}" {{ $spending->category_id == $category->id ? 'selected' : '' }}>
      {{ $category->name }}
     </option>
     @endforeach
    </select>
   </div>
   <div class="mb-4">
    <label for="amount{{ $spending->id }}" class="block text-gray-700 text-sm font-bold mb-2">金額:</label>
    <input type="number" name="amount" value="{{ $spending->amount }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="mb-4">
    <label for="accrual_date{{ $spending->id }}" class="block text-gray-700 text-sm font-bold mb-2">日付:</label>
    <input type="date" name="accrual_date" value="{{ $spending->accrual_date->format('Y-m-d') }}"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新</button>
   </div>
  </form>
 </div>
</div>
@endforeach

<!-- ページトップへ戻るボタン -->
<div id="backToTop" class="fixed bottom-4 right-4 hidden">
 <button onclick="scrollToTop()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
  トップへ戻る
 </button>
</div>
</div>

<script>
function openModal(modalId) {
 document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
 document.getElementById(modalId).style.display = 'none';
}

// スクロールイベントのリスナー
window.addEventListener('scroll', function() {
 var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
 var backToTopButton = document.getElementById('backToTop');

 if (scrollPosition > 10) {
  backToTopButton.classList.remove('hidden');
 } else {
  backToTopButton.classList.add('hidden');
 }
});

// トップに戻る関数
function scrollToTop() {
 window.scrollTo({
  top: 0,
  behavior: 'smooth'
 });
}
</script>
@endsection