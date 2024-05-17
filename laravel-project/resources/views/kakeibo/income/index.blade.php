@extends('layouts.header')

@section('title', '収入一覧')

@section('content')
<div class="container mx-auto mt-8">
 <h2 class="text-2xl font-semibold mb-6 text-blue-800">収入一覧</h2>
 <div class="mb-4">
  <p class="text-xl">合計額: <span class="font-bold">{{ number_format($totalIncome) }}円</span></p>
 </div>

 <div class="mb-6">
  <form method="GET" action="{{ route('incomes.index') }}" class="flex items-center space-x-2">
   <select name="income_source_id" class="form-control">
    <option value="">すべての収入源</option>
    @foreach ($incomeSources as $source)
    <option value="{{ $source->id }}" {{ request('income_source_id') == $source->id ? 'selected' : '' }}>
     {{ $source->name }}
    </option>
    @endforeach
   </select>
   <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="開始日">
   <span class="mx-2">〜</span>
   <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="終了日">
   <select name="income_category_id" class="form-control">
    <option value="">すべてのカテゴリ</option>
    @foreach ($incomeCategories as $category)
    <option value="{{ $category->id }}" {{ request('income_category_id') == $category->id ? 'selected' : '' }}>
     {{ $category->name }}
    </option>
    @endforeach
   </select>
   <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-blue font-bold py-2 px-4 rounded shadow">
    検索
   </button>
  </form>
  <button onclick="openModal('newIncomeModal')"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300 mt-4">
   新規収入登録
  </button>
  {{-- カテゴリー登録モーダルを開くボタン --}}
  <button onclick="openModal('newCategoryModal')"
   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300">
   カテゴリ登録
  </button>
  <!-- カテゴリー一覧へ遷移するボタン -->
  <a href="{{ route('income_categories.index') }}"
   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300">
   カテゴリー一覧へ
  </a>
  <!-- 収入源一覧へ遷移するボタン -->
  <a href="{{ route('income_sources.index') }}"
   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow-lg transition ease-in-out duration-300">
   収入源一覧へ
  </a>
 </div>

 <div class="bg-white shadow-md rounded my-6">
  <table class="text-left w-full border-collapse">
   <thead>
    <tr>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">収入源</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">カテゴリ</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">金額</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">日付</th>
     <th class="py-4 px-6 bg-blue-200 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">操作</th>
    </tr>
   </thead>
   <tbody>
    @foreach ($incomes as $income)
    <tr class="hover:bg-grey-lighter">
     <td class="py-4 px-6 border-b border-grey-light">{{ $income->incomeSource->name ?? '収入源なし' }}</td>
     <td class="py-4 px-6 border-b border-grey-light">
      @foreach ($income->incomeCategories as $category)
      <span>{{ $loop->first ? '' : ', ' }}</span>{{ $category->name }}
      @endforeach
     </td>
     <td class="py-4 px-6 border-b border-grey-light">{{ number_format($income->amount) }}</td>
     <td class="py-4 px-6 border-b border-grey-light">{{ $income->accrual_date->format('Y-m-d') }}</td>
     <td class="py-4 px-6 border-b border-grey-light">
      <a href="#" onclick="openModal('editIncomeModal{{ $income->id }}')" class="text-blue-500 pr-4">編集</a>
      <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" class="inline-block">
       @csrf
       @method('DELETE')
       <button type="submit" class="text-red-500" onclick="return confirm('この収入を削除してもよろしいですか？');">削除</button>
      </form>
     </td>
    </tr>
    @endforeach
   </tbody>
  </table>
 </div>

 <!-- 新規収入登録モーダル -->
 <div id="newIncomeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
  <div class="bg-white p-8 rounded-lg shadow-xl w-3/4 max-w-4xl">
   <span onclick="closeModal('newIncomeModal')" class="text-gray-600 hover:text-gray-800 cursor-pointer">&times;
    閉じる</span>
   <h2 class="text-2xl mb-4">新規収入登録</h2>
   <form action="{{ route('incomes.store') }}" method="post">
    @csrf
    <div class="mb-4">
     <label for="income_source_id" class="block text-blue-700 text-sm font-bold mb-2">収入源</label>
     <select name="income_source_id" id="income_source_id"
      class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option value="">収入源を選択</option>
      @foreach ($incomeSources as $source)
      <option value="{{ $source->id }}">{{ $source->name }}</option>
      @endforeach
     </select>
    </div>
    <div class="mb-4">
     <label for="income_category_id" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ</label>
     <select name="income_category_id" id="income_category_id"
      class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option value="">カテゴリを選択</option>
      @foreach ($incomeCategories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
     </select>
    </div>
    <div class="mb-4">
     <label for="amount" class="block text-blue-700 text-sm font-bold mb-2">金額</label>
     <input type="number" id="amount" name="amount"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" required>
    </div>
    <div class="mb-4">
     <label for="accrual_date" class="block text-blue-700 text-sm font-bold mb-2">日付</label>
     <input type="date" id="accrual_date" name="accrual_date"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" required>
    </div>
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     登録する
    </button>
   </form>
  </div>
 </div>

 <!-- 編集モーダル -->
 @foreach ($incomes as $income)
 <div id="editIncomeModal{{ $income->id }}"
  class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
  <div class="bg-white p-8 rounded-lg shadow-xl w-3/4 max-w-4xl">
   <span onclick="closeModal('editIncomeModal{{ $income->id }}')"
    class="text-gray-600 hover:text-gray-800 cursor-pointer">&times; 閉じる</span>
   <h2 class="text-2xl mb-4">収入の編集</h2>
   <form action="{{ route('incomes.update', $income->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-4">
     <label for="income_source_id" class="block text-blue-700 text-sm font-bold mb-2">収入源</label>
     <select name="income_source_id" id="income_source_id{{ $income->id }}"
      class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      @foreach ($incomeSources as $source)
      <option value="{{ $source->id }}" {{ $income->income_source_id == $source->id ? 'selected' : '' }}>
       {{ $source->name }}
      </option>
      @endforeach
     </select>
    </div>
    <div class="mb-4">
     <label for="income_category_id" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ</label>
     <select name="income_category_id" id="income_category_id{{ $income->id }}"
      class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      @foreach ($incomeCategories as $category)
      <option value="{{ $category->id }}" {{ $income->incomeCategories->contains($category->id) ? 'selected' : '' }}>
       {{ $category->name }}
      </option>
      @endforeach
     </select>
    </div>
    <div class="mb-4">
     <label for="amount" class="block text-blue-700 text-sm font-bold mb-2">金額</label>
     <input type="number" id="amount{{ $income->id }}" name="amount" value="{{ $income->amount }}"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" required>
    </div>
    <div class="mb-4">
     <label for="accrual_date" class="block text-blue-700 text-sm font-bold mb-2">日付</label>
     <input type="date" id="accrual_date{{ $income->id }}" name="accrual_date"
      value="{{ $income->accrual_date->format('Y-m-d') }}"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" required>
    </div>
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     更新
    </button>
   </form>
  </div>
 </div>
 @endforeach

 {{-- カテゴリー登録モーダル --}}
 <div id="newCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
  <div class="bg-white p-8 rounded-lg shadow-xl w-3/4 max-w-4xl">
   <span onclick="closeModal('newCategoryModal')" class="text-gray-600 hover:text-gray-800 cursor-pointer">&times;
    閉じる</span>
   <h2 class="text-2xl mb-4">カテゴリの登録</h2>
   <form action="{{ route('income_categories.store') }}" method="post">
    @csrf
    <div class="mb-6">
     <label for="name" class="block text-blue-800 text-lg font-bold mb-2">カテゴリ名</label>
     <input type="text" id="name" name="name"
      class="form-input mt-1 block w-full border rounded py-2 px-3 shadow outline-none ring-blue-300 focus:ring"
      placeholder="カテゴリ名を入力してください" required>
    </div>
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline">
     登録
    </button>
   </form>
  </div>
 </div>
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