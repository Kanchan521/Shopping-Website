
var link =document.querySelector('#category');
var form =document.querySelector('form');
var fbtn=form.querySelector('#form-btn');
var myInput=form.querySelector('#exampleInputEmail1').value;
link.onclick=(()=>{
 document.querySelector('.form-container').style.display='block';
})

fbtn.onclick=(()=>{
    if(myInput ==""){
       return;
    }else{
        document.querySelector('.form-container').style.display='none';
   
    }
})