function cmsNotify(e,t){$(".cms-notification").css("display","block"),$(".cms-notification").attr("class","cms-notification"),$(".cms-notification").addClass(t),$(".cms-notify-comment").html(e),$(".cms-notification").animate({right:"20px"}),$(".cms-notify-closer").click(function(){$(".cms-notification").animate({right:"-300px"},"",function(){$(".cms-notification").css("display","none"),$(".cms-notify-comment").html("")})}),setTimeout(function(){$(".cms-notification").animate({right:"-300px"},"",function(){$(".cms-notification").css("display","none"),$(".cms-notify-comment").html("")})},8e3)}function confirmDelete(e){$("#deleteBtn").attr("href",e),$("#deleteModal").modal("toggle")}$(document).ready(function(){$(".alert").delay(7e3).fadeOut(),$(".sidebar-toggle").on("click",function(){$(".sidebar").toggleClass("toggled")});var e=$(".sidebar .active");if(e.length&&e.parent(".collapse").length){var t=e.parent(".collapse");t.prev("a").attr("aria-expanded",!0),t.addClass("show")}}),$(function(){$(".non-form-btn").bind("click",function(e){e.preventDefault()}),$(".delete-btn").bind("click",function(e){e.preventDefault(),$("#deleteModal").modal("toggle");var t=$(this).parent("form");$("#deleteBtn").bind("click",function(){t[0].submit()})}),$(".delete-link-btn").bind("click",function(e){e.preventDefault(),$("#deleteLinkModal").modal("toggle");var t=$(this).parent("form");$("#deleteLinkBtn").bind("click",function(){t[0].submit()})}),$(".delete-btn-confirm").bind("click",function(e){e.preventDefault()}),$("form.add, form.edit").submit(function(){$(".loading-overlay").show()}),$("a.slow-link").click(function(){$(".loading-overlay").show()})});var typeaheadMatcher=function(e){return function(t,i){var n;n=[],substrRegex=new RegExp(t,"i"),$.each(e,function(e,t){substrRegex.test(t)&&n.push(t)}),i(n)}},_redactorConfig={toolbarFixedTopOffset:$(window).width()<376?30:50,visual:!0,minHeight:175,convertVideoLinks:!0,imageUpload:!1,pastePlaintext:!0,imagePosition:!0,imageResizable:!0,deniedTags:["script"],imageManagerJson:_url+"/cms/api/images/list",fileManagerJson:_url+"/cms/api/files/list",stockImageManagerJson:"https://pixabay.com/api/",formatting:["p","blockquote","pre","h1","h2","h3","h4","h5"],buttonsAddAfter:{after:"deleted",buttons:["underline"]},plugins:["table","fontcolor","alignment","specialchars","video","stockimagemanager","fileselector","imageselector"]};$(window).ready(function(){$(".pull-down").each(function(){var e=300-$(this).siblings(".thumbnail").height()-$(this).height()-48;$(this).css("margin-top",e)}),$("textarea.redactor").redactor(_redactorConfig)}),$(function(){function e(e){return e.replace(/[^\w\s]/gi,"").replace(/ /g,"-").toLowerCase()}var t=$("#Url").val();$("#Title, #Name").bind("keyup",function(){""==t&&$("#Url").val(e($(this).val()))}),$(".timepicker").datetimepicker({format:"LT",timeZone:_appTimeZone}),$(".datepicker").datetimepicker({format:"YYYY-MM-DD",timeZone:_appTimeZone}),$(".datetimepicker").datetimepicker({showTodayButton:!0,format:"YYYY-MM-DD HH:mm",timeZone:_appTimeZone}),$(".tags").tagsinput()}),$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip()}),$("#External").is(":checked")?($("#External_url").parent().show(),$("#Page_id").parent().hide()):($("#External_url").parent().hide(),$("#Page_id").parent().show()),$(window).ready(function(){$("#External").bind("click",function(){$(this).is(":checked")?($("#External_url").parent().show(),$("#Page_id").parent().hide()):($("#External_url").parent().hide(),$("#Page_id").parent().show())})});var linkList=document.getElementById("linkList");if(void 0!==linkList&&null!=linkList)var sortable=Sortable.create(linkList,{store:{get:function(e){return _linkOrder||[]},set:function(e){var t=e.toArray();$.ajax({url:_cmsUrl+"/menus/"+_id+"/order",type:"put",data:{_token:_token,order:JSON.stringify(t)},success:function(e){}})}}});$(function(){$("#saveFilesBtn").click(function(e){e.preventDefault(),Dropzone.forElement(".dropzone").processQueue()})}),$(function(){$(".bulk-image-delete").hide(),$("#saveImagesBtn").click(function(e){e.preventDefault(),Dropzone.forElement(".dropzone").processQueue()}),$(".selectable").bind("click",function(){$(this).hasClass("selected-highlight")?$(this).removeClass("selected-highlight"):$(this).addClass("selected-highlight"),$(".selected-highlight").length>0?$(".bulk-image-delete").show():$(".bulk-image-delete").hide()}),$(".bulk-image-delete").click(function(){var e=[];if($(".selected-highlight").each(function(){e.push($(this).attr("data-id"))}),e.length>0){$("#bulkImageDeleteModal").modal("toggle");var t=_cmsUrl+"/images/bulk-delete/"+e.join("-");$("#bulkImageDelete").attr("href",t)}}),$(".img-alter-btn").click(function(e){e.stopPropagation()})}),$(".preview-toggle").bind("click",function(){"desktop"==$(this).attr("data-platform")&&$("#frame").css({width:"150%"}),"mobile"==$(this).attr("data-platform")&&$("#frame").css({width:"320px"})}),$("#frame").ready(function(){var e=$("#frame").contents().find("body");$("a",e).click(function(e){e.preventDefault()})}),$(function(){$(".add-block-btn").bind("click",function(e){e.preventDefault(),$("#blockName").val(""),$("#addBlockModal").modal("toggle")}),$("#addBlockBtn").bind("click",function(){var e=$("#blockName").val();$(".blocks").prepend('<div id="block_container_'+e+'" class="col-md-12"><div class="form-group"><h4>'+e+'<button type="button" class="btn btn-xs btn-danger delete-block-btn pull-right"><span class="fa fa-trash"></span></button></h4><textarea id="block_'+e+'" name="block_'+e+'" class="form-control redactor"></textarea></div></div>'),$("#addBlockModal").modal("toggle"),$("#block_"+e).redactor(_redactorConfig)}),$(".delete-block-btn").bind("click",function(e){e.preventDefault(),$("#deleteBlockBtn").attr("data-slug",$(this).attr("data-slug")),$("#deleteBlockModal").modal("toggle")}),$("#deleteBlockBtn").bind("click",function(){$("#"+$(this).attr("data-slug")).remove(),$("#deleteBlockModal").modal("toggle")})}),Dropzone.options.fileDropzone={paramName:"location",addRemoveLinks:!0,autoProcessQueue:!1,init:function(){this.on("success",function(e,t){e.serverData=t.data,$(["name","original","mime","size"]).each(function(){$("#fileDetailsForm").prepend('<input id="file_'+e.serverData.name+'" name="location['+e.serverData.name+"]["+this+']" value="'+e.serverData[this]+'" type="hidden" />')}),this.options.autoProcessQueue=!0}),this.on("queuecomplete",function(){$("#fileDetailsForm").submit()}),this.on("removedfile",function(e){e.serverData&&($.get(_url+"/cms/files/remove/"+e.serverData.name),$("#file_"+e.serverData.name).remove())})},accept:function(e,t){t()}};
