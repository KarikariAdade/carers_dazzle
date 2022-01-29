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
        unit_price: 0
    }

    let currency_convert = {
        convert: false,
        default_currency: Number(`{{$default_currency}}`)
    }

    let prepared_products = [];

    let fetch_products_url = `{{route('retailer.fetch.products.for.quotation')}}`

    let fetch_taxes_url = `{{route('retailer.fetch.taxes.for.quotation')}}`

    fetchData(fetch_products_url)

    fetchData(fetch_taxes_url)

    function fetchData(url)
    {
        $.ajax({
            url
        }).done((data) => {

            if(!jQuery.isEmptyObject(data))
            {


                if(url === `{{route('retailer.fetch.taxes.for.quotation')}}`)
                {
                    fetched_taxes = data

                }else{

                    let product_data = {}

                    fetched_products = data

                    console.log('This is the logged product', fetched_products);

                    $.each(fetched_products, function (i, product) {

                        product_data.id = product.id

                        product_data.description = product.description

                        product_data.item_type = product.item_type

                        product_data.quantity = product.quantity ? product.quantity : 1 //`<input type="number" title="${product.id}" onchange="updateItemQuantity()" value="1" min="1" max="${product.quantity}" class="form-control input_quantity">`

                        product_data.unit_price = product.item_type === 'product' ? ( product.selling_price > 0 ? product.selling_price : product.price) : product.service_price

                        product_data.sub_total = product.item_type === 'product' ? ( product.selling_price > 0 ? product.selling_price : product.price) : product.service_price //with initial quantity = 1

                        product_data.currency_id = product.currency_id

                        prepared_products.push(product_data)

                        product_data = {}
                    })
                }
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

    $('#discount_type').change(function(){

        discount_type = $(this).children("option:selected").val();


        if(product_rows.length > 0)
        {
            RedoTotalCalculations()
        }
    })

    function calculateDiscount(row_id)
    {

        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        let sub_total = current_row_content.quantity * current_row_content.unit_price

        let discount_amount = 0

        if(discount === 0)
        {
            discount = $('#discount').val()
        }

        if(discount_type === '')
        {
            discount_type = $('#discount_type').children("option:selected").val();
        }

        if(discount_type !== '' &&  discount > 0)
        {
            discount_amount = checkDiscountType(sub_total)

            let row_discount = sub_total - discount_amount

            if(row_discount < 0 )
            {
                initErrorAlert('Discount amount can\'t be more than the subtotal')
            }else{

                current_row_content.apply_row_discount = true
            }

        }else{

            current_row_content.apply_row_discount = false

            current_row_content.row_sub_total = sub_total

            //alert either discount type and discount has not been set

            initErrorAlert('Discount type or discount is required')

        }

        displayRowItems()
    }

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
                    item_name = product.item_type == 'product' ? product.name : product.service_name;

                product_options += `<option ${product_selected} title="${product.item_type}" value="${product.id},${product.item_type}">${item_name}</option>`

            }else{

                let item_name = product.item_type == 'product' ? product.name : product.service_name;

                product_options += `<option value="${product.id},${product.item_type}" title="${product.item_type}">${item_name}</option>`
            }

        })

        // console.log(product_options)

        return product_options
    }

    function setTaxOptions(selected_tax_id=null)
    {
        tax_options = ``

        $.each(fetched_taxes, function(i, tax)
        {
            if(selected_tax_id !== null)
            {
                let tax_selected = tax.id === Number(selected_tax_id) ? 'selected' : ''

                tax_options += `<option ${tax_selected} value="${tax.id}">${tax.name}</option>`

            }else{

                tax_options += `<option value="${tax.id}">${tax.name}</option>`
            }
        })

        return tax_options
    }

    function addRow()
    {
        let new_row_id = product_rows.length + 1

        let product_options = setProductOptions()

        let tax_options = setTaxOptions()

        product_rows.push({
            product_options,
            row_sub_total : ``,
            quantity: '',
            row_id: new_row_id,
            description: '',
            tax_options,
            unit_price: ``,
            selected_tax_ids_from_grid: [],
        })

        console.log('product_options upon add:', product_options)

        displayRowItems()
    }

    function updateItemQuantity(selected_row_id, input_item_quantity)
    {

        let row_id = selected_row_id.split(',')[0]

        // alert(row_id)

        let item_type = selected_row_id.split(',')[1]
        //
        // alert(item_type)

        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))



        // let selected_product_id_from_grid = current_row_content.selected_product_id

        // let product = prepared_products.find(row_data => row_data.id === Number(selected_product_id_from_grid))

        let product = prepared_products.find(row_data => row_data.item_type === item_type && row_data.id === Number(row_id))


        // alert('logging unit price')
        //
        // alert(current_row_content.unit_price)

        // alert('new quantity')
        //
        // alert(input_item_quantity)

        let sub_total = Number(current_row_content.unit_price) * Number(input_item_quantity)

        // alert('sub total')
        //
        // alert(sub_total)

        console.log("current row content", current_row_content)

        current_row_content.row_sub_total = sub_total

        current_row_content.quantity = input_item_quantity

        //recalculate tax when there the quantity change
        populateRowTax(row_id, current_row_content.selected_tax_ids_from_grid)

        displayRowItems()

        // current_row_content.quantity.focus().val(input_item_quantity);
        //
        // let input = item.parent().find('.input_quantity');
        //
        // // console.log(item.parent().find('.input_quantity').val())
        //
        // item.parent().find('.input_quantity').focus().val("").val('44');
        //s
        // alert($(".input_quantity").filter(":selected").val());

        // Replicate this code on other models

        // if($('.input_quantity').is('.input_quantity:last')){
        //     $('.input_quantity:last').focus().val("").val(input_item_quantity);
        // }
        //
        // $('.input_quantity').focusout(function (){
        //     $(this).focus().val('').val(input_item_quantity)
        // })
        //
        // if($(this).is($('.payments').last()))


        $('.input_quantity').focus().val(input_item_quantity);

        if($('.input_quantity').is('.input_quantity:last') && $('.input_quantity').last()){
            // alert('wow')
            $('.input_quantity').focus().val(input_item_quantity);
        }





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

            if(row_content.selected_tax_ids_from_grid !== undefined)
            {

                if(row_content.selected_tax_ids_from_grid.length > 0)
                {
                    row_content.tax_options = MarkTaxesAsChecked(row_content.selected_tax_ids_from_grid, row_content)

                }else{
                    row_content.tax_options = setTaxOptions(row_content.selected_tax_id)
                }
            }


            let new_row_content = gridSkeleton(row_content)

            main_dom += new_row_content

            all_data_with_tax.sub_total += Number(row_content.row_sub_total)

            if(row_content.apply_row_discount)
            {
                all_data_with_tax.discounted_amount += Number(checkDiscountType(row_content.row_sub_total))
            }

            if(row_content.row_tax_amount !== undefined)
            {
                all_data_with_tax.taxes += row_content.row_tax_amount
            }
        })

        $('#tbody').html(main_dom)

        styleSelectTags()

        $('#all_sub_total').val(all_data_with_tax.sub_total)

        $('#all_discount_amount').val(all_data_with_tax.discounted_amount)

        $('#all_tax').val(all_data_with_tax.taxes)

        let net_total = ((all_data_with_tax.sub_total - all_data_with_tax.discounted_amount) + all_data_with_tax.taxes)

        $('#all_net').val(parseFloat(net_total).toFixed(2))

        //delete a row from a quotation table list
        $('.del_row').click(function(){

            let selected_row_id = $(this).attr('title')

            deleteRow(selected_row_id)

            GetIndividualTaxes();
        })

        $('.selected_grid_product').change(function() {

            console.log('logging selected value', $(this).children("option:selected").val());

            let selected_product_id = $(this).children("option:selected").val();

            let row_id = $(this).attr('title')

            console.log('logging row id', row_id);

            populateFormRow(row_id, selected_product_id)

            GetIndividualTaxes();

        });

        $('.selected_grid_tax').change(function() {

            console.log('logging selected tax value', $(this).children("option:selected").toArray().map(item => item.value));

            // let selected_product_id = $(this).children("option:selected").val();

            let selected_tax_ids = $(this).children("option:selected").toArray().map(item => item.value);

            let row_id = $(this).attr('title')

            console.log('logging row id', row_id);

            populateRowTax(row_id, selected_tax_ids)

            GetIndividualTaxes();


        });

        $('.apply_discount').click(function() {

            let row_id = $(this).attr('title')

            if($(this).is(':checked'))
            {
                calculateDiscount(row_id)

            }else{
                reCalculateDiscount(row_id)
            }
        })

        $('.input_quantity').on('keyup', function(){

            let input_item_quantity = $(this).val()

            let row_id = $(this).attr('title'),
                item_id = $(this).attr('id');

            updateItemQuantity(row_id, input_item_quantity)

            RedoTotalCalculations(item_id, 'quantity');

            GetIndividualTaxes();


        })



        //
        $('.item_unit_price').keyup(function(){

            let item_unit_price = $(this).val(),
                item_id = $(this).attr('id');

            if(Number(item_unit_price) === 0)
            {
                initErrorAlert('Unit Price can\'t be 0')

            }else{

                input_price.row_id = $(this).attr('title')

                input_price.unit_price = item_unit_price

                RedoTotalCalculations(item_id);

                // alert('item price');

                GetIndividualTaxes();

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
            row_data.unit_price = input_price.unit_price

            input_price.unit_price = 0

            input_price.row_id = 0

            row_data.row_sub_total = row_data.unit_price * row_data.quantity
        }

        let description = row_data.description === '' || row_data.description === null ? `` : row_data.description;

        let unit_price = row_data.unit_price === '' ? `` : row_data.unit_price;

        let subtotal = row_data.row_sub_total === '' ? `` : row_data.row_sub_total;

        let quantity = ``

        let row_discount = ``

        // if(row_data.quantity === '')
        // {
        //     quantity = `<input type="number" style="width: 100px;" value="1" min="1" disabled name="quantity" class="form-control">`
        //
        // }
        if(row_data.item_type === 'service')
        {
            quantity = `<input type="text" id="item_unit_quantity_${row_data.row_id}" style="width: 100px;" value="0" readonly name="quantity" class="form-control input_quantity" autofocus>`

        }
        else{
            quantity = `<input type="number" id="item_unit_quantity_${row_data.row_id}" style="width: 100px;" title="${row_data.row_id},${row_data.item_type}"  value="${row_data.quantity}" min="1" max="${row_data.max_quantity}" class="form-control input_quantity">`
        }

        if(row_data.apply_row_discount)
        {
            row_discount =  `<input type="checkbox" checked title="${row_data.row_id}" name="discount" class="apply_discount ml-3" value="1">`

        }else{

            row_discount =  `<input type="checkbox" title="${row_data.row_id}" name="discount" class="apply_discount ml-3" value="1">`
        }

        return `<tr>
                            <td>
                                <select name="product" title="${row_data.row_id}" class="form-control select2 selected_grid_product" style="width: 200px;">
                                        <option value="">Select Product/Service</option>
                                        ${row_data.product_options}
                                    </select>
                                </td>
                                <td><input class="form-control description" title="${row_data.row_id}" value="${description}"/></td>
                                <td><input type="text" id="item_unit_price_${row_data.row_id}" style="width: 100px;" class="form-control item_unit_price" title="${row_data.row_id}"  value="${unit_price}"</td>
                                <td>${quantity}</td>
                                <td>${row_discount}</td>
                                <td>
                                    <select class="form-control select2 mt-3 selected_grid_tax" multiple="" style="width:140px;" title="${row_data.row_id}">
                                        <option value="">Select Tax</option>
                                        ${row_data.tax_options}
                                    </select>
                                </td>
                                <td><input type="number" disabled class="form-control" value="${subtotal}"</td>
                                <td>
                                    <a href="javascript:void(0);"  title="${row_data.row_id}" class="btn btn-icon shadow btn-danger btn-sm btn-circle mr-2 convert del_row"><i class="fa fa-sm fa-trash"></i></a>
                                </td>
                            </tr>
                           `;
    }

    function reCalculateDiscount(row_id)
    {
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        let sub_total = current_row_content.quantity * current_row_content.unit_price

        current_row_content.apply_row_discount = false

        current_row_content.row_sub_total = sub_total

        displayRowItems()
    }

    function populateFormRow(row_id, selected_product_id_from_grid)
    {

        console.log('selected product from grid ', selected_product_id_from_grid)

        let product_id = selected_product_id_from_grid.split(',')[0]

        console.log(product_id)

        let item_type = selected_product_id_from_grid.split(',')[1]

        console.log(item_type, 'loging item type')

        //get the product using the selected product id
        let product = prepared_products.find(row_data => row_data.item_type === item_type && row_data.id === Number(product_id))

        if(Number(product.currency_id) !== currency_convert.default_currency)
        {
            currency_convert.convert = true // if at least one currency != default currency convert currency must be true

            console.log('logging convert currencies');

            console.log(currency_convert)
        }

        console.log(product, 'product was found')

        //get the content of row from which the product was selected
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        //set subtotal for the row content
        current_row_content.row_sub_total = product.sub_total

        current_row_content.currency_id = product.currency_id

        console.log(current_row_content.row_id)

        //set input quantity for the row content
        current_row_content.quantity = 1

        current_row_content.description = product.description

        current_row_content.unit_price = product.unit_price

        current_row_content.selected_product_id = product.id

        current_row_content.max_quantity = product.quantity

        current_row_content.item_type = product.item_type

        current_row_content.apply_row_discount = false

        current_row_content.selected_tax_ids_from_grid = []

        // current_row_content.product_options = product_options

        displayRowItems()
    }





    function GetIndividualTaxes(){

        // Init Variables

        let tax_percentage = {
                nhil : 0,
                vat: 0,
                getfund: 0,
                covid: 0,
                cst: 0,
                flat_vat: 0,
            },
            tax_values = {
                nhil: 0,
                vat: 0,
                getfund: 0,
                covid: 0,
                cst: 0,
                flax_vat: 0,
            },
            sub_total = 0,
            item_type = '',
            tax_total = {
                nhil: 0,
                vat: 0,
                getfund: 0,
                covid: 0,
                cst: 0,
                flax_vat: 0,
            };

        // Go through list items

        $.each(product_rows, function (i, row_content){

            // Compute subtotal of each list item

            sub_total = row_content.quantity * row_content.unit_price;

            console.log('These are the selected taxes', row_content);

            // Loop through selected taxes
            if(row_content.selected_tax_ids_from_grid !== undefined)
            {
                $.each(row_content.selected_tax_ids_from_grid, function (i, selected_tax_id) {

                    //find the tax item
                    let selected_tax = fetched_taxes.find(tax_data => tax_data.id === Number(selected_tax_id))

                    // Compute for individual tax items

                    if(selected_tax.name === 'COVID 19 TAX'){
                        item_type = 'COVID 19 TAX';

                        tax_percentage.covid = Number(selected_tax.percentage)

                        tax_values.covid = (sub_total * tax_percentage.covid) / 100

                        tax_total.covid += tax_values.covid;

                    }



                    if(selected_tax.name === 'Flat VAT'){
                        item_type = 'Flat VAT';

                        tax_percentage.flat_vat = Number(selected_tax.percentage);

                        tax_values.flax_vat = (sub_total * tax_percentage.flat_vat) / 100

                        tax_total.flax_vat += tax_values.flax_vat
                    }

                    if(selected_tax.name === 'NHIL'){

                        item_type = 'NHIL';

                        tax_percentage.nhil = Number(selected_tax.percentage);

                        tax_values.nhil = (sub_total * tax_percentage.nhil) / 100

                        tax_total.nhil += tax_values.nhil;

                    }

                    if(selected_tax.name === 'VAT'){
                        item_type = 'VAT';

                        tax_percentage.vat = Number(selected_tax.percentage);

                        tax_values.vat = (sub_total * tax_percentage.vat) / 100

                        tax_total.vat += tax_values.vat;

                    }


                    if(selected_tax.name === 'GETFund'){
                        item_type = 'GETFund';

                        tax_percentage.getfund = Number(selected_tax.percentage);

                        tax_values.getfund = (sub_total * tax_percentage.getfund) / 100

                        tax_total.getfund += tax_values.getfund

                    }


                    if (selected_tax.name === 'CST'){
                        item_type = 'CST';


                        tax_percentage.cst = Number(selected_tax.percentage);

                        tax_values.cst = (sub_total * tax_percentage.cst) / 100

                        tax_total.cst += tax_values.cst
                    }

                })


            }

        })

        // Change frontend items (blade file)

        $('#nhil_total').val(Number(tax_total.nhil).toFixed(2))
        $('#cst_total').val(Number(tax_total.cst).toFixed(2));
        $('#getfund_total').val(Number(tax_total.getfund).toFixed(2));
        $('#vat_total').val(Number(tax_total.vat).toFixed(2))
        $('#covid_total').val(Number(tax_total.covid).toFixed(2));
        $('#vat_flat_total').val(Number(tax_total.flax_vat).toFixed(2))
    }








    function populateRowTax(row_id, selected_tax_ids_from_grid)
    {
        console.log('selected tax ids from grid', selected_tax_ids_from_grid)
        //get the content of row from which the product was selected
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        //set the sub_total for the row content
        let sub_total = current_row_content.quantity * current_row_content.unit_price

        let vat_percentage = 0;

        let taxes = []

        //loop tru the selected taxes ids
        $.each(selected_tax_ids_from_grid, function (i, selected_tax_id){

            console.log(selected_tax_id)
            //find the tax
            let selected_tax = fetched_taxes.find(tax_data => tax_data.id === Number(selected_tax_id))

            //check if its vat
            if(selected_tax.name === 'VAT')
            {
                //set the tax percentage
                vat_percentage = Number(selected_tax.percentage)

            }
            else{

                let new_sub_total = 0

                //check if discount was applied
                if(current_row_content.apply_row_discount)
                {
                    //get discount amount
                    let discount_amount = checkDiscountType(sub_total)

                    //set sub total after applying discount
                    new_sub_total = sub_total - discount_amount

                }else{

                    //set sub total with out applying discount
                    new_sub_total = sub_total
                }

                let computed_tax_amount = (new_sub_total * selected_tax.percentage) / 100;

                current_row_content[selected_tax.name] = computed_tax_amount

                //push tax into array
                taxes.push(computed_tax_amount)
            }
        })

        //for VAT tax
        if(vat_percentage > 0)
        {
            //sum all taxes
            let sum_of_taxes = taxes.reduce((a, b) => a + b, 0)

            let selected_tax = fetched_taxes.find(tax_data => tax_data.name === 'VAT')

            //find the vat percentage of taxes and the subtotal and push into tax array

            let computed_vat_amount = ((sub_total + sum_of_taxes) * vat_percentage) / 100

            current_row_content[selected_tax.name] = computed_vat_amount

            taxes.push(computed_vat_amount)
        }

        //reset row subtotal
        current_row_content.row_tax_amount = taxes.reduce((a, b) => a + b, 0)

        console.log('logging row tax amount', current_row_content.row_tax_amount)

        current_row_content.selected_tax_ids_from_grid = selected_tax_ids_from_grid

        console.log('logging computed taxes')

        console.log(current_row_content)

        displayRowItems()

    }

    function MarkTaxesAsChecked(selected_tax_ids_from_grid, current_row_content)
    {
        tax_options = ``

        let selected_tax_name = []

        console.log('loging for selected taxes')
        $.each(fetched_taxes, function (i, tax) {

            $.each(selected_tax_ids_from_grid, function(x, selected_tax_id)
            {
                if(tax.id === Number(selected_tax_id))
                {
                    console.log(tax, selected_tax_id)

                    selected_tax_name.push(tax.name)

                    tax_options += `<option selected value="${tax.id}">${tax.name}</option>`
                }
            })
        })

        console.log('loging for unselected taxes')

        $.each(fetched_taxes, function (i, tax) {

            if(!selected_tax_name.some(tax_name => tax_name === tax.name))
            {
                console.log(tax)
                tax_options += `<option value="${tax.id}">${tax.name}</option>`
            }
        })

        return tax_options
    }

    function checkDiscountType(sub_total)
    {
        if(discount === 0)
        {
            discount = $('#discount').val()
        }

        if(discount_type === '')
        {
            discount_type = $('#discount_type').children("option:selected").val();
        }

        let discount_amount = 0

        if(discount_type === 'percentage')
        {
            discount_amount = (discount * sub_total) / 100

        }else if(discount_type === 'amount') {

            discount_amount = discount
        }

        return discount_amount
    }

    function RedoTotalCalculations(id = null, type = null)
    {
        $.each(product_rows, function (i, row_content){

            if(row_content.selected_tax_ids_from_grid !== undefined)
            {
                populateRowTax(row_content.row_id, row_content.selected_tax_ids_from_grid)
            }
        })

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


    function resetRowUnitPrice(row_id, input_unit_price)
    {
        let current_row_content = product_rows.find(row_data => row_data.row_id === Number(row_id))

        current_row_content.unit_price = input_unit_price

        console.log('changed price is ' + input_unit_price)

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
            url: '{{ route('income.invoice.new.store_beta') }}',
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


    function populateFields(data){
        let reference = $('#reference'),

            due_date = $('#due_date'),

            check_credit_limit = $('#check_credit_limit'),

            discount_type = $('#discount_type'),

            discount = $('#discount');

        reference.val(data.reference_no);

        due_date.val(data.due_date);

        data.check_credit_limit == 0 ? check_credit_limit.append('<option value="No" selected>No</option>') : check_credit_limit.append('<option value="Yes" selected>Yes</option>');

        discount_type.val(data.discount_type);

        discount.val(Number(data.discount).toFixed(0));

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
                unit_price: product.price,
                currency_id: product.currency_id,
                apply_row_discount: product.apply_discount === 1,
                selected_tax_ids_from_grid
            })

            console.log(product_rows)
        })

        displayRowItems()

    }

    $('#customer_id').on('change',function(){
        let id = $(this).val();

        let route = '{{route('retailer.customer.sales-orders','customer_id')}}'.replace('customer_id',id);

        console.log(route)

        $.get(route,function (data) {

            let dom = `<option value="">Select Order</option>`

            $.each(data,function(i,order){
                dom += `<option value="${order.id}">${order.order_no}</option>`
            });

            $('#sales_order_number').html(dom)

        })
    })

    $('#sales_order_number').on('change',function () {
        let id = $(this).val();

        let route = '{{route('retailer.customer.sales-orders-items','order-id')}}'.replace('order-id',id);

        console.log(route)

        $.ajax({
            url: route
        }).done(function (data) {

            console.log(data)

            displayQuotationItems(data.sales_order_items);

            $('#all_net').val(data.sales_order.total)
            $('#all_sub_total').val(data.sales_order.sub_total)
            $('#all_discount_amount').val(data.sales_order.discount_total)
            $('#all_tax').val(data.sales_order.tax_amount)
            $('#discount_type').html(`<option ${data.sales_order.discount_type === 'percentage' ? 'selected' : ''} value="percentage">Percentage</option><option ${data.sales_order.discount_type === 'amount' ? 'selected' : ''} value="amount">Fixed Amount</option>`)
            $('#discount').val(data.sales_order.discount)
            $('#reference').val(data.sales_order.reference_no)

            GetIndividualTaxes();

        })
    })









</script>
