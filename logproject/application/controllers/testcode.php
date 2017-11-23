<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="js/js.js" type="text/javascript"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script>
        $(document).ready(function () {
            var txt = $("#txt");
            txt.mask('99:99').val('hh:mm');

            $("#txt").blur(function () {
                txtTime = $(this).val();
                var hrs = txtTime.substr(0, 2);
                var min = txtTime.substr(3, 4);

                //following code validates hours and minutes 
                if (hrs != 'hh') {
                    if (parseInt(hrs) > 24) {
                        alert("Please enter valid hours (00-24).");
                    }
                }

                if (min != 'mm') {
                    if (parseInt(min) > 60) {
                        alert("Please enter valid minutes (00-60).");
                    }
                }

            }); //end blur

        });//end ready
    </script>
</head>
<body>
    <form id="form1" runat="server">
  
    <input type="text" id="txt" />
    
    </form>
</body>
</html>
