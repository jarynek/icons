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
                console.log('beforeSend');
            },
            success: (response) => {
                console.log('success');
            },
            complete: () => {
                console.log('complete');
            }
        })
    }
}

export default Ajax;