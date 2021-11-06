$(document).ready(function (){



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let errorMsg = $('.errorMsg'),
        url = '',
        form_loader = $('.form-loader');
    // Add Product Category Form

    form_loader.hide();

    $('.product_category_form').submit(async function (e) {
        e.preventDefault();

        url = $(this).attr('action')

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response)=>{
            if(response.code == '200'){
                runToast(response.msg, response.code)
                setInterval($('#dataTable').DataTable().draw(), 3000)
            }else{
                setInterval($('#dataTable').DataTable().draw(), 3000)
                runToast(response.msg, response.code)
            }
        })
    })



    function returnMessage(msg, code) {
        if (code == '200') {

            return '<p class="alert alert-success text-white"><i class="fa fa-exclamation-circle"></i> ' + msg + '</p>';
        } else {

            return '<p class="alert alert-danger text-white"><i class="fa fa-exclamation-circle"></i> ' + msg + '</p>';
        }
    }


    function runToast(msg, code){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        })

        if (code == "200"){
            Toast.fire({
                icon: 'success',
                title: msg
            })
        }else{
            Toast.fire({
                icon: 'error',
                title: msg
            })
        }
    }
});
