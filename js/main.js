const navitems =document.querySelector('.nav_items');
const opennav =document.querySelector('#open_nav');
const closenav =document.querySelector('#close_nav');


const openit=()=>{

    navitems.style.display ='flex';
    opennav.style.display='none';
    closenav.style.display='inline-block';

}

const closeit = () =>{

    navitems.style.display='none';
    closenav.style.display='none';
    opennav.style.display='flex';

}


opennav.addEventListener('click',openit);
closenav.addEventListener('click',closeit);