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
     */
    dragEnter() {
        this.options.dropEl.on('dragenter', (event) => {
            event.preventDefault();
            event.stopPropagation();

            console.log('dragenter');

        });
    }

    /**
     * drag over
     */
    dragOver() {
        this.options.dropEl.on('dragover', (event) => {
            event.preventDefault();
            event.stopPropagation();

            console.log('dragOver');

        });
    }

    /**
     * drop
     */
    drop() {
        this.options.dropEl.on('drop', (event) => {
            event.preventDefault();
            event.stopPropagation();

            let thisEl = jQuery(event.target);
            let thisForm = thisEl.closest('form');
            let files = event.originalEvent.dataTransfer.files;

            thisForm.find('input[type="file"]').prop('files', files);
            let data = new FormData(thisForm[0]);

            let args = {
                type: 'post',
                url: '/wp-admin/admin.php?page=scripts',
                data: data,
                xhr: (event) => {
                    jQuery('.progress_text').text(Math.floor(event.loaded / event.total * 100) + '%');
                    jQuery('.progress').css({
                        width: Math.floor(event.loaded / event.total * 100) + '%'
                    });
                }
            };

            Ajax.request(args);
        });
    }

    /**
     * drop upload files
     */
    dropUploadFiles() {

        this.dragEnter();
        this.dragOver();
        this.drop();
    }
}

export default new Form();