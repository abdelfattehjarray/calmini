const dropZone = document.getElementById('drop-zone');
const titleInput = document.getElementById('Title');
const contentTextarea = document.getElementById('content');
const imagePreview = document.getElementById('image-preview');
const imageInput = document.getElementById('image');
const imageTypeInput = document.getElementById('image_type');
let imageData = null;
let imageType = null;
let docxContent = null;

dropZone.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropZone.style.borderStyle = 'dashed';
});

dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderStyle = 'none';
});

dropZone.addEventListener('drop', (event) => {
    event.preventDefault();
    dropZone.style.borderStyle = 'none';

    const files = event.dataTransfer.files;
    const formData = new FormData();
    let hasValidFile = false;
    for (let i = 0; i < files.length; i++) {
        if (files[i].name.endsWith('png') || files[i].name.endsWith('jpg') || files[i].name.endsWith('jpeg')) {
            // ...
            const reader = new FileReader();
            reader.onload = (e) => {
                imageData = e.target.result;
                imagePreview.src = imageData;
                imageType = files[i].type.split('/')[1];
            };
            reader.readAsDataURL(files[i]);
            hasValidFile = true;
        } else if (files[i].name.endsWith('.docx') ||files[i].name.endsWith('.doc')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const arrayBuffer = e.target.result;
                const docxFile = new Uint8Array(arrayBuffer);
                const zip = new JSZip();
                zip.loadAsync(docxFile).then((zip) => {
                    // Extract title and content from docx file
                    zip.file("word/document.xml").async("string").then((content) => {
                        const parser = new DOMParser();
                        const xmlDoc = parser.parseFromString(content, "text/xml");
                        const titleNode = xmlDoc.getElementsByTagName("w:p")[0];
                        const titleText = titleNode.getElementsByTagName("w:t")[0].textContent.trim();
                        titleInput.value = titleText;
                    });
                    zip.file("word/document.xml").async("string").then((content) => {
                        const parser = new DOMParser();
                        const xmlDoc = parser.parseFromString(content, "text/xml");
                        const paragraphs = xmlDoc.getElementsByTagName("w:p");
                        docxContent = '';
                        for (let i = 1; i < paragraphs.length; i++) {
                            const texts = paragraphs[i].getElementsByTagName("w:t");
                            for (let j = 0; j < texts.length; j++) {
                                docxContent += texts[j].textContent;
                            }
                            docxContent += '\n\n';
                        }
                        contentTextarea.value = docxContent.trim();
                    });
                    const imageFile = zip.file("word/media/image1.png");
                    const image = imageFile.async("base64").then((content) => {
                        const fileType = "png";
                        if (imageFile.name.endsWith('.jpg') || imageFile.name.endsWith('.jpeg')) {
                            fileType = "jpeg";
                        }
                        imagePreview.src = "data:image/" + fileType + ";base64," + content;
                        imageData = content;
                        imageType = fileType;
                    });
                });
            };
            reader.readAsArrayBuffer(files[i]);
            hasValidFile = true;
        } else {
            alert('not supported type');
        }
    }
    if (hasValidFile) {
        imageError.textContent = '';
    } else {
        imageError.textContent = 'Image or document is required';
    }
});

