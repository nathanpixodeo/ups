require([
    "jquery"
], function($) {
    $(document).ready(function() {
        $("#to_ap_delivery").on("change",function() {
            $("#ap_check_err").hide();
            if ($("#to_ap_delivery").prop("checked")) {
                $.ajax({
                    showLoader: true,
                    url: $("#urlcheckap").val(),
                    data: '{}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.status != "success") {
                            var ap_check_html = '<p style="color:red;background-color: #fde1c0;text-align: center;border-radius: 5px;">Failed to enable AP service. '+data.status+' Contact support.</p>';
                            $("#ap_check_err").html(ap_check_html);
                            $("#ap_check_err").show();
                            $("#to_ap_delivery").prop("checked", false);
                        } else if (data.status == "success"){
                            var ap_check_html = '<p style="color:green;background-color:#91f091;text-align: center;border-radius: 5px;">AP service enabled.</p>';
                            $("#ap_check_err").html(ap_check_html);
                            $("#ap_check_err").show();
                            $('.open-form-ap').slideToggle(500);
                        } else {
                            var ap_check_html = '<p style="color:red;background-color: #fde1c0;text-align: center;border-radius: 5px;">Failed to enable AP service. Contact support.</p>';
                            $("#ap_check_err").html(ap_check_html);
                            $("#ap_check_err").show();
                            $("#to_ap_delivery").prop("checked", false);
                        }
                    },
                    error: function (errorThrown) {
                        var ap_check_html = '<p style="color:red;">Failed to check AP service. Contact support.</p>';
                        $("#ap_check_err").html(ap_check_html);
                        $("#ap_check_err").show();
                        $("#to_ap_delivery").prop("checked", false);
                    }
                });
            } else {
                if ($(".open-form-ap").is(":visible")) {
                    $('.open-form-ap').slideToggle(500);
                }
            }
        });

        $("#to_address_delivery").on("change",function() {
            $('.open-form-add').slideToggle(500);
        })
        var toapdeliveryvalue = $("#toapdeliveryvalue").val();
        var toaddressdeliveryvalue = $("#toaddressdeliveryvalue").val();
        var selected_country = $("#selected_country").val();
        if (toapdeliveryvalue =="1" || (toapdeliveryvalue =='' && 'us' == selected_country)) {
            $(".open-form-ap").show();
        } else {
            $(".open-form-ap").hide();
        }

        if (toaddressdeliveryvalue == "1" || (toaddressdeliveryvalue =='' && 'us' == selected_country)) {
            $(".open-form-add").show();
        } else {
            $(".open-form-add").hide();
        }
    });
});
