document.addEventListener("pimcore.admin.after_init", () => {
    if (pimcore.object && pimcore.object.tags && pimcore.object.tags.wysiwyg) {
        
        const originalPostInit = pimcore.object.tags.wysiwyg.prototype.postInitialize;
        
        pimcore.object.tags.wysiwyg.prototype.postInitialize = function () {
            // Apply these specific settings to the TinyMCE config object
            this.editorConfig = Object.assign({}, this.editorConfig, {
                toolbar_sticky: true,
                toolbar_sticky_offset: 35, // Adjust this if it overlaps the "Save" button
                
                // This tells TinyMCE to look for the scroll event in the 
                // parent container rather than the browser window.
                fixed_toolbar_container_target: this.component,
                
                // Optional: makes the toolbar look better when stuck
                inline: false,
                skin: "oxide",
                content_css: "default"
            });
            
            originalPostInit.apply(this, arguments);
        };
    }
});


document.addEventListener(pimcore.events.preInitFinished, function () {
    // Modify the default config for all TinyMCE instances
    if (pimcore.object && pimcore.object.tags && pimcore.object.tags.wysiwyg) {
        pimcore.object.tags.wysiwyg.defaultEditorConfig = {
            ...pimcore.object.tags.wysiwyg.defaultEditorConfig,
            plugins: 'image link code lists advlist table',
            toolbar: 'undo redo | formatselect | bold italic | link image | code',
            // Enable the 'Upload' tab in the Image dialog
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image'
        };
    }
});