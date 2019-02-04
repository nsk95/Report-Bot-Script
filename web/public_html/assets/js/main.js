function mysqlform() {
    var form = $( "#mysqlform" );
    var url = window.location.href;
    $.ajax({
        type: "POST",
        url: "/index.php",
        data: {
            "checkMysql": true,
            "formData": form.serialize()
        },
        success: function(ret) {
            if( ret == 0 || ret == '0' ) {
                $( "#nosuccess").css("display", "block");
                $( "#success").css("display", "none");
            }
            if( ret == 1 || ret == '1' ) {
                $( "#success").css("display", "block");
                $( "#nosuccess").css("display", "none");
            }
        }
    }); 
};
