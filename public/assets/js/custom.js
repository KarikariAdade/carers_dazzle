$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let errorMsg = $('.errorMsg'),
        url = '',
        dataTable = $('#dataTable');
        form_loader = $('.form-loader');
    // Add Product Category Form

    form_loader.hide();

    $('.product_category_form').submit(function (e) {
        e.preventDefault();

        url = $(this).attr('action')

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response)=>{
            if(response.code == '200'){
                runToast(response.msg, response.code)
                $('#dataTable').DataTable().ajax.reload();
            }else{
                runToast(response.msg, response.code)
            }
        })
    })


    $('#dataTable').on('click', '#deleteCategory', function (e) {
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'));
    })


    dataTable.on('click', '#deleteShelf', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'));
    })



    $('#dataTable').on('click', '#updateCategory', function (e){
        e.preventDefault();

        let name = $(this).closest('tr').children('td:eq(0)').text(),
            description = $(this).closest('tr').children('td:eq(1)').text();

        $('#editDescription').val(description);
        $('#editName').val(name);
        $('.updateCategoryForm').attr('action', $(this).attr('href'));
        $('#editCategoryModal').modal('show');
    })


    dataTable.on('click', '#updateShelf', function (e){
        e.preventDefault();

        let name = $(this).closest('tr').children('td:eq(0)').text(),
            location = $(this).closest('tr').children('td:eq(1)').text(),
            description = $(this).closest('tr').children('td:eq(2)').text();

        $('#editDescription').val(description);
        $('#editLocation').val(location);
        $('#editName').val(name);
        $('.updateShelfForm').attr('action', $(this).attr('href'));
        showModal($('#editShelfModal'));
    })


    function showModal(modal){
        modal.modal('show');
    }

    function hideModal(modal){
        modal.modal('hide');
    }


    $('.updateShelfForm').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response)=>{
            if(response.code == '200'){
                runToast(response.msg, response.code)
                $('#dataTable').DataTable().ajax.reload();
                hideModal($('#editShelfModal'));
            }else{
                runToast(response.msg, response.code)
            }
        })
    })


    $('.updateCategoryForm').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response)=>{
            if(response.code == '200'){
                runToast(response.msg, response.code)
                $('#dataTable').DataTable().ajax.reload();
                $('#editCategoryModal').modal('hide');
            }else{
                runToast(response.msg, response.code)
            }
        })
    })


    $('.product_shelf_form').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response) => {
            if(response.code == '200'){
                runToast(response.msg, response.code)
                $('#dataTable').DataTable().ajax.reload();
                // setTimeout($('#dataTable').DataTable().ajax.reload(), 3000)
            }else{
                // setInterval($('#dataTable').DataTable().draw(), 3000)
                runToast(response.msg, response.code)
            }
        })
    })


    function runAjaxPrompt(url){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, function (response){
                    if(response.code == '200'){
                        runToast(response.msg, response.code)
                        $('#dataTable').DataTable().ajax.reload();
                    }else{
                        runToast(response.msg, response.code)
                    }
                });
            }
        })
    }

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



    $('.productAddForm').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        let formdata = new FormData(this);

        runSubmission(url, formdata, true);

    })


    $('#updateProductForm').submit(function (e) {
        e.preventDefault();
        url = $(this).attr('action');
        let formdata = new FormData(this);

        runSubmission(url, formdata );
    })



    $('.coupon_form').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        let formData = new FormData(this);

        runSubmission(url, formData, true);
    })

    function runSubmission(url, form, withDatatable = false){
        $.ajax({
            url: url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
        }).done((response) => {
            console.log(response)
            if(response.code == '200'){
                runToast(response.msg, response.code)
                if(withDatatable == true){
                    $('#dataTable').DataTable().ajax.reload();
                }
            }else{
                runToast(response.msg, response.code)
                if(withDatatable == true){
                    $('#dataTable').DataTable().ajax.reload();
                }
            }
        })
    }
});

