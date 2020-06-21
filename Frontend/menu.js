
const selectElement = function(element){
    return document.querySelector(element);  
};

let wrapper = selectElement('.wrapper');
let body = selectElement('body');

let map = selectElement('.map');

wrapper.addEventListener('click', function() {
    body.classList.toggle('close');

});

  
    
    

