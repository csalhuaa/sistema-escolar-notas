const imagenes=document.querySelectorAll('.imagen_galeria')
const imagenLight=document.querySelector('.agregar-imagen')
const contendorLight=document.querySelector('.imagen_light')

imagenes.forEach(imagen=>{
    imagen.addEventListener('click', ()=>{

        aparecerImagen(imagen.getAttribute('src'))
    })
})

contendorLight.addEventListener('click',(e)=>{
    if(e.target !==imagenLight){
        contendorLight.classList.toggle('show')
        imagenLight.classList.toggle('showImage')
    }
})

const aparecerImagen =(imagen)=>{
    imagenLight.src=imagen;
    contendorLight.classList.toggle('show')
    imagenLight.classList.toggle('showImage')
}
window.addEventListener("scroll", function() {
    var menu = document.querySelector(".menu");
    if (!document.body.classList.contains('lightbox-active')) {
        menu.classList.toggle("abajo", window.scrollY > 0);
    }
});