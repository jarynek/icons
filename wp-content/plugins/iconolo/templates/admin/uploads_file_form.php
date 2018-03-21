<style>
    form {
        position: relative;
    }
    .progress-layer {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: #206fb4a8;
    }
    .progress-box {
        background: white;
        width: 40%;
        height: 60px;
        padding: 20px;
        border-radius: 4px;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        font-size: 12px;
    }
    .progress-line {
        height: 10px;
        background: #e2e1e1;
        border-radius: 3px;
    }
    .progress {
        background: #1571af;
        width: 0;
        height: 10px;
        border-radius: 3px;
    }
    .progress_text {
        text-align: center;
        margin: 4px  0;
        font-size: 14px;
    }
    .progress_description {
        text-align: left;
        height: 40px;
        overflow-x: hidden;
        overflow-y: scroll;
    }
    .progress-item {
        display: inline-block;
    }
    .progress-item:after {
        content: ', ';
    }

    .progress-item:last-child:after {
        content: '';
    }
    .in-success {
        text-align: center;
        color: #1b8000;
    }
    .in-success .dashicons{
        font-size: 50px;
        height: 40px;
        width: 50px;
        color: green;
        line-height: 40px;
        text-align: center;
    }
    .hdn {
        display: none !important;
    }
</style>
<div class="wrap">
    <form method="post" enctype="multipart/form-data" action="/wp-admin/admin.php?page=scripts">
        <div class="file-upload">
            <h2 class="upload-instructions drop-instructions">Přetáhnout soubory z počítače</h2>
            <p class="upload-instructions drop-instructions">nebo</p>
            <label class="browser button button-hero">
                <input data-changeUploadFiles class="hdn" type="file" name="file[]" multiple accept=".zip">
                <span>Vybrat soubory</span>
            </label>
            <input class="hdn browser button button-primary button-hero" type="submit" value="Uložit">
            <p class="max-upload-size">Maximální velikost nahrávaného souboru: 8 MB.</p>
        </div>

        <div class="progress-layer hdn">
            <div class="progress-box">
                <div class="in-progress">
                    <div class="progress-line">
                        <div class="progress"></div>
                    </div>
                    <div class="progress_text"></div>
                    <div class="progress_description"></div>
                </div>
                <div class="in-success hdn">
                    <span class="dashicons dashicons-yes"></span>
                    <div class="success_description">Zpracováno</div>
                </div>
            </div>
        </div>
    </form>
</div>