<form action="{{ route('site.search') }}" class="header-form-search d-flex align-items-center gap-3 none">
    <i class="fas fa-search"></i>
    <input name="key" type="text" placeholder="Tìm kiếm sản phẩm" autocomplete="off">
    <i class="fas fa-times" onclick="hiddenSearchForm()" style="cursor: pointer;"></i>
    @if(count($listKeySearch) > 0)
    <div class="history-key">
        <div class="history-key-content">
            <h4 class="history-header">
                Tìm kiếm trước đó
            </h4>
            @foreach($listKeySearch  as $key)
            <div class="item-key">
                <a href="{{ route('site.search', ['key' => $key]) }}">{{ $key }}</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</form>