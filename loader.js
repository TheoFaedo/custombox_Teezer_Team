const loader = document.getElementsByClassName('loader');
const load = document.getElementsByClassName('load');
const box = document.getElementsByClassName('box');

window.addEventListener('load', () => {

    console.log('Loading...');
    
    setTimeout( function(){
        
        load[0].style.animation = 'transparent ease 0.5s forwards';
        load[1].style.animation = 'transparent ease 0.5s forwards';
        load[2].style.animation = 'transparent ease 0.5s forwards';
        
        setTimeout( function(){
            loader[0].remove();
            box[0].style.animation = 'apparaitre ease 0.5s forwards';
        }, 500);
        
        console.log('load');

    },500);

})