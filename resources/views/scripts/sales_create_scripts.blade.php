<script>
    ;(function($){
        $(document).ready(function(){
            $('#product_id').on('change', function(e){
                var product_id = $(this).val();

                var route = "{{ route('product.get', 'id') }}";
                    route = route.replace('id', product_id);

                $.ajax({
                    url: route,
                    type: "GET",
                    success: function(res){
                        if(res.status === 'success'){
                            var product = res.product
                            if(product.total_quantity > 0){
                                var product_row = `<div class="row mb-4">
                                                <div class="col-md-3">
                                                    <label for="product" class="form-label">Product Name <small class="text-danger">*</small></label>
                                                    <input type="text" name="product" value="${product.name}" id="product" class="form-control" placeholder="Product" min="0" required>
                                                    <input type="hidden" name="product_id[${product.id}]" value="${product.id}" id="product_id">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="sales_price" class="form-label">Sale Price (Per Unit) <small class="text-danger">*</small></label>
                                                    <input type="number" name="sales_price[${product.id}]" value="${product.sales_price}" id="sales_price" class="form-control" placeholder="Sale Price" min="0" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="quantity" class="form-label">Total Quantity <small class="text-danger">*</small></label>
                                                    <input type="number" name="quantity[${product.id}]" value="" id="quantity" class="form-control quantity" placeholder="Quantity" min="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="total_amount" class="form-label">Total Amount <small class="text-danger">*</small></label>
                                                    <input type="number" name="total_amount[${product.id}]" value="" id="total_amount" class="form-control total_amount" placeholder="Total amount" min="0">
                                                </div>
                                            </div>`;
                                $("#product_list").append(product_row);
                                $(".quantity").focus();
                            }else{
                                Swal.fire({
                                    'title': 'Not Found!',
                                    'text': 'The product is not in stock',
                                    'icon': 'info',
                                })
                            }

                        }else{
                            Swal.fire({
                                'title': 'Not Found!',
                                'text': 'There is no product for this specific id',
                                'icon': 'info',
                            })
                        }
                    },
                    error: function(err){
                        console.log(err);
                        Swal.fire({
                            'title': err.statusText,
                            'text': 'Sorry! There is some problem',
                            'icon': 'error',
                        })
                    }
                })

            });

            function showCustomerFields(ele){
                var isChecked = $(ele).prop('checked');
                if(isChecked){
                    $('#old-customer-fields').hide('fast');
                    $('#new-customer-fields').show('fast').removeClass('d-none');
                }else{
                    $('#new-customer-fields').hide('fast');
                    $('#old-customer-fields').show('fast');
                }
            }

            function showDueFields(ele){
                var trx_type = $(ele).val();

                if(trx_type == 'Due'){
                    $('#due_sales_info_row').addClass('d-flex').removeClass('d-none');
                }else{
                    $('#due_sales_info_row').hide('fast').removeClass('d-flex');
                }

                if(trx_type == 'Mobile Banking'){
                    $('#transaction_id_row').addClass('d-flex').removeClass('d-none');
                }else{
                    $('#transaction_id_row').hide('fast').removeClass('d-flex');
                }
            }

            showCustomerFields('#is_new_customer');
            showDueFields("#transaction_type");

            $('#transaction_type').on('change', function(e){
               showDueFields("#transaction_type");
            });

            $('#is_new_customer').on('change', function(e){
                showCustomerFields('#is_new_customer');
            });

            $(document).on('change', '.quantity', function(e){
                var quantity = e.target.value;
                var sales_price = $(this).parent().siblings().find('#sales_price').val();                    
                var total_amount = quantity * sales_price;

                $(this).parent().siblings().find('#total_amount').val(total_amount)

                var amount = $(this).parents('.row').siblings().find(".total_amount").val();
                console.log(amount);
            });
            
            $(document).on('focus', '.total_amount', function(e){
                var gross_amount = 0;
                var totalAmountFields = $('.total_amount').parents('.row').find('.total_amount');

                totalAmountFields.each(function(key, ele){
                    gross_amount += parseInt($(ele).val());
                })

                $("#gross_amount").val(gross_amount);
                var discount_amount = $('#total_discount').val();
                if (discount_amount) {
                    var net_amount = gross_amount - discount_amount;                    
                }
                $("#net_amount").val(net_amount);

                var paid_amount = $('#paid_amount').val();
                if(paid_amount){
                    var due_amount = net_amount - paid_amount;
                    $("#due_amount").val(due_amount)
                }
                
            });

            $(document).on('change', '#total_discount', function(e){
                var gross_amount = $('#gross_amount').val()
                var discount_amount = $('#total_discount').val()
                var net_amount = gross_amount - discount_amount;

                $("#net_amount").val(net_amount);

            });

            // $("#gross_amount").on("change", function(e){
            //     var gross_amount = e.target.value;
            //     alert(gross_amount);
            // })

            $("#paid_amount").on('change', function (e) {

                var paid_amount = e.target.value;
                var net_amount = parseInt($('#net_amount').val());

                if (paid_amount > net_amount) {

                    Swal.fire({
                        'title': 'Wrong Input!',
                        'text': 'You enter greater amount than total amount',
                        'icon': 'info',
                    });

                    $(this).val('');
                    $("#due_amount").val('');

                }else{
                    var trx_type = $("#transaction_type option:selected").val();
                    if(trx_type == 'Due'){
                        var due_amount = net_amount - paid_amount;
                        $("#due_amount").val(due_amount);
                    }
                }

            })
        });
        $('.select2').select2();
    })(jQuery);
</script>