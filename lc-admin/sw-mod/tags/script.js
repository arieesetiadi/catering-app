
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            $('#sw-cms').dataTable({
                "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1, 1 ] } ],
                "iDisplayLength": 20,
                "aLengthMenu": [[20, 25, 30, -1], [10, 20, 30, "All"]]
            });

