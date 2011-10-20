
            // slide toggle
            $(document).ready(function() {
            $('#Request').find('.requestInformation').hide().end().find('.requestTitle').click(function() {
            $(this).next().slideToggle("slow"); });   })


            //****************************************************************************
            //        Show Artist Information
            //****************************************************************************
            function showArtist(num)
            {
               alert(num);
            if (num.length==0)
              {
              document.getElementById("title"+num).innerHTML="";
              return;
              }
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("title"+num).innerHTML=xmlhttp.responseText;
                //showSong(num);
                }
              }
            xmlhttp.open("GET","sql.php?q="+num+"&sid="+Math.random(),true);
            xmlhttp.send(null);
            }
