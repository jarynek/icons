import Ajax from '../components/ajax';

/**
 * Form
 */
class Form {
    constructor() {
        this.options = {
            dropEl: jQuery('.file-upload')
        };
    }

    /**
     * drag enter
     * @param {object} el
     */
    static dragEnter(el) {
        el.on('dragenter', (event) => {
            event.preventDefault();
            event.stopPropagation();
        });
    }

    /**
     * drag over
     * @param {object} el
     */
    static dragOver(el) {
        el.on('dragover', (event) => {
            event.preventDefault();
            event.stopPropagation();
        });
    }

    /**
     * drop
     * @param {object} el
     */
    static drop(el) {
        el.on('drop', (event) => {
            event.preventDefault();
            event.stopPropagation();

            let index = 0;
            let thisEl = jQuery(event.target);
            let thisForm = thisEl.closest('form');
            let files = event.originalEvent.dataTransfer.files;

            console.log(files);

            thisForm.find('input[type="file"]').prop('files', files);
            let data = new FormData(thisForm[0]);

            let args = {
                type: 'post',
                url: '/wp-admin/admin.php?page=scripts',
                data: data,
                xhr: (event) => {
                    jQuery('.progress_text').text('Zpracovávám ' + Math.floor(event.loaded / event.total * 100) + '%');
                    jQuery('.progress').css({
                        width: Math.floor(event.loaded / event.total * 100) + '%'
                    });

                    if (files) {
                        if (files.hasOwnProperty(index)) {
                            jQuery('<span class="progress-item">' + files[index].name + '</span>').appendTo('.progress_description');
                        }
                    }
                    index++;
                },
                beforeSend: () => {
                    jQuery('.progress-layer').removeClass('hdn');
                },
                success: () => {
                    jQuery('.in-progress').addClass('hdn');
                    jQuery('.in-success').removeClass('hdn');
                },
                complete: () => {
                    setTimeout(()=>{
                        jQuery('.progress-layer').addClass('hdn');
                        thisForm.find('input[type="file"]').val(null);
                        thisForm.find('[type="submit"]').addClass('hdn');
                    }, 500);
                }
            };

            Ajax.request(args);
        });
    }

    /**
     * drop upload files
     */
    dropUploadFiles() {
        const options = this.options;

        this.constructor.dragEnter(options.dropEl);
        this.constructor.dragOver(options.dropEl);
        this.constructor.drop(options.dropEl);
    }

    /**
     * change submit
     */
    changeUploadFiles() {
        jQuery(document).on('change', '[data-changeUploadFiles]', (event) => {
            event.preventDefault();

            let thisEl = jQuery(event.target);
            thisEl.closest('form').find('[type="submit"]').removeClass('hdn');
        });
    }
}

export default new Form();