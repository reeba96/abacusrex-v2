 
@if ($article->id)
    @php 
        $pages = $article->pages()->get();
    @endphp

    <div class="card card-body pt-2 pb-0" id="parent_list">
        @if ( $article->id && $pages->count() != 1 )
            @include('admin::admin.article_linked_pages_list', ['article' => $article,'pages' => $pages])
        @endif
    </div>
@endif

@if( isset($page_id))
    <input type="hidden" name="page_id" value="{{ $page_id }}"/>
@endif
