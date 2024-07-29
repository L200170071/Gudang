$(document).ready(function(){
    tampil_data(1); 
});

//menampilkan data
function tampil_data(pages){
    // var nama = encodeURI(document.querySelector('[id="sech"]').value);	
    $("#tampil_data").load("../../controllers/Keluar.php/index/");
}