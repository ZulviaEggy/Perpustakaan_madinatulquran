/* ------------------------------------------------------------------------------
 *
 *  # Fixed Columns extension for Datatables
 *
 *  Demo JS code for datatable_extension_fixed_columns.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableFixedColumns = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableFixedColumns = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            columnDefs: [{ 
                orderable: false,
                width:100,
                targets: [ 0 ]
            }],
            lengthMenu: [ 10, 25, 50, 75, 100 ],
            displayLength: 50,
            dom: '<"datatable-header"fl><"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Search:</span> _INPUT_',
                searchPlaceholder: 'Type to search...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });


        // Left fixed column example
        $('.datatable-fixed-left').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [12,1]
                },
                { 
                    width: "200px",
                    targets: [0]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [5, 6]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 0
            }
        });


        // Right fixed column example
        $('.datatable-fixed-right').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [5]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [2, 3]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

        // Right fixed column example
        $('.datatable-fixed-right2').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [7]
                },
                { 
                    width: "200px",
                    targets: [5]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [5, 6]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

         // Right fixed column example
         $('.datatable-fixed-right4').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [6]
                },
                { 
                    width: "100px",
                    targets: [3,4]
                },
                { 
                    width: "80px",
                    targets: [1]
                },
                { 
                    width: "70px",
                    targets: [5]
                },
                { 
                    width: "300px",
                    targets: [2]
                },
                { 
                    width: "50px",
                    targets: [0]
                }
            ],
           
        });


         // Right fixed column example
         $('.datatable-fixed-right3').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [2,3]
                },
               
                { 
                    width: "300px",
                    targets: [1]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

        // Right fixed column example
        $('.datatable-fixed-noted').DataTable({

            columnDefs: [
                { 
                    orderable: false,
                    width: "500px",
                    targets: [7]
                },
               
                { 
                    width: "700px",
                    targets: [6]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "300px",
                    targets: [4]
                },
                { 
                    width: "50px",
                    targets: [0]
                }
            ],
            fixedHeader: true
           
        });

         // Right fixed column example

        $('.datatable-fixed-left2').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [6]
                },
                { 
                    width: "200px",
                    targets: [5]
                },
                { 
                    width: "300px",
                    targets: [2,3]
                },
                { 
                    width: "30px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

        $('.datatable-fixed-usulan').DataTable({
            columnDefs: [
                { 
                    width: "20px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [5]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

         // Right fixed column example

         $('.datatable-fixed-transaksi').DataTable({
            columnDefs: [
                { 
                    width: "200px",
                    targets: [0]
                },
                { 
                    width: "200px",
                    targets: [8]
                },
                { 
                    width: "300px",
                    targets: [10]
                },
                { 
                    width: "200px",
                    targets: [5, 6]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

        $('.datatable-fixed-guru').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [6]
                },
                { 
                    width: "300px",
                    targets: [2]
                },
                { 
                    width: "200px",
                    targets: [1,3]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

        $('.datatable-fixed-lef').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [1]
                },
               
                {
                    width: "300px",
                    targets: [7,8,9,10,11,12,13]
                },
                { 
                    width: "200px",
                    targets: [5, 6]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });
       
        // Right fixed column example
         $('.datatable-fixed-left3').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    width: "100px",
                    targets: [3]
                },
                { 
                    width: "500px",
                    targets: [1]
                }
                
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

          // Right fixed column example
          $('.datatable-fixed-left4').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    width: "100px",
                    targets: [1]
                },
                { 
                    orderable: false,
                    width: "600px",
                    targets: [0]
                },
                { 
                    orderable: false,
                    width: "600px",
                    targets: [12]
                }
                
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: true
        });

          // Right fixed column example
          $('.datatable-fixed-rig').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [1]
                },
                { 
                    width: "300px",
                    targets: [0]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [3, 5, 6]
                },
                { 
                    width: "100px",
                    targets: [4]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 0
            }
        });

           // Right fixed column example
           $('.datatable-fixed-righ').DataTable({
            columnDefs: [
                { 
                    orderable: false,
                    targets: [15]
                },
                { 
                    width: "300px",
                    targets: [0]
                },
                { 
                    width: "300px",
                    targets: [1]
                },
                { 
                    width: "200px",
                    targets: [13]
                },
                { 
                    width: "100px",
                    targets: [5]
                }
            ],
            scrollX: true,
            scrollY: '350px',
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 0
            }
        });
      

         // Adjust columns on window resize
         setTimeout(function() {
            $(window).on('resize', function () {
                table.columns.adjust();
            });
        }, 100);
    };

    

    // Select2 for length menu styling
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableFixedColumns();
            _componentSelect2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableFixedColumns.init();
});
