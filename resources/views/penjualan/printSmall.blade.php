<style is="custom-style">
    paper-progress {
      width: 100%;
    }
    paper-progress.blue {
      paper-progress-active-color: var(--paper-light-blue-500);
      paper-progress-secondary-color: var(--paper-light-blue-100);
    }
    paper-slider {
      width: 100%;
    }
    paper-slider.blue {
      paper-slider-active-color: var(--paper-light-blue-500);
      paper-slider-knob-color: var(--paper-light-blue-500);
    }
    paper-button {
      display: block;
      margin-bottom: 2px;
    }
    paper-button.colorful {
      color: #4285f4;
    }
    paper-button[raised].colorful {
      background: #4285f4;
      color: #fff;
    }
    paper-button.blue {
      color: var(--paper-light-blue-500);
      paper-button-flat-focus-color: var(--paper-light-blue-50);
    }
    body {
      background-color: var(--paper-grey-50);
    }
    #cards {
      margin-left: auto;
      margin-right: auto;
      max-width: 400px;
    }
    paper-card {
      margin-bottom: 5px;
      margin-top: 5px;
      width: 100%;
    }
    paper-card#logo {
      @apply(--layout-vertical);
      @apply(--layout-center);
    }
  </style>

<div id="cards">
    <paper-card heading="Bluetooth Printer">
      <div class="card-content">
        <paper-progress id="progress" indeterminate></paper-progress>
      </div>
    </paper-card>

    <paper-card id="logo">
      <div class="card-content">
        <image id="image" src="data:image/png;base64,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" width="200px"></image>
      </div>
    </paper-card>

    <paper-card>
      <div class="card-content">
        <paper-textarea id="message" label="Enter Message"></paper-textarea>
      </div>
    </paper-card>

    <paper-card>
      <div class="card-content">
        <paper-button id="print" raised class="colorful">Print</paper-button>
      </div>
    </paper-card>

    <paper-dialog id="dialog">
      <h2>Error</h2>
      <p>Could not connect to bluetooth device!</p>
    </paper-dialog>
  </div>

  <script>
    'use strict';
    document.addEventListener('WebComponentsReady', function() {
      let progress = document.querySelector('#progress');
      let dialog = document.querySelector('#dialog');
      let message = document.querySelector('#message');
      let printButton = document.querySelector('#print');
      let printCharacteristic;
      let index = 0;
      let data;
      progress.hidden = true;

      let image = document.querySelector('#image');
      // Use the canvas to get image data
      let canvas = document.createElement('canvas');
      // Canvas dimensions need to be a multiple of 40 for this printer
      canvas.width = 120;
      canvas.height = 120;
      let context = canvas.getContext("2d");
      context.drawImage(image, 0, 0, canvas.width, canvas.height);
      let imageData = context.getImageData(0, 0, canvas.width, canvas.height).data;

      function getDarkPixel(x, y) {
        // Return the pixels that will be printed black
        let red = imageData[((canvas.width * y) + x) * 4];
        let green = imageData[((canvas.width * y) + x) * 4 + 1];
        let blue = imageData[((canvas.width * y) + x) * 4 + 2];
        return (red + green + blue) > 0 ? 1 : 0;
      }

      function getImagePrintData() {
        if (imageData == null) {
          console.log('No image to print!');
          return new Uint8Array([]);
        }
        // Each 8 pixels in a row is represented by a byte
        let printData = new Uint8Array(canvas.width / 8 * canvas.height + 8);
        let offset = 0;
        // Set the header bytes for printing the image
        printData[0] = 29;  // Print raster bitmap
        printData[1] = 118; // Print raster bitmap
        printData[2] = 48; // Print raster bitmap
        printData[3] = 0;  // Normal 203.2 DPI
        printData[4] = canvas.width / 8; // Number of horizontal data bits (LSB)
        printData[5] = 0; // Number of horizontal data bits (MSB)
        printData[6] = canvas.height % 256; // Number of vertical data bits (LSB)
        printData[7] = canvas.height / 256;  // Number of vertical data bits (MSB)
        offset = 7;
        // Loop through image rows in bytes
        for (let i = 0; i < canvas.height; ++i) {
          for (let k = 0; k < canvas.width / 8; ++k) {
            let k8 = k * 8;
            //  Pixel to bit position mapping
            printData[++offset] = getDarkPixel(k8 + 0, i) * 128 + getDarkPixel(k8 + 1, i) * 64 +
                        getDarkPixel(k8 + 2, i) * 32 + getDarkPixel(k8 + 3, i) * 16 +
                        getDarkPixel(k8 + 4, i) * 8 + getDarkPixel(k8 + 5, i) * 4 +
                        getDarkPixel(k8 + 6, i) * 2 + getDarkPixel(k8 + 7, i);
          }
        }
        return printData;
      }

      function handleError(error) {
        console.log(error);
        progress.hidden = true;
        printCharacteristic = null;
        dialog.open();
      }

      function sendNextImageDataBatch(resolve, reject) {
        // Can only write 512 bytes at a time to the characteristic
        // Need to send the image data in 512 byte batches
        if (index + 512 < data.length) {
          printCharacteristic.writeValue(data.slice(index, index + 512)).then(() => {
            index += 512;
            sendNextImageDataBatch(resolve, reject);
          })
          .catch(error => reject(error));
        } else {
          // Send the last bytes
          if (index < data.length) {
            printCharacteristic.writeValue(data.slice(index, data.length)).then(() => {
              resolve();
            })
            .catch(error => reject(error));
          } else {
            resolve();
          }
        }
      }

      function sendImageData() {
        index = 0;
        data = getImagePrintData();
        return new Promise(function(resolve, reject) {
          sendNextImageDataBatch(resolve, reject);
        });
      }

      function sendTextData() {
        // Get the bytes for the text
        let encoder = new TextEncoder("utf-8");
        // Add line feed + carriage return chars to text
        let text = encoder.encode(message.value + '\u000A\u000D');
        return printCharacteristic.writeValue(text).then(() => {
          console.log('Write done.');
        });
      }

      function sendPrinterData() {
        // Print an image followed by the text
        sendImageData()
        .then(sendTextData)
        .then(() => {
          progress.hidden = true;
        })
        .catch(handleError);
      }

      printButton.addEventListener('click', function () {
        progress.hidden = false;
        if (printCharacteristic == null) {
          navigator.bluetooth.requestDevice({
            filters: [{
              services: ['000018f0-0000-1000-8000-00805f9b34fb']
            }]
          })
          .then(device => {
            console.log('> Found ' + device.name);
            console.log('Connecting to GATT Server...');
            return device.gatt.connect();
          })
          .then(server => server.getPrimaryService("000018f0-0000-1000-8000-00805f9b34fb"))
          .then(service => service.getCharacteristic("00002af1-0000-1000-8000-00805f9b34fb"))
          .then(characteristic => {
            // Cache the characteristic
            printCharacteristic = characteristic;
            sendPrinterData();
          })
          .catch(handleError);
        } else {
          sendPrinterData();
        }
      });
    });
  </script>