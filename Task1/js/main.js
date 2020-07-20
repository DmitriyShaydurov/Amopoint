function loadFile(event) {
    event.preventDefault();
    
    let myFile = document.getElementById('modelFile');
    let url = 'scripts/main.php?';
    let statusP = document.getElementById('status');

    let files = myFile.files;
    let formData = new FormData();
    let file = files[0];

    if (files[0]) {
        statusP.innerHTML = 'Загрузка...';
    } else {
        statusP.innerHTML = 'файл не выбран';
        document.getElementById("info-dot").style.backgroundColor = 'red';
        return;
    }

    formData.append('fileAjax', file, file.name);
    // Set up the request
    let xhr = new XMLHttpRequest();

    // Open the connection
    xhr.open('POST', url , true);

    // Set up a handler for when the task for the request is complete
    xhr.onload = function () {
      if (xhr.status == 200) {
        let return_data =  JSON.parse(xhr.responseText);
        let uls = '';
        document.getElementById("array-output").innerHTML = uls;
        statusP.innerHTML =  return_data.info;
        
        document.getElementById("info-dot").style.backgroundColor = (return_data.info !== 'Загрузка прошла успешно') ? 'red' : 'green';

        for (i = 0; i < return_data.results.length; i++) {
          uls += '<li class="list-group-item text-center">' + return_data.results[i].line + '=' +  return_data.results[i].length + '</li>';
          document.getElementById("array-output").innerHTML = uls;
        }
      } else {
        statusP.innerHTML = 'Загрузка не завершена. Попробуйте еще раз';
      }
      
    };
    xhr.send(formData);
}