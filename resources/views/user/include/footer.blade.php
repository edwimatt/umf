</div>


</div>

</div>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/jquery.lineProgressbar.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<script src="{{ asset('assets/js/moment.min.js')}}"></script>
{{--<script src="{{ asset('assets/js/jquery.comiseo.daterangepicker.js')}}"></script>--}}
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
{{--<script src="{{ asset('assets/js/custom.js')}}"></script>--}}

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script>
    $("[rel=tooltip]").tooltip({placement: 'right'});
    if ($(".table-responsive").find(".__delete").length > 0) {
        $(".__delete").click(function (e) {
            e.preventDefault();
            let id = $(this).attr("data-id");
            var module = $(this).attr("data-module");
            if(typeof module == "undefined"){
                module = "hospital-email";
            }
            var msg = confirm(`Are you sure you want to delete this record?`);
            var redirect_url = `user/${module}`;
            var delete_url = "{!! url("/") !!}"+`/${redirect_url}/delete/${id}`;
            if (msg) {
                $.ajax({
                    type: "GET",
                    url: `${delete_url}`,
                    beforeSend: function () {
                        $('#overlay').show()
                    },
                    success: function (data) {
                        $('#overlay').hide();
                        if (data.code == "400") {
                            alert(data.message);
                        } else {
                            alert(data.message);
                            window.location.href = "{!! url("/") !!}"+`/${redirect_url}`;
                        }
                    }
                })
            } else {
                return false
            }
        })
    }
</script>

</body>
</html>