`        <script src="jquery-3.3.1.js" type="text/javascript"></script>
        <script src="jquery.validate.js" type="text/javascript"></script>
        <script src="additional-methods.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {

                $("#myform").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        city: {
                            required: true,
                            minlength: 2
                        }

                    }
                });

            });

        </script>
        <style>
            .error{
                color:red;
            }
        </style>