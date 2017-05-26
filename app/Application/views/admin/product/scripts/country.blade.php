<script>
    $('#country').on('change' , function(){
        var country = $(this).val();
        if(country != ''){
            $.get("{{ concatenateLangToUrl('admin/getState') }}"+'/'+country , function(res){
                var json = JSON.parse(res);
                var out = '';
                $.each(json , function(key , value){
                    console.log(value);
                    out += '<option value="'+key+'">'+value+'</option>'
                });
                $('#state').html(out);
                $('#state').selectpicker('refresh');
            });
        }
    });
</script>