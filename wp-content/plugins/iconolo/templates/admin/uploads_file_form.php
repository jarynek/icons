<style>
    .progress {
        background: #1571af;
        margin: 10px 0 0 0;
        width: 0;
        height: 12px;
        border-radius: 3px;
    }
    .progress_text {
        text-align: left;
    }
    .hdn {
        display: none;
    }
</style>
<div class="wrap">
    <form method="post" enctype="multipart/form-data" action="/wp-admin/admin.php?page=scripts">
        <div class="file-upload">
            <h2 class="upload-instructions drop-instructions">Přetáhnout soubory z počítače</h2>
            <label class="browser button button-hero">
                <input class="hdn" type="file" name="file[]" multiple accept=".zip">
                <span>Vybrat soubory</span>
            </label>
            <input class="browser button button-hero" type="submit" value="Uložit">
        </div>
    </form>
    <div class="progress"></div>
    <div class="progress_text"></div>
</div>