<script>

    // alert('514,product'.split(',')[1])

    let product_rows = [];

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

    let discount_type = $('#discount_type'),
        shipping_fee = $('#shipping_fee'),
        discount_amount = $('#discount_amount'),
        discount_total;


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

    function initErrorAlert(msg){
        Swal.fire(
            'Error!',
            msg,
            'error'
        )
    }

    function updateItemQuantity(selected_row_id, input_item_quantity)
    {

        console.log('update item quantity', input_item_quantity)
        let row_id = selected_row_id;

        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        let product = prepared_products.find(row_data => row_data.id === Number(row_id))

        let sub_total = Number(current_row_content.price) * Number(input_item_quantity)

        console.log("current row content", current_row_content)

        current_row_content.row_sub_total = sub_total

        current_row_content.quantity = input_item_quantity

        displayRowItems()

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


        let net_total = all_data_with_tax.sub_total,
            total,
            discount = 0;

        if (discount_type.val() == 'fixed'){

            total = (net_total + parseInt(shipping_fee.val())) - parseInt(discount_amount.val());

            $('#discount_total').val(discount_amount.val());

        }else{

            total = parseInt(net_total) + parseInt(shipping_fee.val());

            discount = (total * discount_amount.val()) / 100

            total = total - discount;

            $('#discount_total').val(discount);
        }

        $('#all_net').val(parseFloat(total).toFixed(2))

        //delete a row from a quotation table list
        $('.del_row').click(function(){

            let selected_row_id = $(this).attr('title')

            deleteRow(selected_row_id)
        })



        $('.selected_grid_product').change(function() {

            let selected_product_id = $(this).children("option:selected").val();

            let row_id = $(this).attr('title')

            populateFormRow(row_id, selected_product_id)

        });


        $('.input_quantity').on('keyup', function(){

            let input_item_quantity = $(this).val()

            let row_id = $(this).attr('title'),
                item_id = $(this).attr('id');

            updateItemQuantity(row_id, input_item_quantity)

            RedoTotalCalculations(item_id, 'quantity');



        })


        $('.description').keyup(function(){

            input_description.description = $(this).val()

            input_description.row_id = $(this).attr('title')

        })


    }

    $('#shipping_fee').keyup(function (){
        $('#shipping').val(Number($(this).val()).toFixed(2))
        displayRowItems();
    })


    discount_type.change(function (){
        displayRowItems();
    })

    discount_amount.keyup(function (){

        if(discount_type.val() == ''){

            initErrorAlert('Select discount type before adding a discount value');

            $(this).val('')

            return false;
        }else{
            displayRowItems()
        }
    })

    function gridSkeleton(row_data)
    {

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

        RedoTotalCalculations()

        displayRowItems()
    }

    function resetRowDescription(row_id, description)
    {
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        current_row_content.description = description

        displayRowItems()
    }

    $('#susu_form').submit(function (e){
        e.preventDefault();

        let customer = $('#customer').val();
        let payment_interval = $('#payment_interval').val();
        let initial_amount = $('#initial_amount').val();
        let remarks = $('#remarks').val();
        let shipping_fee = $('#shipping_fee').val();
        let discount_type = $('#discount_type').val();
        let discount_amount = $('#discount_amount').val();
        let all_sub_total = $('#all_sub_total').val();
        let all_net = $('#all_net').val();
        let shipping = $('#shipping').val();
        let discount_total = $('#discount_total').val();
        let payment_status = $('#payment_status').val();

        let data = {
            customer,
            shipping_fee,
            discount_type,
            discount_amount,
            all_sub_total,
            all_net,
            shipping,
            discount_total,
            payment_status,
            product_rows,
            payment_interval,
            initial_amount,
            remarks,

        }

        if (product_rows.length === 0) {

            initErrorAlert('Row items in the grid cannot be empty');
        }


        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data_type: 'json',
            data,
        }).done((response) => {
            console.log(response)
            if (response.code == '200') {

                window.location.reload();

            } else {
                initErrorAlert(response.msg)

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
