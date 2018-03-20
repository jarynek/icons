import Search from './components/search';
import Form from './components/form';

/**
 * Insert icons
 */
class InsertIcons {
    constructor() {
        Search.ajaxRenderResult();
        Form.dropUploadFiles();
    }
}

new InsertIcons();