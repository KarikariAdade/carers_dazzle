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
        let formdata = new FormData(this);

        runSubmission(url, formdata, true);



        // $.ajax({
        //     url: url,
        //     method: 'POST',
        //     data: $(this).serialize(),
        // }).done((response)=>{
        //     if(response.code == '200'){
        //         runToast(response.msg, response.code)
        //         $('#dataTable').DataTable().ajax.reload();
        //     }else{
        //         runToast(response.msg, response.code)
        //     }
        // })
    })

    $('#dataTable').on('click', '#deleteCategory', function (e) {
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'));
    })

    dataTable.on('click', '#deleteShelf', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'));
    })


    dataTable.on('click', '#deleteCoupon', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'), 'coupon');
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


    dataTable.on('click', '#updateCoupon', function (e){
        e.preventDefault();

        let name = $(this).closest('tr').children('td:eq(0)').text(),
            amount = $(this).closest('tr').children('td:eq(1)').text(),
            amount_type = $(this).closest('tr').children('td:eq(2)').text(),
            description = $(this).closest('tr').children('td:eq(3)').text();


        $('#editName').val(name);
        $('#editAmountType').val(amount_type);
        $('#editAmount').val(amount);
        $('#editDescription').val(description);

        updateSubmitAttrAndShowModal('updateCouponForm', $(this).attr('href'), 'editShelfModal', 'class')

    });


    function updateSubmitAttrAndShowModal(form, url, modal, formType){
        if (formType == 'class'){
            form = $('.'+form);
        }else{
            form = $('#'+form);
        }


        form.prop('action', url);

        showModal($('#'+modal));
    }

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
        // e.preventDefault();
        // url = $(this).attr('action');
        // $.ajax({
        //     url: url,
        //     method: 'POST',
        //     data: $(this).serialize(),
        // }).done((response)=>{
        //     if(response.code == '200'){
        //         runToast(response.msg, response.code)
        //         $('#dataTable').DataTable().ajax.reload();
        //         $('#editCategoryModal').modal('hide');
        //     }else{
        //         runToast(response.msg, response.code)
        //     }
        // })

        e.preventDefault();
        url = $(this).attr('action');
        let formdata = new FormData(this);

        runSubmission(url, formdata );
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



    function runAjaxPrompt(url, type = null){
        let msg = 'You won\'t be able to revert this!';

        if (type == 'coupon'){
            msg = 'Coupon will be removed from all instances where it was added.';
        }

        if (type == 'tax'){
            msg = 'Tax will be removed from all instances where it was used.';
        }

        if (type == 'shipping'){
            msg = 'Default shipping charges would be used in all instances where this shipping charge is used';
        }
        Swal.fire({
            title: 'Are you sure?',
            text: msg,
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

    $('.updateCouponForm').submit(function (e) {
        e.preventDefault();
        url = $(this).attr('action');
        let formData = new FormData(this);

        runSubmission(url, formData, true);

        hideModal($('#updateCouponForm'));
    })



    $('.taxForm').submit(function (e) {
        e.preventDefault();

        url = $(this).attr('action');
        let formData = new FormData(this);

        runSubmission(url, formData, true);
    })


    dataTable.on('click', '#updateTax', function (e){
        e.preventDefault();

        let name = $(this).closest('tr').children('td:eq(0)').text(),
            amount = $(this).closest('tr').children('td:eq(1)').text().replace(/[^0-9\.]+/g, "")
            description = $(this).closest('tr').children('td:eq(2)').text();

        $('#editName').val(name);
        $('#editAmount').val(amount);
        $('#editDescription').val(description);

        updateSubmitAttrAndShowModal('updateTaxForm', $(this).attr('href'), 'editShelfModal', 'class')

    });

    $('.updateTaxForm').submit(function (e) {
        e.preventDefault();
        url = $(this).attr('action');
        let formData = new FormData(this);

        runSubmission(url, formData, true);
    })


    dataTable.on('click', '#deleteTax', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'), 'tax');
    })


    dataTable.on('click', '#deleteProduct', function (e){
        e.preventDefault(0);

        runAjaxPrompt($(this).attr('href'));
    })

    $('.imgDelBtn').click(function (e){
        e.preventDefault()
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this image?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    })



    // SHIPPING PAGE

    $('.shipping_form, .addCustomerForm, .addBannerForm, #updateBannerForm, .confirmPaymentForm' ).submit(function (e) {
        e.preventDefault();
        url = $(this).attr('action');
        let formData = new FormData(this);

        runSubmission(url, formData, true);
    })

    dataTable.on('click', '#deleteShipping', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'), 'shipping');
    })

    dataTable.on('click', '#setDefaultShipping', function (e){
        e.preventDefault();
        runAjaxPrompt($(this).attr('href'));
    });

    dataTable.on('click', '#updateShipping', function (e){
        e.preventDefault();

        let name = $(this).closest('tr').children('td:eq(0)').text(),
            amount = $(this).closest('tr').children('td:eq(1)').text().replace(/[^0-9\.]+/g, "")
        description = $(this).closest('tr').children('td:eq(2)').text();

        $('#editName').val(name);
        $('#editAmount').val(amount);
        $('#editDescription').val(description);

        updateSubmitAttrAndShowModal('updateShippingForm', $(this).attr('href'), 'editShippingModal', 'class')

    });


    dataTable.on('click', '#markActive', function (e){
        e.preventDefault();

        runRawAjaxPost($(this).attr('href'), true);

    })

    dataTable.on('click', '#markFeatured', function (e){
        e.preventDefault();

        runRawAjaxPost($(this).attr('href'), true);
    })

    dataTable.on('click', '#deleteBanner', function (e){
        e.preventDefault();

        runAjaxPrompt($(this).attr('href'), true);
    })


    function runRawAjaxPost(url, withDatatable = false){
        $.post(url, function (response){
            if(response.code == '200'){
                runToast(response.msg, response.code)
                if(withDatatable == true){
                    $('#dataTable').DataTable().ajax.reload();
                }

            }else{
                runToast(response.msg, response.code)
            }
        });
    }

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


    dataTable.on('click', '#verifyPayment', function (e){
        e.preventDefault();
        updateSubmitAttrAndShowModal('confirmPaymentForm', $(this).attr('href'), 'verifyPaymentModal', 'class')
    })


    $('#updatePhoneNumber').on('click', function (e){
        e.preventDefault();
        updateSubmitAttrAndShowModal('updatePhoneForm', $(this).attr('href'), 'verifyPhone', 'class')
    })

    $('.updatePhoneForm').submit(function (e){
        e.preventDefault();

        $.post($(this).attr('action'), $(this).serialize(), function (response) {
            if (response.code == '200'){
                runToast(response.msg, response.code)
                $('#updatePhoneNumber').text('Update Phone');
                $('#phoneNumberMsg').hide(300)
            }else{
                runToast(response.msg, response.code)
            }
        })
    })


    $('.addSusuCustomer').submit(function (e){
        e.preventDefault();
        let url = $(this).prop('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize()
        }).done((response) =>{
            if(response.code == '200'){
                $('#customer').append(`<option selected value="${response.user.id}">${response.user.name}</option>`)
                runToast(response.msg, response.code)
                hideModal($('#addCustomerModal'));
            }else{
                runToast(response.msg, response.code)
            }
        })
    })






    //============================================= WEBSITE JS ==============================================


    $('#itemQuantity').on('change keyup', function (){

        let total = calculatePrice($(this).val(), $('#itemPriceData').val());

        $('#itemPrice').html('GHS '+total);
    })


    function calculatePrice(multiplier, price){
        return Number(multiplier * price).toFixed(2);
    }





    // Add Item to Cart
    $('.addToCartBtn').on('click', function (e){
        e.preventDefault();

        addToCart($(this).attr('href'), false ,1)
    })


    // Add item to cart on product detail page, with item number

    $('#addToCartWithItem').on('click', function (e){
        e.preventDefault();

        addToCart($(this).attr('href'), true, ''+$('#itemQuantity').val())
    });


    // Remove item from cart in notification area
    $('#cart-list').on('click', '#del-icon', function (e){

        e.preventDefault();

        let parent = $(this).closest('.product'),
            url = $(this).attr('href'),
            path = window.location.pathname;



        $.post(url, function (response){
            if(response.code == '200'){
                if (path == '/shop/cart'){
                    window.location.reload();
                }else{
                    runToast(response.msg, response.code)
                    runCartUpdate(response)
                }
            }else{
                runToast(response.msg, response.code)
            }
        });

        parent.remove();
    })

    $('.removeCart').click(function (e){
        e.preventDefault();
        url = $(this).attr('href');

        $.post(url, function (response){
            if(response.code == '200'){
                window.location.reload();
            }else{
                runToast(response.msg, response.code)
            }
        });

    })


    function addToCart(url, withValues = false, formdata = null){

        if (withValues == true){
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'item_value': formdata
                },
            }).done((response) => {
                if(response.code == '200'){
                    runToast(response.msg, response.code)
                    runCartUpdate(response)

                }else{
                    runToast(response.msg, response.code)
                }
            })
        }else{

            $.post(url, function (response){
                if(response.code == '200'){
                    runToast(response.msg, response.code)
                    runCartUpdate(response);
                }else{
                    runToast(response.msg, response.code)
                }
            });
        }
    }



    $('#updateCartBtn').on('click', function (e){
        e.preventDefault();
        let form_data = [];
        $('input[name="item_quantity"]').each(function (item){
            form_data.push({
                'form_value': $(this).val(),
                'rowId': $(this).attr('title')
                }
            )
        })

        url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'POST',
            data: {'fields': form_data}
        }).done((response) => {
            if(response.code == '200'){
                window.location = response.url
            }else{
                runToast(response.msg, response.code)
            }
        })
    })




    function runCartAjaxCalls(url, data){
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
        }).done((response) => {
            if (response.code == '200'){
                runToast(response.msg, response.code)
                window.location.reload();
            }else{
                runToast(response.msg, response.code)
            }
        })
    }

    $('#couponForm').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response) => {
            if (response.code == '200'){
                runToast(response.msg, response.code)
                window.location.reload();
            }else{
                runToast(response.msg, response.code)
            }
        })
    })


    $('.shippingCart').submit(function (e){
        e.preventDefault();
        runCartAjaxCalls($(this).attr('action'), $(this).serialize());
    })

    $('#clearCartBtn').click(function (e){
        e.preventDefault();

        e.preventDefault()
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to clear your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Clear'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    })


    function runCartUpdate(response){
        let cart_dropdown = ``,
            item_image,
            route,
            cart_total = ``;

        $.each(response.cart, function (i, item){
            $.each(item.options, function (option, items_option){
                item_image = item.options['product_image']

            })
            route = response.base_path+item.rowId+'/remove';

            cart_dropdown += `
                <div class="product">
                    <div class="product-cart-details" style="width: 100%;">
                        <h4 class="product-title">
                            <a href="#">${item.name}</a>
                        </h4>
                        <span class="cart-product-info">
                                           <span class="cart-product-qty">${item.qty}</span>
                                             x GHS ${item.subtotal}
                                            </span>
                    </div>
                    <figure class="product-img-container" style="width:100%;">
                        <a href="#" class="product-img">
                            <img src="../../../${item_image}" alt="product" class="img-fluid" style="height: 100px; width: 100%;">
                        </a>
                    </figure>
                    <a href="${route}" class="btn-remove" id="del-icon" title="Remove Product"><i class="icon-close"></i></a>
                </div>`


        });


        $('.dropdown-cart-products').html(cart_dropdown)
        $('.cart-count').html(response.cart_count)
        $('.cart-total-price').html(response.cart_total)
    }

    // cart_dropdown += `<li>
    //                                         <div class="cart-img">
    //                                             <a href="#"><img src="${item_image}" alt=""></a>
    //                                         </div>
    //                                         <div class="cart-info">
    //                                             <h4><a href="">${item.name} (${item.qty})</a></h4>
    //                                             <span>GHS ${item.subtotal}</span>
    //                                         </div>
    //                                         <div class="del-icon">
    //                                             <a href="${route}" class="text-danger" id="del-icon"><i class="fa fa-times"></i></a>
    //                                         </div>
    //                                     </li>
    //                                 `;


    /* ================================== CHECKOUT SCRIPTS =============================== */

    $('#cartLogin').submit(function (e){
        e.preventDefault();
        runCartAjaxCalls($(this).attr('action'), $(this).serialize())
    })



    $('#orderForm').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        let btn_order = $('.btn-order');
        btn_order.prop('disabled', true)
        btn_order.html('Processing...')
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response) => {
            if (response.code == '200'){
                runToast(response.msg, response.code)
                window.location.href = response.url;
            }else{
                btn_order.prop('disabled', false);
                btn_order.html('Proceed to Payment')
                runToast(response.msg, response.code)
            }
        })
    })

    $('#customerAccountUpdate').submit(function (e){
        e.preventDefault();
        runCartAjaxCalls($(this).attr('action'), $(this).serialize());
    })


    $('.clientRegister').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');
        let formdata = new FormData(this);

        runSubmission(url, formdata);

    })


    $('.clientLogin').submit(function (e){
        e.preventDefault();
        url = $(this).attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
        }).done((response) => {
            if(response.code == '200'){
                window.location = response.msg
            }else {
                runToast(response.msg, response.code)
            }
            })

    })


    $('.reviewForm').submit(function (e){
        e.preventDefault();

        url = $(this).attr('action');

        // $('#reviewBtn').prop('disabled', true)
        switchButton(true, 'Add Review', 'reviewBtn')

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize()
        }).done((response) => {

            if (response.code == '200'){
                window.location.reload();

                switchButton(false, 'Add Review', 'reviewBtn');
            }else{
                switchButton(false, 'Add Review', 'reviewBtn')
                runToast(response.msg)
            }
        })

    })


    function switchButton(is_not_switched = true, text, element){
        element = $(`#${element}`);

        if(is_not_switched === true){
            element.prop('disabled', true);
            element.text('Processing...')
        }else{
            element.prop('disabled', false);
            element.text(text)
        }

    }



    $('#checkout-create-acc').change(function (){
        toggleFormFields($(this), $('.create_account'))
    });

    $('#checkout-diff-address').change(function () {
        toggleFormFields($(this), $('.ship_to_diff_address'))
    })


    function toggleFormFields(item, form_field){
        if(item.is(":checked")){
            form_field.show(400)
        }else{
            form_field.hide(400)
        }
    }



    $('.addToWishlist').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            method: 'POST',
            data: $(this).serialize(),
        }).done((response) => {
            if(response.code == '200'){
                runToast(response.msg, response.code)
                $('.wishlist_count').html(`(${response.count})`)
            }else {
                runToast(response.msg, response.code)
            }
        })
    })



    $('#sortby').change(function (e){
        e.preventDefault();

        url = $('#filterUrl').val();

        window.location.href = url+'?sort='+$(this).val();
    })


    // $('.submitContact').submit(function (e){
    //     e.preventDefault();
    //
    //     url = $(this).attr('action');
    //
    //     let formData = new FormData(this);
    //
    //     $('#contactBtn').html('Processing...')
    //     $('#contactBtn').prop('disabled', true)
    //
    //     $.ajax({
    //         url: url,
    //         method: 'POST',
    //         data: formData,
    //         dataType: 'JSON',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //     }).done((response) => {
    //
    //         console.log('some response', response)
    //         if(response.code == '200'){
    //             runToast(response.msg, response.code)
    //             $('#contactBtn').html('Submit')
    //             $('#contactBtn').prop('disabled', false)
    //         }else{
    //             runToast(response.msg, response.code)
    //             $('#contactBtn').html('Submit')
    //             $('#contactBtn').prop('disabled', false)
    //         }
    //     })
    //
    //
    //
    // })
});

