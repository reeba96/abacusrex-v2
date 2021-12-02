<ul  style="list-style: none;">
                
    @foreach ($pages as $page)
        <?php  $name = 'title_en'; ?>
        <li id="li_{{ $page->id }}"  class="row mt-1">
        
        <div class="col-md-10">
                {{ $page->$name }}
        </div>
        <div id="span_{{ $article->id }}" class="col-md-2 text-right" >
            
                <div class="btn btn-danger btn-sm"><a data-article_id="{{ $article->id }}" data-page_id="{{ $page->id }}" title="Unlink page" class="page_unlink"><i class="fas fa-unlink"></i></a></div>
        
        </div>
        </li>
        
    @endforeach
        
</ul>

<script type="text/javascript">
    $(document).ready(function() {
        $('.page_unlink').click(function(e) {  

                var btn = $(this);
                var article_id = $(this).data('article_id'),
                    page_id    = $(this).data('page_id');		
                e.preventDefault();
                $("#loading").addClass('loading');
                $.post('{{ route('article.unlink') }}', {
                    article_id : article_id,
                    page_id    : page_id,
                },
                function(){
                    $("#li_" + page_id).remove();
                    var articles = $("#tree").fancytree('getTree').getNodeByKey('p#'+page_id).getChildren();
                    
                    $.each( articles, function( i, node ) {
                        if( node && node.key == article_id){
                            node.remove();
                        }
                    
                    });
            
                });
            });
        });
    </script>