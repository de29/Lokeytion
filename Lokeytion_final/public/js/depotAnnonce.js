
    // JavaScript code
    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']; // Add more days here...
    const container = document.getElementById('from-to-container');

    days.forEach(day => {
      const checkbox = document.getElementById(day);
      checkbox.addEventListener('click', event => {
        if (checkbox.checked) {
          // If checkbox is checked, add "from-to" inputs to container
          const inputs = `
          <div class="form-group row">
          <label for="${day}-from"  name="${day}-from" class="col-sm-4 col-form-label">${day}:</label>
          <div class="col-sm-8 input-group">
            <input type="time" name="${day}-from" class="form-control rounded-pill border border-dark mx-2 form-control-sm">
            <span class="input-group-text border border-dark rounded mx-2">to</span>
            <input type="time" name="${day}-to" class="form-control rounded-pill border border-dark form-control-sm">
          </div>
        </div>
          `;
          container.innerHTML += inputs;
        } else {
          // If checkbox is unchecked, remove "from-to" inputs from container
          const inputsToRemove = document.querySelectorAll(`[name^="${day}-"]`);
          inputsToRemove.forEach(input => input.parentNode.remove());
        }
      });
    });

    $(".imgAdd").click(function() {
      $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
    });
    $(document).on("click", "i.del", function() {
      // 	to remove card
      $(this).parent().remove();
      // to clear image
      // $(this).parent().find('.imagePreview').css("background-image","url('')");
    });
    $(function() {
      $(document).on("change", ".uploadFile", function() {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
          var reader = new FileReader(); // instance of the FileReader
          reader.readAsDataURL(files[0]); // read the local file

          reader.onloadend = function() { // set image data as background of div
            alert(uploadFile.closest(".upimage").find('.imagePreview').length);
            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
          }
        }

      });
    });

    var isAdvancedUpload = function() {
      var div = document.createElement('div');
      return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    }();

    let draggableFileArea = document.querySelector(".drag-file-area");
    let browseFileText = document.querySelector(".browse-files");
    let uploadIcon = document.querySelector(".upload-icon");
    let dragDropText = document.querySelector(".dynamic-message");
    let fileInput = document.querySelector(".default-file-input");
    let cannotUploadMessage = document.querySelector(".cannot-upload-message");
    let cancelAlertButton = document.querySelector(".cancel-alert-button");
    let uploadedFile = document.querySelector(".file-block");
    let fileName = document.querySelector(".file-name");
    let fileSize = document.querySelector(".file-size");
    let progressBar = document.querySelector(".progress-bar");
    let removeFileButton = document.querySelector(".remove-file-icon");
    let uploadButton = document.querySelector(".upload-button");
    let fileFlag = 0;

    fileInput.addEventListener("click", () => {
      fileInput.value = '';
      console.log(fileInput.value);
    });

    fileInput.addEventListener("change", e => {
      console.log(" > " + fileInput.value)
      uploadIcon.innerHTML = 'check_circle';
      dragDropText.innerHTML = 'File Dropped Successfully!';
      document.querySelector(".label").innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top: 0;"> browse file</span></span>`;
      uploadButton.innerHTML = `Upload`;
      fileName.innerHTML = fileInput.files[0].name;
      fileSize.innerHTML = (fileInput.files[0].size / 1024).toFixed(1) + " KB";
      uploadedFile.style.cssText = "display: flex;";
      progressBar.style.width = 0;
      fileFlag = 0;
    });

    uploadButton.addEventListener("click", () => {
      let isFileUploaded = fileInput.value;
      if (isFileUploaded != '') {
        if (fileFlag == 0) {
          fileFlag = 1;
          var width = 0;
          var id = setInterval(frame, 50);

          function frame() {
            if (width >= 390) {
              clearInterval(id);
              uploadButton.innerHTML = `<span class="material-icons-outlined upload-button-icon"> check_circle </span> Uploaded`;
            } else {
              width += 5;
              progressBar.style.width = width + "px";
            }
          }
        }
      } else {
        cannotUploadMessage.style.cssText = "display: flex; animation: fadeIn linear 1.5s;";
      }
    });

    cancelAlertButton.addEventListener("click", () => {
      cannotUploadMessage.style.cssText = "display: none;";
    });

    if (isAdvancedUpload) {
      ["drag", "dragstart", "dragend", "dragover", "dragenter", "dragleave", "drop"].forEach(evt =>
        draggableFileArea.addEventListener(evt, e => {
          e.preventDefault();
          e.stopPropagation();
        })
      );

      ["dragover", "dragenter"].forEach(evt => {
        draggableFileArea.addEventListener(evt, e => {
          e.preventDefault();
          e.stopPropagation();
          uploadIcon.innerHTML = 'file_download';
          dragDropText.innerHTML = 'Drop your file here!';
        });
      });

      draggableFileArea.addEventListener("drop", e => {
        uploadIcon.innerHTML = 'check_circle';
        dragDropText.innerHTML = 'File Dropped Successfully!';
        document.querySelector(".label").innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top: -23px; left: -20px;"> browse file</span> </span>`;
        uploadButton.innerHTML = `Upload`;

        let files = e.dataTransfer.files;
        fileInput.files = files;
        console.log(files[0].name + " " + files[0].size);
        console.log(document.querySelector(".default-file-input").value);
        fileName.innerHTML = files[0].name;
        fileSize.innerHTML = (files[0].size / 1024).toFixed(1) + " KB";
        uploadedFile.style.cssText = "display: flex;";
        progressBar.style.width = 0;
        fileFlag = 0;
      });
    }

    removeFileButton.addEventListener("click", () => {
      uploadedFile.style.cssText = "display: none;";
      fileInput.value = '';
      uploadIcon.innerHTML = 'file_upload';
      dragDropText.innerHTML = 'Drag & drop any file here';
      document.querySelector(".label").innerHTML = `or <span class="browse-files"> <input type="file" class="default-file-input"/> <span class="browse-files-text">browse file</span> <span>from device</span> </span>`;
      uploadButton.innerHTML = `Upload`;
    });


    let timer;

    document.addEventListener('input', e => {
      const el = e.target;

      if (el.matches('[data-color]')) {
        clearTimeout(timer);
        timer = setTimeout(() => {
          document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
        }, 100)
      }
    })
    // Design By
    // - https://dribbble.com/shots/13992184-File-Uploader-Drag-Drop

    // Select Upload-Area
    const uploadArea = document.querySelector('#uploadArea')

    // Select Drop-Zoon Area
    const dropZoon = document.querySelector('#dropZoon');

    // Loading Text
    const loadingText = document.querySelector('#loadingText');

    // Slect File Input 
    const fileInput1 = document.querySelector('#fileInput1');

    // Select Preview Image
    const previewImage = document.querySelector('#previewImage');

    // File-Details Area
    const fileDetails = document.querySelector('#fileDetails');

    // Uploaded File
    const uploadedFile1 = document.querySelector('#uploadedFile1');

    // Uploaded File Info
    const uploadedFileInfo = document.querySelector('#uploadedFileInfo');

    // Uploaded File  Name
    const uploadedFileName = document.querySelector('.uploaded-file__name');

    // Uploaded File Icon
    const uploadedFileIconText = document.querySelector('.uploaded-file__icon-text');

    // Uploaded File Counter
    const uploadedFileCounter = document.querySelector('.uploaded-file__counter');

    // ToolTip Data
    const toolTipData = document.querySelector('.upload-area__tooltip-data');

    // Images Types
    const imagesTypes = [
      "jpeg",
      "png",
      "svg",
      "gif"
    ];

    // Append Images Types Array Inisde Tooltip Data
    toolTipData.innerHTML = [...imagesTypes].join(', .');

    // When (drop-zoon) has (dragover) Event 
    dropZoon.addEventListener('dragover', function(event) {
      // Prevent Default Behavior 
      event.preventDefault();

      // Add Class (drop-zoon--over) On (drop-zoon)
      dropZoon.classList.add('drop-zoon--over');
    });

    // When (drop-zoon) has (dragleave) Event 
    dropZoon.addEventListener('dragleave', function(event) {
      // Remove Class (drop-zoon--over) from (drop-zoon)
      dropZoon.classList.remove('drop-zoon--over');
    });

    // When (drop-zoon) has (drop) Event 
    dropZoon.addEventListener('drop', function(event) {
      // Prevent Default Behavior 
      event.preventDefault();

      // Remove Class (drop-zoon--over) from (drop-zoon)
      dropZoon.classList.remove('drop-zoon--over');

      // Select The Dropped File
      const file = event.dataTransfer.files[0];

      // Call Function uploadFile(), And Send To Her The Dropped File :)
      uploadFile(file);
    });

    // When (drop-zoon) has (click) Event 
    dropZoon.addEventListener('click', function(event) {
      // Click The (fileInput)
      fileInput1.click();
    });

    // When (fileInput) has (change) Event 
    fileInput1.addEventListener('change', function(event) {
      // Select The Chosen File
      const file = event.target.files[0];

      // Call Function uploadFile(), And Send To Her The Chosen File :)
      uploadFile(file);
    });

    // Upload File Function
    function uploadFile(file) {
      // FileReader()
      const fileReader = new FileReader();
      // File Type 
      const fileType = file.type;
      // File Size 
      const fileSize = file.size;

      // If File Is Passed from the (File Validation) Function
      if (fileValidate(fileType, fileSize)) {
        // Add Class (drop-zoon--Uploaded) on (drop-zoon)
        dropZoon.classList.add('drop-zoon--Uploaded');

        // Show Loading-text
        loadingText.style.display = "block";
        // Hide Preview Image
        previewImage.style.display = 'none';

        // Remove Class (uploaded-file--open) From (uploadedFile)
        uploadedFile1.classList.remove('uploaded-file--open');
        // Remove Class (uploaded-file__info--active) from (uploadedFileInfo)
        uploadedFileInfo.classList.remove('uploaded-file__info--active');

        // After File Reader Loaded 
        fileReader.addEventListener('load', function() {
          // After Half Second 
          setTimeout(function() {
            // Add Class (upload-area--open) On (uploadArea)
            uploadArea.classList.add('upload-area--open');

            // Hide Loading-text (please-wait) Element
            loadingText.style.display = "none";
            // Show Preview Image
            previewImage.style.display = 'block';

            // Add Class (file-details--open) On (fileDetails)
            fileDetails.classList.add('file-details--open');
            // Add Class (uploaded-file--open) On (uploadedFile)
            uploadedFile1.classList.add('uploaded-file--open');
            // Add Class (uploaded-file__info--active) On (uploadedFileInfo)
            uploadedFileInfo.classList.add('uploaded-file__info--active');
          }, 500); // 0.5s

          // Add The (fileReader) Result Inside (previewImage) Source
          previewImage.setAttribute('src', fileReader.result);

          // Add File Name Inside Uploaded File Name
          uploadedFileName.innerHTML = file.name;

          // Call Function progressMove();
          progressMove();
        });

        // Read (file) As Data Url 
        fileReader.readAsDataURL(file);
      } else { // Else

        this; // (this) Represent The fileValidate(fileType, fileSize) Function

      };
    };

    // Progress Counter Increase Function
    function progressMove() {
      // Counter Start
      let counter = 0;

      // After 600ms 
      setTimeout(() => {
        // Every 100ms
        let counterIncrease = setInterval(() => {
          // If (counter) is equle 100 
          if (counter === 100) {
            // Stop (Counter Increase)
            clearInterval(counterIncrease);
          } else { // Else
            // plus 10 on counter
            counter = counter + 10;
            // add (counter) vlaue inisde (uploadedFileCounter)
            uploadedFileCounter.innerHTML = `${counter}%`
          }
        }, 100);
      }, 600);
    };


    // Simple File Validate Function
    function fileValidate(fileType, fileSize) {
      // File Type Validation
      let isImage = imagesTypes.filter((type) => fileType.indexOf(`image/${type}`) !== -1);

      // If The Uploaded File Type Is 'jpeg'
      if (isImage[0] === 'jpeg') {
        // Add Inisde (uploadedFileIconText) The (jpg) Value
        uploadedFileIconText.innerHTML = 'jpg';
      } else { // else
        // Add Inisde (uploadedFileIconText) The Uploaded File Type 
        uploadedFileIconText.innerHTML = isImage[0];
      };

      // If The Uploaded File Is An Image
      if (isImage.length !== 0) {
        // Check, If File Size Is 2MB or Less
        if (fileSize <= 2000000) { // 2MB :)
          return true;
        } else { // Else File Size
          return alert('Please Your File Should be 2 Megabytes or Less');
        };
      } else { // Else File Type 
        return alert('Please make sure to upload An Image File Type');
      };
    };



   // const fileInput = document.getElementById('fileInput1');

    fileInput.addEventListener('change', function() {
      const files = fileInput.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];

        const uploadedFile = document.createElement('div');
        uploadedFile.classList.add('uploaded-file');

        const iconContainer = document.createElement('div');
        iconContainer.classList.add('uploaded-file__icon-container');

        const icon = document.createElement('i');
        icon.classList.add('bx', 'bxs-file-blank', 'uploaded-file__icon');

        const iconText = document.createElement('span');
        iconText.classList.add('uploaded-file__icon-text');
        iconText.textContent = file.name;

        iconContainer.appendChild(icon);
        iconContainer.appendChild(iconText);

        const fileInfo = document.createElement('div');
        fileInfo.classList.add('uploaded-file__info');

        const fileName = document.createElement('span');
        fileName.classList.add('uploaded-file__name');
        fileName.textContent = file.name;

        const fileCounter = document.createElement('span');
        fileCounter.classList.add('uploaded-file__counter');
        fileCounter.textContent = '0%';

        const closeButton = document.createElement('button');
        closeButton.classList.add('uploaded-file__close-button');
        closeButton.textContent = 'Close';
        closeButton.addEventListener('click', function() {
          uploadedFile.remove();
        });

        fileInfo.appendChild(fileName);
        fileInfo.appendChild(fileCounter);
        fileInfo.appendChild(closeButton);

        uploadedFile.appendChild(iconContainer);
        uploadedFile.appendChild(fileInfo);

        document.getElementById('fileDetails').appendChild(uploadedFile);
      }
    });