"use strict";

class App {
    constructor () {
        this.setupAjax();

        this.requestUserConfirmDelete();
    }

    setupAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    requestUserConfirmDelete () {
        $('.js-confirm-delete').click(event => {
            event.preventDefault();

            let $target = $(event.target).closest('a.js-confirm-delete');
            let name = $target.data('name');
            let href = $target.attr('href');
            let method = $target.data('method');

            swal({
                title: "Are you sure?",
                text: "Remove " + name  ,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                (isConfirm) => {
                    if (isConfirm) {
                        $
                            .post({
                                type: method,
                                url: href
                            })
                            .done( () => {
                                this.confirmEntityWasRemoved($target);
                                this.removeRow($(event.target).closest('.domain-row'));
                            })
                            .fail( () => {
                                swal(
                                    "Oh Poo-stick!",
                                    "There was an error removing the domain;please try again or report the issue",
                                    "error"
                                );
                            });
                    } else {
                        swal("Cancelled", "Your domain is safe :)", "error");
                    }
                });
        })
    }

    confirmEntityWasRemoved($target) {
        let name = $target.data('model');
        swal("Good choice!", "You removed the " + name + "!", "success");
    }

    removeRow ($row) {
        $row.remove();
    }
}
new App();
