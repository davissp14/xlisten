      
      
      
        function updateList()
         {
           // alert("Your Playlist Has Been Updated!");
                $.get("update.php",
                  function(data) {
                     $("#subcontainer").html(data);
                  }, "html");
         }
       

            function call(id)
            {
               alert(id);
                 $.get("player.php", {id: id},
                     function(data) {
                        $("#player").html(data);
                     }, "json");
            }

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


$('#playButton').find('#test').click(function(){
   alert($('#test').val());
})
