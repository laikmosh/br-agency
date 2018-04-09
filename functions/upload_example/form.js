
    $(function(){
        // Avoid double posts by disabling submit button on form submit
        $('#myform').submit(function(){
            $("#submit").attr('disabled','disabled');
            return true;
        });

    });