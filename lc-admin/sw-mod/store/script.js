
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();
            /* Initialize Datatables */
            $('#sw-cms').dataTable({
                "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1, 3 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
