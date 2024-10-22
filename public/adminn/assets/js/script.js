
$(document).ready(function() {
    $('.delete-confirm').on('click', function(ev) {
        ev.preventDefault(); 
        const url = $(this).attr('href'); 
        const supplierRow = $(this).closest('tr');
        swal({
            title: "Are you sure ?",
            text:  "you want to delete this!",
            icon: "info",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    value: true,
                    visible: true,
                    className: "btn btn-success"
                },
                cancel: {
                    text: "No, Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                },
            }
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url, 
                    type: 'DELETE', 
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        const orderUrl = /\/admin\/orders\/(\d+)/;
                        const supplierUrl = /\/admin\/suppliers\/(\d+)/;
                        const categoryUrl =  /\/product\/category\/delete\/(\d+)/;
                        const productUrl =  /\/product\/delete\/(\d+)/;
                        if (orderUrl.test(url)) {
                            successMessage = "Order deleted successfully.";
                        } else if (supplierUrl.test(url)) {
                            successMessage = "Supplier deleted successfully.";
                        } else if (categoryUrl.test(url)) {
                            successMessage = "Category deleted successfully.";
                        } else if (productUrl.test(url)) {
                            successMessage = "product deleted successfully.";
                        }
                       swal("Deleted!", successMessage, "success").then(() => {
                            supplierRow.remove(); 
                         });
                    },
                }); 
            }
        });
    });
    
   $('.status-confirm').on('click', function(ev) {
    ev.preventDefault();
    const url = $(this).attr('href'); 
    swal({
        title: "Are you sure?",
        text: "You want to change the status!",
        icon: "warning",
        buttons: {
            confirm: {
                text: "Yes",
                value: true,
                visible: true,
                className: "btn btn-primary"
            },
            cancel: {
                text: "No",
                value: null,
                visible: true,
                className: "btn btn-danger",
            }
        }
    }).then((willChange) => {
        if (willChange) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentPage = urlParams.get('page') || 1;
            $.ajax({
                url: url, 
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        localStorage.setItem('successMessage', response.message);
                        window.location.href = `/admin/supplier/list?page=${currentPage}`;
                    }
                },
            });
          
        }
    });
  });

});



