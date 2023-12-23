<!-- $(document).on('click', '.search-result-container', function() {
            var id = $(this).data('id');
            var productExists = false;

            // Check if the product already exists in the table
            $('#order-list tr').each(function() {
                var existingProductId = $(this).find('td:first').text(); // Assuming the product ID is in the first <td>
                if (existingProductId.trim() === productId.toString()) {
                    productExists = true;
                    var qtyInput = $(this).find('td:eq(2) input[name="qty"]');
                    var newQty = parseInt(qtyInput.val()) + 1;
                    qtyInput.val(newQty);
                    // Perform any other action or update here if the product already exists
                    return false; // Break out of the loop since the product is found
                }
            });
            if (!productExists) {
                $.ajax({
                    type: "POST",
                    url: "fungsi/get_product_detail.php",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('#order-list').append(response);
                    }
                });
            }
        }); -->

<!-- success: function(response) {
                    var $orderList = $('#order-list');
                    var noResultsRow = $orderList.find('tr:has(td):contains("No results found.")');

                    if (noResultsRow.length) {
                        // If "No results found" row exists, replace it with the response
                        noResultsRow.replaceWith(response);
                    } else {
                        // If no "No results found" row, append the response to the table
                        $orderList.append(response);
                    }
                } -->