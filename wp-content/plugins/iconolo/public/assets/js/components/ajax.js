/**
 * Ajax
 */
class Ajax {

    /**
     * request
     * @param {object} args
     */
    static request(args) {

        if (!args) {
            return;
        }

        let $ = jQuery;

        $.ajax({
            type: args.type,
            url: args.url,
            data: args.data,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(event) {
                    if(args.xhr && typeof args.xhr === 'function'){
                        args.xhr(event);
                    }
                };
                return xhr;
            },
            beforeSend: () => {
                if(args.beforeSend && typeof args.beforeSend === 'function'){
                    args.beforeSend(event);
                }
            },
            success: (response, status, xhr) => {
                if(args.success && typeof args.success === 'function'){
                    args.success(response, status, xhr);
                }
            },
            complete: () => {
                if(args.complete && typeof args.complete === 'function'){
                    args.complete();
                }
            }
        })
    }
}

export default Ajax;