@extends('admin::admin.layouts.master')

@section('css')
<link rel="stylesheet" href="/admin/css/fancytree/skin-lion/ui.fancytree.css">
<link rel="stylesheet" href="/admin/fine-uploader/jquery.fine-uploader/fine-uploader.css">
<style type="text/css">

.ui-menu {
          width: 100px;
          font-size: 12;
          z-index: 3;
    }
    
    
     #draggableSample, #droppableSample {
        height:100px;
        padding:0.5em;
        width:150px;
        border:1px solid #AAAAAA;
      }
      #draggableSample {
        background-color: silver;
        color:#222222;
      }
      #droppableSample {
        background-color: maroon;
        color: white;
      }
      #droppableSample.drophover {
        border: 1px solid green;
      }
    
    
    span.fancytree-icon {
      position: relative;
    }
    span.fancytree-childcounter {
          color: #fff;
          background: #428BCA;
        /*  border: 1px solid gray; */
          position: absolute;
          top: -6px;
          right: -6px;
          min-width: 10px;
          height: 10px;
          line-height: 1;
          vertical-align: baseline;
          border-radius: 10px; /*50%;*/
          padding: 2px;
          text-align: center;
          font-size: 9px;
    }
    
    
    .ui-menu {
          width: 180px;
          font-size: 12;
          z-index: 3;
    }
    
    span.fancytree-icon { position: relative;}
    span.fancytree-childcounter {
          color: #fff;
          background: #428BCA;
        /*  border: 1px solid gray; */
          position: absolute;
          top: -6px;
          right: -6px;
          min-width: 10px;
          height: 10px;
          line-height: 1;
          vertical-align: baseline;
          border-radius: 10px; /*50%;*/
          padding: 2px;
          text-align: center;
          font-size: 9px;
    }
    
    .draggable,.droppable {
            border: 1px solid green;
            border-radius:2px;
            padding: 2px;
            background-color: #FFF;
    }
    /* Prevent scrolling while DND */
    ul.fancytree-container {
        position: inherit;
        overflow: hidden;
    }
    /* Fancytree extension 'table' */
    table.fancytree-ext-table {
        font-size: 80%;
        width: 100%;
    }
    table.fancytree-ext-table tbody tr:nth-child(even){
        background-color: #f4f4f8;
    }
    table.fancytree-ext-table tbody tr td {
        border: 1px solid lightgray;
    }
    
    /* Fancytree extension 'columnview' */
    table.fancytree-ext-columnview {
        font-size: 80%;
        border-collapse: collapse;
        width: 100%;
    }
    table.fancytree-ext-columnview tbody tr[0] { height: 200px;}

    span.fancytree-title{}

    .fancytree-treefocus span.fancytree-selected span.fancytree-title,span.fancytree-selected span.fancytree-title{
        color: #0f913b !important;  outline: 0;
    }

    .fancytree-treefocus span.fancytree-selected span.fancytree-title,
    .fancytree-treefocus span.fancytree-active span.fancytree-title{
        color: #000;
        background-color: #fff;
    }

    .fancytree-treefocus span.fancytree-active span.fancytree-title{
        border-color: #2f61e0;
        border-width: 2px;
        border-style: dashed;
        color:inherit;
        background-color: inherit;
        outline: 0;
    }

    .fancytree-ext-childcounter span.fancytree-childcounter, .fancytree-ext-filter span.fancytree-childcounter{ line-height: 3px;}
    
    </style>
@endsection

@section('content-header')

@endsection

@section ('content')

    <div class="content">
        <h2>{{trans('translate.pages') }}</h2>
    </div>

    <div class="page-content container-fluid">
        <div class='row'>
            

            
            <div class="card col-lg-2" >
                <div class="card-header pl-0 pr-0">
                    <div class="col-lg-10 col-xs-10 pl-0 float-left">
                        <div class="input-group input-group-sm " >
                            <input name="search" type="text" class="form-control" aria-describedby="search-addon1" placeholder="Filter...">
                            <span class="input-group-btn">
                                <button id="btnResetSearch" class="btn btn-primary btn-sm">&times;<span id="matches"></span><i class="fas fa-trash"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-2 p-0 float-right">
                        <button class="btn btn-primary btn-sm pull-right" title="{{__("translate.new_page")}}" id="new_page"><i class="fas fa-folder-plus"></i></button>
                    </div>
                </div><!-- /.row -->
                
                <div class="card-header pl-0 pr-0" id="echo_container" style="display:none">
                        <span id="echoActive" class="draggable"></span>
                </div>
            
                <div class="card-body pl-0 pr-0" >
                 
                
                    <div id="tree" data-source="ajax">
                       
                    </div>
                </div>
            </div>


          
            <div id="response" class='col-lg-10'>
                @if (session('status'))
                <div class="row">
                    <div class="col-md-offset-5 col-md-2 ">
                        <div class="alert alert-success" id="status" style='text-align: center!important;'>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @include ('admin::admin.includes.message-block')
        </div>
    </div>
