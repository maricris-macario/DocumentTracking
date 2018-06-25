          tday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
          tmonth = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

          function GetClock(){
          var d = new Date();
          var nday = d.getDay(), nmonth = d.getMonth(), ndate = d.getDate(), nyear = d.getYear();
          if(nyear < 1000) nyear += 1900;
          var d = new Date();
          var nhour = d.getHours(), nmin = d.getMinutes(), nsec = d.getSeconds();
          if(nmin <= 9) nmin = "0" + nmin
          if(nsec <= 9) nsec = "0" + nsec;

          document.getElementById('clockboxtime').innerHTML = nhour + ":" + nmin + ":" + nsec;
          document.getElementById('clockboxdate').innerHTML = tday[nday] + ", " + tmonth[nmonth] + " " + ndate + ", " + nyear;
          }

          window.onload=function(){
          GetClock();
          setInterval(GetClock,1000);
          }