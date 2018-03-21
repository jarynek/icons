<style>
	.file-upload {
        position: relative;
        top: auto;
        right: auto;
        left: auto;
        bottom: auto;
        margin-top: 20px;
        border: 4px dashed #b4b9be;
        padding: 20px;
        text-align: center;
        height: 200px;
	}
    .file-upload h2 {
        font-weight: 400;
    }
</style>
<?php
print_r($_GET);
include dirname(dirname(__FILE__)) . '/templates/admin/uploads_file_form.php';
