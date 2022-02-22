<script>

    // alert('514,product'.split(',')[1])

    let product_rows = [];

    let discount_type = ``

    let discount = 0

    let fetched_products = []

    let fetched_taxes = []

    let input_description = {
        row_id : 0,
        description: ''
    }

    let input_price = {
        row_id: 0,
        price: 0
    }


    let prepared_products = [];

    let fetch_products_url = `{{route('admin.fetch.products')}}`


    fetchData(fetch_products_url)


    function fetchData(url)
    {
        $.ajax({
            url
        }).done((data) => {

            if(!jQuery.isEmptyObject(data))
            {

                let product_data = {}

                fetched_products = data

                console.log('This is the logged product', fetched_products);

                $.each(fetched_products, function (i, product) {

                    product_data.id = product.id

                    product_data.description = product.description

                    product_data.quantity = product.quantity ? product.quantity : 1 //`<input type="number" title="${product.id}" onchange="updateItemQuantity()" value="1" min="1" max="${product.quantity}" class="form-control input_quantity">`

                    product_data.price = product.price

                    product_data.sub_total = product.price

                    prepared_products.push(product_data)

                    product_data = {}
                })
            }
        })
    }

    $('#discount').keyup(function(){

        discount = $(this).val()


        if(product_rows.length > 0)
        {
            RedoTotalCalculations()
        }
    })

    $('#add_prod_btn').click(()=>{

        addRow();
    })

    function deleteRow(row_id)
    {
        // delete the process flow from the position
        product_rows = product_rows.filter(row_data => row_data.row_id !== Number(row_id))

        //reset the ids actions
        $.each(product_rows, (i, row_data) => {

            row_data.row_id = i +1;

            row_data.row_action = `<td>
                                            <a href="javascript:void(0);"  title="${row_data.row_id}" class="btn btn-icon shadow btn-danger btn-sm btn-circle mr-2 convert del_row"><i class="fa fa-sm fa-trash"></i></a>
                                        </td>
                                     </tr>`
        })

        displayRowItems()
    }

    function setProductOptions(selected_product_id=null, item_type=null)
    {
        let product_options = ``



        $.each(fetched_products, function(i, product)
        {
            if(selected_product_id !== null)
            {

                let product_selected = product.id === selected_product_id ? 'selected' : '',
                    item_name = product.name

                product_options += `<option ${product_selected} title="" value="${product.id}">${item_name}</option>`

            }else{

                let item_name = product.name;

                product_options += `<option value="${product.id}">${item_name}</option>`
            }

        })

        // console.log(product_options)

        return product_options
    }



    function addRow()
    {
        let new_row_id = product_rows.length + 1

        let product_options = setProductOptions()

        product_rows.push({
            product_options,
            row_sub_total : ``,
            quantity: '',
            row_id: new_row_id,
            description: '',
            price: ``,
            selected_tax_ids_from_grid: [],
        })

        console.log('product_options upon add:', product_options)

        displayRowItems()
    }

    function updateItemQuantity(selected_row_id, input_item_quantity)
    {

        console.log('update item quantity', input_item_quantity)
        let row_id = selected_row_id;

        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))



        // let selected_product_id_from_grid = current_row_content.selected_product_id

        // let product = prepared_products.find(row_data => row_data.id === Number(selected_product_id_from_grid))

        let product = prepared_products.find(row_data => row_data.id === Number(row_id))


        // alert('logging unit price')
        //
        // alert(current_row_content.price)

        // alert('new quantity')
        //
        // alert(input_item_quantity)

        let sub_total = Number(current_row_content.price) * Number(input_item_quantity)

        // alert('sub total')
        //
        // alert(sub_total)

        console.log("current row content", current_row_content)

        current_row_content.row_sub_total = sub_total

        current_row_content.quantity = input_item_quantity

        //recalculate tax when there the quantity change

        displayRowItems()


        // $('.input_quantity').focus().val(input_item_quantity);
        //
        // if($('.input_quantity').is('.input_quantity:last') && $('.input_quantity').last()){
        //     // alert('wow')
        //     $('.input_quantity').focus().val(input_item_quantity);
        // }





    }

    function displayRowItems()
    {
        let main_dom = ``

        let all_data_with_tax = {
            sub_total: 0,
            taxes: 0,
            grand_total: 0,
            discounted_amount: 0
        }

        $.each(product_rows, function (i, row_content){

            if(row_content.selected_product_id !== undefined)
            {
                row_content.product_options = setProductOptions(row_content.selected_product_id, row_content.item_type)
            }

            let new_row_content = gridSkeleton(row_content)

            main_dom += new_row_content

            all_data_with_tax.sub_total += Number(row_content.row_sub_total)

        })

        $('#tbody').html(main_dom)

        styleSelectTags()

        $('#all_sub_total').val(all_data_with_tax.sub_total)


        let net_total = all_data_with_tax.sub_total;

        $('#all_net').val(parseFloat(net_total).toFixed(2))

        //delete a row from a quotation table list
        $('.del_row').click(function(){

            let selected_row_id = $(this).attr('title')

            deleteRow(selected_row_id)
        })

        $('.selected_grid_product').change(function() {

            console.log('logging selected value', $(this).children("option:selected").val());

            let selected_product_id = $(this).children("option:selected").val();

            let row_id = $(this).attr('title')

            console.log('logging row id', row_id);

            populateFormRow(row_id, selected_product_id)

        });


        $('.input_quantity').on('keyup', function(){

            let input_item_quantity = $(this).val()

            let row_id = $(this).attr('title'),
                item_id = $(this).attr('id');

            updateItemQuantity(row_id, input_item_quantity)

            RedoTotalCalculations(item_id, 'quantity');



        })



        //
        $('.item_price').keyup(function(){

            let item_price = $(this).val(),
                item_id = $(this).attr('id');

            if(Number(item_price) === 0)
            {
                initErrorAlert('Unit Price can\'t be 0')

            }else{

                input_price.row_id = $(this).attr('title')

                input_price.price = item_price

                RedoTotalCalculations(item_id);

                $(this).focus()

            }

        })




        $('.description').keyup(function(){

            input_description.description = $(this).val()

            // console.log(input_description.description)

            input_description.row_id = $(this).attr('title')

        })
    }

    function gridSkeleton(row_data)
    {
        console.log(row_data)

        if(Number(row_data.row_id) === Number(input_description.row_id))
        {
            row_data.description = input_description.description

            input_description.row_id = 0

            input_description.description = ''
        }

        if(Number(row_data.row_id) === Number(input_price.row_id))
        {
            row_data.price = input_price.price

            input_price.price = 0

            input_price.row_id = 0

            row_data.row_sub_total = row_data.price * row_data.quantity
        }

        let description = row_data.description === '' || row_data.description === null ? `` : row_data.description;

        let price = row_data.price === '' ? `` : row_data.price;

        let subtotal = row_data.row_sub_total === '' ? `` : row_data.row_sub_total;

        let quantity = ``

        let row_discount = ``

        if(row_data.quantity === '')
        {
            quantity = `<input type="number" style="width: 100px;" value="1" min="1" disabled name="quantity" class="form-control">`

        }

        quantity = `<input type="number" id="item_unit_quantity_${row_data.row_id}" style="width: 100px;" title="${row_data.row_id}"  value="${row_data.quantity}" min="1" max="${row_data.max_quantity}" class="form-control input_quantity">`


        return `<tr>
                            <td>
                                <select name="product" title="${row_data.row_id}" class="form-control select2 selected_grid_product" style="width: 200px;">
                                        <option value="">Select Product</option>
                                        ${row_data.product_options}
                                    </select>
                                </td>
                                <td><textarea class="form-control description" title="${row_data.row_id}"> ${description}</textarea></td>
                                <td><input type="text" readonly id="item_price_${row_data.row_id}" style="width: 100px;" class="form-control item_price" title="${row_data.row_id}"  value="${price}"</td>
                                <td>${quantity}</td>

                                <td><input type="number" disabled class="form-control" value="${subtotal}"</td>
                                <td>
                                    <a href="javascript:void(0);"  title="${row_data.row_id}" class="btn btn-icon shadow btn-danger btn-sm btn-circle mr-2 convert del_row"><i class="fa fa-sm fa-trash"></i></a>
                                </td>
                            </tr>
                           `;
    }



    function populateFormRow(row_id, selected_product_id_from_grid)
    {

        let product_id = selected_product_id_from_grid.split(',')[0]

        let item_type = selected_product_id_from_grid.split(',')[1]

        //get the product using the selected product id
        let product = prepared_products.find(row_data => row_data.item_type === item_type && row_data.id === Number(product_id))

        console.log('product', product);

        //get the content of row from which the product was selected
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))



        //set subtotal for the row content
        current_row_content.row_sub_total = product.sub_total


        //set input quantity for the row content
        current_row_content.quantity = 1

        current_row_content.description = product.description

        current_row_content.price = product.price

        current_row_content.selected_product_id = product.id

        current_row_content.max_quantity = product.quantity

        current_row_content.apply_row_discount = false

        // current_row_content.product_options = product_options

        displayRowItems()
    }




    function RedoTotalCalculations(id = null, type = null)
    {
        if(id != null){
            let get_id = '#'+id;
            if($(get_id).val() != ''){
                strLength = $(get_id).val().length * 2;
                if(type != null){
                    changeQtyAttr(get_id, strLength);
                }else{
                    changeAttr(get_id, strLength);
                }
            }

        }


    }

    function changeAttr(element, length){
        $(element).focus();
        if($(element).val().length > 0){
            $(element)[0].setSelectionRange(length, length);
        }
    }

    function changeQtyAttr(element, length){
        $(element).attr('type', 'text');
        $(element).focus();
        $(element)[0].setSelectionRange(length, length);
        $(element).attr('type', 'number');
    }


    function resetRowUnitPrice(row_id, input_price)
    {
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        current_row_content.price = input_price

        console.log('changed price is ' + input_price)

        RedoTotalCalculations()

        displayRowItems()
    }

    function resetRowDescription(row_id, description)
    {
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        current_row_content.description = description

        displayRowItems()
    }

    $('#invoice').submit(function (e){
        e.preventDefault();


        let customer_id = $('#customer_id').val()
        let sales_order_number = $('#sales_order_number').val()
        let invoice_number = $('#invoice_number').val()
        let invoice_term = $('#invoice_term').val()
        let invoice_date = $('#invoice_date').val()
        let purchase_date = $('#purchase_date').val()
        let cost_center = $('#cost_center').children("option:selected").val();
        let reference = $('#reference_no').val()
        let bill_to = $('#bill_to').val()
        let ship_to = $('#ship_to').val()
        let customer_balance = $('#customer_balance').val()
        let discount_type = $('#discount_type').val()
        let discount = $('#discount').val()
        let discount_date = $('#discount_date').val()
        let vat_wth_acc_id = $('#vat_wth_acc_id').val()
        let wth_acc_id = $('#wth_acc_id').val()
        // let status = $('#status').children("option:selected").val();
        let description = $('#description').val()
        let invoice_message = $('#invoice_message').val()
        let sub_total = $('#all_sub_total').val()
        let total_applied_tax = $('#all_tax').val()
        let total_applied_discount = $('#all_discount_amount').val()
        let net_total = $('#all_net').val()
        let nhil_total = $('#nhil_total').val();
        let cst_total = $('#cst_total').val();
        let getfund_total = $('#getfund_total').val();
        let vat_total = $('#vat_total').val();
        let covid_total = $('#covid_total').val();
        let vat_flat_total = $('#vat_flat_total').val();

        let data = {
            customer_id,
            sales_order_number,
            invoice_number,
            invoice_term,
            invoice_date,
            purchase_date,
            cost_center,
            reference,
            bill_to,
            ship_to,
            customer_balance,
            discount_type,
            discount,
            discount_date,
            vat_wth_acc_id,
            wth_acc_id,
            description,
            invoice_message,
            sub_total,
            total_applied_tax,
            total_applied_discount,
            net_total,
            nhil_total,
            cst_total,
            getfund_total,
            vat_total,
            covid_total,
            vat_flat_total,
            product_rows
        }

        if (product_rows.length === 0) {

            initErrorAlert('Row items in the grid can\'t be empty');
        }

        console.log('this is the sending items', data);


        $.ajax({
            url: '',
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data_type: 'json',
            data,
        }).done((response) => {
            console.log('This is the ajax response', response)
            if (response.message === 'success') {

                console.log(response)

                window.location.reload();

            }
            else {
                console.log(response)

                let errors = `${response.message}`

                if(errors === 'Quotation Items can\'t be empty. Please select one or more quotation items')
                {
                    $('#errorMsg').html(errors)
                    console.log(errors)

                }else if(errors === 'error'){

                    $('#errorMsg').html('Whoops! Something went wrong')
                    console.log(errors)

                }else if(errors.includes('Exchange Rate between')){

                    $('#errorMsg').html(errors)
                    console.log(errors)

                }else if(errors.includes('Quotation cannot be generated with product in different currencies')){

                    $('#errorMsg').html(errors)
                    console.log(errors)

                }else {

                    let error_dom = ``


                    console.log('logging validation errors from the controller')

                    console.log(response.errors)

                    if(typeof(response.errors) === 'string')
                    {
                        error_dom += `${error}<br>`
                    }else{

                        $.each(response.errors, (i, error)=> {

                            error = error.replace('[', '')
                            error = error.replace(']', '')

                            error_dom += `${error}<br>`
                        })
                    }

                    $('#errorMsg').html(error_dom)
                    console.log(error_dom)
                }


                $('#errorMsg').show();
                //
                $('#errorMsg').fadeOut(15000)
            }
        })
    })


    function styleSelectTags()
    {
        $(".selected_grid_product").select2();
        $(".selected_grid_tax").select2();
    }

    function displayQuotationItems(data)
    {
        console.log(data)

        product_rows = []

        $.each(data, function (i, product) {

            let new_row_id = product_rows.length + 1

            let tax_options = setTaxOptions()

            let product_options = setProductOptions(product.id, product.item_type)

            let selected_tax_ids_from_grid = []

            if(product.selected_taxes === null)
            {
                //leave it selected_tax_ids_from_grid as empty array

            }else if(product.selected_taxes === undefined){

                //leave it selected_tax_ids_from_grid as empty array

            }else{

                selected_tax_ids_from_grid = JSON.parse(product.selected_taxes)
            }

            product_rows.push({
                product_options,
                row_sub_total : product.total,
                quantity: product.quantity ? product.quantity : 1,
                row_id: new_row_id,
                description: product.description,
                tax_options,
                quotation_item_id_in_db: product.id,
                selected_product_id: product.item_type === 'product' ? product.product_id : product.service_id,
                item_type: product.item_type,
                price: product.price,
                currency_id: product.currency_id,
                apply_row_discount: product.apply_discount === 1,
                selected_tax_ids_from_grid
            })

            console.log(product_rows)
        })

        displayRowItems()

    }









</script>
