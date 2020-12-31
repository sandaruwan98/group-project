<link href="https://fonts.googleapis.com/css?family=Hind:700" rel="stylesheet">
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="fab.css">

<body style="background-color: rgb(72, 127, 149);">

    <div class="notification-container-wrap">
        <div class="notification-container  popup-ani">
            <header>
                <h1>Notifications</h1>
            </header>
        </div>
        <div class="notification-fab">
            <div class="wrap">
                <div class="img-fab img"><div class="count-wrap"><span class="count"></span></div></div>
            </div>
        </div>
    </div>

    <script>

        const fab = document.querySelector('.notification-fab');
        fab.addEventListener('click', () => {

            document.querySelector('.notification-fab .wrap').classList.toggle("ani");
            document.querySelector('.notification-container').classList.toggle("open");
            document.querySelector('.img-fab.img').classList.toggle("close");
        });

        $(document).ready(function(){
        
        function load_unseen_notification(view = '')
        {
        $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
            $('.notification-container').html(data.notification);
            if(data.unseen_notification > 0)
            {
            $('.count').html(data.unseen_notification);
            $('.count').css({
            "position": "absolute",
            "top": "-10px",
            "right": "-10px",
            "padding": "5px 10px",
            "border-radius": "50%",
            "background": "red",
            "color": "white"
        });
            }
        }
        });
        }
        
        load_unseen_notification();
        
        // $('#comment_form').on('submit', function(event){
        // event.preventDefault();
        // if($('#subject').val() != '' && $('#comment').val() != '')
        // {
        // var form_data = $(this).serialize();
        // $.ajax({
        //     url:"insert.php",
        //     method:"POST",
        //     data:form_data,
        //     success:function(data)
        //     {
        //     $('#comment_form')[0].reset();
        //     load_unseen_notification();
        //     }
        // });
        // }
        // else
        // {
        // alert("Both Fields are Required");
        // }
        // });
        
        $(document).on('click', '.notification-container', function(){
        $('.count').html('');
        $('.count').css({
            "position": "",
            "top": "",
            "right": "",
            "padding": "",
            "border-radius": "",
            "background": "",
            "color": ""
        });
        load_unseen_notification('yes');
        });
        
        setInterval(function(){ 
        load_unseen_notification();; 
        }, 5000);
        
        }); 

    </script>







</body>