"use strict";

/**
 * Main Application class written in ES2015/ES6
 */
class App {

    /**
     * What should we do when a new instance of this class is called
     */
    constructor () {
        this.config = new Config();
        this.setListeners();
        this.setupAjax();
        this.requestUserConfirmDelete();
    }

    /**
     * For every ajax call send a a csrf token
     */
    setupAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    /**
     * Ask the user if they are positive they want to remove the model instance
     */
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

    /**
     * Let the user know that the model instance has been removed
     *
     * @param $target
     */
    confirmEntityWasRemoved($target) {
        let name = $target.data('model');
        swal("Good choice!", "You removed the " + name + "!", "success");
    }

    /**
     * Remove the row
     *
     * @todo If there are no rows left after this row has been removed then change the display
     *
     * @param $row  This should be a jquery element
     */
    removeRow ($row) {
        $row.remove();
    }

    /**
     * If the domain field of a form doesn't have a protocol at the beginning the prepend it
     *
     * If however the input element has a "no-protocol" class then we should not do this
     */
    prependProtocolToURLFields (target) {
        if (target.value.indexOf("http://") == 0 || target.value.indexOf("https://") == 0) {
            return target;
        }

        target.value = this.config.defaultProtocol + target.value;
    }

    /**
     * Set any listeners up that need to be autoset
     */
    setListeners() {
        this.disableSubmitButtonsWhenPressed();
        // prepend the protocol to url fields
        $("input[type='url']").change( (el) => { this.prependProtocolToURLFields(el.target) });
    }

    /**
     * Make sure that a user cannot accidentally press the submit button twice
     */
    disableSubmitButtonsWhenPressed () {
        $("form").submit( (event) => {
            $(event.target).find(':input').prop('readonly', true);
        })
    }
}

/**
 * Call a new instance of the application App.
 */
new App();
