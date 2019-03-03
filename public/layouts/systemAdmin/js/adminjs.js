$('.text-danger').on('click', function (e) {
    if (confirm($(this).data('confirm'))) {
        $('#delete-form').submit();
        return true;
    }
    else {
        return false;
    }
});
    function dep(id){
        $("#form-dep"+id).submit();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: '/ajaxdp/'+id,
        //     type: 'POST',
        //     cache: false,
        //     success: function(){
        //     },
        //     error: function (){
        //         alert('Lỗi đã xảy ra');
        //     }
        // });
        // return false;
    };
    function pos(id) {
        $("#form-pos"+id).submit();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: "/ajaxps/"+id,
        //     type: 'POST',
        //     cache: false,
        //     success: function(){
        //     },
        //     error: function (){
        //         alert('Lỗi đã xảy ra');
        //     }
        // });
        // return false;
    };
