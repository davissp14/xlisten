// slide toggle
$(document).ready(function() {
   $('#Request').find('.requestInformation').hide().end().find('.requestTitle').click(function() {
      $(this).next().slideToggle("slow"); });   })


$(document).ready(function()
{
   $(".stripeMe tr").mouseover(function()
   {
      $(this).addClass("over");
   });
   $(".stripeMe tr").mouseout(function()
   {
   $(this).removeClass("over");
   });
   $(".stripeMe tr:even").addClass("alt");
});