@endsection

@push('head-scripts')


@endpush



@push('scripts')
    <script src="/admin/jquery-ui/jquery-ui.min.js"></script>
    <script src="/admin/js/jquery.fancytree-all-deps.js"></script>
    <script src="/admin/js/jquery.fancytree.dnd.js"></script>
    <script src="/admin/js/jquery.cookie.js"></script>
  

    <script src="/admin/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.min.js"></script>

    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" 
    rel="stylesheet" />
   
    <script src="/admin/ui-contextmenu/jquery.ui-contextmenu.js"></script>
    

    <script src="/tinymce/tinymce.min.js"></script>

   
 
    <script>

window.onload = function () {
    $('#new_page').on('click', function (event) {
        event.preventDefault();
        $("#response").load("{{ route('page.edit') }}",{'new':'1'}); //new azert hogy POST legyen a .load()
    });

    if("{{ session('status') }}") {
        setTimeout(function() {
            $('#status').hide();
        }, 2500);
    }

    var token = '{{ Session::token() }}';

    $('#tree').fancytree({
        activeVisible: true, // Make sure, active nodes are visible (expanded).
        aria: false, // Enable WAI-ARIA support.
        autoActivate: false, // Automatically activate a node when it is focused (using keys).
        autoCollapse: false, // Automatically collapse all siblings, when a node is expanded.
        autoScroll: true, // Automatically scroll nodes into visible area.
        clickFolderMode: 1, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
        checkbox: true, // Show checkboxes.
        debugLevel: 2, // 0:quiet, 1:normal, 2:debug
        generateIds: true, // Generate id attributes like <span id='fancytree-id-KEY'>
        idPrefix: "", // Used to generate node id´s like <span id='fancytree-id-<key>'>.
     //   icon: true, // Display node icons.
        keyboard: true, // Support keyboard navigation.
        keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath().
        minExpandLevel: 1, // 1: root node is not collapsible
        selectMode: 2, // 1:single, 2:multi, 3:multi-hier
        tabbable: true, // Whole tree behaves as one single control
        titlesTabbable: false, // Node titles can receive keyboard focus
		icons: true, // Display node icons.
        //persist: false,
        persist: {
            overrideSource: true,
            expandLazy: false,
            // overrideSource: false, // true: cookie takes precedence over `source` data attributes.
            store: "local" // 'cookie', 'local': use localStore, 'session': sessionStore
        },
        filter: {
            autoApply: true,   // Re-apply last filter if lazy data is loaded
            autoExpand: true, // Expand all branches that contain matches while filtered
            counter: true,     // Show a badge with number of matching child nodes near parent icons
            fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
            hideExpandedCounter: true,  // Hide counter badge if parent is expanded
            hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
            highlight: true,   // Highlight matches by wrapping inside <mark> tags
            leavesOnly: false, // Match end nodes only
            nodata: true,      // Display a 'no data' status node if result is empty
            mode: "hide"       // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)

        },
        childcounter: {
            deep: true,
            hideZeros: true,
            hideExpanded: true
        },
        source: {
            url: "{{ route('get.data')}}",
            cache: false
        },
        //extensions: ["dnd", "edit", "persist"],
        extensions: [ "dnd","edit","filter","childcounter","persist"],
        activate: function (event, data) {
            var node_key = data.node['key'];
            var parent = data.node.parent['key'];

            if (data.node.isFolder()) {
                $("#response").load("{{ route('page.edit') }}", {page_id: node_key, _token: token, parent: parent});
                $("#echoActive").removeClass('draggable ui-draggable ui-draggable-handle'); 
            } else {
                $("#response").load("{{ route('article.edit') }}", {article_id: node_key, _token: token, parent: parent});
                $("#echoActive").addClass('draggable ui-draggable ui-draggable-handle');
            }
            $("#echo_container").show();
            $("#echoActive").text(data.node.title);

            var node = data.node;
            console.log(node);
            var id = node.li.id;
            console.log(id);
            $("#echoActive").data('key',id);
            $("#echoActive").data('selected',node.isSelected());
        },
        select: function(event, data) {

            var node_key = data.node['key'];
            var parent = data.node.parent['key'];

            if (data.node.isFolder()) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('page.online') }}",
                    data: {id: node_key, _token: token}
                }).done(function(msg){
                    if (msg['message'] == 'OK') {
                        console.log('page online');
                    }
                });

            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('article.publish') }}",
                    data: {id: node_key, parent: parent, _token: token}
                }).done(function(msg){
                    if (msg['message'] == 'OK') {
                        console.log('article published');
                    }
                });

            }
        },
        
        dnd: {
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            autoExpandMS: 400,
            draggable: {
                //zIndex: 1000,
                // appendTo: "body",
                // helper: "clone",
                scroll: false,
                revert: "invalid"
            },
            dragStart: function (node, data) {
                return true;
            },
            dragEnter: function (node, data) {
                console.log('dragEnter hitMode:'+data.hitMode);
             // console.log(JSON.stringify(data));
              if( !data.otherNode  ){  // It's a non-tree draggable EXTERNAL
               console.log('External dnd');
                  return ["after","over"];
              }
              
              if ( data.otherNode === null) {
                  if ( node.isFolder() ) {
                        return false;
                  }
                  return ["before", "after"]; 
              }
              else{
                   console.log('Other NODE');
                   console.log(node.parent.key +'/'+data.otherNode.parent.key);
                   if (node.parent.key == data.otherNode.parent.key ){
                        return ["before", "after"];
                   } 
              }
               
             //  console.log('drag enter '+node.key+' '+data.otherNode.parent);
              if(node.parent !== data.otherNode.parent) 
                    return false;
              if ( node.isFolder() & data.otherNode.isFolder() ){
                 return ["before", "after"]; 
              }
            },
            dragOver: function (node, data) {
                //return false;
            },
            dragDrop: function (node, data) {
                /** This function MUST be defined to enable dropping of items on the tree.             */

                if( !data.otherNode ){  // It's a non-tree draggable EXTERNAL
                
                    // console.log('External key:'+key+' page:'+parent_key+' '+data.hitMode+' selected:'+selected+' parent_key:'+data.node.parent.key+' node.key:'+node.key);
                 
                 
                    var title = $(data.draggable.element).text();
                    var key  =  $(data.draggable.element).data('key');
                    var selected  =  $(data.draggable.element).data('selected');
                   /* if ( node.isFolder() ) { //dropped below the folder
                        var parent_key = data.node.key;
                    }
                    else{ //dropped into folder
                        var parent_key = data.node.parent.key;
                    }*/
                    if( data.node.parent.key =='root_1'){
                        var parent_key = node.key;
                        var mode = 'child';
                    }
                    else{
                        var parent_key = data.node.parent.key;
                        var mode = 'after';
                    }
                    console.log(data);
                    console.log(parent_key);
                    //parent_key = parent_key.substring(2, parent_key .length);
                   
                    //var parent_key = data.parent.key
                    $.post("{{route('article.link')}}", { 
                            article_id: key, 
                            page_id: parent_key
                        }, function(data){
                            if ( data ) {
                                
                                node.addNode({title: title, key: key, selected: selected}, mode); // add fancytree node
                                console.log('load');
                                $("#parent_list").load("{{route('article.refresh_pages_list')}}", { 
                                   // id_page: parent_key, 
                                    article_id: key
                                });
                            }
                            else{
                                console.log('node dropped on root OR duplicated');
                            } 
                            $("#echoActive").css('left',0).css('top',0);   
                        },"JSON");
                  
                  
                }
                else{
                    data.otherNode.moveTo(node, data.hitMode);
                    console.log('dragDrop');
                    data.otherNode.moveTo(node, data.hitMode);
                    if (node.parent !== data.otherNode.parent) {
                        console.log('EEEEEEEEEEERrror');
                    } else {
                        console.log('drop');
                        if (node.isFolder()) {

                            /*  PAGE ORDERING  */

                            var tree = $('#tree').fancytree('getTree');
                            var root = tree.getRootNode();
                            var nodes = root.children;
                            var array = [];
                            for (var i = 0; i <= nodes.length-1; i++) {
                            array[i] = nodes[i]['key'];
                            }
                            $.ajax({
                                method: "POST",
                                url: "{{route('page.ordering')}}",
                                data: {array: array, _token: token}
                            }).done(function(msg) {
                                console.log(msg['order']);
                            });
                        } else {

                            /*  ARTICLE ORDERING  */

                            var nodes = data.node.parent.children;
                            var array = [];
                            for (var i = 0; i <= nodes.length-1; i++) {
                            array[i] = nodes[i]['key'];
                            }
                            $.ajax({
                                method: "POST",
                                url: "{{route('article.ordering')}}",
                                data: {array: array, _token: token}
                            }).done(function(msg) {
                                console.log(msg['order']);
                            });
                        }
                    }
                }
                
            }
        }
    });

     $("#tree").contextmenu({
        delegate: "span.fancytree-title",
       //delegate: ".hasmenu",
        menu: [
            {title: "{{__('translate.new_page')}}", cmd: "new_page", uiIcon: "ui-icon-folder-collapsed"},
            {title: "{{__('translate.create_new_article')}}", cmd: "new_article", uiIcon: "ui-icon-document"},
         //   {title: "{{__('translate.duplicate_article')}}", cmd: "duplicate_article", uiIcon: "ui-icon-newwin"},
        ],
        beforeOpen: function (event, ui) {
            var node = $.ui.fancytree.getNode(ui.target);
            //      node.setFocus();      //  node.setActive();
            var $menu = ui.menu,
                    $target = ui.target,
                    extraData = ui.extraData; // optionally passed when menu was opened by call to open()
            // Optionally return false, to prevent opening the menu
            if (node.isFolder()) {
                $("#tree").contextmenu("enableEntry", "new_page", true);
                $("#tree").contextmenu("enableEntry", "duplicate_article", false);
            } else {
                //return false;
                $("#tree").contextmenu("enableEntry", "new_page", false);
                $("#tree").contextmenu("enableEntry", "duplicate_article", true);
            }
        },
        select: function (event, ui) {
            var node = $.ui.fancytree.getNode(ui.target);
            node.setActive(true);
            //   node.setFocus(false);
            //console.log('menu select '+node.key);
            //   nodedata = node;
            //  alert("select " + ui.cmd + " on " + node);
            switch (ui.cmd) {
                case "new_page":
                    if (node.isFolder()) {
                        var id = node.key;
                    } else {
                        var id = node.parent.key;
                    }
                    $("#response").load("{{ route('page.edit') }}", {parent_id: id, _token: token});
                    break;

                case "new_article":
                    if (node.isFolder()) {
                        var page_id = node.key;
                    } else {
                        var page_id = node.parent.key;
                    }
                    $("#response").load("{{ route('article.edit') }} ", {page_id: page_id, _token: token});
                    break;

                case "duplicate_article":
                    console.log('duplicate');
                    break;

                default:
                    console.log('default select');
            }
        }
    });

    var tree = $("#tree").fancytree("getTree");

    $("input[name=search]").val('');    
   
     $("input[name=search]").keyup(function(e){
	      var n,
	        opts = {
	          autoExpand: $("#autoExpand").is(":checked"),
	          leavesOnly: $("#leavesOnly").is(":checked")
	        },
	        match = $(this).val();
	
	      if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
	        $("button#btnResetSearch").click();
	        return;
	      }
	      
	        n = tree.filterNodes(match, opts);
	      $("button#btnResetSearch").attr("disabled", false);
	      $("span#matches").text("(" + n + ")");
	}).focus();
	
	
	
	$("button#btnResetSearch").click(function(e){
	      $("input[name=search]").val("");
	      $("span#matches").text("");
	      tree.clearFilter();
    }).attr("disabled", true);


	$(".draggable").draggable({
            revert: true, //"invalid",
            cursorAt: { top: -5, left: -5 },
            connectToFancytree: true   // let Fancytree accept drag events
    });

    $("#new_category").click(function (e) {
            $("#loading").addClass('loading');
			e.preventDefault();

            $("#response").load("{{ route('page.edit') }}", { _token: token});
			return false;
        });
        

};
</script>
<script>console.log("index");</script>



@endpush
