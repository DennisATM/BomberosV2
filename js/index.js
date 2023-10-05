function htmlExcel(idTabla, nombreArchivo = '') {
    let linkDescarga;
    let tipoDatos = 'application/vnd.ms-excel' + ';charset=utf-8';
    let tablaDatos = document.getElementById(idTabla);
    let tablaHTML = tablaDatos.outerHTML.replace(/ /g, '%20');
  
    // Nombre del archivo
    nombreArchivo = nombreArchivo ? nombreArchivo + '.xls' : 'Reporte_Bomberos.xls';
  
    // Crear el link de descarga
    linkDescarga = document.createElement("a");
  
    document.body.appendChild(linkDescarga);
  
    if (navigator.msSaveOrOpenBlob) {
      let blob = new Blob(['\ufeff', tablaHTML], {
        type: tipoDatos
      });
      navigator.msSaveOrOpenBlob(blob, nombreArchivo);
    } else {
      // Crear el link al archivo
      linkDescarga.href = 'data:' + tipoDatos + ', ' + tablaHTML;
  
      // Setear el nombre de archivo
      linkDescarga.download = nombreArchivo;
  
      //Ejecutar la función
      linkDescarga.click();
    }
  }

function notif(key,id){
    
    url = 'https://xdroid.net/api/message?k='+key+'&t=Alerta%20de%20nueva%20Emergencia&c='+id+'&u=https://bomberosretiro.cl';
    // url = 'https://api.simplepush.io/send/cWiqKy/Alerta%20de%20Emergencia/Se%20registro%20una%20nueva%20emergencia';
    fetch(url,{
        method: 'POST',
        mode: 'no-cors', // no-cors, *cors, same-origin
        headers: {
             'Content-Type': 'application/json'
             //'Content-Type': 'application/x-www-form-urlencoded',
          },

    })
   
}